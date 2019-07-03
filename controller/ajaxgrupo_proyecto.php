<?php

header('content-type: aplication/json; charset=utf-8'); //header para json

include '../DAO/genericoDAO.php';

include 'helper_controller/crea_sql.php';

class Generico_DAO
{

    use GenericoDAO;

}

$accion = isset($_GET['tipo']) ? $_GET['tipo'] : "x";

$r = array();

switch ($accion) {

        case 'insertar':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();
        $linea_investigacion=$_GET['linea_investigacion'];
        $pregunta_investigacion =$_GET['pregunta_investigacion'];
        $objetivo_general=$_GET['objetivo_general'];
        $fkID_grupo=$_GET['fkID_grupo'];

        $q_inserta  = "insert into `proyecto_grupo`(`linea_investigacion`, `pregunta_investigacion`, `objetivo_general`, `fkID_grupo`) VALUES ('$linea_investigacion','$pregunta_investigacion','$objetivo_general','$fkID_grupo')";
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
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    case 'actualizar2':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();
        $nombre_album=$_GET['nombre_album'];
        $fecha_creacion=$_GET['fecha_creacion'];
        $observacion_album=$_GET['observacion_album'];
        $pkID=$_GET['pkID'];

        $q_actualiza = "update `grupo_album` SET `nombre_album`='$nombre_album',`fecha_creacion_album`='$fecha_creacion',`observacion_album`='$observacion_album' WHERE pkID=".$pkID;

        $resultado = $generico->EjecutaActualizar($q_actualiza);
        /**/
        if ($resultado) {

            $r["estado"]  = "ok";
            $r["mensaje"] = $resultado;
            $r["query"]   = $q_actualiza;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se actualizó.";
            $r["query"]   = $q_actualiza;
        }

        break;

}
//--------------------------------------------------------------------------------------------------------

echo json_encode($r); //imprime el json