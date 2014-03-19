<?

function lang_check($string) {

    if ( preg_match('/[а-яА-Я]+/ui',$string) ){
        // ok, its russian
        return 0;
    };

    return 1;
};

function unhtmlspecialchars($string){
    $string = str_replace ( '&amp;', '&', $string );
    $string = str_replace ( '&#039;', '\'', $string );
    $string = str_replace ( '&quot;', '\"', $string );
    $string = str_replace ( '&lt;', '<', $string );
    $string = str_replace ( '&gt;', '>', $string );
         
    return $string;
};


function prepare_content($rowid, $link, $content) {

    $content = unhtmlspecialchars($content);
    $content = stripslashes($content);
    $content = nl2br($content);

    $p=stripos($content,"<lj-cut");
    if ( $p>0 ){
        $replace = "<a target=\"_blank\" href=\"$link#cutid1\">( Read more )</a>";
        $content=substr($content,0,$p).$replace;
    } else {
        
        // do not cut post if contain table tag
        if ( stripos($content,"<table") !== FALSE) {
            return $content;
        };

        $CUTON = 3000;
        $BIGLEN = 5000;
        if (strlen($content) > $BIGLEN){
            $pos = strpos($content, "\n", $CUTON);
            if ($pos == FALSE){ $pos = $CUTON; };
            $replace = "\n".'<br/><a target="_blank" href="/show.php?id='.$rowid.'">( Read more )</a>';
            $content=substr($content,0,$pos).$replace;
        };

    };


    #
    # todo
    # replace links with nofollow
    #

    return $content;
};


function prepare_content_full($content) {

    $content = unhtmlspecialchars($content);
    $content = stripslashes($content);
    $content = nl2br($content);

    return $content;
};

function prepare_content2($rowid, $link, $content) {

    $content = unhtmlspecialchars($content);
    $content = stripslashes($content);
    $content = nl2br($content);

    $p=stripos($content,"<lj-cut");
    if ( $p>0 ){
        $replace = "<a target=\"_blank\" href=\"$link#cutid1\">( Read more )</a>";
        $content=substr($content,0,$p).$replace;
    };

    return $content;
};

function prepare_content3($rowid, $link, $content) {

    $content = unhtmlspecialchars($content);
    $content = stripslashes($content);
    $content = nl2br($content);

    $p=stripos($content,"<lj-cut");
    if ( $p>0 ){
        $replace = "\n".'<br/><a target="_blank" href="/show.php?id='.$rowid.'">( Read more )</a>';
        $content=substr($content,0,$p).$replace;
    };

    return $content;
};


?>
