<?php
function masVendidos($conn){
	$sql = "SELECT * FROM productos WHERE masvendido='1' LIMIT 3";
	$r = mysqli_query($conn, $sql);
	while ($data = mysqli_fetch_assoc($r)) {
		print '<div class="well">'.$data["nombre"];
		print '<a href="producto.php?id='.$data["id_producto"].'"><img src="img/'.$data["imagen"].'" 
			class="media-object img-resposvive" width="100%"></a>';
		print "</div>";
	}
}

function nuevos($conn){
	$sql = "SELECT * FROM productos WHERE nuevos='1' LIMIT 3";
	$r = mysqli_query($conn, $sql);
	while ($data = mysqli_fetch_assoc($r)) {
		print '<div class="well">'.$data["nombre"];
		print '<a href="producto.php?id='.$data["id_producto"].'"><img src="img/'.$data["imagen"].'" 
			class="media-object img-resposvive" width="100%"></a>';
		print "</div>";
	}
}
?>