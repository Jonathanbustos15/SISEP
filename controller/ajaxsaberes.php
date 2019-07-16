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
$fechas = $tipo = isset($_POST['fecha_salida'])? $_POST['fecha_salida'] : "";
$fkID_grupo = $tipo = isset($_POST['fkID_grupo'])? $_POST['fkID_grupo'] : "";
$comunidad = $tipo = isset($_POST['comunidad_visitada'])? $_POST['comunidad_visitada'] : "";
$fk_asesor = $tipo = isset($_POST['fkID_asesor'])? $_POST['fkID_asesor'] : "";

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
            $q_inserta  = "insert into `saber_propio`(`fecha_salida`, `fkID_grupo`, `comunidad_visitada`, `fkID_asesor`, `url_lista`) VALUES ('$fechas', '$fkID_grupo', '$comunidad', '$fk_asesor', '$nombre')";
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
            $q_inserta  = "update `saber_propio` SET `fecha_salida`='$fechas',`fkID_grupo`='$fkID_grupo',`comunidad_visitada`='$comunidad',`fkID_asesor`='$fk_asesor',url_lista='$nombre' where pkID='$id'";
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
        $q_inserta  = "update `saber_propio` SET `fecha_salida`='$fechas',`fkID_grupo`='$fkID_grupo',`comunidad_visitada`='$comunidad',`fkID_asesor`='$fk_asesor' where pkID='$id'";
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
    default:
        # code...
        break;
}

echo json_encode($r);

?>