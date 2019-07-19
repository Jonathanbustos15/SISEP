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
    default:
        # code...
        break;
}

echo json_encode($r);

?>