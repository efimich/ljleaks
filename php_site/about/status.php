<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

include("../config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$query =" SELECT count(*) as num FROM ljoper ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$totaloper=$row["num"];

$query =" SELECT count(*) as num FROM ljdump ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$totaldump=$row["num"];


mysql_free_result($res);
mysql_close($conn);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ljleaks.ru</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<center><h1>LiveJournal Leaks</h1></center>
<center>[ <a href="/">main</a> ]</center>
<br/>
<br/>
<center>Записей в оперативной базе: <? echo $totaloper; ?> </center>
<center>В полной базе: <? echo $totaldump; ?> </center>
<br/>
<br/>
<br/>
<br/>


</body>
</html>
