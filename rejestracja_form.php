<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: aplikacja.php');
		exit();
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
			<div id="logowanie">Rejestracja</div>
			<div id="formularz">
			
				<form action="rejestracja.php" method="post">
				Login: <br /> <input type="text" value="<?php
				if (isset($_SESSION['fr_nick']))
				{
					echo $_SESSION['fr_nick'];
					unset($_SESSION['fr_nick']);
				}
				?>"name="login" /> <br />
				
				<?php
				if (isset($_SESSION['e_nick']))
				{
					echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
					unset($_SESSION['e_nick']);
				}
				?>
				
				Hasło: <br /> <input type="password" value="<?php
				if (isset($_SESSION['fr_haslo1']))
				{
					echo $_SESSION['fr_haslo1'];
					unset($_SESSION['fr_haslo1']);
				}
				?>"name="haslo1" /> <br />
				
				<?php
				if (isset($_SESSION['e_haslo']))
				{
					echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
					unset($_SESSION['e_haslo']);
				}
				?>
				Powtórz hasło: <br /> <input type="password" value="<?php
				if (isset($_SESSION['fr_haslo2']))
				{
					echo $_SESSION['fr_haslo2'];
					unset($_SESSION['fr_haslo2']);
				}
				?>" name="haslo2" /> <br />
				<input type="submit" value="Zarejestruj się" />
			</div>
			<div id="button_rej">
				<a href="index.php" id="button_rej_text">Zaloguj się jeżeli już posiadasz konto!</a>
			</div>
			<div class="error">
			<?php
				if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
			?>
			</div>
		</div>
		</form>
	</div >


</body>
</html>