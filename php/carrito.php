<?php
if(isset($_SESSION['carrito'])) {
	$carrito = $_SESSION['carrito'];
}

function despliegaCarrito($carrito, $conn) {
	//variables de trabajo
	$subtotal = 0;
	$decuento = 0;
	$envio = 0;
	$total = 0;
	// leer los datos del carrito
	$sql = "SELECT c.idUsuario as usuario, ";
	$sql .= "c.idProducto as producto, ";
	$sql .= "c.cantidad as cantidad, ";
	$sql .= "c.precio as precio, ";
	$sql .= "c.envio as envio, ";
	$sql .= "c.descuento as descuento, ";
	$sql .= "p.imagen as imagen, ";
	$sql .= "p.descripcion as descripcion, ";
	$sql .= "p.nombre as nombre ";
	$sql .= "FROM carrito as c, productos as p ";
	$sql .= "WHERE num='".$carrito."' AND ";
	$sql .= "c.idProducto=p.id_producto";
	//ejecuramos el query
	$r = mysqli_query($conn, $sql);
	if (!mysqli_query($conn, $sql)) {
		print "error al buscar los productos";
	}
			while ($data = mysqli_fetch_assoc($r)) {
				$tot = $data['cantidad'] * $data['precio'];
				$subtotal += $tot;
				$descuento += $data["descuento"];
				$envio += $data["envio"];
			}
            $total = $subtotal + $envio - $descuento;
            return number_format($total,2);
}

function actualizaProducto($carrito, $producto, $cantidad, $conn){
	$sql = "UPDATE carrito ";
	$sql .= "SET cantidad=".$cantidad." ";
	$sql .= "WHERE num='".$carrito."' AND idProducto=".$producto;
	
	if (!mysqli_query($conn, $sql)) {
		print "Error al modificar un registro";
	}else {
	}
}

function llaveCarrito($Len) {
	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,
	 $Len);
}

function agregaProducto($carrito, $id, $precio, $descuento, $envio, $conn) {
	//Verificamos eciste el producto en el carrito
	$sql = "SELECT * FROM carrito WHERE num='".$carrito."' AND idProducto=".$id;
	$r = mysqli_query($conn, $sql);
	if (mysqli_num_rows($r)==0) {
		$sql = "INSERT INTO carrito ";
		$sql .= "SET num='".$carrito."', ";
		$sql .= "estado='0', ";
		$sql .= "idProducto=".$id.", ";
		$sql .= "precio=".$precio.", ";
		$sql .= "descuento=".$descuento.", ";
		$sql .= "envio=".$envio.", ";
		$sql .= "cantidad =1";
		if (!mysqli_query($conn, $sql)) {
			print "Error al insertar el producto";
		}
	}
}

function despliegaCarritoCompleto($carrito, $verifica, $conn) {
	//variables de trabajo
	$subtotal = 0;
	$decuento = 0;
	$envio = 0;
	$total = 0;
	// leer los datos del carrito
	$sql = "SELECT c.idUsuario as usuario, ";
	$sql .= "c.idProducto as producto, ";
	$sql .= "c.cantidad as cantidad, ";
	$sql .= "c.precio as precio, ";
	$sql .= "c.envio as envio, ";
	$sql .= "c.descuento as descuento, ";
	$sql .= "p.imagen as imagen, ";
	$sql .= "p.descripcion as descripcion, ";
	$sql .= "p.nombre as nombre, ";
	$sql .= "p.cantidad_almacen as almacen ";
	$sql .= "FROM carrito as c, productos as p ";
	$sql .= "WHERE num='".$carrito."' AND ";
	$sql .= "c.idProducto=p.id_producto";
	//ejecuramos el query
	$r = mysqli_query($conn, $sql);
	if (!mysqli_query($conn, $sql)) {
		print "error al buscar los productos";
	}
	print '<form action="carrito.php" method="post">';
	print '<table class="table-striped" width="100%">';
	print '<tr>';
		print'<th width="12%">Producto</th>';
		print'<th width="58%">Descripción</th>';
		print'<th width="1.8%">Cant.</th>';
		print'<th width="10.12%">Precio</th>';
		print'<th width="10.12%">Subtotal</th>';
		print'<th width="1%"></th>';
		print'<th width="6.5%">Borrar</th>';
		print'</tr>';
		$i=0;
			while ($data = mysqli_fetch_assoc($r)) {
				$cantidad = $data['cantidad'];
				$desc = $data['descripcion'];
				$almacen = $data['almacen'];
				$nom = $data['nombre'];
				$num = $data['producto'];
				$tot = $data['cantidad'] * $data['precio'];
				$almacentot = $almacen - $cantidad;
				print'<tr>';
				print'<td>';
				print'<img src="img/' .$data['imagen'].'" width="105" alt="'.$nom.'">';
				print'</td>';
				print'<td>';
				print'<p>' .$desc.'</p>';
				print'</td>';
				print'<td class="text-right">';
				print '<input type="number" name="c'.$i.'" value="'.$data['cantidad'].'" min="1" max="99"/>';
				print '<input type="hidden" name="i'.$i.'" value="'.$data['producto'].'"/>';
				print'</td>';
				print'<td class="text-right">$'.$data['precio'].'</td>';
				print'<td class="text-right">$'.$tot.'</td>';
				print'<td>&nbsp;</td>';
				print'<td class="text-right"><a href="carrito.php?m=b&id='.$data['producto'].'" class="btn btn-danger">Borrar</a></td>';
				print'</tr>';
				$subtotal += $tot;
				$descuento += $data["descuento"];
				$envio += $data["envio"];
				$sql1 = "UPDATE productos ";
				$sql1 .= "SET cantidad_almacen=".$almacentot." ";
				$sql1 .= "WHERE id_producto = ".$num;
				if (!mysqli_query($conn, $sql1)) {
					print "Error al modificar un registro";
				}else {
				}
				//$i++;
			}
			$total = $subtotal + $envio - $descuento;
			print '<input type="hidden" name="num" value="'.$i.'"/>';
			print'</table>';
			print'<hr>';
			print'<table width="100%" class="text-right">';
			print'<tr>';
			print'<td width="79.85%"></td>';
			print'<td width="11.55%">Subtotal:</td>';
			print'<td width="9.20%">$'.number_format($subtotal,2).'</td>';
			print'</tr>';
			print'<tr>';
			print'<td></td>';
			print'<td>Descuento:</td>';
			print'<td>$'.number_format($descuento,2).'</td>';
			print'</tr>';
			print'<tr>';
			print'<td></td>';
			print'<td>Costo de envío:</td>';
			print'<td>$'.number_format($envio,2).'</td>';
			print'</tr>';
			print'<tr>';
			print'<td></td>';
			print'<td>Gran total:</td>';
			print'<td>$'.number_format($total,2).'</td>';
			print'</tr>';
			print'<tr>';
			print'<td><a href="index.php" class="btn btn-info" role="button">Seguir comprando</a></td>';
			print'<td><input type="submit" class="btn btn-info" role="button" value ="Recalcular"></td>';

			if ($verifica) {
				print'<td><a href="gracias.php" class="btn btn-success" role="button">Pagar</a></td>';
			}else {
				print'<td><a href="checkout.php" class="btn btn-success" role="button">Pagar</a></td>';
			}
			print'</tr>';
			print'</table>';
			print '</form>';
				
}

