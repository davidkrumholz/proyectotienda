<?php
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
	//recuperamos el nombre de la imagen
	$sql = "SELECT imagen FROM productos WHERE id=".$id;
	$r = mysqli_query($onn, $sql);
	$row = mysqli_fetch_assoc($r);
	$imagen = $row["imagen"];
	unlink("../img/".$imagen);
	//borramos el registro
	$sql = "DELETE FROM productos WHERE id_producto=".$id;
	if(mysqli_query($conn, $sql)) {
		header("location:productosABC.php");
	}else {
		$errores = array("Error al borrar el registro");
	}
}

//se checa la informacion
error_reporting(0);
$errores =array();

if(isset($_POST["nombre"])) {
	//recuperamos el id
	$id = (isset($_POST["id_producto"]))?$_POST["id_producto"]:"";
	$nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    //  Validacion de los numeros
    $precio = ($_POST["precio"]=="")?0:$_POST["precio"];
    $descuento = ($_POST["descuento"]=="")?0:$_POST["descuento"];
    $envio = ($_POST["envio"]=="")?0:$_POST["envio"];
    $imagen = $_POST["imagen"];
    $fecha = $_POST["fecha"];
    $relacion1 = $_POST["relacion1"];
    $relacion2 = $_POST["relacion2"];
    $relacion3 = $_POST["relacion3"];
    $masvendido = ($_POST["masvendido"]=="")?"0":"1";
    $nuevo = ($_POST["nuevos"]=="")?"0":"1";
    $cantidadalmacen = ($_POST["cantidad_almacen"]=="")?0:$_POST["cantidad_almacen"];
    $fabricante = $_POST["fabricante"];
    $origen = $_POST["origen"];
    
    // Validaciones
    if ($nombre=="") {
        array_push($errores, "El nombre del curso es requerido");
    }else if ($descripcion=="") {
        array_push($errores, "La descripcion es requerida");
    }else if (is_numeric($precio)==false) {
     array_push($errores, "Error en el precio, debe de ser numerico");   
    }else if (is_numeric($descuento)==false) {
        array_push($errores, "Error en el descuento, debe de ser numerico");
    }else if (is_numeric($envio)==false){
        array_push($errores, "Error en el monto de envio, debe ser numerico");
    }else if ($precio<=0 || $precio>99999.99){
        array_push($errores, "El precio esta fuera de rango");
    }else if (is_numeric($cantidadalmacen)==false) {
        array_push($errores, "Error en la cantidad en el almacen, debe de ser numerico");
    }else if ($precio<$descuento) {
        array_push($errores, "El precio no puede ser menor al descuento");
    }else if ($fecha=="") {
        array_push($errores, "La fecha es requerida");
    }else{
		//Valida imagen
		$buscar = array(' ', '*', '!', '@', '?');
		$reemplazar = array('', '', '', '', '');
		$imagen = str_replace($buscar, $reemplazar, $nombre);
		$imagen = $imagen.".jpg";
		$imagen = strtolower($imagen);
        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
           //copiamos del area temporal a nuestra carpeta
            copy($_FILES['imagen']['tmp_name'], "../img/".$imagen);
            //optimizacion el archivo
            validaImagen($imagen, 240);
        }else{
            array_push($errores, "Error en la carga de la imagen");
        }
		//
		if ($id=="") {
			$sql = "INSERT INTO productos VALUES(0,'0','".$nombre."', ";
			$sql .= "'".$descripcion."', ";
			$sql .= "".$precio.", ";
			$sql .= "".$descuento.", ";
			$sql .= "".$envio.", ";
			$sql .= "'".$imagen."', ";
			$sql .= "'".$fecha."', ";
			$sql .= "'".$relacion1."', ";
			$sql .= "'".$relacion2."', ";
			$sql .= "'".$relacion3."', ";
			$sql .= "'".$masvendido."', ";
			$sql .= "'".$nuevo."', ";
			$sql .= "".$cantidadalmacen.", ";
			$sql .= "'".$fabricante."', ";
			$sql .= "'".$origen."')";
		} else {
			$sql = "UPDATE productos SET ";
			$sql .= "nombre = '".$nombre."', ";
			$sql .= "descripcion = '".$descripcion."', ";
			$sql .= "precio = ".$precio.", ";
			$sql .= "descuento = ".$descuento.", ";
			$sql .= "envio = ".$envio.", ";
			$sql .= "imagen = '".$imagen."', ";
			$sql .= "fecha = '".$fecha."', ";
			$sql .= "relacion1 = '".$relacion1."', ";
			$sql .= "relacion2 = '".$relacion2."', ";
			$sql .= "relacion3 = '".$relacion3."', ";
			$sql .= "masvendido = '".$masvendido."', ";
			$sql .= "nuevos = '".$nuevo."', ";
			$sql .= "cantidad_almacen = ".$cantidadalmacen.", ";
			$sql .= "fabricante = '".$fabricante."', ";
			$sql .= "origen = '".$origen."' ";
			$sql .= "WHERE id_producto = ".$id;
			//print $sql;
		}
//
if(mysqli_query($conn, $sql)) {
} else {
	print "Error al insertar registro";
}
    }
}
// lee la tabla de productos
//tipo 0 cursos
//tipo 1 libros
if ($m=="S") {
	$sql = "SELECT * FROM productos";
	$r = mysqli_query($conn, $sql);
	$productos = array();
while ($row = mysqli_fetch_assoc($r)) {
	array_push($productos, $row);
	}
}
//lee la tabla de productos
if ($m=="A" || $m=="C") {
	$sql = "SELECT id_producto,nombre FROM productos ORDER BY nombre";
	$r = mysqli_query($conn, $sql);
	$productos = array();
while ($row = mysqli_fetch_assoc($r)) {
	array_push($productos, $row);
	}
}
// lee un producto
if ($m=="C") {
	$id = $_GET["id"];
	$sql = "SELECT * FROM productos WHERE id_producto=".$id;
	$r = mysqli_query($conn, $sql);
	$data=mysqli_fetch_assoc($r);
	//Variables de trabajo
	$nombre = $data["nombre"];
    $descripcion = $data["descripcion"];
    $precio = $data["precio"];
    $descuento = $data["descuento"];
    $envio = $data["envio"];
    $imagen = $data["imagen"];
    $fecha = $data["fecha"];
    $relacion1 = $data["relacion1"];
    $relacion2 = $data["relacion2"];
    $relacion3 = $data["relacion3"];
    $masvendido = $data["masvendido"];
    $nuevo = $data["nuevos"];
    $cantidadalmacen = $data["cantidad_almacen"];
    $fabricante = $data["fabricante"];
    $origen = $data["origen"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Productos ABC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
			window.onload = function() {
		<?php if($m=="C") { ?>
        document.getElementById("borrar").onclick = function() {
            if (confirm("Desea borrar el producto?\nUna vez borrado el registro No podra ser recuperado.")) {
				var id = <?php print $id; ?>;
				window.open("productosABC.php?m=B&id="+id,"_self");
				}
			}
		<?php } ?>

		<?php if($m=="S") { ?>
        document.getElementById("alta").onclick = function() {
				window.open("productosABC.php?m=A","_self");
			}
		<?php } else { ?>
			document.getElementById("regresar").onclick = function() {
        	window.open("productosABC.php","_self");
		}
	<?php } ?>
		}
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
				<li  class="active"><a href="productosABC.php">Productos</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			</ul>
		</div>
	</div>
</nav>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-sm-2 sidenav">
		<?php if ($m=="S") { ?>
		<label for="alta"></label>
		<input type="button" name="alta" value="Dar de alta un producto" class="btn btn-info" role="button" id="alta">
		<?php } ?>
		</div>
		<div class="col-sm-8 text-left">
			<div class="well" id="contenedor">
			<h2 class="text-center">ABC productos</h2>
					<?php
					if($m=="A" || $m=="C") {
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
				<form action="productosABC.php" method="post" enctype="multipart/form-data">
					<div class="form-group text-left">
						<label for="nombre">* Nombre producto:</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Escriba su nombre" value="<?php print $nombre; ?> "/>
					</div>

					<div class="form-group text-left">
						<label for="descripcion">* Descripcion:</label>
						<textarea name="descripcion" id="descripcion" class="form-control"><?php print $descripcion; ?></textarea>
					</div>

					<div class="form-group text-left">
						<label for="precio">*Precio:</label>
						<input type="text" name="precio" id="precio" class="form-control" placeholder="precio del producto" pattern="^(\d|-)?(\d|,)*\.?\d*$" value="<?php print $precio; ?> "/>
					</div>

					<div class="form-group text-left">
						<label for="descuento">* Descuento:</label>
						<input type="text" name="descuento" id="descuento" class="form-control" placeholder="Escriba el descuento del producto" pattern="^(\d|-)?(\d|,)*\.?\d*$" value="<?php print $descuento; ?> "/>
					</div>

					<div class="form-group text-left">
						<label for="envio">* Costo de envio</label>
						<input type="text" name="envio" id="envio" class="form-control" placeholder="Costo de envio" pattern="^(\d|-)?(\d|,)*\.?\d*$" value="<?php print $envio; ?> "/>
					</div>

					<div class="form-group text-left">
						<label for="imagen">* imagen:</label>
						<input type="file" name="imagen" id="imagen" class="form-control" accept="image/jpeg"/>
						<?php
						if (isset($imagen)) {
							print "<img src='../img/".$imagen."' width='150'/>";
							print "<p>".$imagen."</p>";
						}
						

						?>
					</div>

					<div class="form-group text-left">
						<label for="fecha">* fecha:</label>
						<input type="date" name="fecha" id="fecha" class="form-control" placeholder="Escriba la fecha de modificacion" value="<?php print $fecha; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="relacion1"> producto relacionado 1</label>
						<select name="relacion1" id="relacion1">
						<option value="0">-No hay productos relacionados-</option>
						<?php
							for ($i=0; $i < count($productos); $i++) { 
								print "<option value='".$productos[$i]["id_producto"]."'";
								if ($productos[$i]["id_producto"]==$relacion1) {
									print " selected ";
								}
								print "/>".$productos[$i]["nombre"]."</option>";
							}
						?>
						</select>
					</div>

					<div class="form-group text-left">
						<label for="relacion2"> producto relacionado 2</label>
						<select name="relacion2" id="relacion2">
						<option value="0">-No hay productos relacionados-</option>
						<?php
							for ($i=0; $i < count($productos); $i++) { 
								print "<option value='".$productos[$i]["id_producto"]."'";
								if ($productos[$i]["id_producto"]==$relacion2) {
									print " selected ";
								}
								print "/>".$productos[$i]["nombre"]."</option>";
							}
						?>
						</select>
					</div>

					<div class="form-group text-left">
						<label for="relacion3"> producto relacionado 3</label>
						<select name="relacion3" id="relacion3">
						<option value="0">-No hay productos relacionados-</option>
						<?php
							for ($i=0; $i < count($productos); $i++) { 
								print "<option value='".$productos[$i]["id_producto"]."'";
								if ($productos[$i]["id_producto"]==$relacion3) {
									print " selected ";
								}
								print "/>".$productos[$i]["nombre"]."</option>";
							}
						?>
						</select>
					</div>

					<div class="form-group text-left">
						<label>productos mas vendido:</label>
						<input type="checkbox" name="masvendido" id="masvendido" class="form-control"
						<?php if ($masvendido=="1") {
							print " checked ";
						}
						?>
						/>
					</div>

					<div class="form-group text-left">
						<label>producto nuevo:</label>
						<input type="checkbox" name="nuevos" id="nuevos" class="form-control" 
						<?php if ($nuevo=="1") {
							print " checked ";
						}
						?>
						/>
					</div>

					<div class="form-group text-left">
						<label for="cantidadalmacen">* cantidad en el almacen:</label>
						<input type="number" name="cantidad_almacen" id="cantidad_almacen" class="form-control" placeholder="Escriba la cantidad del producto en el almacen" pattern="^(\d|-)?(\d|,)*\.?\d*$" value="<?php print $cantidadalmacen; ?>"/>
					</div>

					<div class="form-group text-left">
						<label for="fabricante">* Fabricante:</label>
						<input type="text" name="fabricante" id="fabricante" class="form-control" placeholder="Escriba el nombre del fabricante"/ value="<?php print $fabricante; ?>">
					</div>

                    <div class="form-group text-left">
						<label for="origen">* origen:</label>
						<input type="text" name="origen" id="origen" class="form-control" placeholder="Escriba el origen del producto" value="<?php print $origen; ?>"/>
					</div>

					<input type="hidden" name="id_producto" id="id_producto" value="<?php print $id; ?>">

					<div class="form-group text-left">
						<label for="enviar"></label>
						<input type="submit" name="enviar" value="Enviar" class="btn btn-success" role="button"/>

						<label for="regresar"></label>
						<input type="button" name="regresar" value="regresar" class="btn btn-info" role="button" id="regresar"/>
						
						<?php if ($m=="C"){?>
						<label for="borrar"></label>
						<input type="button" name="borrar" value="borrar" class="btn btn-danger" role="button" id="borrar"/>
						<?php }?>
					</div>
					


				</form>
				<?php } 
				// mostrar la seleccion de la tabla
				if ($m == "S") {
					$ren = 0; //control de los productos por renglon
					for ($i=0; $i < count($productos) ; $i++) {
						if ($ren==0) {
							print '<div class="row">';
						}
						print '<div class="col-sm-3">';
						print '<img src="../img/'.$productos[$i]["imagen"].'" class="img-responsive img-rounded" alt="'.$productos[$i]["nombre"].'" style="height: 400;">';
						print '<p><a href="productosABC.php?m=C&id='.$productos[$i]["id_producto"].'">'.$productos[$i]["nombre"].'</a></p>';
						print '</div>';
						$ren++;
						if ($ren==4) {
							$ren =0;
							print "</div>";
						}
					}// cerramos ciclo for
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