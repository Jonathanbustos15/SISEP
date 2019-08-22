<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class tiexDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM(); 
    }

    public function getTiexs($pkID_proyectoM)
    {

        $query = "SELECT *,YEAR(fecha) AS anio, tiex.pkID AS pkID,grado.nombre AS grado,(SELECT COUNT(*) FROM tiex_estudiante LEFT JOIN estudiante ON estudiante.pkID = tiex_estudiante.fkID_estudiante WHERE tiex.pkID = tiex_estudiante.fkID_tiex AND tiex_estudiante.estadoV = 1) as cantidad  FROM tiex
                INNER JOIN institucion ON institucion.pkID = tiex.fkID_institucion
                INNER JOIN grado ON grado.pkID = tiex.fkID_grado
                LEFT JOIN curso ON curso.pkID = tiex.fkID_curso
                INNER JOIN ciclo ON ciclo.pkID = tiex.fkID_ciclo
                WHERE tiex.estadoV = 1 AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getTiex($filtro, $pkID_proyectoM)
    {
        if ($filtro == "'Todos'") {
            $where_anio = '';
        } else {
            $where_anio = "AND YEAR(fecha) = " . $filtro;
        }

        $query = "SELECT *,YEAR(fecha) AS anio, tiex.pkID AS pkID,grado.nombre AS grado,(SELECT COUNT(*) FROM tiex_estudiante LEFT JOIN estudiante ON estudiante.pkID = tiex_estudiante.fkID_estudiante WHERE tiex.pkID = tiex_estudiante.fkID_tiex AND tiex_estudiante.estadoV = 1) as cantidad  FROM tiex
                INNER JOIN institucion ON institucion.pkID = tiex.fkID_institucion
                INNER JOIN grado ON grado.pkID = tiex.fkID_grado
                LEFT JOIN curso ON curso.pkID = tiex.fkID_curso
                INNER JOIN ciclo ON ciclo.pkID = tiex.fkID_ciclo
                WHERE tiex.estadoV = 1 " . $where_anio . " AND fkID_proyecto_marco = " . $pkID_proyectoM;

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

    public function getTiexEstudiantes($pkID_tiex)
    {
        $query = "SELECT tiex_estudiante.pkID AS pkID,grado.pkID AS id_grado, concat_ws(' ',nombre_estudiante1,nombre_estudiante2) AS nombres,concat_ws(' ',apellido_estudiante1,apellido_estudiante2) AS apellidos, documento_estudiante, grado.nombre as grado FROM tiex_estudiante
                INNER JOIN tiex ON tiex.pkID = tiex_estudiante.fkID_tiex
                INNER JOIN estudiante ON estudiante.pkID = tiex_estudiante.fkID_estudiante
                INNER JOIN grado on grado.pkID= estudiante.fkID_grado
                WHERE tiex_estudiante.estadoV = 1 AND fkID_tiex = " . $pkID_tiex;

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

    public function getTiexGaleria($pkID_album){  
       
      $query = "select galeria_tiex.*, proyecto_marco.pkID as fkID_proyecto FROM galeria_tiex 
                INNER JOIN tiex on tiex.pkID = galeria_tiex.fkID_tiex
                INNER JOIN proyecto_marco on proyecto_marco.pkID = tiex.fkID_proyecto_marco
                WHERE galeria_tiex.pkID=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getAlbumTiex($pkID_tiex){  
       
      $query = "select * FROM `galeria_tiex` WHERE estadoV=1 and fkID_tiex=".$pkID_tiex;

      return $this->EjecutarConsulta($query);
    }

    public function getFotosTiex($pkID_album){  
       
      $query = "select * FROM `fotos_tiex` WHERE estadoV=1 and fkID_album=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getEstudiantes()
    {

        $query = "SELECT grado.pkID AS id_grado,estudiante.pkID, concat_ws(' ',nombre_estudiante1,apellido_estudiante1) as nombres, documento_estudiante, grado.nombre as grado_estudiante FROM `estudiante`
            INNER JOIN grado on grado.pkID= estudiante.fkID_grado
            WHERE estudiante.estadoV=1";

        return $this->EjecutarConsulta($query);
    }

    public function getSesiones($pkID_tiex)
    {
        $query = "SELECT * FROM tiex_sesion WHERE estadoV=1 and fkID_tiex =" . $pkID_tiex;

        return $this->EjecutarConsulta($query);
    }

    public function getTotalEstudiantes($pkID_proyectoM, $filtro)
    {
        if ($filtro == "'Todos'") {
            $where_anio = "!= 0";
        } else {
            $where_anio = "=" . $filtro;
        }

        $query = "SELECT COUNT(*) AS cantidad FROM tiex_estudiante
                LEFT JOIN estudiante ON estudiante.pkID = tiex_estudiante.fkID_estudiante
                LEFT JOIN tiex on tiex.pkID = tiex_estudiante.fkID_tiex
                WHERE tiex.estadoV = 1 AND tiex_estudiante.estadoV=1 and tiex.pkID = tiex_estudiante.fkID_tiex and tiex.fkID_proyecto_marco = " . $pkID_proyectoM . " and YEAR(tiex.fecha)" . $where_anio;

        return $this->EjecutarConsulta($query);
    }
}
