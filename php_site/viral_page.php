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
<center><h3>посты набирающие популярность</h3></center>
<br/>
<center>выборка по <? echo $total; ?> записям</center>
<center>(за последние два часа)</center>
<br/>
<br/>

<?

$hash = array();
foreach ($LIST as $row) {
    $data = $row['content'];
    $link = $row['link'];

    unset($urls);
    preg_match_all("/href=&quot;(http:\/\/[^ ]+)&quot;/i", $data, $urls);

    foreach ($urls[1] as $u){
        if ($u == "http://bigsauron.livejournal.com/334615.html") {
            continue;
        };

        if (preg_match("/livejournal.com\/\d+\.html/i",$u)){
            $hash["$u"]=$hash["$u"]+1;
        };
    };

    $hash["$link"]=$hash["$link"]+1000;

    //var_dump($data);
    //var_dump($urls[1]);
    //echo "<br/><br/><br/>\n\n";

};

arsort($hash);

?>

<center>Новые посты (созданные не позже 2 часов назад)</center>
<br/>
<table align="center" width="40%" border="1">
<tr><td>Пост</td><td align="center">Кол-во<br/>репостов</td></tr>

<?
foreach ($hash as $key => $val) {
    if ($val > 1000) {
        $val = $val - 999;
        echo "<tr>\n";
        echo "<td><a target=\"_blank\" href=\"$key\">$key</a></td>\n";
        echo "<td align=\"center\">$val</td>\n";
        echo "</tr>\n";
    };
};
?>

</table>

<br/>
<br/>
<br/>

<center>Старые посты на которые по-прежнему ссылаются</center>
<br/>
<table align="center" width="40%" border="1">
<tr><td>Пост</td><td align="center">Кол-во<br/>репостов</td></tr>

<?
foreach ($hash as $key => $val) {
    if ( ($val > 1) and ($val < 1000) ) {
        echo "<tr>\n";
        echo "<td><a target=\"_blank\" href=\"$key\">$key</a></td>\n";
        echo "<td align=\"center\">$val</td>\n";
        echo "</tr>\n";
    };
};
?>

</table>

<br/>
<br/>

<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<? include("metrika.php"); ?>
<? include("debug.php"); ?>

</body>
</html>
