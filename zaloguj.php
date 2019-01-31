<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s' AND verify='1'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true;
				
				if($login =='admin')
				{
					$_SESSION['admin'] = true;
					header('Location: aplikacja_admin.php');
				}	
				else{
					
					
					$wiersz = $rezultat->fetch_assoc();
					$_SESSION['show_db']=1;
					$_SESSION['user'] = $wiersz['user'];
					$_SESSION['haslo'] = $wiersz['pass'];
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: aplikacja.php');
				}
			} 
			else {
				
						if($rezultat = @$polaczenie->query(
						sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
						mysqli_real_escape_string($polaczenie,$login)))	)
						$ilu_userow = $rezultat->num_rows;
						if($ilu_userow>0)
						{
							
							$rezultat = @$polaczenie->query(
							sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
							mysqli_real_escape_string($polaczenie,$haslo),
							mysqli_real_escape_string($polaczenie,$login)));
							$ilu_userow = $rezultat->num_rows;
							if($ilu_userow>0)
							{
								$_SESSION['e_verify']="Poczekaj na weryfikację konta";
								
							}
							else{
								$_SESSION['e_haslo']="Błędne hasło!";
							}
						}
						else{
							$_SESSION['e_login']="Błędny login!";
						}
						
						
			}
			
		}
		
		header('Location: index.php');
		
		
		$polaczenie->close();
	}
	
?>