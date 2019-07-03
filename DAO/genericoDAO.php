<?php

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

include_once '../conexion/conexion.php';

trait GenericoDAO
{

    use Conexion;

    public $r;
    public $q_general;

    public function __construct()
    {

        $this->r = array();
    }

    //------------------------------------------------------------------------
    public function EjecutarConsulta($query)
    {

        //echo $query;

        $db = $this->connect();

        /**/
        if (!$result = $db->query($query)) {
            //die('Hubo un error al ejecutar el query [' . $db->error . ']');
            $retorno["error"] = $db->error;
            //print_r($retorno);
            //return false;
            return $retorno;
        } else {

            //$retorno["affected_rows"] = $db->affected_rows;
            //-------------------------

            if ($result->num_rows > 0) {

                while ($fila = $result->fetch_assoc()) {
                    $retorno[] = $fila;
                }

                return $retorno;

            } else {

                return false;
            }

            $result->free();
        }

    }
    //------------------------------------------------------------------------
    public function EjecutaInsertar($query)
    {

        $db = $this->connect();

        if (!$result = $db->query($query)) {
            die('There was an error running the query [' . $db->error . ']');
        } else {
            $this->r["last_id"] = $db->insert_id;
            $this->r["estado"]  = "ok";
            $this->r["mensaje"] = "Guardado correctamente.";

            return $this->r;
        }
    }
    //------------------------------------------------------------------------
    public function EjecutaActualizar($query)
    {

        $db = $this->connect();

        if (!$result = $db->query($query)) {
            die('There was an error running the query [' . $db->error . ']');
        } else {
            $this->r["estado"]  = "ok";
            $this->r["mensaje"] = "Actualizado correctamente.";

            return $this->r;
        }
    }
    //------------------------------------------------------------------------
    //------------------------------------------------------------------------
    public function EjecutaEliminar($query)
    {

        $db = $this->connect();

        if (!$result = $db->query($query)) {
            die('There was an error running the query [' . $db->error . ']');
        } else {
            $this->r["estado"]  = "ok";
            $this->r["mensaje"] = "Eliminado correctamente.";

            return $this->r;
        }
    }

    public function EjecutaEliminarLogico($query)
    {

        $db = $this->connect();

        if (!$result = $db->query($query)) {
            die('There was an error running the query [' . $db->error . ']');
        } else {
            $this->r["estado"]  = "ok";
            $this->r["mensaje"] = "Eliminado correctamente.";

            return $this->r;
        }
    }
    //------------------------------------------------------------------------
    //permisos de usuario
    public function getPermisos()
    {

        $this->q_general = "select permisos.*, tipo_usuario.nombre as nom_tipo, modulos.Nombre as nom_modulo

                                FROM `permisos`

                                INNER JOIN tipo_usuario ON tipo_usuario.pkID = permisos.fkID_tipo_usuario

                                INNER JOIN modulos ON modulos.pkID = permisos.fkID_modulo";

        return $this->EjecutarConsulta($this->q_general);
    }

    public function getPermisosModulo_Tipo($fkID_modulo, $fkID_tipo_usuario)
    {

        $this->q_general = "select permisos.*, tipo_usuario.nombre as nom_tipo, modulos.Nombre as nom_modulo

                                FROM `permisos`

                                INNER JOIN tipo_usuario ON tipo_usuario.pkID = permisos.fkID_tipo_usuario

                                INNER JOIN modulos ON modulos.pkID = permisos.fkID_modulo

                                WHERE permisos.fkID_modulo = " . $fkID_modulo . " AND permisos.fkID_tipo_usuario = " . $fkID_tipo_usuario;

        return $this->EjecutarConsulta($this->q_general);
    }
    //------------------------------------------------------------------------

    //------------------------------------------------------------------------
    public function getCookieProyectoM()
    {

        if ($_COOKIE["id_proyectoM"]) {
            return $_COOKIE["id_proyectoM"];
        } else {
            return 0;
        }

    }

    public function getCookieNombreProyectoM()
    {

        if ($_COOKIE["nom_proyectoM"]) {
            return $_COOKIE["nom_proyectoM"];
        } else {
            return "--";
        }

    }
    //------------------------------------------------------------------------
}
