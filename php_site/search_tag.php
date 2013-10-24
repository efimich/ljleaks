<?php

include("func.php");
include("config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$text=$_GET["tag"];

if (strlen($text) == 0){
    echo "Nothing to find, no search tag provided.\n";
    return 0;
};

$period = $_GET["period"];

$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$startPoint = $page - 1;
$startPoint = $startPoint*20;

$h = 1;
if ($period == "day"){
    $h = 24;
};

$query =" SELECT id, uniq, link, DATE_ADD(date,INTERVAL 4 HOUR) as date, ";
$query.=" title, content, n_tags FROM ljoper  ";
$query.=" WHERE ( DATE_ADD(date,INTERVAL 4 HOUR) > DATE_SUB(NOW(),INTERVAL $h HOUR) ) ";
$query.=" AND ( n_tags like \"%$text%\" ) ";
$query.=" ORDER BY id DESC";
$query.=" LIMIT $startPoint,20 ";


$msc2=microtime(true);
$res=mysql_query($query); 
$msc2=microtime(true)-$msc2;


$LIST=array(); 
while($row=mysql_fetch_assoc($res)) $LIST[]=$row; 

$num_q=count($LIST);

mysql_free_result($res);
mysql_close($conn);

include("search_tag_table.php");

?>
