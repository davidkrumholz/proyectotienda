<?php
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
		header("location:".$saltapagina);
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