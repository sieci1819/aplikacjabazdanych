<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		if((isset($_SESSION['admin'])) && ($_SESSION['admin']==true))
		{
			header('Location: aplikacja_admin.php');
			exit();
		}
		else{
		header('Location: aplikacja.php');
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
			<div id="logowanie">Logowanie</div>
			<div id="formularz">
			
				<form action="zaloguj.php" method="post">
				Login: <br /> <input type="text" name="login" /> <br />
				Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
				<input type="submit" value="Zaloguj się" />
			</div>
			<div id="button_rej">
				<a href="rejestracja_form.php" id="button_rej_text">Zarejestruj się jeżeli nie masz konta!</a>
			</div>
			<div class="error">
			<?php
			
			if(isset($_SESSION['udanarejestracja'])&&($_SESSION['udanarejestracja']==true))
			{
				echo "Dziękujemy za rejestrację! Żeby się zalogować musisz poczekać na weryfikację konta przez administratora!";	
			}

			//Usuwanie zmiennych pamiętających wartości wpisane do formularza
			if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
			if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
			if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
			
			//Usuwanie błędów rejestracji
			if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
			if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
			if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
			session_unset();
			?>
			</div>
		</div>
		</form>
	</div>


</body>
</html>