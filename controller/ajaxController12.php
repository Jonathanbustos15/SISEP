<?php

/*
-------------------------------------------------------------------------
Nota: Para poder usar esta clase en la base de datos debe tener todo re-
gistro en las tablas de la BD el campo pkID, ya que la clase crea_sql lo
requiere para poder crear todas las sentencias.
 */

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

    //----------------------------------------------------------------------------------------------------
    case 'inserta':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();

        $q_inserta  = $crea_sql->crea_insert($_GET);
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

        case 'insertar':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();
        $nombre_album=$_GET['nombre_album'];
        $fecha_creacion=$_GET['fecha_creacion'];
        $observacion_album=$_GET['observacion_album'];
        $fkID_grupo=$_GET['fkID_grupo'];

        $q_inserta  = "INSERT INTO `grupo_album`(`nombre_album`, `fecha_creacion_album`, `observacion_album`, `fkID_grupo`) VALUES ('$nombre_album','$fecha_creacion','$observacion_album','$fkID_grupo')";
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
    //caso especial gestión de usuarios, para poder codificar la contraseña de un usuario en la BD.

    case 'inserta_registro':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();

        $_GET["pass"] = sha1($_GET["pass"]);

        //descomentarear en caso de que tenga campo de
        //confirmacion de contraseña
        //$_GET["pass_conf"] = sha1($_GET["pass_conf"]);

        $q_inserta = $crea_sql->crea_insert($_GET);

        $r["query"] = $q_inserta;

        /**/
        $resultado = $generico->EjecutaInsertar($q_inserta);

        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }

        break;
    //----------------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------------
    //caso especial gestión de usuarios, para poder codificar la contraseña de un usuario en la BD.

    case 'actualiza_usuario':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();

        $_GET["pass"] = sha1($_GET["pass"]);

        $q_actualiza = $crea_sql->crea_update($_GET);

        $r["query"] = $q_actualiza;

        /**/
        $resultado = $generico->EjecutaActualizar($q_actualiza);

        if ($resultado) {

            $r["estado"]  = "ok";
            $r["mensaje"] = "Contraseña Actualizada!";

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se actualizo.";
        }

        break;
    //----------------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------------
    case 'consultar':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();

        $q_carga = $crea_sql->crea_select($_GET);

        $resultado = $generico->EjecutarConsulta($q_carga);
        /**/
        if ($resultado) {

            $r["estado"]  = "ok";
            $r["mensaje"] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No hay registros.";
        }

        break;
    //----------------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------------
    //caso especial en caso de que se necesite hacer una consulta en la que el select no sea simple.
    //o consultas diferentes por medio de javascipt.

    case 'consulta_gen':

        $generico = new Generico_DAO();
        //$crea_sql = new crea_sql();

        $q_consulta = $_GET["query"];

        $resultado = $generico->EjecutarConsulta($q_consulta);
        /**/
        if ($resultado) {

            $r["estado"]   = "ok";
            $r["mensaje"]  = $resultado;
            $r["consulta"] = $q_consulta;

        } else {

            $r["estado"]   = "Error";
            $r["mensaje"]  = "No hay registros.";
            $r["consulta"] = $q_consulta;
        }

        break;
    //----------------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------------
    case 'actualizar':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();

        $q_actualiza = $crea_sql->crea_update($_GET);

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
    //----------------------------------------------------------------------------------------------------
    
    //----------------------------------------------------------------------------------------------------
    case 'eliminar':

        $generico = new Generico_DAO();
        $crea_sql = new crea_sql();

        $q_elimina = $crea_sql->crea_delete($_GET);

        $r["query"] = $q_elimina;

        $resultado = $generico->EjecutaEliminar($q_elimina);
        /**/
        if ($resultado) {

            $r["estado"]  = "ok";
            $r["mensaje"] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se eliminó.";
        }

        break;
    //----------------------------------------------------------------------------------------------------
    case 'eliminar_logico':
        $generico   = new Generico_DAO();
        $crea_sql   = new crea_sql();
        $q_elimina  = $crea_sql->crea_deletelog($_GET);
        $r["query"] = $q_elimina;
        $resultado  = $generico->EjecutaEliminar($q_elimina);
        /**/
        if ($resultado) {
            $r["estado"]  = "ok";
            $r["mensaje"] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se eliminó.";
        }
        break;
        //----------------------------------------------------------------------------------------------------
}
//--------------------------------------------------------------------------------------------------------

echo json_encode($r); //imprime el json
