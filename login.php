<?php
require "php/conn.php";
require "php/sesion.php";
error_reporting(0);
if (isset($_POST["email"])) {
	$email = $_POST["email"];
	$clave = $_POST["clave"];
	//$clave2 = hash_hmac("sha512", $clave, "mimamamemima");
	$recordarme = $_POST["recordarme"];
	//recuerdame
	$nombre = "datos";
	$valor = $email."|".$clave;
	if ($recordarme == "on") {
		$fecha = time() + (60*60*24*7);
	}else{
		$fecha = time() - 1;
	}
	setcookie($nombre, $valor, $fecha);
	//Creamos el query
	$sql = "SELECT * FROM usuarios WHERE email='".$email."' AND clave = '".$clave."'";
	$r = mysqli_query($conn, $sql);
	$n = mysqli_num_rows($r);
	//Clave y usuario correco
	if($n==1) {
		//pasamos los datos a un objeto
		$usuario = mysqli_fetch_assoc($r);
		//Iniciar sesion
		session_start();
		//Creamos la variable de sesion
		$_SESSION['usuario']=$usuario;
		//Saltamos a index
		header("location:index.php");
	}else{
		$error = "Clave de acceso o correo electronico incorrectos";
	}
}
$datos = $_COOKIE["datos"];
$email = "";
$clave = "";
$recordarme = "";
if(isset($datos)) {
	$aDatos = explode("|", $datos);
	$email = $aDatos[0];
	$clave = $aDatos[1];
	$recordarme = "checked";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
			<?php
					if(isset($error)>0) {
						print '<div class="alert alert-danger">';
						print "<strong>".$error."</strong>";
						print '</div>';
					}
					?>
				<h2>Iniciar sesión</h2>
				<form class="text-left" action="login.php" method="post">
					<div class="form-group">
						<label for="email">Correo electrónico:</label>
						<input type="email" name="email" id="email" class="form-control" required placeholder="Escribe tu correo electrónico" value = "<?php print $email; ?>">
					</div>
					<div class="form-group">
						<label for="clave">Clave de acceso:</label>
						<input type="password" name="clave" id="clave" class="form-control" required placeholder="Escribe tu clave de acceso" value = "<?php print $clave; ?>">
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id="recordarme" name="recordarme" <?php print "$recordarme"; ?>>Recordarme</label>
		
					</div>
					<div class="form-group text-left">
					<label for="entrar"></label>
					<input type="submit" name="entrar" value="Entrar" class="btn btn-success" role="button"/>
					</div>
				</form>
			</div>
			<div class="well text-left" id="contenedor" >
				<a href="olvido.php" class="btn btn-info">¿Olvidó su clave de acceso?</a>
				<br><br>
				<a href="registro.php" class="btn btn-info">Registrarte en el sitio</a>
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