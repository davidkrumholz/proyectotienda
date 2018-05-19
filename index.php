<?php
require "php/sesion.php";
require "php/conn.php";
//
$sql = "SELECT * FROM productos ORDER BY masvendido DESC, nombre";
$r = mysqli_query($conn, $sql);
$productos = array();
while ($row = mysqli_fetch_array($r)) {
	array_push($productos, $row);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mi sitio</title>
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
				<li class="active"><a href="index.php">Inicio</a></li>
				<li><a href="cursos.php">Cursos</a></li>
				<li><a href="libros.php">Libros</a></li>
				<li><a href="computadoras.php">Computadoras</a></li>
				<li><a href="sobremi.php">Sobre mi</a></li>
				<li><a href="contacto.php">Contacto</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php require "php/navbar.php"; ?>
			</ul>
		</div>
	</div>
</nav>

<div class="jumbotron">
	<div class="container text-center">
		<h1>Los mejores productos de la red</h1>
		<p>Nuestro slogan</p>
	</div>
</div>

<div class="container-fluid bg-3 text-center">
<?php
	// mostrar la seleccion de la tabla
	$ren = 0; //control de los productos por renglon
		for ($i=0; $i < count($productos) ; $i++) {
			if ($ren==0) {
				print '<div class="row">';
				}
			print '<div class="col-sm-3">';
			print '<img src="img/'.$productos[$i]["imagen"].'" class="img-responsive img-rounded" alt="'.$productos[$i]["nombre"].'" height= "50" >';
			print '<p><a href="producto.php?id='.$productos[$i]["id_producto"].'">'.$productos[$i]["nombre"].'</a></p>';
			print '</div>';
			$ren++;
			if ($ren==4) {
				$ren =0;
				print "</div>";
			}
		}// cerramos ciclo for
?>
</div><br>

<footer class="container-fluid text-center">
	<p>Todos los derechos reservados &copy;</p>
	<form action="busca.php" class="form-inline" method="get">Buscar:
		<input type="text" name="buscar" id="buscar" class="form-control" size="50" placeholder="buscar un producto">
		<button type="submit" class="btn btn-info">ir</button>
	</form>
</footer>

</body>
</html>