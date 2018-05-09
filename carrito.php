<?php
require "php/sesion.php";
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
		<div class="col-sm-8 text-left">
			<div class="well" id="contenedor">
				<ol class="breadcrumb">
					<li><a href="index.php">Inicio</a></li>
					<li class="active">Carrito</li>
				</ol>
				<table class="table-striped" width="100%">
					<tr>
						<th width="12%">Producto</th>
						<th width="58%">Descripción</th>
						<th width="1.8%">Cant.</th>
						<th width="10.12%">Precio</th>
						<th width="10.12%">Subtotal</th>
						<th width="1%"></th>
						<th width="6.5%">Borrar</th>
					</tr>
					<tr>
						<td>
							<img src="img/bootstrap.jpg" width="105" alt="bootstrap">
						</td>
						<td>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut massa eget odio porttitor rutrum. Aliquam vulputate lacus sem, non congue mauris venenatis id. Praesent elementum in purus ut dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed nec sodales ligula. Duis lobortis hendrerit enim, condimentum accumsan purus pellentesque ac. Phasellus neque nisl, scelerisque vel leo ac, condimentum sodales mauris.</p>
						</td>
						<td class="text-right">1</td>
						<td class="text-right">$150.00</td>
						<td class="text-right">$150.00</td>
						<td>&nbsp;</td>
						<td class="text-right"><a href="#" class="btn btn-danger">Borrar</a></td>
					</tr>
				</table>
				<hr>
				<table width="100%" class="text-right">
					<tr>
						<td width="79.85%"></td>
						<td width="11.55%">Subtotal:</td>
						<td width="9.20%">$150.00</td>
					</tr>
					<tr>
						<td></td>
						<td>Descuento:</td>
						<td>$0.00</td>
					</tr>
					<tr>
						<td></td>
						<td>Costo de envío:</td>
						<td>$0.00</td>
					</tr>
					<tr>
						<td></td>
						<td>Gran total:</td>
						<td>$150.00</td>
					</tr>
					<tr>
						<td><a href="index.php" class="btn btn-info" role="button">Seguir comprando</a></td>
						<td><a href="#" class="btn btn-info" role="button">Recalcular</a></td>
						<td><a href="checkout.php" class="btn btn-success" role="button">Pagar</a></td>
					</tr>
				</table>
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