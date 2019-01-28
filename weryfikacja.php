<?php

	session_start();
	
	if ((!isset($_POST['verify_login']))||($_POST['verify_login']==''))
	{
		$_SESSION['blad'] = '<div style="text-align: center; color:red; font-size: 30px;">Podaj poprawny login !</div>';
		header('Location: aplikacja_admin.php');
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
		$verify_login = $_POST['verify_login'];
		
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE user='%s'", mysqli_real_escape_string($polaczenie,$verify_login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				@$polaczenie->query("UPDATE uzytkownicy SET verify='1' WHERE user='$verify_login'");

				unset($_SESSION['blad']);
				$rezultat->free_result();
				$_SESSION['zalogowany'] = true;
				header('Location: aplikacja_admin.php');
				$_SESSION['blad'] = '<div style="text-align: center; color:red; font-size: 30px;">Użytkownik o loginie '.$verify_login. ' został zweryfikowany! </div>';	
			} else {
				
				$_SESSION['blad'] = '<div style="text-align: center; color:red; font-size: 30px;">Brak użytkownika w bazie! </div>';
				$_SESSION['zalogowany'] = true;
				header('Location: aplikacja_admin.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>