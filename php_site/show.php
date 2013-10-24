<?php

include("func.php");
include("config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

mysql_select_db($dbname);

$reqid = intval( $_GET["id"] );

if ($reqid <= 0){
    echo "Nothing to show, no post id provided.\n";
    return 0;
};

$query =" SELECT id, uniq, link, DATE_ADD(date,INTERVAL 4 HOUR) as date, ";
$query.=" title, content, n_tags FROM ljoper  ";
$query.=" WHERE id = $reqid ";

$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);

mysql_free_result($res);
mysql_close($conn);

include("show_table.php");

?>
