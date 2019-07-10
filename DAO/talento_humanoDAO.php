<?php
/**/
include_once 'genericoDAO.php';

class talento_humanoDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.

    public function getFuncionariosCargo($pkID_proyectoM)
    {

        include '../conexion/datos.php';

        $this->q_general = "SELECT fkID_proyecto_marco,funcionario_cargo.pkID AS pkID,nombre_funcionario,apellido_funcionario,nombre_cargo,anio_funcionario_cargo,estado_funcionario_cargo FROM `funcionario_cargo`
            INNER JOIN funcionario ON funcionario.pkID = funcionario_cargo.fkID_funcionario
            INNER JOIN cargo ON cargo.pkID = funcionario_cargo.fkID_cargo
            WHERE funcionario_cargo.estadoV = 1 AND funcionario_cargo.fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($this->q_general);
    }

    public function getProyectosMarcoId($pkID)
    {

        $query = "select proyecto_marco.*, departamento.nombre as nom_departamento

                      FROM proyecto_marco

                      INNER JOIN departamento ON departamento.pkID = proyecto_marco.fkID_departamento

                      WHERE proyecto_marco.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getDepartamentosProyectoM($pkID)
    {

        $query = "select municipio.*

                        FROM `proyectoM_municipio`

                        INNER JOIN municipio ON municipio.pkID = proyectoM_municipio.fkID_municipio

                        WHERE fkID_proyectoM = " . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getFuncionarios()
    {

        $query = "SELECT * FROM funcionario";

        return $this->EjecutarConsulta($query);
    }

    public function getCargos()
    {

        $query = "SELECT * FROM cargo ORDER BY nombre_cargo";

        return $this->EjecutarConsulta($query);
    }
}
