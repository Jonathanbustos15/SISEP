<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class anuarioDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getAnuarios($pkID_proyectoM)
    {

        $query = "SELECT *, YEAR(fecha) AS anio FROM anuario
                WHERE estadoV = 1 AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getAnuario($filtro, $pkID_proyectoM)
    {
        if ($filtro == "'Todos'") {
            $where_anio = '';
        } else {
            $where_anio = "AND YEAR(fecha) = " . $filtro;
        }

        $query = "SELECT *, YEAR(fecha) AS anio FROM anuario
                WHERE estadoV = 1 " . $where_anio . " AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getAnuariosId($pkID)
    {

        $query = "SELECT *,resignificacion.pkID AS pkID,CONCAT(nombre_funcionario,' ',apellido_funcionario) AS asesor FROM resignificacion
                INNER JOIN funcionario ON funcionario.pkID = resignificacion.fkID_asesor
                INNER JOIN institucion ON institucion.pkID = resignificacion.fkID_institucion
                WHERE resignificacion.pkID =" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoGrupo($fkID_grupo)
    {

        $query = "SELECT *,proyecto_marco.nombre AS nombre_proyecto FROM proyecto_marco
                INNER JOIN grupo ON grupo.fkID_proyecto_marco = proyecto_marco.pkID
                WHERE grupo.pkID = " . $fkID_grupo;

        return $this->EjecutarConsulta($query);
    }

}
