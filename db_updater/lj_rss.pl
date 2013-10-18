#!/usr/bin/perl

#
# save to file with name as timestamp
# wget http://www.livejournal.com/stats/latest-rss.bml -O 1109851813.bml 
#

$folder="./data/";
mkdir($folder);

$cmd = "wget -nv http://www.livejournal.com/stats/latest-rss.bml";
while(1){

  # sleep for 5 sec
  sleep(5);

  $unxtime=time();
  $run=$cmd." -O ".$folder.$unxtime.".bml";

  print "Running $run\n";
  system($run);

};

