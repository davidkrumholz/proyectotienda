<?php
require "php/sesion.php";
require "php/conn.php";
require "php/laterales.php";
error_reporting(0);
if(!isset($_SESSION["usuario"])) {
	header("location:login.php");
	exit;
}
if(isset($_POST["nombre"])) {
	// recuperamos el identificador desde la sesion
	$id = $_SESSION["usuario"]["id"];
	// recuperamos la informacion del usuario
	$nombre = $_POST["nombre"];
	$apellidoPaterno =$_POST["apellidoPaterno"];
	$apellidoMaterno = $_POST["apellidoMaterno"];
	$fechanac = $_POST["fechanac"];
	$correo = $_POST["correo"];
	$direccion = $_POST["direccion"];
	$ciudad = $_POST["ciudad"];
	$colonia = $_POST["colonia"];
	$estado = $_POST["estado"];
	$codpos = $_POST["codpos"];
	$pais = $_POST["pais"];
	//update
	$sql = "UPDATE usuarios SET ";
	$sql .= "nombre='".$nombre."', ";
	$sql .= "apellidoPaterno='".$apellidoPaterno."', ";
	$sql .= "apellidoMaterno='".$apellidoMaterno."', ";
	$sql .= "fechanac='".$fechanac."', ";
	$sql .= "email='".$correo."', ";
	$sql .= "direccion='".$direccion."', ";
	$sql .= "ciudad='".$ciudad."', ";
	$sql .= "colonia='".$colonia."', ";
	$sql .= "estado='".$estado."', ";
	$sql .= "codpos='".$codpos."', ";
	$sql .= "pais='".$pais."' ";
	$sql .= "WHERE id_usuarios=".$id;
	//ejecutamos el query
	if (mysqli_query($conn, $sql)) {
		print "si se ejecuto el query";
		$sql = "SELECT * FROM usuarios WHERE id_usuarios=".$id;
		$r = mysqli_query($conn, $sql);
		$usuario = mysqli_fetch_assoc($r);
		$_SESSION["usuario"]=$usuario;
		header("location:pago.php");
		exit;
		}
	}
//variables de trabajo
$nombre = $_SESSION["usuario"]["nombre"];
$apellidoPaterno = $_SESSION["usuario"]["apellidoPaterno"];
$apellidoMaterno = $_SESSION["usuario"]["apellidoMaterno"];
$fechanac = $_SESSION["usuario"]["fechanac"];
$correo = $_SESSION["usuario"]["email"];
$direccion = $_SESSION["usuario"]["direccion"];
$ciudad = $_SESSION["usuario"]["ciudad"];
$colonia = $_SESSION["usuario"]["colonia"];
$estado = $_SESSION["usuario"]["estado"];
$cospos = $_SESSION["usuario"]["codpos"];
$pais = $_SESSION["usuario"]["pais"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Datos de envío</title>
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
				<li><a href="cursos.php">Celulareas</a></li>
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
					<li class="active">Datos de envío</li>
					<li>Forma de pago</li>
					<li>Revisar</li>
				</ol>
				<h2 class="text-center">Datos de envío</h2>
				<p>Favor de verificar los siguientes datos para su envío:</p>
				<form action="pago.php" method="post">
					<div class="form-group text-left">
						<label for="nombre">* Nombre:</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Escriba su nombre" value="<?php print $nombre; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="apellidoPaterno">* Apellido Paterno:</label>
						<input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" required placeholder="Escriba su apellido paterno" value="<?php print $apellidoPaterno; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="apellidoMaterno">Apellido Materno:</label>
						<input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="Escriba su apellido materno" value="<?php print $apellidoMaterno; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="fechanacimiento">Fecha de nacimiento:</label>
						<input type="date" name="fechanac" id="fechanac" class="form-control" placeholder="" value="<?php print $fechanac; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="correo">* Correo electrónico:</label>
						<input type="email" name="correo" id="correo" class="form-control" placeholder="Escriba su correo electrónico" value="<?php print $correo; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="direccion">* Dirección:</label>
						<input type="text" name="direccion" id="direccion" class="form-control" placeholder="Escriba su dirección" value="<?php print $direccion; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="ciudad">* Ciudad:</label>
						<input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Escriba su ciudad" value="<?php print $ciudad; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="colonia">* Colonia:</label>
						<input type="text" name="colonia" id="colonia" class="form-control" placeholder="Escriba su colonia" value="<?php print $colonia; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="estado">* Estado:</label>
						<input type="text" name="estado" id="estado" class="form-control" placeholder="Escriba su estado" value="<?php print $estado; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="codpos">* Código Postal:</label>
						<input type="text" name="codpos" id="codpos" class="form-control" placeholder="Escriba su código postal" value="<?php print $cospos; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="pais">* País:</label>
						<input type="text" name="pais" id="pais" class="form-control" placeholder="Escriba su país" value="<?php print $pais; ?>"/>
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