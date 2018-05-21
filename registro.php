<?php
require "php/conn.php";
require "php/sesion.php";
//se checa la informacion
if(isset($_POST["nombre"])) {
	$nombre = $_POST["nombre"];
	$apellidoPaterno = $_POST["apellidoPaterno"];
	$apellidoMaterno = $_POST["apellidoMaterno"];
	$email = $_POST["email"];
	$direccion = $_POST["direccion"];
	$ciudad = $_POST["ciudad"];
	$colonia = $_POST["colonia"];
	$estado = $_POST["estado"];
	$codpos = $_POST["codpos"];
	$pais = $_POST["pais"];
	$numtarjeta = $_POST["numtarjeta"];
	$fechanac = $_POST["fechanac"];
	$clave1 = $_POST["clave"];
	$clave2 = $_POST["clave2"];
	
	$errores = array();
	for($i=0; $i<=13; $i++) {
		$errores[$i] = ""; 
	};

	if ($nombre == "") {
		$errores[0]="El nombre del usuario es requerido";
	}else if ($apellidoPaterno == "") {
		$errores[1]="El apellido paterno del usuario es requerido";
	}else if ($email == "") {
		$errores[2]="El correo electronico del usuario es requerido";
	}else if ($direccion == "") {
		$errores[3]="La dirección del usuario es requerida";
	}else if ($ciudad == "") {
		$errores[4]="La ciudad del usuario es requerida";
	}else if ($colonia == "") {
		$errores[5]="la colonia del usuario es requerida";
	}else if ($colonia == "") {
		$errores[6]="La colonia del usuario es requerida";
	}else if ($codpos == "") {
		$errores[7]="El codigo postal del usuario es requerido";
	}else if ($pais == "") {
		$errores[8]="El país del usuario es requerido";
	} else if ($clave1 == "") {
		$errores[9] = "No hay clave 1";
	}else if ($clave2 == "") {
		$errores[10] = "No hay clave 2";
	}else if ($numtarjeta == "") {
		$errores[11] = "ingrese el numero de su tarjeta de 16 digitos";
	}else if ($fechanac == ""){
		$errores[12] = "Ingresa tu fecha de nacimiento";
	}else{			
		if(validaCorreo($email, $conn)) {
			if ($clave1 == $clave2) {
				//$clave=hash_hmac("sha512", $clave1, "mimamamemima");
				$sql = "INSERT INTO usuarios VALUES(0,";
				$sql .= "'".$nombre."', '".$apellidoPaterno."',";
				$sql .= "'".$apellidoMaterno."', '".$fechanac."', '".$email."',";
				$sql .= "'".$direccion."', '".$ciudad."',";
				$sql .= "'".$colonia."', '".$estado."',";
				$sql .= "'".$codpos."', '".$pais."','".$numtarjeta."','".$clave1."')";
				//
				if(mysqli_query($conn, $sql)) {
					header("location:registroGracias.php");
				}else {
					$errores[13]="Error al agregar a la base de datos";
				}
				}else {
					$errores[14] = "Las contraseñas no coinciden";
				}
			}else{
				$errores[15]="Ya existe el correo en la base de datos";
			}
		}
	}
		
function validaCorreo($email, $conn) {
	$sql = "SELECT * FROM usuarios WHERE email ='".$email."'";
	$r = mysqli_query($conn, $sql);
	$n = mysqli_num_rows($r);
	$bandera = ($n==0)? true : false;
	return $bandera;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registro</title>
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
		<div class="col-sm-8 text-left">
			<div class="well" id="contenedor">
					<?php
					if(isset($errores)){
					if(count($errores)>0) {
						print '<div class="alert alert-danger">';
						foreach ($errores as $key => $value) {
							print "<strong>".$value."</strong>";
						}
						print '</div>';
					}
				}
					?>
				<h2 class="text-center">Registro</h2>
				<p>Favor de capturar los siguientes datos:</p>
				<form action="registro.php" method="post">
					<div class="form-group text-left">
						<label for="nombre">* Nombre:</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Escriba su nombre"/>
					</div>

					<div class="form-group text-left">
						<label for="apellidoPaterno">* Apellido Paterno:</label>
						<input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" required placeholder="Escriba su apellido paterno"/>
					</div>

					<div class="form-group text-left">
						<label for="apellidoMaterno">Apellido Materno:</label>
						<input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="Escriba su apellido materno"/>
					</div>

					<div class="form-group text-left">
						<label for="fechanacimiento">* Fecha de nacimiento:</label>
						<input type="date" name="fechanac" id="fechanac" class="form-control"/>
					</div>

					<div class="form-group text-left">
						<label for="correo">* Correo electrónico:</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Escriba su correo electrónico"/>
					</div>

					<div class="form-group text-left">
						<label for="direccion">* Dirección:</label>
						<input type="text" name="direccion" id="direccion" class="form-control" placeholder="Escriba su dirección"/>
					</div>

					<div class="form-group text-left">
						<label for="ciudad">* Ciudad:</label>
						<input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Escriba su ciudad"/>
					</div>

					<div class="form-group text-left">
						<label for="colonia">* Colonia:</label>
						<input type="text" name="colonia" id="colonia" class="form-control" placeholder="Escriba su colonia"/>
					</div>

					<div class="form-group text-left">
						<label for="estado">* Estado:</label>
						<input type="text" name="estado" id="estado" class="form-control" placeholder="Escriba su estado"/>
					</div>

					<div class="form-group text-left">
						<label for="codpos">* Código Postal:</label>
						<input type="text" name="codpos" id="codpos" class="form-control" placeholder="Escriba su código postal"/>
					</div>

					<div class="form-group text-left">
						<label for="pais">* País:</label>
						<input type="text" name="pais" id="pais" class="form-control" placeholder="Escriba su país"/>
					</div>

					<div class="form-group text-left">
						<label for="numeor de tarjeta">* Numero de tarjeta:</label>
						<input type="text" name="numtarjeta" id="numtarjeta" class="form-control" placeholder="Escriba el numero de su tarjeta de 16 digitos"/>
					</div>

					<div class="form-group text-left">
						<label for="clave">* clave:</label>
						<input type="password" name="clave" id="clave" class="form-control" placeholder="Escriba contrasña"/>
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