<?php
require "php/sesion.php";
require "php/conn.php";
require "php/laterales.php";
if (isset($_GET["buscar"])) {
    $buscar = $_GET["buscar"];
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$buscar."%'";
    $r = mysqli_query($conn, $sql);
    $productos = array();
    while ($data = mysqli_fetch_assoc($r)) {
        array_push($productos, $data);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Buscar</title>
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
				<?php masVendidos($conn); ?>
		</div>
		<div class="col-sm-8 text-left">
			<div class="well" id="contenedor">
				<h2 class="text-center">Resultados busqueda: <?php print $buscar; ?></h2>
                <?php
                    for ($i=0; $i < count($productos); $i++) { 
                        print '<div class"media">';
                        print '<div class="media-left">';
                        print '<img src="img/'.$productos[$i]["imagen"].'" class="media-object"/>';
                        print '</div>';
                        print '<div class="media-body">';
                        print '<h4 class="media-heading"><a href="producto.php?id='.$productos[$i]["id_producto"].'">'.$productos[$i]["nombre"].'</a></h4>';
                        print '<p>'.$productos[$i]["descripcion"].'</p>';
                        print '</div>';
                        print '</div>';
                    }
                ?>
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