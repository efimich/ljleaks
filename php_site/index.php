<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

include("func.php");
include("config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


//$query =" SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED; ";
//$res=mysql_query($query); 


$query =" SELECT count(*) as num FROM ljoper  ";
$query.=" WHERE date > DATE_SUB(NOW(),INTERVAL 4 HOUR) ";

$msc1=microtime(true);
$res=mysql_query($query); 
$msc1=microtime(true)-$msc1;
$row=mysql_fetch_assoc($res);
$num_q=$row["num"];


$fullpost = (isset($_GET['full'])) ? $_GET['full'] : 1;


$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$startPoint = $page - 1;
$startPoint = $startPoint*20;

$query =" SELECT id, uniq, link, DATE_ADD(date, INTERVAL 4 HOUR) as date, ";
$query.=" title, content, n_tags FROM ljoper ";
$query.=" WHERE date > DATE_SUB(NOW(),INTERVAL 4 HOUR) ";
$query.=" ORDER BY id DESC ";
$query.=" LIMIT $startPoint,20 ";

$msc2=microtime(true);
$res=mysql_query($query); 
$msc2=microtime(true)-$msc2;

$LIST=array(); 
while($row=mysql_fetch_assoc($res)) $LIST[]=$row; 

mysql_free_result($res);
mysql_close($conn);

include("index_table.php");

?>
