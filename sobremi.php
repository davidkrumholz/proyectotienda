<?php
require "php/sesion.php";
require "php/conn.php";
require "php/laterales.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Todo sobre mi</title>
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
				<li class="active"><a href="sobremi.php">Sobre mi</a></li>
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
			<h4>Productos más venidos</h4>
			<?php masVendidos($conn);  ?>
		</div>
		<div class="col-sm-8 text-left">
			<div class="well" id="contenedor">
			<h2 class="text-center">Todo sobre mi</h2>
			<p><img src="img/foto.png" width="200" class="media-object izq" alt="Mi foto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut massa eget odio porttitor rutrum. Aliquam vulputate lacus sem, non congue mauris venenatis id. Praesent elementum in purus ut dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed nec sodales ligula. Duis lobortis hendrerit enim, condimentum accumsan purus pellentesque ac. Phasellus neque nisl, scelerisque vel leo ac, condimentum sodales mauris.</p>		
			<p>Aliquam ligula elit, aliquet sit amet purus et, facilisis egestas nisl. Suspendisse mollis in orci a pellentesque. Nulla hendrerit urna eu lectus malesuada tempor. Quisque ullamcorper ante nec purus dignissim, et vulputate ipsum lobortis. Sed sed massa non lectus porta dictum ut at quam. Aenean lacinia urna quis feugiat sodales. Sed erat ligula, condimentum ut quam nec, mattis accumsan purus. Suspendisse dictum euismod porttitor. Praesent porttitor eleifend lorem, nec vestibulum neque dapibus sit amet. Aliquam eu aliquam risus, eget venenatis neque. Sed eget est posuere, molestie lectus vitae, tempus lacus. Donec mi lectus, maximus vel orci ut, maximus rutrum magna.</p>
			<p>Aliquam at sodales sem, at maximus nunc. In porta nisl vitae nisl pretium malesuada. Proin efficitur et nisi aliquam fringilla. Nullam vitae erat laoreet, vehicula ligula a, facilisis tortor. Duis posuere neque eu purus iaculis, varius cursus mi egestas. Donec tempor ullamcorper odio ac malesuada. Fusce vestibulum quam quis accumsan accumsan. Etiam sollicitudin congue nisi, sit amet tincidunt diam interdum at.</p>
			<p>Nunc tincidunt maximus ultrices. Proin facilisis venenatis diam, sit amet dictum ipsum rutrum ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi quis eros quis elit efficitur sollicitudin ut sed lectus. Etiam sed varius libero. Quisque commodo, ex at ornare commodo, ante orci laoreet orci, nec rhoncus ante lacus at nisl. Proin et eleifend urna.</p>
			<p>Integer nec sem efficitur, fringilla lectus eget, porttitor libero. Quisque id orci sit amet augue vulputate sagittis sit amet vitae diam. Praesent a felis ac metus congue finibus. Aliquam sed mollis nulla. Cras sollicitudin bibendum felis sagittis aliquet. Fusce sed nunc faucibus, iaculis quam nec, mollis urna. Sed accumsan justo id posuere condimentum.</p>
			</div>
		</div>
		<div class="col-sm-2 sidenav">
			<h4>Productos nuevos</h4>
			<?php nuevos($conn);  ?>		
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
<a href="aviso.php">Aviso de privacidad</a>
</footer>

</body>
</html>