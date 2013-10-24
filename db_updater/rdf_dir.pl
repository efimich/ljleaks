#!/usr/bin/perl

use POSIX qw( strftime );
use XML::Bare;
use DBI;
use strict;
use warnings;


my ($mmddyy);
my ($DIRNAME, $FILTER);
my ($i, $f, $posts, $cnt);


$mmddyy = strftime("%Y-%d-%m %H:%M:%S", localtime);

# settings
$DIRNAME = "data_log";
$FILTER = ".bml";

print "Script started at: $mmddyy for db update\n";

# main loop
$i=0;
$posts=0;
opendir(DIR,"./$DIRNAME/") || die "Directory not found.\n";
while($f=readdir(DIR)){
    if ($f=~ /.$FILTER/){
        $cnt = &parse_rdf_xml("$DIRNAME/$f");
        $posts = $posts + $cnt;
        $i++;
    };
};
close(DIR);

print "Total files processed: $i\n";
print "Total posts saved: $posts\n";
print "Script ended.\n";


exit(0);



#
# Parse LiveJournal RDF file routine (process one bml file)
#
sub parse_rdf_xml($) {

    my ($ob, $root);
    my ($dbh, $sth, $sth2);
    my ($xmlfile);
    my ($rootval, $val);
    my ($ins, $i, $tag);
    my ($uniq, $link, $date, $title, $content, $n_tags);


    $xmlfile = $_[0];


    $ob = new XML::Bare( file => $xmlfile );
    $root = $ob->parse() or die "Parse xml file failed\n";

    print "Parse file $xmlfile ...\n";

    $dbh = DBI->connect( 'DBI:mysql:ljleaks_db',
                     'ljleaks_sql','XXXXXXXX',
            { AutoCommit => 1, PrintError => 0 }
    ) || die "Could not connect to database: $DBI::errstr \n";


    $sth = $dbh->prepare(q{
        INSERT INTO ljdump (uniq, link, date, title, content, n_tags)
        VALUES (?,?,?,?,?,?)
    }) or die $dbh->errstr;

    $sth2 = $dbh->prepare(q{
        INSERT INTO ljoper (uniq, link, date, title, content, n_tags)
        VALUES (?,?,?,?,?,?)
    }) or die $dbh->errstr;


    # journal xml parsing
    $i=0;
    $ins=0;
    foreach $rootval ( @{$root->{"rdf:RDF"}->{item}} ) {
        $i++;

        $uniq      = $rootval->{"rdf:about"}->{value};
        $content   = $rootval->{description}->{value};
        $link      = $rootval->{link}->{value};
        $title     = $rootval->{"dc:title"}->{value};
        $date      = $rootval->{"dc:date"}->{value};

        $n_tags="";
        if (ref($rootval->{category}) eq "ARRAY" ){
            foreach $val ( @{$rootval->{category}} ) {
                $tag="";
                $tag=$val->{value};
                if ($tag=~ /,/){
                    #print "Oops. Tags should not contain comma.\n";
                    $tag="";
                };
                $n_tags.=$tag.",";
            };
            chop($n_tags);
        } else {
            $n_tags = $rootval->{category}->{value};
        };

        if (!defined($date)) {$date = "";};
    
        if ($date ne ""){
            $date =~ s/T/ /g;
            $date =~ s/Z/ /g;
        };

        if (0){
            print "Uniq: ".$uniq."\n";
            print "Link: ".$link."\n";
            print "Date: ".$date."\n";
            print "Title: ".$title."\n";
            print "Tags: ".$n_tags."\n";
            #print "CONTENT:\n".$content."\n";
            print "==============\n";
        };
    
        # insert to mysql
        if ( $sth->execute($uniq, $link, $date, $title, $content, $n_tags) ){
            $ins++;
        };
    
        $sth2->execute($uniq, $link, $date, $title, $content, $n_tags);


    };
    $dbh->disconnect();

    print "Parsed $i elements\n";
    print "Inserted $ins elements\n";

    return $ins;
};
