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
Wymagania
</title>
</head>

<body bgcolor="#E6E6FA" leftmargin="20">

<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$kod=$_GET[kod];
echo "<a href=kwalifikuj.php?kod=$kod>Powrót do poprzedniej strony</a><br>
<hr width=30% color=#9966CC align=left>
<h3 align=left>Informacja o przedmiotach wymaganych<br>do uczęszczania na ".$kod."</h3>";

$nr_indeksu=$_GET[nr_indeksu];
$result = pg_query($link, "SELECT * FROM wymagania WHERE przedmioty_kod='$kod'");
$numrows = pg_numrows($result);
?>

<table border="1" align=left>
<tr><th>Kod przedmiotu</th>
<th>Zaliczony</th></tr>

<?php
for($ri = 0; $ri < $numrows; $ri++)
{
echo "<tr>\n";
$row = pg_fetch_array($result, $ri);
echo " <td>" . $row["wymagany_kod"] . "</td>";
if (pg_numrows(pg_query($link,"SELECT * FROM rejestracje_zaliczenia WHERE przedmioty_kod='$row[wymagany_kod]' AND student_nr_indeksu='$nr_indeksu' AND status_przedmiotu='z'"))>0) {echo "<td>Tak</td></tr> ";}
else echo "<td>Nie</td></tr> ";
}

pg_close($link);
?>

</table>
</body>
</html>
