<?php
session_start();
if (!isset($_SESSION["admon"])) {
	header("location:index.php");

}
require "../php/conn.php";
require "../php/funciones.php";
require "../php/carrito.php";
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

if ($m=="D") {
    $id = $_GET["id"];
    $sql = "SELECT * FROM carrito WHERE num='".$id."'";
    $r = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($r)) {

        $sql = "INSERT INTO historicopedidos ";
		$sql .= "SET num='".$data["num"]."', ";
		$sql .= "estado='".$data["estado"]."', ";
		$sql .= "idProducto=".$data["idProducto"].", ";
		$sql .= "precio=".$data["precio"].", ";
		$sql .= "descuento=".$data["descuento"].", ";
		$sql .= "envio=".$data["envio"].", ";
		$sql .= "cantidad =".$data["cantidad"]; 
        if (!mysqli_query($conn, $sql)) {
            print "error al insertar producto";
        }
    }
    $sql = "DELETE FROM carrito WHERE num='".$id."'";
    if (mysqli_query($conn, $sql)) {
        header("location:pedidosABC.php");
    }
    $errores = array("Error al borrar registro");
}
//se checa la informacion
error_reporting(0);
$errores =array();

// lee la tabla de productos
//tipo 0 celulares
//tipo 1 computadoras
if ($m=="S") {
	$sql = "SELECT num, estado, sum(precio) as importe, sum(cantidad) as cantidad, sum(descuento) as descuento, sum(envio) as envio, idUsuario, fecha FROM carrito GROUP BY num ORDER BY fecha";
	$r = mysqli_query($conn, $sql);
	$pedidos = array();
while ($data = mysqli_fetch_assoc($r)) {
	array_push($pedidos, $data);
	}
}

// lee un producto antes de ser borrado
if ($m=="B") {
	$carrito = $_GET["id"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>pedidos ABC</title>
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
                <li  class=""><a href="usuariosABC.php">Usuarios</a></li>
                <li  class="active"><a href="pedidosABC.php">Pedidos</a></li>
                <li  class=""><a href="cambiaClave.php">cambia clave</a></li>
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
			<h2 class="text-center">ABC tabla pedidos</h2>
                    <?php
                        if(count($errores)>0) {
                            print '<div class="alert alert-danger">';
                            foreach ($errores as $key => $valor) {
                                print "<strong>* ".$valor."</strong>";
                            }
                            print '</div>';
                        }
                    //Mostramos el pedido antes de ser borrado
					if($m=="B") {
                      print '<div class="alert alert-danger">';
                        print "Desea borrar este pedido?";
                        print "<a href='pedidosABC.php'>No</a>&nbsp;";
                        print "<a href='pedidosABC.php?m=D&id=".$carrito."'>Si</a>";
                        print "<p>Los datos del pedido se traspasaran al historial.</p>";
                        print "</div>";
                        despliegaCarritoConsulta($carrito, $conn);
                    } 
				// mostrar la seleccion de la tabla
				if ($m == "S") {
                    print "<table class='table table-striped' width='100%'>";
                    print "<tr>";
                    print "<th>Estado</th>";
                    print "<th>Importe</th>";
                    print "<th>Cantidad de productos</th>";
                    print "<th>Descuento</th>";
                    print "<th>Envio</th>";
                    print "<th>Total</th>";
                    print "<th>Cliente</th>";
                    print "<th>Fecha</th>";
                    print "<th>Borrar</th>";
                    print "</tr>";

					for ($i=0; $i < count($pedidos) ; $i++) {
                        $total = $pedidos[$i]["importe"]-$pedidos[$i]["descuento"]+$pedidos[$i]["envio"];
                        if ($pedidos[$i]["estado"]==0) {
                            print "<tr class='warning'>";
                            print "<td>";
                            print "Abierto";
                        }
                        if ($pedidos[$i]["estado"]==1) {
                            print "<tr class='success'>";
                            print "<td>";
                            print "Aprobado";
                        }
                        print "</td>";
                        print "<td>".number_format($pedidos[$i]["importe"],2)."</td>";
                        print "<td>".number_format($pedidos[$i]["cantidad"])."</td>";
                        print "<td>".number_format($pedidos[$i]["descuento"],2)."</td>";
                        print "<td>".number_format($pedidos[$i]["envio"],2)."</td>";
                        print "<td>".number_format($total,2)."</td>";
                        print "<td>".$pedidos[$i]["idUsuario"]."</td>";
                        print "<td>".$pedidos[$i]["fecha"]."</td>";
                        print "<td><a class='btn btn-danger' href='pedidosABC.php?m=B&id=".$pedidos[$i]["num"]."'>Borrar</a></td>";
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