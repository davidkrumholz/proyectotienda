<?php
error_reporting(0);
session_start();
if (!isset($_SESSION["admon"])) {
	header("location:index.php");
}
require "../php/conn.php";

if (isset($_POST["clave1"])) {
    $clave1 = $_POST["clave1"];
	$clave2 = $_POST["clave2"];
    //Verificamos las claves
    if ($clave1 == $clave2){
		//$clave = hash_hmac("sha512",$clave1,"mimamamemima");
		$sql = "UPDATE admon SET clave ='".$clave1."' WHERE id=1";
		if (mysqli_query($conn, $sql)) {
			header("location:index.php");
		}else{
			$error = "Error al actualizar la clave de acceso";
		}
    }else{
        $error = "Las claves de acceso no coinciden";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cambia clave administracion</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/main.css"/>
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
                <li  class=""><a href="productosABC.php">celulares</a></li>
                <li  class=""><a href="computadorasABC.php">computadoras</a></li>
				<li  class=""><a href="usuariosABC.php">Usuarios</a></li>
                <li  class=""><a href="pedidosABC.php">Pedidos</a></li>
                <li  class="active"><a href="cambiaClave.php">Cambia clave</a></li>
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
			
		</div>
		<div class="col-sm-8 text-left">
			<div class="well" id="contenedor">
					<?php
					if(isset($error)) {
						print '<div class="alert alert-danger">';
							print "<strong>".$error."</strong>";
						print '</div>';
					}
					?>
				<h2 class="text-center">Cambia Clave de acceso</h2>
				<form action="cambiaClave.php" method="post">
				
					<div class="form-group text-left">
						<label for="clave">* clave:</label>
						<input type="password" name="clave1" id="clave1" class="form-control" placeholder="Escriba contrasña"/>
					</div>

					<div class="form-group text-left">
						<label for="clave2">* vuelva a escribir su contraseña:</label>
						<input type="password" name="clave2" id="clave2" class="form-control" placeholder="Escriba vuelva a escribir su contraseña"/>
					</div>

					<div class="form-group text-left">
						<label for="enviar"></label>
						<input type="submit" name="enviar" value="Enviar" class="btn btn-success" role="button"/>
					</div>

				
                </form>

			</div>
		</div>
		<div class="col-sm-2 sidenav">
		
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
</footer>

</body>
</html>