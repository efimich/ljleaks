<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ljleaks.ru</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
</head>
<body>

<center><h1>LiveJournal Leaks</h1></center>
<center>[ <a href="/">main</a> ]</center>
<center><h3>Search by tag "<? echo $text; ?>"</h3></center>
<br/>
<center>Добавлено записей по тегу за последний час: <? echo $num_q; ?></center>
<center>Поиск за <a href="?tag=<? echo $text; ?>&period=day">день</a>.</center>
<br/>
<center>
<form action="" method="GET">
<input type="text" name="tag" value="" /><br/>
<input type="hidden" name="period" value="day" />
<input type="submit" value="Поиск по тегу"/>
</form>
</center>
<br/>
<br/>


<table align="center" width="70%" border="0">

<?
foreach ($LIST as $row) {

echo "<tr><td>\n";

echo '<table width="100%" border="1">'."\n";

echo "<tr><td width=\"10%\">ID: </td><td width=\"90%\">".$row['id']."</td></tr>\n";
//echo "<tr><td>uniq: </td><td>".$row['uniq']."</td></tr>\n";

$link=$row['link'];
echo "<tr><td>Автор: </td><td>"."<a rel=\"nofollow\" href=\"$link\">".$link."</a>"."</td></tr>\n";

echo "<tr><td>Дата: </td><td>".$row['date']."</td></tr>\n";

$title=$row['title'];
$title = unhtmlspecialchars($title);
$title = stripslashes($title);
echo "<tr><td>Тема: </td><td>".$title."&nbsp;</td></tr>\n";

$n_tags = $row['n_tags'];
$n_tags = str_replace(",",", ",$n_tags);
echo "<tr><td>Теги: </td><td>".$n_tags."&nbsp;</td></tr>\n";

$content = prepare_content($row['id'], $row['link'], $row['content']);



echo "<tr><td>&nbsp;</td><td><div class=\"content\">".$content."</div></td></tr>\n";

echo "</table>\n";

echo "<br/>\n";
echo "</td></tr>\n";

};
?>

</table>

<br/>
<br/>

<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/script.js"></script>

<? include("metrika.php"); ?>
<? include("debug.php"); ?>

</body>
</html>
