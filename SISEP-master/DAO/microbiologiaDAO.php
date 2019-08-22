<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class microbiologiaDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getMicrobiologias($pkID_proyectoM)
    {

        $query = "SELECT *,YEAR(fecha) AS anio,microbiologia.pkID AS pkID,grado.nombre AS grado,(SELECT COUNT(*) FROM microbiologia_estudiante LEFT JOIN estudiante ON estudiante.pkID = microbiologia_estudiante.fkID_estudiante WHERE microbiologia.pkID = microbiologia_estudiante.fkID_microbiologia AND microbiologia_estudiante.estadoV = 1) as cantidad  FROM microbiologia
                INNER JOIN institucion ON institucion.pkID = microbiologia.fkID_institucion
                INNER JOIN grado ON grado.pkID = microbiologia.fkID_grado
                LEFT JOIN curso ON curso.pkID = microbiologia.fkID_curso
                WHERE microbiologia.estadoV = 1 AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getMicrobiologia($filtro, $pkID_proyectoM)
    {
        if ($filtro == "'Todos'") {
            $where_anio = '';
        } else {
            $where_anio = "AND YEAR(fecha) = " . $filtro;
        }

        $query = "SELECT *,YEAR(fecha) AS anio,microbiologia.pkID AS pkID,grado.nombre AS grado,(SELECT COUNT(*) FROM microbiologia_estudiante LEFT JOIN estudiante ON estudiante.pkID = microbiologia_estudiante.fkID_estudiante WHERE microbiologia.pkID = microbiologia_estudiante.fkID_microbiologia AND microbiologia_estudiante.estadoV = 1) as cantidad  FROM microbiologia
                INNER JOIN institucion ON institucion.pkID = microbiologia.fkID_institucion
                INNER JOIN grado ON grado.pkID = microbiologia.fkID_grado
                LEFT JOIN curso ON curso.pkID = microbiologia.fkID_curso
                WHERE microbiologia.estadoV = 1 " . $where_anio . " AND fkID_proyecto_marco = " . $pkID_proyectoM;

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

    public function getMicrobiologiaEstudiantes($pkID_microbiologia)
    {
        $query = "SELECT microbiologia_estudiante.pkID AS pkID,grado.pkID AS id_grado, concat_ws(' ',nombre_estudiante1,nombre_estudiante2) AS nombres,concat_ws(' ',apellido_estudiante1,apellido_estudiante2) AS apellidos, documento_estudiante, grado.nombre as grado FROM microbiologia_estudiante
                INNER JOIN microbiologia ON microbiologia.pkID = microbiologia_estudiante.fkID_microbiologia
                INNER JOIN estudiante ON estudiante.pkID = microbiologia_estudiante.fkID_estudiante
                INNER JOIN grado on grado.pkID= estudiante.fkID_grado
                WHERE microbiologia_estudiante.estadoV = 1 AND fkID_microbiologia = " . $pkID_microbiologia;

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

    public function getMicrobiologiaGaleria($pkID_album){  
       
      $query = "select galeria_microbiologia.*, proyecto_marco.pkID as fkID_proyecto FROM galeria_microbiologia 
            INNER JOIN microbiologia on microbiologia.pkID = galeria_microbiologia.fkID_microbiologia
            INNER JOIN proyecto_marco on proyecto_marco.pkID = microbiologia.fkID_proyecto_marco
            WHERE galeria_microbiologia.pkID=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getAlbumMicrobiologia($pkID_biotecnologia){  
       
      $query = "select * FROM `galeria_microbiologia` WHERE estadoV=1 and fkID_microbiologia=".$pkID_biotecnologia;

      return $this->EjecutarConsulta($query);
    }

    public function getFotosMicrobiologia($pkID_album){  
       
      $query = "select * FROM `fotos_microbiologia` WHERE estadoV=1 and fkID_album=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getEstudiantes()
    {

        $query = "SELECT grado.pkID AS id_grado,estudiante.pkID, concat_ws(' ',nombre_estudiante1,apellido_estudiante1) as nombres, documento_estudiante, grado.nombre as grado_estudiante FROM `estudiante`
            INNER JOIN grado on grado.pkID= estudiante.fkID_grado
            WHERE estudiante.estadoV=1";

        return $this->EjecutarConsulta($query);
    }

    public function getSesiones($pkID_microbiologia)
    {
        $query = "SELECT * FROM microbiologia_sesion WHERE estadoV=1 and fkID_microbiologia =" . $pkID_microbiologia;

        return $this->EjecutarConsulta($query);
    }

    public function getTotalEstudiantes($pkID_proyectoM, $filtro)
    {
        if ($filtro == "'Todos'") {
            $where_anio = "!= 0";
        } else {
            $where_anio = "=" . $filtro;
        }

        $query = "SELECT COUNT(*) AS cantidad FROM microbiologia_estudiante
                LEFT JOIN estudiante ON estudiante.pkID = microbiologia_estudiante.fkID_estudiante
                LEFT JOIN microbiologia on microbiologia.pkID = microbiologia_estudiante.fkID_microbiologia
                WHERE microbiologia.estadoV = 1 AND microbiologia_estudiante.estadoV=1 and microbiologia.pkID = microbiologia_estudiante.fkID_microbiologia and microbiologia.fkID_proyecto_marco = " . $pkID_proyectoM . " and YEAR(microbiologia.fecha)" . $where_anio;

        return $this->EjecutarConsulta($query);
    }
}
