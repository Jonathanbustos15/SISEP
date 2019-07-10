<?php
if ($_POST) {

    $nombre  = $_FILES['archivo1']['name'];
    $tipo    = $_FILES['archivo1']['type'];
    $tamanio = $_FILES['archivo1']['size'];
    $ruta    = $_FILES['archivo1']['tmp_name'];
    $destino = "archivos/" . $nombre;

    move_uploaded_file($ruta, $destino);
    $validator = array('Nombre' => $nombre, 'Tipo' => $tipo);

    echo json_encode($validator);

    /*$nombre  = $_FILES['archivo2']['name'];
$tipo    = $_FILES['archivo2']['type'];
$tamanio = $_FILES['archivo2']['size'];
$ruta    = $_FILES['archivo2']['tmp_name'];
$destino = "archivos/" . $nombre;

move_uploaded_file($ruta, $destino);
$validator = array('Nombre' => $nombre, 'Tipo' => $tipo);

echo json_encode($validator);*/
}
