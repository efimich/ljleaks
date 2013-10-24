<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

include("func.php");
include("config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$query =" SELECT date, n_tags FROM ljoper ";
$query.=" WHERE ( date > DATE_SUB(NOW(),INTERVAL 5 HOUR) ) ";
$query.=" AND ( n_tags IS NOT NULL ) ";


$msc2=microtime(true);
$res=mysql_query($query); 
$msc2=microtime(true)-$msc2;


$LIST=array(); 
while($row=mysql_fetch_assoc($res)) $LIST[]=$row; 

$total=count($LIST);

mysql_free_result($res);
mysql_close($conn);

include("trends_page.php");

?>