function despliegaCarritoConsulta($carrito, $conn) {
	$subtotal = 0;
	$decuento = 0;
	$envio = 0;
	$total = 0;
	// leer los datos del carrito
	$sql = "SELECT c.idUsuario as usuario, ";
	$sql .= "c.idProducto as producto, ";
	$sql .= "c.cantidad as cantidad, ";
	$sql .= "c.precio as precio, ";
	$sql .= "c.envio as envio, ";
	$sql .= "c.descuento as descuento, ";
	$sql .= "p.imagen as imagen, ";
	$sql .= "p.descripcion as descripcion, ";
	$sql .= "p.nombre as nombre ";
	$sql .= "FROM carrito as c, productos as p ";
	$sql .= "WHERE num='".$carrito."' AND ";
	$sql .= "c.idProducto=p.id_producto";
	
	$r = mysqli_query($conn, $sql);
	print '<table class="table table-striped" width="100%">';
	print '<tr>';
	print '<th width="12%">Producto</th>';
	print '<th width="30%">Nombre</th>';
	print '<th width="1.8%">cantidad</th>';
	print '<th width="15.12%" class="text-center">Precio</th>';
	print '<th width="15.12%" class="text-center">Descuento</th>';
	print '<th width="15.12%" class="text-center">envio</th>';
	print '<th width="23.12%" class="text-center">subtotal</th>';
	print '</tr>';
	while ($data=mysqli_fetch_assoc($r)) {
		$nom = $data['nombre'];
		$num = $data['producto'];
		$tot = $data['cantidad']*$data['precio']-$data['descuento']+$data['envio'];
		print '<tr>';
		print '<td>';
		print '<img src="../img/'.$data['imagen'].'" width="105" alt="'.$nom.'">';
		print '</td>';
		print '<td>';
		print '<p><b>'.$data['nombre'].'</b></p>';
		print '</td>';
		print '<td class="text-center">'.$data['cantidad'].'</p></td>';
		print '<td class="text-right">$'.number_format($data['precio'],2).'</td>';
		print '<td class="text-right">$'.number_format($data['descuento'],2).'</td>';
		print '<td class="text-right">$'.number_format($data['envio'],2).'</td>';
		print '<td class="text-right">$'.number_format($tot,2).'</td>';
		print '</tr>';
		$subtotal += $tot;
		$decuento += $data["descuento"];
		$envio += $data["envio"];
		$can += $data["cantidad"];
	}
	$total = $subtotal - $descuento + $envio;
	print '<tr>';
	print '<td>&nbsp;</td>';
	print '<td class="text-right">Totales:</td>';
	print '<td class="text-center">'.$can.'</p></td>';
	print '<td class="text-right">$'.number_format($subtotal,2).'</td>';
	print '<td class="text-right">$'.number_format($descuento,2).'</td>';
	print '<td class="text-right">$'.number_format($envio,2).'</td>';
	print '<td class="text-right">$'.number_format($total,2).'</td>';
	print '</tr>';
	print '</table>';
}
?>