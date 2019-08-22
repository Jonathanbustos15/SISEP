<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class aibdDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getAibds($pkID_proyectoM)
    {

        $query = "SELECT * FROM aibd
                WHERE estadoV = 1 AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getAibd($filtro, $pkID_proyectoM)
    {
        if ($filtro == "'Todos'") {
            $where_anio = '';
        } else {
            $where_anio = "AND YEAR(fecha) = " . $filtro;
        }

        $query = "SELECT * FROM aibd
                WHERE estadoV = 1 " . $where_anio . " AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoGrupo($fkID_grupo)
    {

        $query = "SELECT *,proyecto_marco.nombre AS nombre_proyecto FROM proyecto_marco
                INNER JOIN grupo ON grupo.fkID_proyecto_marco = proyecto_marco.pkID
                WHERE grupo.pkID = " . $fkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getDocumentos($pkid_aibd)
    {
        $query = "SELECT * FROM documentos_aibd
                WHERE estadoV=1 AND fkID_proyecto_marco = " . $pkid_aibd;

        return $this->EjecutarConsulta($query);
    }

    public function getAsistencias($pkID_grupo)
    {

        $query = "SELECT * FROM acompanamiento_asistencia
                WHERE fkID_acompanamiento = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getFotosAibd($pkID_proyectoM){  
       
      $query = "select fotos_aibd.* FROM `fotos_aibd`
        INNER JOIN aibd on aibd.pkID = fotos_aibd.fkID_aibd
        WHERE aibd.estadoV=1 and fotos_aibd.estadoV=1 and aibd.fkID_proyecto_marco=".$pkID_proyectoM;

      return $this->EjecutarConsulta($query);
    }

    public function getAlbumGrupo($pkID_grupo)
    {

        $query = "select * FROM `grupo_album` WHERE estadoV=1 and fkID_grupo= " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoId($pkID)
    {

        $query = "select proyecto_marco.*, departamento.nombre_departamento as nom_departamento

                      FROM proyecto_marco

                      INNER JOIN departamento ON departamento.pkID = proyecto_marco.fkID_departamento

                      WHERE proyecto_marco.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getproyectoId($pkID)
    {

        $query = "select * FROM `aibd` WHERE estadoV=1 and fkID_proyecto_marco=" . $pkID;

        return $this->EjecutarConsulta($query);
    }
}
