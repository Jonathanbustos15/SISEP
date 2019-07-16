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
$fkID_proyecto_marco = isset($_POST['fkID_proyecto_marco'])? $_POST['fkID_proyecto_marco'] : "";

switch ($tipo) {
    case 'crear':
        $generico = new Generico_DAO();
        $nombre   = $_FILES['file']["name"];
        //Reemplaza los caracteres especiales por guiones al piso
        $nombre = str_replace(" ", "_", $nombre);
        $nombre = str_replace("%", "_", $nombre);
        $nombre = str_replace("-", "_", $nombre);
        $nombre = str_replace(";", "_", $nombre);
        $nombre = str_replace("#", "_", $nombre);
        $nombre = str_replace("!", "_", $nombre);
        //carga el archivo en el servidor
        $destino = "../vistas/logos/" . $nombre;
        if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
            $q_inserta  = "insert into `grupo`(nombre, fkID_tipo_grupo, fkID_grado, fkID_institucion, url_logo, fecha_creacion,fkID_proyecto_marco) VALUES ('$nombref', '$fk_tipo_grupo', '$fk_grado', '$fk_institucion', '$nombre', '$fecha','$fkID_proyecto_marco')";
            $r["query"] = $q_inserta;

            $resultado = $generico->EjecutaInsertar($q_inserta);
            if ($resultado) {

                $r[] = $resultado;

            } else {

                $r["estado"]  = "Error";
                $r["mensaje"] = "No se inserto.";
            }

        } else {
            $mensaje = "El archivo $nombre no se ha almacenado en forma exitosa";
        }
        break;
    case 'editar':
        $generico = new Generico_DAO();
        $nombre   = $_FILES['file']["name"];
        //Reemplaza los caracteres especiales por guiones al piso
        $nombre = str_replace(" ", "_", $nombre);
        $nombre = str_replace("%", "_", $nombre);
        $nombre = str_replace("-", "_", $nombre);
        $nombre = str_replace(";", "_", $nombre);
        $nombre = str_replace("#", "_", $nombre);
        $nombre = str_replace("!", "_", $nombre);
        //carga el archivo en el servidor
        $destino = "../vistas/subidas/" . $nombre;
        if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
            $q_inserta  = "update grupo SET nombre='$nombref',fkID_tipo_grupo='$fk_tipo_grupo',fkID_grado='$fk_grado',fkID_institucion='$fk_institucion',fecha_creacion='$fecha',url_logo='$nombre' where pkID='$id'";
            $r["query"] = $q_inserta;
            $resultado  = $generico->EjecutaInsertar($q_inserta);
            /**/
            if ($resultado) {

                $r[] = $resultado;

            } else {

                $r["estado"]  = "Error";
                $r["mensaje"] = "No se inserto.";
            }

        } else {
            $mensaje = "El archivo $nombre no se ha almacenado en forma exitosa";
        }
        echo json_encode($nombre);
        break;
    case 'editarsin':
        $generico   = new Generico_DAO();
        $q_inserta  = "update grupo SET nombre='$nombref',fkID_tipo_grupo='$fk_tipo_grupo',fkID_grado='$fk_grado',fkID_institucion='$fk_institucion',fecha_creacion='$fecha' where pkID='$id' ";
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
    case 'crearsin':
        $generico   = new Generico_DAO();
        $q_inserta  = "insert into `grupo`(nombre, fkID_tipo_grupo, fkID_grado, fkID_institucion, fecha_creacion) VALUES ('$nombref', '$fk_tipo_grupo', '$fk_grado', '$fk_institucion', '$fecha')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        break;
    default:
        # code...
        break;
}

echo json_encode($r);

?>