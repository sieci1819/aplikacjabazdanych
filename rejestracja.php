<?php

	session_start();
	
	if (isset($_POST['login'])&&$_POST['login']!='')
	{
		
		$wszystko_OK=true;
		
		
		$login = $_POST['login'];
		
		
		if ((strlen($login)<3) || (strlen($login)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($login)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}

		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<3) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 3 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $login;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$login'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już użytkownik o takim loginie! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{
					
					
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$login', '$haslo1', b'0')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: index.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				else{
					$_SESSION['udanarejestracja']=false;
					header('Location: rejestracja_form.php');
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	else
	{
		$_SESSION['e_nick']="Podaj login!";
		header('Location: rejestracja_form.php');
	}

?>
