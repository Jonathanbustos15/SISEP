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
$fkID_institucion    = isset($_POST['fkID_institucion']) ? $_POST['fkID_institucion'] : "";
$fkID_grado          = isset($_POST['fkID_grado']) ? $_POST['fkID_grado'] : "";
$fkID_curso          = isset($_POST['fkID_curso']) ? $_POST['fkID_curso'] : "";
$fkID_proyecto_marco = isset($_POST['fkID_proyecto_marco']) ? $_POST['fkID_proyecto_marco'] : "";
$fkID_microbiologia  = isset($_POST['fkID_microbiologia']) ? $_POST['fkID_microbiologia'] : "";
$fecha_sesion        = isset($_POST['fecha_sesion']) ? $_POST['fecha_sesion'] : "";
$descripcion_sesion  = isset($_POST['descripcion_sesion']) ? $_POST['descripcion_sesion'] : "";
$file                = isset($_POST['file']) ? $_POST['file'] : "";
$descripcion_foto = isset($_POST['descripcion_foto_microbiologia'])? $_POST['descripcion_foto_microbiologia'] : "";
$fkID_album  = isset($_POST['fkID_album'])? $_POST['fkID_album'] : "";
  
switch ($tipo) {
    case 'crear':
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO microbiologia (fecha, fkID_institucion, fkID_grado, fkID_curso, fkID_proyecto_marco) VALUES ('$fecha', '$fkID_institucion','$fkID_grado' , '$fkID_curso', '$fkID_proyecto_marco')";
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
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE microbiologia SET fecha ='$fecha',fkID_institucion='$fkID_institucion', fkID_grado='$fkID_grado', fkID_curso='$fkID_curso' WHERE pkID='$id'";
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
    case 'crear_sesion':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
        } else {
            $nombreDoc = "";
        }
        if ($nombreDoc != "") {
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $destino   = "../server/php/files/" . $nombreDoc;
            if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
                $nombreDoc = $nombreDoc;
            } else {
                $nombreDoc   = "";
                $r["estado"] = "Error servidor";
            }
        }

        $q_inserta  = "INSERT INTO `microbiologia_sesion`(`fkID_microbiologia`, `fecha_sesion`, `descripcion_sesion`, `url_lista`) VALUES ('$fkID_microbiologia', '$fecha_sesion', '$descripcion_sesion','$nombreDoc')";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        break;
    case 'editar_sesion':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
        } else {
            $nombreDoc = "";
        }
        if ($nombreDoc != "") {
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $destino   = "../server/php/files/" . $nombreDoc;
            if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
                $nombreDoc = ",url_lista = '" . $nombreDoc . "'";
            } else {
                $nombreDoc   = "";
                $r["estado"] = "Error servidor";
            }
        }

        $q_inserta  = "UPDATE microbiologia_sesion SET fecha_sesion ='$fecha_sesion', descripcion_sesion='$descripcion_sesion' " . $nombreDoc . " WHERE pkID='$id'";
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
    case 'eliminarlista':
        $generico   = new Generico_DAO();
        $q_inserta  = "update `microbiologia_sesion` SET url_lista='' where pkID='$id' ";
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
                        $q_inserta  = "insert into `fotos_microbiologia`(`url_foto`, `descripcion`, `fkID_album`) VALUES ('$nombre', '$descripcion_foto', '$fkID_album')";
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
