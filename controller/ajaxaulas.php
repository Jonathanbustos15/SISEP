<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r                   = array();
$tipo                = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$id                  = isset($_POST['pkID']) ? $_POST['pkID'] : "";
$num_aula            = isset($_POST['num_aula']) ? $_POST['num_aula'] : "";
$fecha               = isset($_POST['fecha']) ? $_POST['fecha'] : "";
$descripcion         = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$fkID_institucion    = isset($_POST['fkID_institucion']) ? $_POST['fkID_institucion'] : "";
$file                = isset($_POST['file']) ? $_POST['file'] : "";
$zona_wifi           = isset($_POST['zona_wifi']) ? $_POST['zona_wifi'] : "";
$internet            = isset($_POST['internet']) ? $_POST['internet'] : "";
$fecha_ini_wifi      = isset($_POST['fecha_ini_wifi']) ? $_POST['fecha_ini_wifi'] : "";
$fecha_fin_wifi      = isset($_POST['fecha_fin_wifi']) ? $_POST['fecha_fin_wifi'] : "";
$fecha_ini_internet  = isset($_POST['fecha_ini_internet']) ? $_POST['fecha_ini_internet'] : "";
$fecha_fin_internet  = isset($_POST['fecha_fin_internet']) ? $_POST['fecha_fin_internet'] : "";
$fkID_proyecto_marco = isset($_POST['fkID_proyecto_marco']) ? $_POST['fkID_proyecto_marco'] : "";
$fkID_aula           = isset($_POST['fkID_aula']) ? $_POST['fkID_aula'] : "";
$nombre_tec          = isset($_POST['nombre_tec']) ? $_POST['nombre_tec'] : "";
$elemento_tec        = isset($_POST['elemento_tec']) ? $_POST['elemento_tec'] : "";
$cantidad_tec        = isset($_POST['cantidad_tec']) ? $_POST['cantidad_tec'] : "";
$nombre_cien         = isset($_POST['nombre_cien']) ? $_POST['nombre_cien'] : "";
$elemento_cien       = isset($_POST['elemento_cien']) ? $_POST['elemento_cien'] : "";
$cantidad_cien       = isset($_POST['cantidad_cien']) ? $_POST['cantidad_cien'] : "";
$nombre_wifi         = isset($_POST['nombre_wifi']) ? $_POST['nombre_wifi'] : "";
$elemento_wifi       = isset($_POST['elemento_wifi']) ? $_POST['elemento_wifi'] : "";
$cantidad_wifi       = isset($_POST['cantidad_wifi']) ? $_POST['cantidad_wifi'] : "";
$fecha_acta          = isset($_POST['fecha_acta']) ? $_POST['fecha_acta'] : "";
$descripcion_acta    = isset($_POST['descripcion_acta']) ? $_POST['descripcion_acta'] : "";
$descripcion_foto = isset($_POST['descripcion_foto_aula'])? $_POST['descripcion_foto_aula'] : "";
$fkID_album  = isset($_POST['fkID_album'])? $_POST['fkID_album'] : "";  

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

        $q_inserta  = "INSERT INTO aulas (num_aula, fecha, descripcion, url_imagen, fkID_institucion, zona_wifi, fecha_ini_wifi, fecha_fin_wifi, internet, fecha_ini_internet, fecha_fin_internet, fkID_proyecto_marco) VALUES ('$num_aula','$fecha', '$descripcion','$nombreImg' , '$fkID_institucion','$zona_wifi','$fecha_ini_wifi','$fecha_fin_wifi','$internet','$fecha_ini_internet','$fecha_fin_internet','$fkID_proyecto_marco')";
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

        $q_inserta  = "UPDATE aulas SET num_aula ='$num_aula',fecha ='$fecha',descripcion='$descripcion', fkID_institucion='$fkID_institucion', zona_wifi='$zona_wifi', fecha_ini_wifi='$fecha_ini_wifi', fecha_fin_wifi='$fecha_fin_wifi', internet='$internet',fecha_ini_internet='$fecha_ini_internet',fecha_fin_internet='$fecha_fin_internet'" . $imagen . " WHERE pkID='$id'";
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
        $q_inserta  = "UPDATE aulas SET url_imagen='' where pkID='$id' ";
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
            $destinoDoc = "../vistas/subidas/" . $nombreDoc;

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
            $destinoDoc = "../vistas/subidas/" . $nombreDoc;
            $documento  = ",url_imagen = '" . $nombreDoc . "'";
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
    case 'crear_tecnologia':
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO aulas_tecnologia (fkID_aula, nombre_tec, elemento_tec, cantidad_tec) VALUES ('$fkID_aula','$nombre_tec', '$elemento_tec','$cantidad_tec')";
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
    case 'editar_tecnologia':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE aulas_tecnologia SET nombre_tec ='$nombre_tec',elemento_tec='$elemento_tec', cantidad_tec ='$cantidad_tec' WHERE pkID='$id'";
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
    case 'crear_cientifico':
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO aulas_cientifico (fkID_aula, nombre_cien, elemento_cien, cantidad_cien) VALUES ('$fkID_aula','$nombre_cien', '$elemento_cien','$cantidad_cien')";
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
    case 'editar_cientifico':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE aulas_cientifico SET nombre_cien ='$nombre_cien',elemento_cien='$elemento_cien', cantidad_cien ='$cantidad_cien' WHERE pkID='$id'";
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
    case 'crear_wifi':
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO aulas_wifi (fkID_aula, nombre_wifi, elemento_wifi, cantidad_wifi) VALUES ('$fkID_aula','$nombre_wifi', '$elemento_wifi','$cantidad_wifi')";
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
    case 'editar_wifi':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE aulas_wifi SET nombre_wifi ='$nombre_wifi',elemento_wifi='$elemento_wifi', cantidad_wifi ='$cantidad_wifi' WHERE pkID='$id'";
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
    case 'crear_acta':
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
        $q_inserta  = "INSERT INTO aulas_acta (fkID_aula, fecha_acta, descripcion_acta, url_lista) VALUES ('$fkID_aula','$fecha_acta', '$descripcion_acta','$nombreDoc')";
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
    case 'editar_acta':
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

        $q_inserta  = "UPDATE aulas_acta SET fecha_acta ='$fecha_acta', descripcion_acta='$descripcion_acta' " . $nombreDoc . " WHERE pkID='$id'";
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
        $q_inserta  = "UPDATE `aulas_acta` SET url_lista='' where pkID='$id' ";
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
                        $q_inserta  = "insert into `fotos_aula`(`url_foto`, `descripcion`, `fkID_album`) VALUES ('$nombre', '$descripcion_foto', '$fkID_album')";
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
