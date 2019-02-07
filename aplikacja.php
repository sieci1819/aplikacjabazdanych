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
			<div id="wyloguj"><a style="text-align: center; color:white;" href="logout.php">Wyloguj się!</a></div>
			<div class="forms-place">
			<form action="query.php" method="post" id="main-form">
						<span class="span-form"><label>id:</label><input class="align" type="text" name="id"></span>
						<span class="span-form"><label>Imię:</label><input class="align" type="text" name="imie"></span>
						<span class="span-form"><label>Nazwisko: </label><input class="align" type="text" name="nazwisko"></span>
						<span class="span-form"><label>Płeć: </label><input class="align" type="text" name="plec"></span>
						<span class="span-form"><label style="float:left;">Wiek: </label><input style="float:left;" class="align" type="text" name="wiek"> <label style="float:left;">   Od: </label><input style="float:left;" class="align" type="text" name="wiek_od"><label style="float:left;">   Do: </label><input style="float:left;" class="align" type="text" name="wiek_do"></span>
						<span style="clear: both;"class="span-form"><label>Waga:</label><input class="align" type="text" name="waga"><label>   Od: </label><input class="align" type="text" name="waga_od"><label>   Do: </label><input class="align" type="text" name="waga_do"></span>
						<span style="clear: both;" class="span-form"><label>Wzrost </label><input class="align" type="text" name="wzrost"><label>   Od: </label><input class="align" type="text" name="wzrost_od"><label>   Do: </label><input class="align" type="text" name="wzrost_do"></span>
						<span class="span-form"><label>Kolor oczu: </label><input class="align" type="text" name="kolor_oczu"></span>
						<span class="span-form"><label>Kolor włosów: </label><input class="align" type="text" name="kolor_wlosow"></span>
						<span class="span-form"><label>Miasto: </label><input class="align" type="text" name="miasto"></span>
						<span class="span-form"><label>Kraj: </label><input class="align" type="text" name="kraj"></span>
						<span class="span-form"><label>Zarobki: </label><input class="align" type="text" name="zarobki"><label>   Od: </label><input class="align" type="text" name="zarobki_od"><label>   Do: </label><input class="align" type="text" name="zarobki_do"></span>
						<span style="clear: both;"class="span-form"><label>Marka auta: </label><input class="align" type="text" name="marka_auta"></span>
						<span class="span-form"><label>Typ auta: </label><input class="align" type="text" name="typ_auta"></span>
						<span class="span-form"><label>Silnik: </label><input class="align" type="text" name="silnik"></span>
					
						<input class="submit" type="submit" value="Wyszukaj w bazie"/>
			</form>
			<form action="show_db.php" method="post" id="show-db-action">
				<input class="submit" type="submit" value="Wyświetl całą bazę">
			</form>
			</div>
			
			
			<div style="overflow-x:auto; font-size: smaller;">
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
						echo "<table cellpadding=\"2\" border=1 style=\"margin: 0 auto; \">";
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
							echo "<td>Silnik</td>";
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
						if(isset($_SESSION['silnik']))$silnik = $_SESSION['silnik'];
						if(isset($_SESSION['marka_auta']))$marka_auta = $_SESSION['marka_auta'];
						if(isset($_SESSION['typ_auta']))$typ_auta = $_SESSION['typ_auta'];
						if(isset($_SESSION['wiek_od'])) $wiek_od = $_SESSION['wiek_od'];
						if(isset($_SESSION['wiek_do'])) $wiek_do = $_SESSION['wiek_do'];
						if(isset($_SESSION['waga_od'])) $waga_od = $_SESSION['waga_od'];
						if(isset($_SESSION['waga_do'])) $waga_do = $_SESSION['waga_do'];
						if(isset($_SESSION['wzrost_od'])) $wzrost_od = $_SESSION['wzrost_od'];
						if(isset($_SESSION['wzrost_do'])) $wzrost_do = $_SESSION['wzrost_do'];
						if(isset($_SESSION['zarobki_od'])) $zarobki_od = $_SESSION['zarobki_od'];
						if(isset($_SESSION['zarobki_do'])) $zarobki_do = $_SESSION['zarobki_do'];
						
						$wh = array();
						if(isset($id) && $id!="") $wh[] = 'id = '.'"'.$id.'"';
						if(isset($imie) &&$imie!="") $wh[] = 'Imie = '.'"'.$imie.'"'; 
						if(isset($nazwisko) &&$nazwisko!="") $wh[] = 'Nazwisko = '.'"'.$nazwisko.'"';
						if(isset($plec) &&$plec!="") $wh[] = 'Plec = '.'"'.$plec.'"'; 
						if(isset($wiek) &&$wiek!="") $wh[] = 'Wiek = '.'"'.$wiek.'"'; 
					    if(isset($waga) &&$waga!="") $wh[] = 'Waga = '.'"'.$waga.'"'; 
						if(isset($wzrost) &&$wzrost!="") $wh[] = 'Wzrost = '.'"'.$wzrost.'"'; 
						if(isset($kolor_oczu) &&$kolor_oczu!="") $wh[] = 'Kolor_oczu = '.'"'.$kolor_oczu.'"'; 
						if(isset($kolor_wlosow) &&$kolor_wlosow!="") $wh[] = 'Kolor_wlosow = '.'"'.$kolor_wlosow.'"'; 
						if(isset($miasto) &&$miasto!="") $wh[] = 'Miasto = '.'"'.$miasto.'"'; 
						if(isset($kraj) &&$kraj!="") $wh[] = 'Kraj = '.'"'.$kraj.'"'; 
						if(isset($zarobki) &&$zarobki!="") $wh[] = 'Zarobki = '.'"'.$zarobki.'"'; 
						if(isset($marka_auta) &&$marka_auta!="") $wh[] = 'Marka_auta = '.'"'.$marka_auta.'"'; 
						if(isset($typ_auta) &&$typ_auta!="") $wh[] = 'Typ_auta = '.'"'.$typ_auta.'"'; 
						if(isset($silnik) &&$silnik!="") $wh[] = 'Silnik = '.'"'.$silnik.'"';
					
					//
					    if(isset($wiek_od) && $wiek_od!="") $wh[] = 'Wiek >= '.'"'.$wiek_od.'"';
					    if(isset($wiek_do) && $wiek_do!="") $wh[] = 'Wiek <= '.'"'.$wiek_do.'"';
					    if(isset($waga_od) && $waga_od!="") $wh[] = 'Waga >= '.'"'.$waga_od.'"';
					    if(isset($waga_do) && $waga_do!="") $wh[] = 'Waga <= '.'"'.$waga_do.'"';
					    if(isset($wzrost_od) && $wzrost_od!="") $wh[] = 'Wzrost >= '.'"'.$wzrost_od.'"';
					    if(isset($wzrost_do) && $wzrost_do!="") $wh[] = 'Wzrost <= '.'"'.$wzrost_do.'"';
					    if(isset($zarobki_od) && $zarobki_od!="") $wh[] = 'Zarobki >= '.'"'.$zarobki_od.'"';
					    if(isset($zarobki_do) && $zarobki_do!="") $wh[] = 'Zarobki <= '.'"'.$zarobki_do.'"';
						
					
						
					
					 
						if (!empty($wh)) 
						{
						   $where = 'WHERE '.implode(' and ', $wh);
						   $query = 'SELECT * FROM tabela '.$where.'';
						   
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
							echo "<td>Silnik</td>";
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
	$_SESSION['blad'] = '';
?>
</div>
</body>
</html>