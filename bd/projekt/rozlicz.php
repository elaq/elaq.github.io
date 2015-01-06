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
Rozliczenie przedmiotu
</title>
</head>

<body bgcolor="#E6E6FA" leftmargin="20">

<a href="zalicz.php">Powrót do listy przedmiotów</a><br>
<hr width="30%" color="#9966CC" align="left">

<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$kod=$_GET[kod];
echo "<h2 align=left>Rozlicz przedmiot ".$kod."</h2>";

$odp=$_GET[odp];
$nr_indeksu=$_GET[nr_indeksu];

if($odp==tak && pg_numrows(pg_query($link, "SELECT * FROM Rejestracje_Zaliczenia WHERE Student_Nr_indeksu='$nr_indeksu' AND Przedmioty_Kod='$kod' AND Status_Przedmiotu='r'"))>0)
{
	$result2=pg_query($link, "UPDATE rejestracje_zaliczenia SET status_przedmiotu='z' WHERE student_nr_indeksu='$nr_indeksu' AND Przedmioty_Kod='$kod'");
	echo "<marquee width=850 behavior=alternate>Student o numerze indeksu ".$nr_indeksu." zaliczył przedmiot.</marquee>";
}

if($odp==nie && pg_numrows(pg_query($link, "SELECT * FROM Rejestracje_Zaliczenia WHERE Student_Nr_indeksu='$nr_indeksu' AND Przedmioty_Kod='$kod' AND Status_Przedmiotu='r'"))>0)
{
	$result2 = pg_query($link, "delete from rejestracje_zaliczenia where student_nr_indeksu='$nr_indeksu' and przedmioty_kod='$kod'");
	echo "<marquee width=850 behavior=alternate>Student o numerze indeksu ". $nr_indeksu." nie zaliczył przedmiotu.</marquee>";
}

$result = pg_query($link, "SELECT * FROM rejestracje_zaliczenia WHERE przedmioty_kod='$kod' AND status_przedmiotu='r'");
$numrows = pg_numrows($result);
?>

<br><br><table border="1" align="left">
<tr>
<th>Nr indeksu</th>
<th>Zalicz przedmiot</th>
<th>Nie zaliczaj przedmiotu</th>
</tr>

<?php
for($ri = 0; $ri < $numrows; $ri++)
{
	echo "<tr>\n";
	$row = pg_fetch_array($result, $ri);
	echo " <td>" . $row["student_nr_indeksu"] . "</td>
	<td><a href=rozlicz.php?nr_indeksu=$row[student_nr_indeksu]&kod=$kod&odp=tak>Zalicz</a></td>
	<td><a href=rozlicz.php?nr_indeksu=$row[student_nr_indeksu]&kod=$kod&odp=nie>Nie zaliczaj</a></td>
	</tr>";
}

echo "</table>";

pg_close($link);
?>

</body>
</html>
