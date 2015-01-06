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
Student - menu
</title>
</head>

<body bgcolor=#FFE4B5 leftmargin="20">

<a href="wyloguj.php">Wyloguj się</a>
<br><hr width=30% color=#CD853F align=left>

<h2 align=left>Twoje przedmioty</h2>

<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$kod=$_GET[kod];

if($kod!='' && pg_numrows(pg_query($link, "select * FROM rejestracje_zaliczenia WHERE student_nr_indeksu='$_COOKIE[log]' AND przedmioty_kod='$kod'"))>0)
	{
		$result2 = pg_query($link, "DELETE FROM rejestracje_zaliczenia WHERE student_nr_indeksu='$_COOKIE[log]' AND przedmioty_kod='$kod'");
		echo "<marquee width=500 behavior=alternate>Poprawnie wyrejestrowałeś się z przedmiotu ".$kod.".</marquee>";
		pg_query($link, "UPDATE student SET liczba_zetonow=liczba_zetonow+1 WHERE nr_indeksu='$_COOKIE[log]'");
	}

$zetony = pg_query($link, "SELECT liczba_zetonow FROM student WHERE nr_indeksu='$_COOKIE[log]'");
$zetony2 = pg_fetch_result($zetony,0,0);

echo "<br><h4>Liczba posiadanych żetonów: ".$zetony2.".</h4>";
$result = pg_query($link, "SELECT * FROM rejestracje_zaliczenia JOIN przedmioty ON rejestracje_zaliczenia.przedmioty_kod=przedmioty.kod WHERE student_nr_indeksu='$_COOKIE[log]' ORDER BY 3");
$numrows = pg_numrows($result);
?>

Objaśnienia statusu przedmiotu:<br>
o - Twoja prośba o zarejestrowanie na przedmiot została odrzucona<br>
p - złożyłeś prośbę o zarejestrowanie na przedmiot<br>
r - jesteś zarejestrowany na przedmiot<br>
z - przedmiot zaliczony<br>

<a href="rejestruj.php"><h3>Zapisz się na nowy przedmiot</h3></a>

<table border="1" align="left">
<tr> <th>Kod przedmiotu</th>
<th width="350">Nazwa przedmiotu</th>
<th>Status przedmiotu</th>
<th>Wyrejestruj się</th></tr>

<?php
for($ri = 0; $ri < $numrows; $ri++)
{
	echo "<tr>\n";
	$row = pg_fetch_array($result, $ri);
	echo "<td>" . $row["przedmioty_kod"] ."</td>
	<td>".$row["nazwa"]."</td>
	<td align=center>".$row["status_przedmiotu"]."</td>
	<td>"; 

	if($row["status_przedmiotu"]==p and $row["termin_zapisu"]>date('Y-m-d'))
	{
		echo "<a href=usos.php?kod=$row[przedmioty_kod]>Zrezygnuj</a>";
	}
	if($row["status_przedmiotu"]==o)
	{
		echo "<a href=usos.php?kod=$row[przedmioty_kod]>Wycofaj z listy</a>";
	}
	echo "</td></tr>";
}

echo "</table>";

pg_close($link);
?>

</body>
</html>
