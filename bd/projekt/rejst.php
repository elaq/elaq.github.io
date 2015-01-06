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
Rejestrowanie studentów
</title> 
</head> 

<body bgcolor="#E6E6FA" leftmargin="20">

<a href="admin.html">Powrót do strony głównej</a><br>
<hr width="30%" color="#9966CC" align="left">

<h2 align=left>Rejestrowanie nowego studenta</h2>

<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$nr_indeksu=$_POST[nr_indeksu];
$nazwisko=$_POST[nazwisko];
$imie=$_POST[imie];
$haslo=$_POST[haslo];
$liczba_zetonow=$_POST[liczba_zetonow];

if($nr_indeksu!='' && $nazwisko!='' && $imie!=='' && $haslo!='' && $liczba_zetonow!='')
{
	$result = pg_query($link, "insert into student values ('$nr_indeksu', '$nazwisko', '$imie', '$haslo', '$liczba_zetonow')");
	echo "<marquee width=650 behavior=alternate>Poprawnie dopisałeś do bazy studenta o numerze indeksu ".$nr_indeksu.".</marquee><br><br>";
}
else {echo "<br><br>";}
pg_close($link);
?>

<form action="rejst.php" method="post">

<table border="1" align=left rules="none">

<tr><td>Numer indeksu studenta (6-cyfrowy):</td>
<td><input type=text name="nr_indeksu"/></td></tr>

<tr><td>Nazwisko studenta:</td>
<td><input type=text name="nazwisko"/></td></tr>

<tr><td>Imię studenta:</td>
<td><input type=text name="imie"/></td></tr>

<tr><td>Hasło studenta (do 10 znaków):</td>
<td><input type=text name="haslo"/></td></tr>

<tr><td>Liczba żetonów:</td>
<td><input type=text name="liczba_zetonow"/></td></tr>

<tr><td></td><td><input type=submit value="Zatwierdź"></td></tr>
</form>

</body> 
</html>
