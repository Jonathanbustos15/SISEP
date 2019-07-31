<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class aulasDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getaulass($pkID_proyectoM)
    {

        $query = "SELECT *,YEAR(fecha) AS anio,aulas.pkID AS pkID FROM aulas
                INNER JOIN institucion ON institucion.pkID = aulas.fkID_institucion
                WHERE aulas.estadoV = 1 AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getaulas($filtro, $pkID_proyectoM)
    {
        if ($filtro == "'Todos'") {
            $where_anio = '';
        } else {
            $where_anio = "AND YEAR(fecha) = " . $filtro;
        }

        $query = "SELECT *,YEAR(fecha) AS anio,aulas.pkID AS pkID FROM aulas
                INNER JOIN institucion ON institucion.pkID = aulas.fkID_institucion
                WHERE aulas.estadoV = 1 " . $where_anio . " AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getInventario($pkid_aibd)
    {
        $query = "SELECT * FROM inventario_aibd
                WHERE estadoV=1 AND fkID_aibd = " . $pkid_aibd;

        return $this->EjecutarConsulta($query);
    }

    public function getAsistencias($pkID_grupo)
    {

        $query = "SELECT * FROM acompanamiento_asistencia
                WHERE fkID_acompanamiento = " . $pkID_grupo;

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

    public function getCursos()
    {

        $query = "SELECT * FROM curso
                WHERE estadoV = 1";

        return $this->EjecutarConsulta($query);
    }

    public function getCiclos()
    {

        $query = "SELECT * FROM ciclo
                WHERE estadoV = 1";

        return $this->EjecutarConsulta($query);
    }

    public function getAulasTecnologia($pkID_aulas)
    {
        $query = "SELECT * FROM aulas_tecnologia
                WHERE estadoV = 1 AND fkID_aula = " . $pkID_aulas;

        return $this->EjecutarConsulta($query);
    }

    public function getAulasCientifico($pkID_aulas)
    {
        $query = "SELECT * FROM aulas_cientifico
                WHERE estadoV = 1 AND fkID_aula = " . $pkID_aulas;

        return $this->EjecutarConsulta($query);
    }

    public function getAulasWifi($pkID_aulas)
    {
        $query = "SELECT * FROM aulas_wifi
                WHERE estadoV = 1 AND fkID_aula = " . $pkID_aulas;

        return $this->EjecutarConsulta($query);
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

    public function getProyectosMarcoGrupo($fkID_grupo)
    {

        $query = "select *,proyecto_marco.nombre AS nombre_proyecto FROM proyecto_marco
                INNER JOIN grupo ON grupo.fkID_proyecto_marco = proyecto_marco.pkID
                WHERE grupo.pkID=" . $fkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getAulaGaleria($pkID_album){  
       
      $query = "select galeria_aula.*, proyecto_marco.pkID as fkID_proyecto FROM galeria_aula 
                INNER JOIN aulas on aulas.pkID = galeria_aula.fkID_aula
                INNER JOIN proyecto_marco on proyecto_marco.pkID = aulas.fkID_proyecto_marco
                WHERE galeria_aula.pkID=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getAlbumAula($pkID_aula){  
       
      $query = "select * FROM `galeria_aula` WHERE estadoV=1 and fkID_aula=".$pkID_aula;

      return $this->EjecutarConsulta($query);
    }

    public function getFotosAula($pkID_album){  
       
      $query = "select * FROM `fotos_aula` WHERE estadoV=1 and fkID_album=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getEstudiantes()
    {

        $query = "SELECT grado.pkID AS id_grado,estudiante.pkID, concat_ws(' ',nombre_estudiante1,apellido_estudiante1) as nombres, documento_estudiante, grado.nombre as grado_estudiante FROM `estudiante`
            INNER JOIN grado on grado.pkID= estudiante.fkID_grado
            WHERE estudiante.estadoV=1";

        return $this->EjecutarConsulta($query);
    }

    public function getAulasActas($pkID_aulas)
    {
        $query = "SELECT * FROM aulas_acta WHERE estadoV=1 and fkID_aula =" . $pkID_aulas;

        return $this->EjecutarConsulta($query);
    }

    public function getGeneralId($pkID)
    {

        $query = "SELECT *,YEAR(fecha) AS anio FROM aulas
                INNER JOIN institucion ON institucion.pkID = aulas.fkID_institucion
                WHERE aulas.pkID =" . $pkID;

        return $this->EjecutarConsulta($query);
    }
}
