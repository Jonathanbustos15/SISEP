<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r                    = array();
$tipo                 = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$id                   = isset($_POST['pkID']) ? $_POST['pkID'] : "";
$fecha_acompanamiento = isset($_POST['fecha_acompanamiento']) ? $_POST['fecha_acompanamiento'] : "";
$descripcion          = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$fkID_acompanamiento  = isset($_POST['fkID_acompanamiento']) ? $_POST['fkID_acompanamiento'] : "";
$fecha_acompanamiento_asistencia = isset($_POST['fecha_acompanamiento_asistencia']) ? $_POST['fecha_acompanamiento_asistencia'] : "";
$fkID_proyecto_marco  = isset($_POST['fkID_proyecto_marco']) ? $_POST['fkID_proyecto_marco'] : "";
$descripcion_foto = isset($_POST['descripcion_foto_acompanamiento'])? $_POST['descripcion_foto_acompanamiento'] : "";
$fkID_album  = isset($_POST['fkID_album'])? $_POST['fkID_album'] : "";

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

        if (isset($_FILES['file2']["name"])) {
            $nombreInf = $_FILES['file2']["name"];
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
        $q_inserta  = "INSERT INTO acompanamiento (fecha_acompanamiento, descripcion, url_documento, url_informe, fkID_proyecto_marco) VALUES ('$fecha_acompanamiento', '$descripcion', '$nombreDoc', '$nombreInf', '$fkID_proyecto_marco')";
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
            $documento  = ",url_documento = '" . $nombreDoc . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);  
        } else {
            $documento = '';
        }

        if (isset($_FILES['file2']["name"])) {
            $nombreInf = $_FILES['file2']["name"];
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
        $q_inserta  = "UPDATE acompanamiento SET fecha_acompanamiento='$fecha_acompanamiento',descripcion='$descripcion'" . $documento . $informe . " WHERE pkID='$id'";
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
        $q_inserta  = "UPDATE acompanamiento SET url_documento='' where pkID='$id' ";
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
        $q_inserta  = "UPDATE acompanamiento SET url_informe='' where pkID='$id' ";
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
    case 'eliminarasistencia':
                    $generico = new Generico_DAO();
                    $q_inserta = "update acompanamiento_asistencia SET url_asistencia='' where pkID='$id' ";
                    $r["query"] = $q_inserta;           
                    $resultado = $generico->EjecutaActualizar($q_inserta);
                    /**/
                    if($resultado){                    
                        $r[] = $resultado;          
                    }else{
                      $r["estado"] = "Error";
                      $r["mensaje"] = "No se inserto.";
                        }
                
                break;
    case 'crearasistencia':
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

        $q_inserta  = "insert into `acompanamiento_asistencia`( `fkID_acompanamiento`, `fecha_acompanamiento_asistencia`, `url_asistencia`) VALUES ('$fkID_acompanamiento', '$fecha_acompanamiento_asistencia', '$nombreDoc')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        break;
    case 'editarasistencia':
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
            $documento  = ",url_asistencia= '" . $nombreDoc . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);  
        } else {
            $documento = '';
        }

        $q_inserta  = "update `acompanamiento_asistencia` SET `fecha_acompanamiento_asistencia`='$fecha_acompanamiento_asistencia'". $documento . " WHERE pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        };
        break;
    case 'crear_foto':
            $generico = new Generico_DAO();  
            if ($descripcion_foto=="") {
                $descripcion_foto="foto";
            }
            if(!empty($_FILES['url_foto'])){
    // File upload configuration
            $targetDir = "../img/";
            $allowTypes = array('jpg','png','jpeg','gif');
            
            $images_arr = array();  
            foreach($_FILES['url_foto']['name'] as $key=>$val){
                $image_name = $_FILES['url_foto']['name'][$key];
                
                // File upload path
                $fileName = basename($_FILES['url_foto']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){    
                    // Store images on the server
                    if(move_uploaded_file($_FILES['url_foto']['tmp_name'][$key],$targetFilePath)){
                        $nombre = $_FILES['url_foto']['name'][$key];
                        $q_inserta  = "insert into `fotos_acompaniamiento`(`url_foto`, `descripcion`, `fkID_album`) VALUES ('$nombre', '$descripcion_foto', '$fkID_album')";
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
