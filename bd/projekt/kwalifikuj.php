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
Dokonywanie kwalifikacji na przedmioty
</title>
</head>

<body bgcolor="#E6E6FA" leftmargin="20">

<a href="kwalst.php">Powrót do poprzedniej strony</a><br>
<hr width="30%" color="#9966CC" align="left">


<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$kod=$_GET[kod];
$odp=$_GET[odp];
$nr_indeksu=$_GET[nr_indeksu];

echo "<h2 align=left>Kwalifikacja na ".$kod."</h2>";

$limit = pg_query($link, "SELECT limit_miejsc FROM przedmioty WHERE kod='$kod'");
$limit2 = pg_fetch_result($limit,0,0);

if($odp==tak && pg_numrows(pg_query($link, "SELECT * FROM rejestracje_zaliczenia WHERE student_nr_indeksu='$nr_indeksu' AND przedmioty_kod='$kod' AND status_przedmiotu='p'"))>0)
{
	$result2=pg_query($link, "UPDATE rejestracje_zaliczenia SET status_przedmiotu='r' WHERE student_nr_indeksu='$nr_indeksu' AND przedmioty_kod='$kod'");
	echo "<marquee width=650 behavior=alternate>Poprawnie zakwalifikowałeś studenta ".$nr_indeksu.".</marquee>";
	if ($limit2>0)
	{
		pg_query($link, "UPDATE przedmioty SET limit_miejsc=limit_miejsc-1 WHERE kod='$kod'");
		$limit = pg_query($link, "SELECT limit_miejsc FROM przedmioty WHERE kod='$kod'");
		$limit2 = pg_fetch_result($limit,0,0);
	}
	else {echo "<marquee width=850 behavior=alternate>Poprawnie zakwalifikowałeś studenta ".$nr_indeksu." na przedmiot ".$kod.". Limit został przekroczony!</marquee>";}
;}

if($odp==nie && pg_numrows(pg_query($link, "SELECT * FROM rejestracje_zaliczenia WHERE student_nr_indeksu='$nr_indeksu' AND przedmioty_kod='$kod' AND status_przedmiotu='p'"))>0)
{
	$result2 = pg_query($link, "UPDATE rejestracje_zaliczenia SET status_przedmiotu='o' WHERE student_nr_indeksu='$nr_indeksu' and przedmioty_kod='$kod'");
	echo "<marquee width=650 behavior=alternate>Student o numerze indeksu ". $nr_indeksu." został odrzucony z przedmiotu ".$kod.".</marquee>";
};
echo "<br><h4>Limit miejsc na ten przedmiot wynosi: ".$limit2.".</h4>";

$result = pg_query($link, "SELECT * FROM rejestracje_zaliczenia WHERE przedmioty_kod='$kod' AND status_przedmiotu='p'");
$numrows = pg_numrows($result);
?>

<h3 align="left">Lista studentów, którzy złożyli prośbę o zarejestrowanie</h3>

<table border="1" align="left">
<tr>
<th>Nr indeksu</th>
<th>Wymagania</th>
<th>Kwalifikuj</th>
<th>Odrzuć</th>
</tr>
<?php
for($ri = 0; $ri < $numrows; $ri++) 
{
	echo "<tr>\n";
	$row = pg_fetch_array($result, $ri);
	echo " <td>" . $row["student_nr_indeksu"] . "</td>
	<td><a href=wymagania.php?nr_indeksu=$row[student_nr_indeksu]&kod=$kod>";
	$zaliczone=pg_query($link, "SELECT przedmioty_kod FROM rejestracje_zaliczenia WHERE status_przedmiotu='z'");
	$lzaliczone=pg_numrows($zaliczone);
	$wymagane=pg_query($link, "SELECT wymagany_kod FROM wymagania WHERE przedmioty_kod='$kod'");
	$lwymagane=pg_numrows($wymagane);
	$ai=0;
	$spelnione=tak;

	while($ai<$lwymagane and $spelnione==tak)
	{
		$spelnione=nie;
		$rwymagane=pg_fetch_array($wymagane, $ai);
		$bi=0;
	
		while($bi<$lzaliczone and $spelnione==nie)
		{
			$rzaliczone=pg_fetch_array($zaliczone,$bi);
			if ($rwymagane["wymagany_kod"]==$rzaliczone["przedmioty_kod"])
			{
				$spelnione=tak;
			}
			$bi++;
		}
		$ai++;
	}

	if ($spelnione==tak) {echo "Spełnione";}
	else {echo "Nie spełnione";}

	echo "</a> </td>
	<td><a href=kwalifikuj.php?kod=$kod&nr_indeksu=$row[student_nr_indeksu]&odp=tak>Kwalifikuj</a> </td>
	<td><a href=kwalifikuj.php?kod=$kod&nr_indeksu=$row[student_nr_indeksu]&odp=nie>Odrzuć</a></td>
	</tr> "; 
}
	echo"</table>";
pg_close($link);
?>

</body>
</html>
