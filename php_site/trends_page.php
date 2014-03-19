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
<center><h3>тренды</h3></center>
<br/>
<center>выборка по <? echo $total; ?> записям, с тегами, за последний час</center>
<br/>
<br/>

<table align="center" width="15%" border="1">


<?

$hash = array();
foreach ($LIST as $row) {
    if ($row['n_tags'] == "") {
        continue;
    };
    $tags = explode(",",$row['n_tags']);
    foreach ($tags as $t){
        $hash["$t"]=$hash["$t"]+1;
    };
};

arsort($hash);

foreach ($hash as $key => $val) {

    if ($val > 2) {
        $key2 = urlencode($key);
        echo "<tr>\n";
        echo "<td><a href=\"/search_tag.php?tag=$key2\">$key</a></td>\n";
        echo "<td>$val</td>\n";
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
