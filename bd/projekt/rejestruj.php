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
Zapisz się na wybrany przedmiot
</title>
</head>

<body bgcolor="#FFE4B5" leftmargin="20">

<a href="usos.php">Powrót do strony głównej</a>
<hr align="left" color="#CD853F" width="30%">

<h2 align="left">Zapisz się na nowy przedmiot</h2>

<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$zetony = pg_query($link, "SELECT liczba_zetonow from student where nr_indeksu='$_COOKIE[log]'");
$zetony2 = pg_fetch_result($zetony,0,0);
$kod=$_GET[kod];

if($kod!='' && pg_numrows(pg_query($link, "SELECT * FROM rejestracje_zaliczenia WHERE Student_Nr_indeksu='$_COOKIE[log]' AND Przedmioty_Kod='$kod' AND status_przedmiotu='p'"))==0)
{
if ($zetony2>0)
{
	$result = pg_query($link, "INSERT INTO rejestracje_zaliczenia VALUES ('$kod','$_COOKIE[log]','p')");
	echo "<marquee width=500 behavior=alternate>Poprawnie zarejestrowałeś się na przedmiot ".$kod.".</marquee>";
	pg_query($link, "UPDATE student SET liczba_zetonow=liczba_zetonow-1 WHERE nr_indeksu='$_COOKIE[log]'");
	$zetony = pg_query($link, "SELECT liczba_zetonow FROM student WHERE nr_indeksu='$_COOKIE[log]'");
	$zetony2 = pg_fetch_result($zetony,0,0);
}
else {echo "<marquee width=280 behavior=alternate>Brak żetonów!</marquee>";}
}


echo "<br><h4>Liczba posiadanych żetonów: ".$zetony2.".</h4>";

$result = pg_query($link, "SELECT * FROM przedmioty WHERE kod NOT IN (SELECT przedmioty_kod FROM rejestracje_zaliczenia WHERE student_nr_indeksu='$_COOKIE[log]') ORDER BY 1");
$numrows = pg_numrows($result);
?>

<table border="1" align=left>
<tr>
<th>Kod przedmiotu</th>
<th>Nazwa przedmiotu</th>
<th>Zarejestruj się</th>
</tr>

<?php
for($ri = 0; $ri < $numrows; $ri++)
{
	echo "<tr>\n";
	$row = pg_fetch_array($result, $ri);
	echo " <td>" . $row["kod"] . "</td>
	<td width=350>" . $row["nazwa"] . "</td>
	<td>" ;
	if($row["termin_zapisu"]>date('Y-m-d'))
	{
		echo "<a href=rejestruj.php?kod=$row[kod]>Rejestruj</a>";
	}
	else{echo"Po terminie";}
	echo " </td></tr> ";
}

pg_close($link);
?>

</table>
</body>
</html>
