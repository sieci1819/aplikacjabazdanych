<?php

	session_start();
	
	$_SESSION['id'] = $_POST['id'];
	$_SESSION['imie'] = $_POST['imie'];
	$_SESSION['nazwisko'] = $_POST['nazwisko'];
	$_SESSION['plec'] = $_POST['plec'];
	$_SESSION['wiek'] = $_POST['wiek'];
	$_SESSION['waga'] = $_POST['waga'];
	$_SESSION['wzrost'] = $_POST['wzrost'];
	$_SESSION['kolor_oczu'] = $_POST['kolor_oczu'];
	$_SESSION['kolor_wlosow'] = $_POST['kolor_wlosow'];
	$_SESSION['miasto'] = $_POST['miasto'];
	$_SESSION['kraj'] = $_POST['kraj'];
	$_SESSION['zarobki'] = $_POST['zarobki'];
	$_SESSION['marka_auta'] = $_POST['marka_auta'];
	$_SESSION['typ_auta'] = $_POST['typ_auta'];
	$_SESSION['silnik'] = $_POST['silnik'];
	
	header('Location: aplikacja.php');
	exit();

?>