<?php
session_start();
require_once '../../POJOs/Automovil.php';
require_once '../../persistencia/Automoviles.php';

$tAutomovil = Automoviles::singletonAutomoviles();

$idCar = $_GET['id'];
var_dump($idCar);
$tAutomovil->bajaAutomoviles($idCar);
var_dump($tAutomovil);

//header("Location: listCoche.php");
?>
