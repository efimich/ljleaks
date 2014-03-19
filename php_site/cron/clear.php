<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

include("../config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$query =" DELETE FROM ljoper ";
$query.=" WHERE date < DATE_SUB(NOW(), INTERVAL 28 HOUR) ";


$res=mysql_query($query); 

$deleted = mysql_affected_rows();

mysql_free_result($res);
mysql_close($conn);

?>
<html>
<center>OK</center>
<center>Records deleted: <? echo $deleted ?></center>
</html>
