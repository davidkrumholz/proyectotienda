<?php
session_start();
if (!isset($_SESSION["admon"])) {
	header("location:index.php");

}
require "../php/conn.php";
require "../php/funciones.php";
//Modo de la pagina
// S - consulta
// A - alta
// B - borrar
// C- cambiar
if (isset($_GET["m"])) {
	$m = $_GET["m"];
}else {
	$m = "S";
}

if ($m=="B") {
    $id =$_GET["id"];
    //verificamos que el usuario no tenga registro en la tabla de carrito
    $sql = "SELECT count(*) as num FROM carrito WHERE idUsuario=".$id;
    $r = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($r);
    $n = (mysqli_num_rows($r)==1)? $data["num"] : 0;
    if ($n>0) {
        print'<div class="alert alert-danger">';
        print "este usuario tiene ".$n." registros en el carrito de compras";
        print'</div>'; 
        $m = "S";
    }else {
        //borramos el registro
        $sql = "DELETE FROM usuarios WHERE id_usuarios=".$id;
	    if(mysqli_query($conn, $sql)) {
		    header("location:usuariosABC.php");
    }else {
        $errores = array("Error al borrar el usuario");
    }
	}
}
//se checa la informacion
error_reporting(0);
$errores =array();

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
	$sql .= "fechanac='', ";
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
		header("location:usuariosABC.php");
		exit;
		}
	}
// lee la tabla de productos
//tipo 0 celulares
//tipo 1 computadoras
if ($m=="S") {
	$sql = "SELECT * FROM usuarios";
	$r = mysqli_query($conn, $sql);
	$usuarios = array();
while ($data = mysqli_fetch_assoc($r)) {
	array_push($usuarios, $data);
	}
}

// lee un producto
if ($m=="C") {
	$id = $_GET["id"];
	$sql = "SELECT * FROM usuarios WHERE id_usuarios=".$id;
	$r = mysqli_query($conn, $sql);
	$data=mysqli_fetch_assoc($r);
	//Variables de trabajo
    $nombre = $data["nombre"];
    $apellidoPaterno = $data["apellidoPaterno"];
    $apellidoMaterno = $data["apellidoMaterno"];
    $fechanac = $data["fechanac"];
    $correo = $data["email"];
    $direccion = $data["direccion"];
    $ciudad = $data["ciudad"];
    $colonia = $data["colonia"];
    $estado = $data["estado"];
    $cospos = $data["codpos"];
    $pais = $data["pais"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Usuarios ABC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
	</script>
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
			<a href="productosABC.php" class="navbar-brand">Administracion</a>
		</div>
		<div class="collapse navbar-collapse" id="menu">
			<ul class="nav navbar-nav">
				<li  class=""><a href="productosABC.php">Celulares</a></li>
                <li  class=""><a href="computadorasABC.php">computadoras</a></li>
                <li  class="active"><a href="usuariosABC.php">Usuarios</a></li>
                <li  class=""><a href="pedidosABC.php">Pedidos</a></li>
                <li  class=""><a href="cambiaClave.php">Cambia clave</a></li>
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
			<h2 class="text-center">ABC tabla usuarios</h2>
                    <?php
                        if(count($errores)>0) {
                            print '<div class="alert alert-danger">';
                            foreach ($errores as $key => $valor) {
                                print "<strong>* ".$valor."</strong>";
                            }
                            print '</div>';
                        }
                    
					if($m=="C") {
                    
					?>
				<form action="usuariosABC.php" method="post">
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
                    <input type="text" name="codpos" id="codpos" class="form-control" placeholder="Escriba su código postal" value="<?php print $codpos; ?>"/>
                </div>

                <div class="form-group text-left">
                    <label for="pais">* País:</label>
                    <input type="text" name="pais" id="pais" class="form-control" placeholder="Escriba su país" value="<?php print $pais; ?>"/>
                </div>

                <input type="hidden" id="id" name="id" value="<?php print $id; ?>">

                <div class="form-group text-left">
                    <label for="enviar"></label>
                    <input type="submit" name="enviar" value="Enviar" class="btn btn-success" role="button"/>
                </div>

            </form>
				<?php } 
				// mostrar la seleccion de la tabla
				if ($m == "S") {
                    print "<table class='table table-striped' width='100%'>";
                    print "<tr>";
                    print "<th>id</th>";
                    print "<th>nombre</th>";
                    print "<th>apellido Paterno</th>";
                    print "<th>apellido Materno</th>";
                    print "<th>Borrar</th>";
                    print "</tr>";

					for ($i=0; $i < count($usuarios) ; $i++) {
						print "<tr>";
                        print "<td>".$usuarios[$i]["id_usuarios"]."</td>";
                        print "<td>".$usuarios[$i]["nombre"]."</td>";
                        print "<td>".$usuarios[$i]["apellidoPaterno"]."</td>";
                        print "<td>".$usuarios[$i]["apellidoMaterno"]."</td>";
                        print "<td><a class='btn btn-danger' href='usuariosABC.php?m=B&id=".$usuarios[$i]["id_usuarios"]."'>Borrar</a></td>";
                        print "</tr>";
                    }// cerramos ciclo fo6r
                    print "</table";
				}
				?>
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