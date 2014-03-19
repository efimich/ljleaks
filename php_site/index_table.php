<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ljleaks.ru</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
</head>
<body>

<table align="center" width="100%" border="0"><tr>
<td width="25%" align="center" valign="top">
<!-- left side -->
<br/>
<b>настройки</b><br/>
<br/>
<?
$a = '<font size="-1"><a href="/?full=1">показывать полные записи</a></font><br/>';
$b = '<font size="-1"><a href="/?full=0">показывать записи частично</a></font><br/>';
if ($fullpost) { echo $b; } else { echo $a; };
?>
<font size="-1">скрыть пропагандистские блоги</font><br/>
<font size="-1">добавить блоги в бан-лист</font><br/>
&nbsp;
</td>

<td width="50%" align="center" valign="top">
<h1>LiveJournal Leaks</h1>
<a href="/about/">о проекте</a><br/><br/>
лента самых новых жж записей<br/>
<h4><a href="trends.php">тренды этого часа</a></h4>
<h4><a href="viral.php">вирусные посты</a></h4>
<!-- <a href="/friends-only/">friends-only</a> | <a href="/deleted/">deleted</a> -->
добавлено записей за последний час: <? echo $num_q; ?><br/>
</td>

<td width="25%" align="center" valign="top">
<!-- right side -->
<br/>
<b>категории</b><br/>
<br/>
<a href="/search_tag.php?tag=юмор">юмор</a><br/>
<a href="/search_tag.php?tag=кино">кино</a><br/>
<a href="/search_tag.php?tag=фото">фото</a><br/>
<a href="/search_tag.php?tag=путешеств">путешествия</a><br/>
<a href="/search_tag.php?tag=интересно">интересное</a><br/>
<!-- <br/>
<a href="/search_tag.php?tag=эротика">эротика</a><br/>
<a href="/search_tag.php?tag=секс">секс</a><br/>
<a href="/search_tag.php?tag=порно">порно</a><br/>
-->
<br/>
<br/>
<b>поиск по тегу</b><br/>
<center>
<form action="/search_tag.php" method="GET">
<input style="width:120px;" type="text" name="tag" value="" /><br/>
<input type="hidden" name="period" value="day" />
<input type="submit" value="Найти" />
</form>
</center>

</td>
</tr></table>

<!-- <br/> -->

<table align="center" width="70%" border="0">

<?
foreach ($LIST as $row) {

$all = $row['content'].$row['n_tags'].$row['title'];

// exclude english posts
//if ( lang_check($all) ){
//    continue;
//};

echo "<tr><td>\n";

echo '<table class="entry" width="100%" border="1">'."\n";


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


if ($fullpost) {
    $content = prepare_content_full($row['content']);
}else{
    $content = prepare_content($row['id'], $row['link'], $row['content']);
};

echo "<tr><td>&nbsp;</td><td><div class=\"content\">".$content."</div></td></tr>\n";

echo "</table>\n";
//echo '<a href="/show.php?id='.$row['id'].'">link</a>'."<br/><br/>\n";
echo "<br/>\n";

if ($fullpost) {
    echo "<br/>\n";
    echo "<br/>\n";
};

echo "</td></tr>\n";

};
?>

</table>

<br/>
<center><font size="+2"><a href="/?page=<? echo $page+1; ?>">&lt;&lt; prev 20 posts</a></font>
<? 
if ($page > 1) {
?>
<font size="+2">&nbsp;&nbsp; | &nbsp;&nbsp;</font><font size="+2"><a href="/?page=<? echo $page-1; ?>">next 20 posts &gt;&gt;</a></font>
<?
};
?>
</center>

<br/>
<br/>
&nbsp;
<br/>

<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/script.js"></script>

<? include("metrika.php"); ?>
<? include("debug.php"); ?>

<center><a href="http://ljleaks.ru/">(c) ljleaks.ru</a></center>
</body>
</html>
