<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ljleaks.ru</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/css/style.css" rel="stylesheet" media="screen">
</head>
<body>

<center><h1>LiveJournal Leaks</h1></center>
<center>[ <a href="/">main</a> ]</center>
<center><h3>лента friends-only записей жж</h3></center>
<center>всего записей: <? echo $num_q; ?></center>
<br/>
<center><font size="-2">Нашли свою запись и хотите удалить? Сообщите об этом отправив <a href="/remove/">запрос на удаление</a>.</font></center>
<br/>
<br/>


<table align="center" width="70%" border="0">

<?
foreach ($LIST as $row) {

$all = $row['content'].$row['n_tags'].$row['title'];
if ( lang_check($all) ){
    continue;
};


echo "<tr><td>\n";

echo '<table width="100%" border="1">'."\n";


echo "<tr><td width=\"10%\">ID: </td><td width=\"90%\">".$row['id']."</td></tr>\n";
//echo "<tr><td>uniq: </td><td>".$row['uniq']."</td></tr>\n";

$link=$row['link'];
echo "<tr><td>Автор: </td><td><a target=\"_blank\" rel=\"nofollow\" href=\"$link\">".$link."</a>"."</td></tr>\n";

echo "<tr><td>Дата: </td><td>".$row['date']."</td></tr>\n";

$title=$row['title'];
$title = unhtmlspecialchars($title);
$title = stripslashes($title);
echo "<tr><td>Тема: </td><td>".$title."&nbsp;</td></tr>\n";

$n_tags = $row['n_tags'];
$n_tags = str_replace(",",", ",$n_tags);
echo "<tr><td>Теги: </td><td>".$n_tags."&nbsp;</td></tr>\n";

$link2 = "/show.php?id=".$row['id'];
$content = prepare_content($row['id'], $link2, $row['content']);


echo "<tr><td>&nbsp;</td><td><div class=\"content\">".$content."</div></td></tr>\n";

echo "</table>\n";
echo "<br/>\n";
echo "</td></tr>\n";

};
?>

</table>

<br/>
<center><font size="+2"><a href="?page=<? echo $page+1; ?>">&lt;&lt; prev 20 posts</a></font>
<? 
if ($page > 1) {
?>
<font size="+2">&nbsp;&nbsp; | &nbsp;&nbsp;</font><font size="+2"><a href="?page=<? echo $page-1; ?>">next 20 posts &gt;&gt;</a></font>
<?
};
?>
</center>

<br/>
<br/>
&nbsp;
<br/>

<script src="/js/jquery-latest.js"></script>
<script src="/js/bootstrap.min.js"></script>

<script src="/js/script.js"></script>

<? include("../metrika.php"); ?>
<? include("../debug.php"); ?>

<center><a href="http://ljleaks.ru/">(c) ljleaks.ru</a></center>
</body>
</html>
