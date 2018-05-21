<?php
require "php/sesion.php";
require "php/conn.php";
require "php/laterales.php";
error_reporting(0);
if (isset($_SESSION["carrito"])) {
	$carrito = $_SESSION["carrito"];
}else {
	header("location:login.php");
	exit;
}
$sql = "UPDATE carrito ";
$sql .= "SET estado='1', idUsuario=".$_SESSION["usuario"]["id_usuarios"]; 
$sql .= " WHERE num='".$carrito."'";
if (mysqli_query($conn, $sql)) {
	unset($carrito);
	unset($_SESSION["carrito"]);
}else {
	$error = "error al actualizar el carrito";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gracias</title>
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
		<div class="col-sm-8 text-center">
			<div class="well" id="contenedor">
			<?php if (isset($error)) {
				print '<div class="alert alert-danger">';
				print '<strong>'.$error.'</strong>';
				print '</div';
			} else {
				print '<h2>Gracias por su compraaaaa</h2>';
				print '<p>Le llegara un correo para que guie su compra con la forma de envio.</p>';
				print '<a href="index.php" class="btn btn-success" role="button">Regresar</a>';
			}
			?>
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