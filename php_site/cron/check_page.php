<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ljleaks.ru</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<center><h1>LiveJournal Leaks</h1></center>
<br/>
<center>выборка по <? echo $total; ?> записям</center>
<br/>
<br/>


<center>Check</center>
<br/>
<table align="center" width="40%" border="1">
<tr><td>link</td><td align="center">status</td></tr>

<?

foreach ($LIST as $row) {
    $link = $row['link'];
    $rowid = $row['id'];

    $code = req_link($link);

    $query =" UPDATE LOW_PRIORITY ljdump ";
    $query.=" SET status_code=$code, date_checked=NOW() ";
    $query.=" WHERE id = $rowid ";

    $res=mysql_query($query); 

    echo "<tr>\n";
    echo "<td><a target=\"_blank\" href=\"$link\">$link</a></td>\n";
    echo "<td align=\"center\">$code</td>\n";
    echo "</tr>\n";

    //flush();

};


mysql_free_result($res);
mysql_close($conn);


?>


</table>

<br/>
<br/>

</body>
</html>
