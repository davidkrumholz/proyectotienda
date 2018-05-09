<?php
require "php/sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Olvido Gracias</title>
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
				<li><a href="libros.php">Libros</a></li>
				<li><a href="computadoras.php">Computadoras</a></li>
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
			<div class="well">iOS SDK
				<a href="producto.php"><img src="img/iossdk.jpg" class="media-object img-resposvive" width="100%"></a>
			</div>
			<div class="well">Keynote
				<a href="producto.php"><img src="img/keynote.jpg" class="media-object img-resposvive" width="100%"></a>
			</div>
			<div class="well">Objective C
				<a href="producto.php"><img src="img/objectivec.jpg" class="media-object img-resposvive" width="100%"></a>
			</div>
		</div>
		<div class="col-sm-8 text-center">
			<div class="well" id="contenedor">
				<h2>En breve llegará tu clave de acceso</h2>
				<p>Revisa tu buzón y cambia la clave de acceso</p>

				<a href="index.php" class="btn btn-success">Regresar</a>
			</div>
		</div>
		<div class="col-sm-2 sidenav">
		<h4>Productos relacionados</h4>
		<div class="well">AngularJS
			<a href="producto.php"><img src="img/angularjs.jpg" class="media-object img-resposvive" width="100%"></a>
		</div>
		<div class="well">IndexedDB
			<a href="producto.php"><img src="img/indexeddb.jpg" class="media-object img-resposvive" width="100%"></a>
		</div>
		<div class="well">JavaScript DOM
			<a href="producto.php"><img src="img/javascriptdom.jpg" class="media-object img-resposvive" width="100%"></a>
		</div>
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
<a href="aviso.php">Aviso de privacidad</a>
</footer>

</body>
</html>