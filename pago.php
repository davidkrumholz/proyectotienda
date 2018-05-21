<?php
require "php/sesion.php";
require "php/conn.php";
require "php/laterales.php";
if (!isset($_SESSION["usuario"])) {
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forma de pago</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.php" class="navbar-brand">Mi sitio</a>
		</div>
		<div class="collapse navbar-collapse" id="menu">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Inicio</a></li>
				<li><a href="cursos.php">Celulares</a></li>
				<li><a href="libros.php">Computadoras</a></li>
				<li><a href="sobremi.php">Sobre mi</a></li>
				<li class="active"><a href="contacto.php">Contacto</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php require "php/navbar.php"; ?>
			</ul>
		</div>
	</div>
</nav>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-sm-2 sidenav">
			<h4>Productos más venidos</h4>
			<?php masVendidos($conn); ?>
		</div>
		<div class="col-sm-8 text-left">
			<div class="well" id="contenedor">
				<ol class="breadcrumb">
					<li><a href="checkout.php">Iniciar sesión</a></li>
					<li><a href="direccion.php">Datos de envío</a></li>
					<li class="active">Forma de pago</li>
					<li>Revisar</li>
				</ol>
				<h2 class="text-center">Formas de pago</h2>
				<p>Favor de seleccinar una de las formas de pago:</p>
				<form action="verifica.php" method = "post">
					<div class="radio">
						<label><input type="radio" name="pago" id="tarjeta1" value="bancomer">Tarjeta Bancomer</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="pago" id="tarjeta2" value="santander">Tarjeta Santander</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="pago" id="tarjeta3" value="banamex">Tarjeta Banamex</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="pago" id="efectivo" value="efectivo">Efectivo</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="pago" id="pay Pal" value="paypal">Pay Pal</label>
					</div>
					<div class="form-group text-left">
						<label for="enviar"></label>
						<input type="submit" name="enviar" value="Enviar" class="btn btn-success" role="button"/>
					</div>

				</form>
			</div>
		</div>
		<div class="col-sm-2 sidenav">
		<h4>Productos nuevos</h4>
			<?php nuevos($conn); ?>
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
<a href="aviso.php">Aviso de privacidad</a>
</footer>

</body>
</html>