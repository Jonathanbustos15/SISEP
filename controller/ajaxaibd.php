<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r                   = array();
$tipo                = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$id                  = isset($_POST['pkID']) ? $_POST['pkID'] : "";
$fecha               = isset($_POST['fecha']) ? $_POST['fecha'] : "";
$descripcion         = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$file                = isset($_POST['file']) ? $_POST['file'] : "";
$file2               = isset($_POST['file2']) ? $_POST['file2'] : "";
$file3               = isset($_POST['file3']) ? $_POST['file3'] : "";
$fkID_proyecto_marco = isset($_POST['fkID_proyecto_marco']) ? $_POST['fkID_proyecto_marco'] : "";
$nombre              = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$cantidad            = isset($_POST['cantidad']) ? $_POST['cantidad'] : "";
$fkID_aibd           = isset($_POST['fkID_aibd']) ? $_POST['fkID_aibd'] : "";

switch ($tipo) {
    case 'crear':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreImg = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreImg = str_replace(" ", "_", $nombreImg);
            $nombreImg = str_replace("%", "_", $nombreImg);
            $nombreImg = str_replace("-", "_", $nombreImg);
            $nombreImg = str_replace(";", "_", $nombreImg);
            $nombreImg = str_replace("#", "_", $nombreImg);
            $nombreImg = str_replace("!", "_", $nombreImg);
            //carga el archivo en el servidor
            $destinoImg = "../vistas/subidas/" . $nombreImg;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoImg);
        } else {
            $nombreImg = '';
        }
        if (isset($_FILES['file2']["name"])) {
            $nombreDoc = $_FILES['file2']["name"];
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

        if (isset($_FILES['file3']["name"])) {
            $nombreInf = $_FILES['file3']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreInf = str_replace(" ", "_", $nombreInf);
            $nombreInf = str_replace("%", "_", $nombreInf);
            $nombreInf = str_replace("-", "_", $nombreInf);
            $nombreInf = str_replace(";", "_", $nombreInf);
            $nombreInf = str_replace("#", "_", $nombreInf);
            $nombreInf = str_replace("!", "_", $nombreInf);
            //carga el archivo en el servidor
            $destinoInf = "../vistas/subidas/" . $nombreInf;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoInf);
        } else {
            $nombreInf = '';
        }
        $q_inserta  = "INSERT INTO aibd (fecha, descripcion, url_imagen, url_documento, url_informe, fkID_proyecto_marco) VALUES ('$fecha', '$descripcion','$nombreImg' , '$nombreDoc', '$nombreInf', '$fkID_proyecto_marco')";
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
            $nombreImg = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreImg = str_replace(" ", "_", $nombreImg);
            $nombreImg = str_replace("%", "_", $nombreImg);
            $nombreImg = str_replace("-", "_", $nombreImg);
            $nombreImg = str_replace(";", "_", $nombreImg);
            $nombreImg = str_replace("#", "_", $nombreImg);
            $nombreImg = str_replace("!", "_", $nombreImg);
            //carga el archivo en el servidor
            $destinoImg = "../vistas/subidas/" . $nombreImg;
            $imagen     = ",url_imagen = '" . $nombreImg . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoImg);
        } else {
            $imagen = '';
        }
        if (isset($_FILES['file2']["name"])) {
            $nombreDoc = $_FILES['file2']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $nombreDoc = str_replace("%", "_", $nombreDoc);
            $nombreDoc = str_replace("-", "_", $nombreDoc);
            $nombreDoc = str_replace(";", "_", $nombreDoc);
            $nombreDoc = str_replace("#", "_", $nombreDoc);
            $nombreDoc = str_replace("!", "_", $nombreDoc);
            //carga el archivo en el servidor
            $destinoDoc = "../vistas/subidas/" . $nombreDoc;
            $documento  = ",url_documento = '" . $nombreDoc . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $documento = '';
        }

        if (isset($_FILES['file3']["name"])) {
            $nombreInf = $_FILES['file3']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreInf = str_replace(" ", "_", $nombreInf);
            $nombreInf = str_replace("%", "_", $nombreInf);
            $nombreInf = str_replace("-", "_", $nombreInf);
            $nombreInf = str_replace(";", "_", $nombreInf);
            $nombreInf = str_replace("#", "_", $nombreInf);
            $nombreInf = str_replace("!", "_", $nombreInf);
            //carga el archivo en el servidor
            $destinoInf = "../vistas/subidas/" . $nombreInf;
            $informe    = ",url_informe = '" . $nombreInf . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoInf);
        } else {
            $informe = '';
        }
        $q_inserta  = "UPDATE aibd SET fecha ='$fecha',descripcion='$descripcion'" . $imagen . $documento . $informe . " WHERE pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'eliminararchivodocumento':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE aibd SET url_documento='' where pkID='$id' ";
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
    case 'eliminararchivoinforme':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE aibd SET url_informe='' where pkID='$id' ";
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
    case 'eliminararchivoimagen':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE aibd SET url_imagen='' where pkID='$id' ";
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
    case 'crear_inventario':
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO inventario_aibd (fecha, nombre, cantidad, fkID_aibd) VALUES ('$fecha', '$nombre','$cantidad' , '$fkID_aibd')";
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
    default:
        # code...
        break;
}

echo json_encode($r);
