<?php
//Iniciamos sesion
session_start();
//Si existe la variabe usuario
if (isset($_SESSION['usuario'])) {
	//Pasamos los valores a variables de trabajo
	$nombre = $_SESSION['usuario']['nombre'];
	$apellidoPaterno = $_SESSION['usuario']['apellidoPaterno'];
	$apellidoMaterno = $_SESSION['usuario']['apellidoMaterno'];
}
?>
