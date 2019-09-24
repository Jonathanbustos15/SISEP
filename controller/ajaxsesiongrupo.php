<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r              = array();
$tipo           = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$id             = isset($_POST['pkID']) ? $_POST['pkID'] : "";
$fecha_sesion   = isset($_POST['fecha_sesion']) ? $_POST['fecha_sesion'] : "";
$tema           = isset($_POST['tema']) ? $_POST['tema'] : "";
$file           = isset($_POST['file']) ? $_POST['file'] : "";
$fkID_grupo     = isset($_POST['fkID_grupo']) ? $_POST['fkID_grupo'] : "";

switch ($tipo) {
    case 'crear':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreImg = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreImg = str_replace(" ", "_", $nombreImg);
            //carga el archivo en el servidor
            $destinoImg = "../server/php/files/" . $nombreImg;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoImg);
        } else {
            $nombreImg = '';
        }

        $q_inserta  = "insert into `grupo_sesion`(`fecha_sesion`, `tema`, `url_lista`, `fkID_grupo`) VALUES ('$fecha_sesion', '$tema', '$nombreImg', '$fkID_grupo')";
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
            //carga el archivo en el servidor
            $destinoImg = "../server/php/files/" . $nombreImg;
            $lista     = ",url_lista = '" . $nombreImg . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoImg);
        } else {
            $lista = '';
        }

        $q_inserta  = "update `grupo_sesion` SET fecha_sesion ='$fecha_sesion',tema='$tema'" . $lista . " WHERE pkID='$id'";
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
    case 'eliminararchivodocumento':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE documentos_aibd SET url_documento='' where pkID='$id' ";
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
    case 'crear_documento':
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
            $destinoDoc = "../server/php/files/" . $nombreDoc;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $nombreDoc = '';
        }
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO documentos_aibd (fecha_doc, nombre, url_documento,fkID_proyecto_marco) VALUES ('$fecha_doc', '$nombre','$nombreDoc' , '$fkID_proyecto_marco')";
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
    case 'editar_documento':
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
            $destinoDoc = "../server/php/files/" . $nombreDoc;
            $documento  = ",url_documento = '" . $nombreDoc . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $documento = '';
        }

        $q_inserta  = "UPDATE documentos_aibd SET fecha_doc ='$fecha_doc',nombre='$nombre'" . $documento . " WHERE pkID='$id'";
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
    case 'crear_foto':
        $generico = new Generico_DAO();
        if ($descripcion_foto == "") {
            $descripcion_foto = "foto";
        }
        if ($fkID_aibd == "") {
            $fkID_aibd = "1";
        }
        if (!empty($_FILES['url_foto'])) {
            // File upload configuration
            $targetDir  = "../img/";
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            $images_arr = array();
            foreach ($_FILES['url_foto']['name'] as $key => $val) {
                $image_name = $_FILES['url_foto']['name'][$key];

                // File upload path
                $fileName       = basename($_FILES['url_foto']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;

                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    // Store images on the server
                    if (move_uploaded_file($_FILES['url_foto']['tmp_name'][$key], $targetFilePath)) {
                        $nombre     = $_FILES['url_foto']['name'][$key];
                        $q_inserta  = "insert into `fotos_aibd`(`url_foto`, `descripcion`, `fkID_aibd`) VALUES ('$nombre', '$descripcion_foto', '$fkID_aibd')";
                        $r["query"] = $q_inserta;

                        $resultado = $generico->EjecutaInsertar($q_inserta);

                        if ($resultado) {

                            $r[] = $resultado;

                        } else {

                            $r["estado"]  = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }
                    }
                }
            }
        }
        break;
    default:
        # code...
        break;
}

echo json_encode($r);
