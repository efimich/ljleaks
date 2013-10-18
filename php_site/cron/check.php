<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

include("servfunc.php");
include("../config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$query =" SELECT id, link, status_code, date_checked FROM ljdump ";
$query.=" WHERE (date_checked IS NULL) ";
$query.=" AND ( DATE_ADD(date, INTERVAL 4 HOUR) < DATE_SUB(NOW(),INTERVAL 2 HOUR) ) ";
$query.=" ORDER BY id DESC LIMIT 1000";


$res=mysql_query($query); 


$LIST=array(); 
while($row=mysql_fetch_assoc($res)) $LIST[]=$row; 
$total=count($LIST);


include("check_page.php");

?>
