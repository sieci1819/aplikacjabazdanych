<?php

	session_start();
	
	if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false))
	{
		header('Location: index.php');
		exit();
	}
	if((!isset($_SESSION['admin'])) || ($_SESSION['admin']==false))
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
			<div style="text-align: center; color:white;"id="wyloguj"><a style="text-align: center; color:white;" href="logout.php">Wyloguj się!</a></div>
			<div style="text-align: center; color:white; font-size: 20px;padding-top: 40px;">Panel administracyjny</div>
			<div style="text-align: center; color:white; font-size: 20px;padding-top: 10px;padding-bottom: 10px;">Lista niezweryfikowanych użytkowników:</div>
			<div id="lista">
			<?php
			require_once "connect.php";
			$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($polaczenie->connect_errno!=0)
			{
				echo "Error: ".$polaczenie->connect_errno;
			}
			else
			{
				$rezultat = @$polaczenie->query(
				sprintf("SELECT user FROM uzytkownicy WHERE verify='0'"));
				if($rezultat->num_rows > 0)
				{
					echo "<table cellpadding=\"2\" border=1>";
					while($row = $rezultat->fetch_assoc())
					{
						
						echo "<td>".$row["user"]."</td>";
					}
					echo "</table>";
				}
				else 
				{
					echo "<div>Brak niezweryfikowanych użytkowników</div>";
				}
				$rezultat->free_result();
			} 
						
			$polaczenie->close();
			?>		
			</div>
				<form action="weryfikacja.php" name="weryfikacja" method="post">
					<div style="text-align: center; color:white; font-size: 20px;padding-top: 10px;">Podaj login użytkownika do zweryfikowania: <br><br><input type="text" name="verify_login">
                        <input type="submit" value="Zweryfikuj" /></div>
				</form>
			<div class="error">
			<?php
				if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
				unset($_SESSION['blad']);
			?>
			</div>
		</div>
		</form>
	</div>


</body>
</html>