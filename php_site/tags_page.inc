<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ljleaks.ru</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>

<center><h1>LiveJournal Leaks</h1></center>
<center>[ <a href="/">main</a> ]</center>
<center><h3>Tags</h3></center>

<br/>
<br/>

<table align="center" width="80%">
<tr><td>

<table width="100%" border="1">

<tr>
<td>Автор</td><td>Дата</td><td width="40%">Теги</td><td width="40%">Тема</td>
</tr>

<?
foreach ($LIST as $row) {

$link=$row['link'];

echo "<tr>\n";


//echo "<td>".$row['id']."</td>";
echo "<td><a rel=\"nofollow\" href=\"$link\">".$link."</a>"."</td>";
echo "<td>".$row['date']."</td>";

$n_tags = $row['n_tags'];
$n_tags = str_replace(",",", ",$n_tags);
echo "<td>".$n_tags."&nbsp;</td>";

$title=$row['title'];
$title = unhtmlspecialchars($title);
$title = stripslashes($title);
echo "<td>".$title."&nbsp;</td>";

echo "</tr>\n";

};
?>

</td></tr>
</table>
<br/>


<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<? include("metrika.php"); ?>
<? include("debug.php"); ?>

</body>
</html>
