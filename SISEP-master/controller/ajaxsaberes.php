<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r    = array();
$tipo = isset($_POST['tipo'])? $_POST['tipo'] : "";
if (isset($_POST['pkID'])) {
    $id = $_POST['pkID'];
}
$fechas = isset($_POST['fecha_salida'])? $_POST['fecha_salida'] : "";
$fkID_grupo = isset($_POST['fkID_grupo'])? $_POST['fkID_grupo'] : "";
$comunidad = isset($_POST['comunidad_visitada'])? $_POST['comunidad_visitada'] : "";
$fk_asesor = isset($_POST['fkID_asesor'])? $_POST['fkID_asesor'] : "";
$proyecto_marco = isset($_POST['proyecto_marco'])? $_POST['proyecto_marco'] : "";
$descripcion_foto = isset($_POST['descripcion_foto_saber'])? $_POST['descripcion_foto_saber'] : "";
$fkID_saber  = isset($_POST['fkID_saber'])? $_POST['fkID_saber'] : "";

switch ($tipo) {  
    case 'crear':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombre   = $_FILES['file']["name"];
        } else {
            $nombre = "";
        }

        if ($nombre != "") {
            $nombre = str_replace(" ", "_", $nombre);
            $destino = "../vistas/logos/" . $nombre;
            if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
                $nombre=$nombre;
            } else {
                $nombre = "";
            } 
        } 
        $q_inserta  = "insert into `saber_propio`(`fecha_salida`, `fkID_grupo`, `comunidad_visitada`, `fkID_asesor`, `url_lista`, `fkID_proyectos`) VALUES ('$fechas', '$fkID_grupo', '$comunidad', '$fk_asesor', '$nombre', '$proyecto_marco')";
            $r["query"] = $q_inserta;

            $resultado = $generico->EjecutaInsertar($q_inserta);
            if ($resultado) {

                $r[] = $resultado;

            } else {

                $r["estado"]  = "Error";
                $r["mensaje"] = "No se inserto.";
            }
        
        break;
    case 'editar':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombre   = $_FILES['file']["name"];
        } else {
            $nombre   = "";
        }
        if ($nombre != "") {
            $nombre = str_replace(" ", "_", $nombre);
            $destino = "../server/php/files/" . $nombre;
                if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
                    $q_inserta  = "update `saber_propio` SET `fecha_salida`='$fechas',`fkID_grupo`='$fkID_grupo',`comunidad_visitada`='$comunidad',`fkID_asesor`='$fk_asesor',url_lista='$nombre' where pkID='$id'";
                    $r["query"] = $q_inserta;
                } else{
                    $r["mensaje"] = "No se inserto en el servidor.";
                }
        } else {
            $q_inserta  = "update `saber_propio` SET `fecha_salida`='$fechas',`fkID_grupo`='$fkID_grupo',`comunidad_visitada`='$comunidad',`fkID_asesor`='$fk_asesor' where pkID='$id'";
                    $r["query"] = $q_inserta;
        }
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {
            $r[] = $resultado;

        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($nombre);
        break;
    case 'eliminarlogico':
        $generico   = new Generico_DAO();
        $q_inserta  = "update `saber_propio` SET estadoV=2 where pkID='$id'";
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
    case 'crearsin':
        $generico   = new Generico_DAO();
        $q_inserta  = "insert into `saber_propio`(`fecha_salida`, `fkID_grupo`, `comunidad_visitada`, `fkID_asesor`) VALUES ('$fechas', '$fkID_grupo', '$comunidad', '$fk_asesor')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        break;
    case 'eliminararchivo':
                    $generico = new Generico_DAO();
                    $q_inserta = "update saber_propio SET url_lista='' where pkID='$id' ";
                    $r["query"] = $q_inserta;           
                    $resultado = $generico->EjecutaActualizar($q_inserta);
                    if($resultado){                    
                        $r[] = $resultado;          
                    }else{
                      $r["estado"] = "Error";
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
                        $q_inserta  = "insert into `fotos_saber`(`url_foto`, `descripcion`, `fkID_saber`) VALUES ('$nombre', '$descripcion_foto', '$fkID_saber')";
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

?>