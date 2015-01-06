<?php
setcookie('log', $_POST[log], 0);

$haslo=$_POST['haslo'];
$rola=$_POST['rola'];
$link = pg_connect("host=labdb dbname=bd user=ek266745 password=noela");

if($rola=='student')
{
	$tab = pg_query($link, "select * from student WHERE nr_indeksu='$_POST[log]'");
	
	if(pg_numrows($tab)>0)
	{
		$row=pg_fetch_array($tab,0);
		if ($haslo==$row["haslo"])
		{
			header("refresh: 2; url=usos.php");
			echo "Poprawne hasło. Zaraz zostaniesz przekierowany na stronę główną użytkownika ".$row[imie]." ".$row[nazwisko]."!";	
		}
		else
		{
			header("refresh: 2; url=index.html");
			echo "Błędne hasło. Zaraz zostaniesz przekierowany z powrotem do strony logowania.";
		}
	}
	else
	{
		header("refresh: 2; url=index.html");
		echo "Błędny login. Zaraz zostaniesz przekierowany z powrotem do strony logowania.";
	}
}
else
{
	$tab = pg_query($link, "select * from administrator WHERE id='$_POST[log]'");
	if(pg_numrows($tab)>0)
	{
		$row=pg_fetch_array($tab,0);
		if ($haslo==$row["haslo"])
		{
			header("refresh: 2; url=admin.html");
			echo "Poprawne hasło. Zaraz zostaniesz przekierowany na stronę główną użytkownika ".$row[imie]." ".$row[nazwisko]."!";
		}
		else
		{
			header("refresh: 2; url=index.html");
			echo "Błędne hasło. Zaraz zostaniesz przekierowany z powrotem do strony logowania.";
		}
	}
	else
	{
		header("refresh: 2; url=index.html");
		echo "Błędny login. Zaraz zostaniesz przekierowany z powrotem do strony logowania.";
	}
}

pg_close($link);
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>
Zalogowanie
</title>

<body bgcolor="#DEB887">
<br><br>
</body>
</html>
