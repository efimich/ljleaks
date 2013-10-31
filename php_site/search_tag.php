<?php

include("func.php");
include("config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$tag=$_GET["tag"];

if (strlen($tag) == 0){
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
$query.=" AND ( n_tags like \"%$tag%\" ) ";
$query.=" ORDER BY id DESC";
$query.=" LIMIT $startPoint,20 ";


$msc2=microtime(true);
$res=mysql_query($query); 
$msc2=microtime(true)-$msc2;


$LIST=array(); 
while($row=mysql_fetch_assoc($res)) $LIST[]=$row; 

if ($h==24){
    $query =" SELECT count(*) as num FROM ljoper ";
    $query.=" WHERE ( DATE_ADD(date,INTERVAL 4 HOUR) > DATE_SUB(NOW(),INTERVAL $h HOUR) ) ";
    $query.=" AND ( n_tags like \"%$tag%\" ) ";

    $res=mysql_query($query); 

    $tmp=mysql_fetch_assoc($res);
    $num_q=$tmp["num"];

} else {
    $num_q=count($LIST);
};

mysql_free_result($res);
mysql_close($conn);

include("search_tag_table.php");

?>
