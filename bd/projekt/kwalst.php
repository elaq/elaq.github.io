<?php
if(empty($_COOKIE[log]))
{
header('refresh:0; url=bdostepu.php');
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>
Wybór przedmiotu
</title>
</head>

<body bgcolor="#E6E6FA" leftmargin="20">

<a href="admin.html">Powrót do strony głównej</a><br>
<hr width="30%" color="#9966cc" align="left">

<h2 align="left">Dokonywanie kwalifikacji na wybrany przedmiot</h2>

<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$result = pg_query($link, "SELECT * from przedmioty order by 1");
$numrows = pg_numrows($result);
?>

<br>
<table border="1" align="left">
<tr>
<th>Kod przedmiotu</th>
<th>Nazwa przedmiotu</th>
<th>Kwalifikuj na przedmiot</th>
</tr>

<?php
for($ri = 0; $ri < $numrows; $ri++)
{
	$row = pg_fetch_array($result, $ri);
	if(pg_numrows(pg_query($link, "SELECT * FROM rejestracje_zaliczenia WHERE przedmioty_kod='$row[kod]' AND status_przedmiotu='p'"))>0){		
	echo "<tr>\n";
	echo " <td>" . $row["kod"] . "</td>
	<td width=350>" . $row["nazwa"] . "</td>
	<td>" . "<a href=kwalifikuj.php?kod=$row[kod]>Kwalifikuj</a> </td> </tr> ";
	}
}

echo "</table>";

pg_close($link);
?>

</body>
</html>
