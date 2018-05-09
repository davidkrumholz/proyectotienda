<?php

function validaImagen($producto, $anchoNuevo){
    $archivo = "../img/".$producto;
    print $archivo."<br>";
    //recuperamos los datos de la imagen
    $info = getimagesize($archivo);
    $ancho = $info[0];
    $alto = $info[1];
    $tipo = $info["mime"];
    //calculamos la proporcionalidad
    $nuevoAncho = $anchoNuevo;
    $factor = $anchoNuevo / $ancho;
    $nuevoAlto = $alto * $factor;

    switch($tipo) {
        case "image/jpg":
        case "image/jpeg":
            $imagen = imagecreatefromjpeg($archivo);
            break;
        case "image/png":
            $imagen = imagecreatefrompng($archivo);
            break;
        case "image/gif":
            $imagen = imagecreatefromgif($archivo);
            break;
    }

    $lienzo = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

    imagecopyresampled($lienzo, $imagen, 0,0, 0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

    imagejpeg($lienzo, "../img/".$producto, 160);
}



?>