<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r    = array();
$tipo = $_POST['tipo'];
if (isset($_POST['pkID'])) {
    $id = $_POST['pkID'];
} else {
    $id = '';
}
$fecha               = $_POST['fecha'];
$fkID_proyecto_marco = $_POST['fkID_proyecto_marco'];
if (isset($_POST['file'])) {
    $file = $_POST['file'];
} else {
    $file = '';
}
switch ($tipo) {
    case 'crear':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $nombreDoc = str_replace("%", "_", $nombreDoc);
            $nombreDoc = str_replace("-", "_", $nombreDoc);
            $nombreDoc = str_replace(";", "_", $nombreDoc);
            $nombreDoc = str_replace("#", "_", $nombreDoc);
            $nombreDoc = str_replace("!", "_", $nombreDoc);
            //carga el archivo en el servidor
            $destinoDoc = "../vistas/subidas/" . $nombreDoc;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $nombreDoc = '';
        }
        $q_inserta  = "INSERT INTO anuario (fecha,url_documento,fkID_proyecto_marco) VALUES ('$fecha', '$nombreDoc', '$fkID_proyecto_marco')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'editar':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $nombreDoc = str_replace("%", "_", $nombreDoc);
            $nombreDoc = str_replace("-", "_", $nombreDoc);
            $nombreDoc = str_replace(";", "_", $nombreDoc);
            $nombreDoc = str_replace("#", "_", $nombreDoc);
            $nombreDoc = str_replace("!", "_", $nombreDoc);
            //carga el archivo en el servidor
            $destinoDoc = "../vistas/subidas/" . $nombreDoc;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $nombreDoc = '';
        }
        $q_inserta  = "UPDATE anuario SET fecha='$fecha',url_documento='$nombreDoc' where pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'editarsin':
        $generico   = new Generico_DAO();
        $q_inserta  = "update funcionario SET nombre_funcionario='$nombref',apellido_funcionario='$apellido',fkID_tipo_documento='$fk_tipo',documento_funcionario='$documento',telefono_funcionario='$telefono',direccion_funcionario='$direccion',email_funcionario='$email' where pkID='$id' ";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {
            $r[] = $resultado;

        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        break;
    case 'eliminararchivodocumento':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE anuario SET url_documento='' where pkID='$id' ";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }

        break;
}

echo json_encode($r);
