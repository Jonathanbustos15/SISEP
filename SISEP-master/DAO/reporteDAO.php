<?php
/**/
include_once 'genericoDAO.php';

class reporteDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.

    public function getIndicadores($fkID_proyecto_marco)
    {
        include '../conexion/datos.php';
        $this->q_general = "SELECT *,indicador.pkID AS id_indicador FROM indicador
                            INNER JOIN subactividad ON subactividad.pkID = indicador.fkID_subactividad
                            INNER JOIN actividad ON actividad.pkID = subactividad.fkID_actividad
                            INNER JOIN objetivo ON objetivo.pkID = actividad.fkID_objetivo
                            WHERE indicador.estadoV = 1";
        return $this->EjecutarConsulta($this->q_general);
    }

    public function getConsulta($consulta, $fkID_proyecto_marco)
    {
        include '../conexion/datos.php';

        $this->q_general = $consulta . $fkID_proyecto_marco;
        return $this->EjecutarConsulta($this->q_general);
    }

    public function getCantObjetivo($fkID_objetivo)
    {
        include '../conexion/datos.php';
        $this->q_general = 'SELECT COUNT(*) AS cantidad FROM indicador
                            INNER JOIN subactividad ON subactividad.pkID = indicador.fkID_subactividad
                            INNER JOIN actividad ON actividad.pkID = subactividad.fkID_actividad
                            INNER JOIN objetivo ON objetivo.pkID = actividad.fkID_objetivo
                            WHERE indicador.estadoV = 1 AND fkID_objetivo = ' . $fkID_objetivo . '
                            GROUP BY fkID_objetivo';
        return $this->EjecutarConsulta($this->q_general);
    }

    public function getCantActividad($fkID_actividad)
    {
        include '../conexion/datos.php';
        $this->q_general = 'SELECT COUNT(*) AS cantidad FROM indicador
                            INNER JOIN subactividad ON subactividad.pkID = indicador.fkID_subactividad
                            INNER JOIN actividad ON actividad.pkID = subactividad.fkID_actividad
                            INNER JOIN objetivo ON objetivo.pkID = actividad.fkID_objetivo
                            WHERE indicador.estadoV = 1 AND fkID_actividad = ' . $fkID_actividad . '
                            GROUP BY fkID_actividad';
        return $this->EjecutarConsulta($this->q_general);
    }

    public function getCantSubactividad($fkID_subactividad)
    {
        include '../conexion/datos.php';
        $this->q_general = 'SELECT COUNT(*) AS cantidad FROM indicador
                            INNER JOIN subactividad ON subactividad.pkID = indicador.fkID_subactividad
                            INNER JOIN actividad ON actividad.pkID = subactividad.fkID_actividad
                            INNER JOIN objetivo ON objetivo.pkID = actividad.fkID_objetivo
                            WHERE indicador.estadoV = 1 AND fkID_subactividad = ' . $fkID_subactividad . '
                            GROUP BY fkID_subactividad';
        return $this->EjecutarConsulta($this->q_general);
    }

    public function getProyectosMarcoId($pkID)
    {

        $query = "select proyecto_marco.*, departamento.nombre_departamento as nom_departamento

                      FROM proyecto_marco

                      INNER JOIN departamento ON departamento.pkID = proyecto_marco.fkID_departamento

                      WHERE proyecto_marco.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }
}
