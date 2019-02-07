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
	$_SESSION['wiek_od']=$_POST['wiek_od'];
	$_SESSION['wiek_do']=$_POST['wiek_do'];
	$_SESSION['waga_od']=$_POST['waga_od'];
	$_SESSION['waga_do']=$_POST['waga_do'];
	$_SESSION['wzrost_od']=$_POST['wzrost_od'];
	$_SESSION['wzrost_do']=$_POST['wzrost_do'];
	$_SESSION['zarobki_od']=$_POST['zarobki_od'];
	$_SESSION['zarobki_do']=$_POST['zarobki_do'];
	
	header('Location: aplikacja.php');
	exit();

?>