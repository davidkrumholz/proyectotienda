<?php
require "php/sesion.php";
require "php/conn.php";
require "php/carrito.php";
require "php/laterales.php";
error_reporting(0);
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$sql = "SELECT * FROM productos WHERE id_producto=".$id;
	$r = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($r);
}

function muestraProductoRelacionado($id, $conn) {
	$sql = "SELECT nombre,imagen FROM productos WHERE id_producto=".$id;
	$r = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($r);
	//Desplegamos etiquetas
	print '<div class="well">'.$data["nombre"];
	print '<a href="producto.php?id='.$id.'"><img src="img/'.$data["imagen"].'" class="media-object img-resposvive" width="100%"></a>';
		print '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Productos</title>
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
				<li class="active"><a href="cursos.php">Celulares</a></li>
				<li><a href="libros.php">Computadoras</a></li>
				<li><a href="sobremi.php">Sobre mi</a></li>
				<li><a href="contacto.php">Contacto</a></li>
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
			<img src="img/<?php print $data['imagen']; ?> " class="media-object img-responsive" heigth="50px" />
			<br>
			<h4>Núm. producto: <?php print $data['id_producto']; ?></h4>
			<h4>precio: $<?php print $data['precio']; ?></h4>
			<h4>Cantidad en almacen: <?php print $data['cantidad_almacen']; ?> </h4>
			<br><br>
			<div class="well"><p>Carrito de compras</p>
			<p>Total: $<?php print despliegaCarrito($carrito, $conn); ?></p>
			</div>
			<a href="carrito.php?id=<?php print $id; ?>" class="btn btn-success" role="button">comprar</a>
			<a href="index.php" class="btn btn-info" role="button">Regresar</a>
		</div>
		<div class="col-sm-8 text-left">
		<h2><?php print $data['nombre']; ?></h2>
		<br>
		<h4>Descripción:</h4>		
		<p><?php print $data['descripcion']; ?></p>
		</div>
		<div class="col-sm-2 sidenav">
		<h4>Productos relacionados</h4>
		<div class="well">
		<?php
			if ($data["relacion1"]!=0) {
				muestraProductoRelacionado($data["relacion1"], $conn);
			}
			if ($data["relacion2"]!=0) {
				muestraProductoRelacionado($data["relacion2"], $conn);
			}
			if ($data["relacion3"]!=0) {
				muestraProductoRelacionado($data["relacion3"], $conn);
			}
		?>
		
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
<a href="aviso.php">Aviso de privacidad</a>
</footer>

</body>
</html>