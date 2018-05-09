<?php
require "php/sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Todos los libros</title>
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
				<li><a href="cursos.php">Cursos</a></li>
				<li class="active"><a href="libros.php">Libros</a></li>
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
		<h1>Todos los libros</h1>
		<p>Los mejores productos de la red</p>
	</div>
</div>

<div class="container-fluid bg-3 text-center">
	<div class="row">
		<div class="col-sm-3">
			<p><a href="producto.php">Libro 1</a></p>
			<a href="producto.php">
				<img src="img/libros.jpg" class="img-responsive img-rounded" style="width:100%" alt="Bootstrap">
			</a>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit gravida sem, quis aliquet ante. Nulla nec feugiat risus. Nunc ullamcorper faucibus tempor. Etiam elementum sapien ac cursus facilisis. Pellentesque id vulputate ipsum. Quisque massa leo, malesuada ut ullamcorper et, convallis porta tellus. Sed sit amet ipsum ligula. Vivamus imperdiet gravida lacus, at vulputate erat tincidunt non. Aenean felis lorem, aliquet in tempor ac, lobortis id ex. Nunc nec ex tellus. Quisque nibh nunc, blandit feugiat ultricies in, varius vel risus. Fusce venenatis massa sed nibh elementum pretium.</p>
			<a href="producto.php" class="btn btn-info">$150.00</a>
			
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">Libro 2</a></p>
			<a href="producto.php">
				<img src="img/libros1.jpg" class="img-responsive img-rounded" style="width:100%" alt="indexedDb">
			</a>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit gravida sem, quis aliquet ante. Nulla nec feugiat risus. Nunc ullamcorper faucibus tempor. Etiam elementum sapien ac cursus facilisis. Pellentesque id vulputate ipsum. Quisque massa leo, malesuada ut ullamcorper et, convallis porta tellus. Sed sit amet ipsum ligula. Vivamus imperdiet gravida lacus, at vulputate erat tincidunt non. Aenean felis lorem, aliquet in tempor ac, lobortis id ex. Nunc nec ex tellus. Quisque nibh nunc, blandit feugiat ultricies in, varius vel risus. Fusce venenatis massa sed nibh elementum pretium.</p>
			<a href="producto.php" class="btn btn-info">$250.00</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">Libro 3</a></p>
			<a href="producto.php">
				<img src="img/libros2.jpg" class="img-responsive img-rounded" style="width:100%" alt="JavaScriptDOM">
			</a>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit gravida sem, quis aliquet ante. Nulla nec feugiat risus. Nunc ullamcorper faucibus tempor. Etiam elementum sapien ac cursus facilisis. Pellentesque id vulputate ipsum. Quisque massa leo, malesuada ut ullamcorper et, convallis porta tellus. Sed sit amet ipsum ligula. Vivamus imperdiet gravida lacus, at vulputate erat tincidunt non. Aenean felis lorem, aliquet in tempor ac, lobortis id ex. Nunc nec ex tellus. Quisque nibh nunc, blandit feugiat ultricies in, varius vel risus. Fusce venenatis massa sed nibh elementum pretium.</p>
			<a href="producto.php" class="btn btn-info">$350.00</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">Libro 4</a></p>
			<a href="producto.php">
				<img src="img/libros3.jpg" class="img-responsive img-rounded" style="width:100%" alt="Phonegap Avanzado">
			</a>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit gravida sem, quis aliquet ante. Nulla nec feugiat risus. Nunc ullamcorper faucibus tempor. Etiam elementum sapien ac cursus facilisis. Pellentesque id vulputate ipsum. Quisque massa leo, malesuada ut ullamcorper et, convallis porta tellus. Sed sit amet ipsum ligula. Vivamus imperdiet gravida lacus, at vulputate erat tincidunt non. Aenean felis lorem, aliquet in tempor ac, lobortis id ex. Nunc nec ex tellus. Quisque nibh nunc, blandit feugiat ultricies in, varius vel risus. Fusce venenatis massa sed nibh elementum pretium.</p>
			<a href="producto.php" class="btn btn-info">$250.00</a>
		</div>
	</div>
</div><br>
<br>

<footer class="container-fluid text-center">
	<p>Todos los derechos reservados &copy;</p>
	<form class="form-inline">Buscar:
		<input type="text" name="buscar" id="buscar" class="form-control" size="50" placeholder="buscar un producto">
		<button type="button" class="btn btn-info">ir</button>
	</form>
</footer>

</body>
</html>