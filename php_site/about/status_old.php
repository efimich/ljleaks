<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

include("../config.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);


$query =" SELECT count(*) as num FROM ljoper ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$total=$row["num"];

/*

$query =" SELECT count(*) as num FROM ljoper ";
$query.=" WHERE (date_checked IS NULL) ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$unchecked=$row["num"];

$query =" SELECT count(*) as num FROM ljoper ";
$query.=" WHERE (date_checked IS NOT NULL) ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$checked=$row["num"];


$query =" SELECT count(*) as num FROM ljoper ";
$query.=" WHERE (status_code = 200) ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$code200=$row["num"];

$query =" SELECT count(*) as num FROM ljoper ";
$query.=" WHERE (status_code = 404) ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$code404=$row["num"];

$query =" SELECT count(*) as num FROM ljoper ";
$query.=" WHERE (status_code = 302) ";
$res=mysql_query($query); 
$row=mysql_fetch_assoc($res);
$code302=$row["num"];
*/


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
<center>Всего записей: <? echo $total; ?> </center>
<br/>
<center>Проверено записей: <? echo $checked; ?> </center>
<center>Осталось проверить: <? echo $unchecked; ?> </center>
<br/>
<br/>
<center>Записей с кодом 200: <? echo $code200; ?> </center>
<center>Записей с кодом 404: <? echo $code404; ?> </center>
<center>Записей с кодом 302: <? echo $code302; ?> </center>
<br/>
<br/>


</body>
</html>
