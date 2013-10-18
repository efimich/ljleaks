<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

include("func.php");
include("config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$query =" SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED; ";
$res=mysql_query($query); 


/*
$query =" SELECT count(*) as num FROM ljdump  ";
$query.=" WHERE date > DATE_SUB(NOW(),INTERVAL 5 HOUR) ";

$msc1=microtime(true);
$res=mysql_query($query); 
$msc1=microtime(true)-$msc1;
$row=mysql_fetch_assoc($res);
$num_q=$row["num"];
*/


$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$startPoint = $page - 1;
$startPoint = $startPoint*20;

$query =" SELECT id, uniq, link, DATE_ADD(date, INTERVAL 4 HOUR) as date, ";
$query.=" title, content, n_tags FROM ljdump ";
$query.=" WHERE date > DATE_SUB(NOW(),INTERVAL 5 HOUR) ";
$query.=" ORDER BY date DESC ";
$query.=" LIMIT $startPoint,20 ";


$msc2=microtime(true);
$res=mysql_query($query); 
$msc2=microtime(true)-$msc2;

$LIST=array(); 
while($row=mysql_fetch_assoc($res)) $LIST[]=$row; 

mysql_free_result($res);
mysql_close($conn);

include("index_table.inc");

?>
