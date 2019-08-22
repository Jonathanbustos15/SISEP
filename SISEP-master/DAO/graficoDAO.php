<?php
/**/

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

include_once 'usuariosDAO.php';

class graficoDAO extends UsuariosDAO
{
    public function getIndicador($pkID_indicador)
    {

        $query = "SELECT * FROM indicador
                INNER JOIN subactividad ON subactividad.pkID = indicador.fkID_subactividad
                INNER JOIN actividad ON actividad.pkID = subactividad.fkID_actividad
                INNER JOIN objetivo ON objetivo.pkID = actividad.fkID_objetivo
                WHERE indicador.estadoV = 1 AND indicador.pkID = " . $pkID_indicador;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoId($pkID)
    {

        $query = "select proyecto_marco.*, departamento.nombre_departamento as nom_departamento

                      FROM proyecto_marco

                      INNER JOIN departamento ON departamento.pkID = proyecto_marco.fkID_departamento

                      WHERE proyecto_marco.pkID= " . $pkID;

        return $this->EjecutarConsulta($query);
    }
}
