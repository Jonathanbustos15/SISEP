<?php

header('Content-type: application/json');

include "php_subida_objt.php";
include "../Conexion/datos.php";

$va_para = $ruta_server;

if (isset($_FILES['archivo'])) {

    $subida = new sube_imagen($_FILES["archivo"], $va_para);

    echo json_encode($respuesta = $subida->subir());

} elseif (isset($_FILES['file'])) {
    # code...

    $subida = new sube_imagen($_FILES["file"], $va_para);

    echo json_encode($respuesta = $subida->subir());

} else {

    $mensaje = array('mensaje' => "No existe ningún archivo para subirsss.");

    echo json_encode($mensaje);
}
;
