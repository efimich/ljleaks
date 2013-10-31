<?php

include("func.php");
include("config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);

$query =" SELECT id, uniq, link, DATE_ADD(date,INTERVAL 4 HOUR) as date, ";
$query.=" title, content, n_tags FROM ljoper  ";
$query.=" WHERE ( date > DATE_SUB(NOW(),INTERVAL 5 HOUR) ) ";
$query.=" AND ( n_tags IS NOT NULL ) ";
$query.=" ORDER BY id DESC";

$res=mysql_query($query); 

$LIST=array(); 
while($row=mysql_fetch_assoc($res)) $LIST[]=$row; 

mysql_free_result($res);
mysql_close($conn);

include("tags_page.php");

?>
