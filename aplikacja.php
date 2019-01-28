<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany'])||($_SESSION['zalogowany']==false))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		if((isset($_SESSION['admin'])) && ($_SESSION['admin']==true))
		{
			header('Location: aplikacja_admin.php');
			exit();
		}

	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Aplikacja baz danych</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script src="timer.js"></script>
</head>

<body onload="odliczanie();">
	<div id="container">
		<div id="header">
		
			<div id="logo"></div>
			<div id="zegar">12:00:00</div>
			
		</div>

		<div id="content">
			<div id="wyloguj"><a href="logout.php">Wyloguj się!</a></div>
			<div >
				<form action="????jakisplikphp" id="userform" method="post">
				<input type="submit">
				</form>
				<textarea rows="6" cols="60" name="body" form="userform"></textarea> 
			</div>

			</div>
		</div>
		</form>
	</div>
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

</body>
</html>