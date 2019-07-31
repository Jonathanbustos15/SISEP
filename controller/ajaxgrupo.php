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
$nombref             = isset($_POST['nombre'])? $_POST['nombre'] : "";
$fk_tipo_grupo       = isset($_POST['fkID_tipo_grupo'])? $_POST['fkID_tipo_grupo'] : "";
$fk_grado            = isset($_POST['fkID_grado'])? $_POST['fkID_grado'] : "";
$fk_institucion      = isset($_POST['fkID_institucion'])? $_POST['fkID_institucion']: "";
$fecha               = isset($_POST['fecha_creacion'])? $_POST['fecha_creacion'] : "";
$proyecto_marco      = isset($_POST['proyecto_marco'])? $_POST['proyecto_marco'] : "";
$fkID_proyecto_marco = isset($_POST['fkID_proyecto_marco'])? $_POST['fkID_proyecto_marco'] : "";
$descripcion_foto = isset($_POST['descripcion_foto_grupo'])? $_POST['descripcion_foto_grupo'] : "";
$fkID_album  = isset($_POST['fkID_album'])? $_POST['fkID_album'] : "";

switch ($tipo) {
    case 'crear':
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
                    $q_inserta  = "insert into `grupo`(nombre, fkID_tipo_grupo, fkID_grado, fkID_institucion, url_logo, fecha_creacion,fkID_proyecto_marco) VALUES ('$nombref', '$fk_tipo_grupo', '$fk_grado', '$fk_institucion', '$nombre', '$fecha','$proyecto_marco')";
                    $r["query"] = $q_inserta;
                } else{
                    $r["mensaje"] = "No se inserto en el servidor.";
                }
        } else {
            $q_inserta  = "insert into `grupo`(nombre, fkID_tipo_grupo, fkID_grado, fkID_institucion, url_logo, fecha_creacion,fkID_proyecto_marco) VALUES ('$nombref', '$fk_tipo_grupo', '$fk_grado', '$fk_institucion', '$nombre', '$fecha','$proyecto_marco')";
                    $r["query"] = $q_inserta;
        }
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
                    $q_inserta  = "update grupo SET nombre='$nombref',fkID_tipo_grupo='$fk_tipo_grupo',fkID_grado='$fk_grado',fkID_institucion='$fk_institucion',fecha_creacion='$fecha',url_logo='$nombre' where pkID='$id'";
                    $r["query"] = $q_inserta;
                } else{
                    $r["mensaje"] = "No se inserto en el servidor.";
                }
        } else {
            $q_inserta  = "update grupo SET nombre='$nombref',fkID_tipo_grupo='$fk_tipo_grupo',fkID_grado='$fk_grado',fkID_institucion='$fk_institucion',fecha_creacion='$fecha' where pkID='$id'";
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
        break;
    case 'eliminararchivo':
        $generico   = new Generico_DAO();
        $q_inserta  = "update funcionario SET url_funcionario='' where pkID='$id' ";
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
                        $q_inserta  = "insert into `fotos_grupo`(`url_foto`, `descripcion`, `fkID_album`) VALUES ('$nombre', '$descripcion_foto', '$fkID_album')";
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