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
Rejestrowanie nowych przedmiotów
</title> 
</head> 

<body bgcolor="#E6E6FA" leftmargin="20">
<a href="admin.html">Powrót do strony głównej</a><br>
<hr width="30%" color="#9966CC" align="left">

<h2 align="left">Rejestrowanie nowego przedmiotu wraz z limitem miejsc oraz wymaganiami</h2>

<?php
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

$kod=$_POST[kod];
$nazwa=$_POST[nazwa];
$limit=$_POST[limit];
$termin=$_POST[termin];
$kodwym1=$_POST[kodwym1];
$kodwym2=$_POST[kodwym2];
$kodwym3=$_POST[kodwym3];

if($kod!='' && $nazwa!='' && $limit!='' && $termin!='')
{
	$result = pg_query($link,"INSERT INTO przedmioty VALUES ('$kod', '$nazwa', '$limit', '$termin')");
	echo "<marquee width=650 behavior=alternate>Poprawnie dopisałeś przedmiot ".$nazwa.".</marquee><br><br>";
	if ($kodwym1!='')
	{
		$result2 = pg_query($link, "INSERT INTO wymagania VALUES ('$kod','$kodwym1')");
	}
	if ($kodwym2!='')
	{
	$result3 = pg_query($link, "INSERT INTO wymagania VALUES ('$kod','$kodwym2')");
	}
	if ($kodwym3!='')
	{
	$result4 = pg_query($link, "INSERT INTO wymagania VALUES ('$kod','$kodwym3')");
	}
}
else {echo "<br><br>";}
?>

<form action="dopisz.php" method="post"> 

<table border="1" align="left" rules="none">

<tr><td>Kod przedmiotu (4-cyfrowy):</td>
<td><input type="text" name="kod"/></td></tr>

<tr><td>Nazwa przedmiotu:</td>
<td><input type="text" name="nazwa"/></td></tr>

<tr><td>Limit dostępnych miejsc:</td>
<td><input type="text" name="limit"/></td></tr>

<tr><td>Termin zapisów na przedmiot (rrrr-mm-dd):</td>
<td><input type="text" name="termin"/></td></tr>

<tr><td>Kod wymaganego przedmiotu*<br></td>
<td><input type="text" name="kodwym1"/></td></tr>

<tr><td>Kod wymaganego przedmiotu*<br></td>
<td><input type="text" name="kodwym2"/></td></tr>

<tr><td>Kod wymaganego przedmiotu*<br></td>
<td><input type="text" name="kodwym3"/></td></tr>

<tr><td>* - pole opcjonalne</td></tr>

<tr><td></td>
<td><input type="submit" value="Zatwierdź"> </td></tr>

</table>
</form>

<?php
pg_close($link);
?>

</body> 
</html>
