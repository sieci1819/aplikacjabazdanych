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
				<form action="query.php" method="post">
						id: <input type="text" name="id">
						Imię: <input type="text" name="imie">
						Nazwisko: <input type="text" name="nazwisko">
						Płeć: <input type="text" name="plec">
						Wiek: <input type="text" name="wiek">
						Waga: <input type="text" name="waga">
						Wzrost <input type="text" name="wzrost">
						Kolor oczu: <input type="text" name="kolor_oczu">
					
					
						Kolor włosów: <input type="text" name="kolor_wlosow">
						Miasto:<input type="text" name="miasto">
						Kraj: <input type="text" name="kraj">
						Zarobki: <input type="text" name="zarobki">
						Marka auta:<input type="text" name="marka_auta">
						Typ auta:<input type="text" name="typ_auta">
						Silnik: <input type="text" name="silnik">
				<input type="submit" value="Wyszukaj w bazie"/>
				</form>
				<form action="show_db.php" method="post">
				<input type="submit" value="Wyświetl całą bazę">
				</form>
			</div>
			</br></br>
			<div>
				<?php
				require_once "connect2.php";
				$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($polaczenie->connect_errno!=0)
			{
				echo "Error: ".$polaczenie->connect_errno;
			}
			else if($_SESSION['show_db']==1)
			{
					$_SESSION['show_db']=0;
					$query = 'SELECT * FROM tabela';
						   
					$rezultat = @$polaczenie->query($query);
					
					if($rezultat->num_rows > 0)
					{
						echo "<table cellpadding=\"2\" border=1>";
						echo "<tr>";
							echo "<td>id</td>";
							echo "<td>Imię</td>";
							echo "<td>Nazwisko</td>";
							echo "<td>Plec</td>";
							echo "<td>Wiek</td>";
							echo "<td>Waga</td>";
							echo "<td>Wzrost</td>";
							echo "<td>Kolor oczu</td>";
							echo "<td>Kolor włosów</td>";
							echo "<td>Miasto</td>";
							echo "<td>Kraj</td>";
							echo "<td>Zarobki</td>";
							echo "<td>Marka auta</td>";
							echo "<td>Typ silnika</td>";
							echo "<td>Silniek</td>";
							echo "</tr>";
						while($r = $rezultat->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$r['id']."</td>";
							echo "<td>".$r['Imie']."</td>";
							echo "<td>".$r['Nazwisko']."</td>";
							echo "<td>".$r['Plec']."</td>";
							echo "<td>".$r['Wiek']."</td>";
							echo "<td>".$r['Waga']."</td>";
							echo "<td>".$r['Wzrost']."</td>";
							echo "<td>".$r['Kolor_oczu']."</td>";
							echo "<td>".$r['Kolor_wlosow']."</td>";
							echo "<td>".$r['Miasto']."</td>";
							echo "<td>".$r['Kraj']."</td>";
							echo "<td>".$r['Zarobki']."</td>";
							echo "<td>".$r['Marka_auta']."</td>";
							echo "<td>".$r['Typ_auta']."</td>";
							echo "<td>".$r['Silnik']."</td>";
							echo "</tr>";
						}
						echo "</table>"; 
						
								
						   } 
			}
			else
			{
				
						
						
						if(isset($_SESSION['imie'])) $imie = $_SESSION['imie'];
						if(isset($_SESSION['id'])) $id = $_SESSION['id'];
						if(isset($_SESSION['nazwisko']))$nazwisko = $_SESSION['nazwisko'];
						if(isset($_SESSION['plec']))$plec = $_SESSION['plec'];
						if(isset($_SESSION['wiek']))$wiek = $_SESSION['wiek'];
						if(isset($_SESSION['waga']))$waga = $_SESSION['waga'];
						if(isset($_SESSION['wzrost']))$wzrost = $_SESSION['wzrost'];
						if(isset($_SESSION['kolor_oczu']))$kolor_oczu = $_SESSION['kolor_oczu'];
						if(isset($_SESSION['kolor_wlosow']))$kolor_wlosow = $_SESSION['kolor_wlosow'];
						if(isset($_SESSION['miasto']))$miasto = $_SESSION['miasto'];
						if(isset($_SESSION['kraj']))$kraj = $_SESSION['kraj'];
						if(isset($_SESSION['zarobki']))$zarobki = $_SESSION['zarobki'];
						if(isset($_SESSION['marka_auta']))$marka_auta = $_SESSION['marka_auta'];
						if(isset($_SESSION['typ_auta']))$typ_auta = $_SESSION['typ_auta'];
						if(isset($_SESSION['silnik']))$silnik = $_SESSION['silnik'];
						
						$wh = array();
						if(isset($id) && $id!="") 
						{
						   $wh[] = 'id = '.'"'.$id.'"'; 
						   }
						if (isset($imie) &&$imie!="") 
						{
							$wh[] = 'Imie = '.'"'.$imie.'"'; 
						   }
						if (isset($nazwisko) &&$nazwisko!="")
						{
						   $wh[] = 'Nazwisko = '.'"'.$nazwisko.'"'; 
						   }
						   if (isset($plec) &&$plec!="")
						{
						   $wh[] = 'Plec = '.'"'.$plec.'"'; 
						   }if (isset($wiek) &&$wiek!="")
						{
						   $wh[] = 'Wiek = '.'"'.$wiek.'"'; 
						   }if (isset($waga) &&$waga!="")
						{
						   $wh[] = 'Waga = '.'"'.$waga.'"'; 
						   }if (isset($wzrost) &&$wzrost!="")
						{
						   $wh[] = 'Wzrost = '.'"'.$wzrost.'"'; 
						   }if (isset($kolor_oczu) &&$kolor_oczu!="")
						{
						   $wh[] = 'Kolor_oczu = '.'"'.$kolor_oczu.'"'; 
						   }if (isset($kolor_wlosow) &&$kolor_wlosow!="")
						{
						   $wh[] = 'Kolor_wlosow = '.'"'.$kolor_wlosow.'"'; 
						   }if (isset($miasto) &&$miasto!="")
						{
						   $wh[] = 'Miasto = '.'"'.$miasto.'"'; 
						   }if (isset($kraj) &&$kraj!="")
						{
						   $wh[] = 'Kraj = '.'"'.$kraj.'"'; 
						   }if (isset($zarobki) &&$zarobki!="")
						{
						   $wh[] = 'Zarobki = '.'"'.$zarobki.'"'; 
						   }if (isset($marka_auta) &&$marka_auta!="")
						{
						   $wh[] = 'Marka_auta = '.'"'.$marka_auta.'"'; 
						   }if (isset($typ_auta) &&$typ_auta!="")
						{
						   $wh[] = 'Typ_auta = '.'"'.$typ_auta.'"'; 
						   }if (isset($silnik) &&$silnik!="")
						{
						   $wh[] = 'Silnik = '.'"'.$silnik.'"'; 
						   }
					
					  
					
					 
						if (!empty($wh)) 
						{
						   $where = 'WHERE '.implode(' and ', $wh);
						   $query = 'SELECT * FROM tabela '.$where.' ORDER BY id DESC';
						   
						   $rezultat = @$polaczenie->query($query);
					
					if($rezultat->num_rows > 0)
					{
						echo "<table cellpadding=\"2\" border=1>";
						echo "<tr>";
							echo "<td>id</td>";
							echo "<td>Imię</td>";
							echo "<td>Nazwisko</td>";
							echo "<td>Plec</td>";
							echo "<td>Wiek</td>";
							echo "<td>Waga</td>";
							echo "<td>Wzrost</td>";
							echo "<td>Kolor oczu</td>";
							echo "<td>Kolor włosów</td>";
							echo "<td>Miasto</td>";
							echo "<td>Kraj</td>";
							echo "<td>Zarobki</td>";
							echo "<td>Marka auta</td>";
							echo "<td>Typ silnika</td>";
							echo "<td>Silniek</td>";
							echo "</tr>";
						while($r = $rezultat->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$r['id']."</td>";
							echo "<td>".$r['Imie']."</td>";
							echo "<td>".$r['Nazwisko']."</td>";
							echo "<td>".$r['Plec']."</td>";
							echo "<td>".$r['Wiek']."</td>";
							echo "<td>".$r['Waga']."</td>";
							echo "<td>".$r['Wzrost']."</td>";
							echo "<td>".$r['Kolor_oczu']."</td>";
							echo "<td>".$r['Kolor_wlosow']."</td>";
							echo "<td>".$r['Miasto']."</td>";
							echo "<td>".$r['Kraj']."</td>";
							echo "<td>".$r['Zarobki']."</td>";
							echo "<td>".$r['Marka_auta']."</td>";
							echo "<td>".$r['Typ_auta']."</td>";
							echo "<td>".$r['Silnik']."</td>";
							echo "</tr>";
						}
						echo "</table>"; 
					}
					else{
						$_SESSION['blad'] = "0 zwróconych rekordów";
					}
						   
						} }
							
							
							
			
				
			
				$polaczenie->close();
				unset($_SESSION['id']);
				unset($_SESSION['imie']);
				unset($_SESSION['nazwisko']);
				unset($_SESSION['plec']);
				unset($_SESSION['wiek']);
				unset($_SESSION['waga']);
				unset($_SESSION['wzrost']);
				unset($_SESSION['kolor_oczu']);
				unset($_SESSION['kolor_wlosow']);
				unset($_SESSION['miasto']);
				unset($_SESSION['kraj']);
				unset($_SESSION['zarobki']);
				unset($_SESSION['marka_auta']);
				unset($_SESSION['typ_auta']);
				unset($_SESSION['silnik']);
			?>
			</div >
			
			</div>
		</div>
		</form>
	</div>
	<div class="error">
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>
</div>
</body>
</html>