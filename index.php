<?php
require "php/sesion.php";
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
	<div class="row">
		<div class="col-sm-3">
			<p><a href="producto.php">Bootstrap</a></p>
			<a href="producto.php">
				<img src="img/bootstrap.jpg" class="img-responsive img-rounded" style="width:100%" alt="Bootstrap">
			</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">IndexedDB</a></p>
			<a href="producto.php">
				<img src="img/indexeddb.jpg" class="img-responsive img-rounded" style="width:100%" alt="indexedDb">
			</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">JavaScript DOM</a></p>
			<a href="producto.php">
				<img src="img/javascriptdom.jpg" class="img-responsive img-rounded" style="width:100%" alt="JavaScriptDOM">
			</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">Phonegap Avanzado</a></p>
			<a href="producto.php">
				<img src="img/phonegapavanzado.jpg" class="img-responsive img-rounded" style="width:100%" alt="Phonegap Avanzado">
			</a>
		</div>
	</div>
</div><br>

<div class="container-fluid bg-3 text-center">
	<div class="row">
		<div class="col-sm-3">
			<p><a href="producto.php">AngularJS</a></p>
			<a href="producto.php">
				<img src="img/angularjs.jpg" class="img-responsive img-rounded" style="width:100%" alt="AngularJS">
			</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">Objective C</a></p>
			<a href="producto.php">
				<img src="img/objectivec.jpg" class="img-responsive img-rounded" style="width:100%" alt="Objective C">
			</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">Keynote</a></p>
			<a href="producto.php">
				<img src="img/keynote.jpg" class="img-responsive img-rounded" style="width:100%" alt="Keynote">
			</a>
		</div>
		<div class="col-sm-3">
			<p><a href="producto.php">iOS SDK</a></p>
			<a href="producto.php">
				<img src="img/iossdk.jpg" class="img-responsive img-rounded" style="width:100%" alt="iOS SDK">
			</a>
		</div>
	</div>
</div><br><br>

<footer class="container-fluid text-center">
	<p>Todos los derechos reservados &copy;</p>
	<form class="form-inline">Buscar:
		<input type="text" name="buscar" id="buscar" class="form-control" size="50" placeholder="buscar un producto">
		<button type="button" class="btn btn-info">ir</button>
	</form>
</footer>

</body>
</html>