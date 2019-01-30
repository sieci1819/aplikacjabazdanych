<?php

	session_start();
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
	$_SESSION['show_db']=1;
	header('Location: aplikacja.php');
	exit();

?>