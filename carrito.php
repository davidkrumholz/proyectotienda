<?php
require "php/sesion.php";
require "php/conn.php";
require "php/laterales.php";
require "php/carrito.php";
error_reporting(0);
// la m nos indica que nos va a borrar.
if (isset($_GET["m"])) {
	$id = $_GET["id"];
	// delete
	$sql = "DELETE FROM carrito WHERE idProducto=".$id." AND num='".$carrito."'";
	if(!mysqli_query($conn, $sql)) print "error al borrar registro";


} else if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$sql = "SELECT * FROM productos WHERE id_producto=".$id;
	$r = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($r);
	//
	if (isset($_SESSION['carrito'])) {
		$carrito = $_SESSION['carrito'];
	}else {
		$carrito = llaveCarrito(30);
		$_SESSION['carrito']=$carrito;
	}

	print $carrito;

	agregaProducto($carrito, $id, $data["precio"], $data["descuento"], $data["envio"], $conn);
	
}
if(isset($_POST["num"])) {
	$num = $_POST["num"];
	for ($i=0; $i < $num; $i++) { 
		$producto = $_POST["i".$i];
		$cantidad = $_POST["c".$i];
		actualizaProducto($carrito, $producto, $cantidad, $conn);
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Carrito de compras</title>
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
					<li><a href="index.php">Inicio</a></li>
					<li class="active">Carrito</li>
				</ol>
				<?php despliegaCarritoCompleto($carrito, false, $conn); ?>
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