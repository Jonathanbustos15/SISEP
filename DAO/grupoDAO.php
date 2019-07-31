<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class grupoDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }


    public function getGrupo($pkID_proyectoM,$filtro,$filtro2)
    {

        if ($filtro == "Todos") {
            $where_anio = "!= 0";
        } else {
            $where_anio = "=" . $filtro;
        }
        if ($filtro2 == "Todos" || $filtro2 == "") {
            $where_estado = "!= 0";
        } else {
            $where_estado = "=".$filtro2;
        }

        $query = "select distinct grupo.*,YEAR(grupo.fecha_creacion) as anio, grado.nombre as nom_grado, institucion.nombre_institucion as nom_institucion, grupo.pkID as numero, tipo_proyecto.nombre as nom_tipo FROM grupo INNER JOIN tipo_proyecto ON tipo_proyecto.pkID = grupo.fkID_tipo_grupo INNER JOIN institucion ON institucion.pkID = grupo.fkID_institucion INNER JOIN grado ON grado.pkID = (CASE WHEN grupo.fkID_grado = 0 THEN 6 WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado END) where grupo.estadoV = 1 and YEAR(grupo.fecha_creacion)" . $where_anio . " And fkID_tipo_grupo" . $where_estado . " AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getGruposUsuario($pkID)
    {

        $query = "select DISTINCT grupo.*, grado.nombre as nom_grado, sede.nombre as nom_institucion

                     FROM usuarios

                     INNER JOIN usuario_grupo ON usuario_grupo.fkID_usuario = usuarios.pkID

                     INNER JOIN grupo ON grupo.pkID = usuario_grupo.fkID_grupo

                     INNER JOIN rol ON rol.pkID = usuario_grupo.fkID_rol

                     INNER JOIN sede ON sede.pkID = grupo.fkID_institucion

                     INNER JOIN grado ON grado.pkID = (CASE

                            WHEN grupo.fkID_grado = 0 THEN 6

                            WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado

                        END)

                     INNER JOIN grupos_proyectoM ON grupos_proyectoM.fkID_grupo = grupo.pkID

                     WHERE usuario_grupo.fkID_usuario = " . $pkID . " AND grupos_proyectoM.fkID_proyectoM = " . $this->getcpm();

        return $this->EjecutarConsulta($query);
    }

    public function getGruposInactivos()
    {

        $query = "select grupo.pkID, grupo.nombre as nombre, grupo.fkID_estado

                        FROM `grupo`


                        WHERE fkID_estado = 2";

        return $this->EjecutarConsulta($query);
    }

    public function getGrupoGaleria($pkID_album){  
       
      $query = "select galeria_grupo.*, proyecto_marco.pkID as fkID_proyecto FROM galeria_grupo 
                INNER JOIN grupo on grupo.pkID = galeria_grupo.fkID_grupo
                INNER JOIN proyecto_marco on proyecto_marco.pkID = grupo.fkID_proyecto_marco
                WHERE galeria_grupo.pkID=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getTipoGrupo()
    {

        $query = "select pkID, nombre FROM `tipo_proyecto`";

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

    public function getTutor()
    {

        $query = "select  pkID, concat_ws(' ',nombre_funcionario,apellido_funcionario) as nombres FROM `funcionario` ORDER BY nombre_funcionario";

        return $this->EjecutarConsulta($query);
    }

    public function getDocente()
    {

        $query = "select  pkID, concat_ws(' ',nombre_docente,apellido_docente) as nombres FROM `docente` ORDER BY nombre_docente";

        return $this->EjecutarConsulta($query);
    }

    public function getNumGruposInactivos()
    {

        $query = "select count(grupo.pkID) as ngi, grupo.fkID_estado

                        FROM `grupo`

                        WHERE fkID_estado = 2

                        GROUP BY grupo.fkID_estado ";

        return $this->EjecutarConsulta($query);

    }

    public function getTotalEstudiantes($pkID_proyectoM,$filtro,$filtro2)
    {
        if ($filtro == "Todos") {
            $where_anio = "!= 0";
        } else {
            $where_anio = "=" . $filtro;
        }
        if ($filtro2 == "Todos" || $filtro2 == "") {
            $where_estado = "!= 0";
        } else {
            $where_estado = "=".$filtro2;
        }

        $query = "select count(*) as cantidad FROM estudiante_grupo LEFT JOIN estudiante ON estudiante.pkID = estudiante_grupo.fkID_estudiante
                LEFT JOIN grupo on grupo.pkID = estudiante_grupo.fkID_grupo
                WHERE estudiante_grupo.estadoV=1 and grupo.pkID = estudiante_grupo.fkID_grupo and grupo.fkID_proyecto_marco=".$pkID_proyectoM. " and YEAR(grupo.fecha_creacion)" . $where_anio . " And fkID_tipo_grupo" . $where_estado;

        return $this->EjecutarConsulta($query);
    }

    public function getGruposId($pkID)
    {

        $query = "select grupo.*,nombre_institucion,grado.nombre as nombre_grado,(select count(*) FROM estudiante_grupo LEFT JOIN estudiante ON estudiante.pkID = estudiante_grupo.fkID_estudiante WHERE grupo.pkID = estudiante_grupo.fkID_grupo) as canti, concat_ws(' ', nombre_docente, apellido_docente)as nombres_docente, concat_ws(' ', nombre_funcionario, apellido_funcionario) as nombres_funcionario from grupo
            INNER JOIN grado on grado.pkID= grupo.fkID_grado
            INNER JOIN institucion on institucion.pkID= grupo.fkID_institucion
            LEFT JOIN docente_grupo on grupo.pkID = docente_grupo.fkID_grupo
            LEFT JOIN docente on docente.pkID = docente_grupo.fkID_docente
            LEFT JOIN funcionario_grupo on grupo.pkID = funcionario_grupo.fkID_grupo
            LEFT JOIN funcionario on funcionario.pkID = funcionario_grupo.fkID_tutor
            where grupo.estadoV = 1 and grupo.pkID=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getproyectoId($pkID)
    {

        $query = "select * FROM `proyecto_grupo` WHERE estadoV=1 and fkID_grupo=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getEstadoGrupo($pkID)
    {

        $query = "select grupo.*, estado_grupo_inv.nombre

                        FROM `grupo`

                        INNER JOIN estado_grupo_inv ON estado_grupo_inv.pkID = grupo.fkID_estado

                        WHERE grupo.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);

    }

    public function getGrados()
    {

        $query = "select * FROM `grado`";

        return $this->EjecutarConsulta($query);
    }

    public function getInstitucion()
    {

        $query = "select sede.*

                    FROM sede

                    INNER JOIN institucion_proyectoM ON sede.fkID_institucion = institucion_proyectoM.fkID_institucion

                    WHERE institucion_proyectoM.fkID_proyectoM = " . $this->getcpm();

        return $this->EjecutarConsulta($query);
    }

    public function getRoles($pkID_tipo)
    {

        $query = "select * FROM `rol` WHERE fkID_tipo_usuario = " . $pkID_tipo;

        return $this->EjecutarConsulta($query);
    }

    public function getGradoUsuarios($pkID_grado, $pkID_institucion)
    {

        $query = "select usuarios.*, grado.nombre as nom_grado, sede.nombre as nom_institucion

                    FROM `usuarios`

                    INNER JOIN usuario_grado ON usuario_grado.fkID_usuario = usuarios.pkID

                    INNER JOIN grado ON usuario_grado.fkID_grado = grado.pkID

                    INNER JOIN sede ON sede.pkID = usuarios.fkID_institucion

                    WHERE grado.pkID = " . $pkID_grado . " AND sede.pkID = " . $pkID_institucion . " AND usuarios.fkID_tipo = 9";

        return $this->EjecutarConsulta($query);
    }

    public function getDocentesGrado($pkID_grado)
    {

        $query = "select usuarios.*, grado.nombre as nom_grado

                    from usuarios

                    INNER JOIN usuario_grado ON usuario_grado.fkID_usuario = usuarios.pkID

                    INNER JOIN grado ON usuario_grado.fkID_grado = grado.pkID

                    WHERE usuarios.fkID_tipo = 8 AND grado.pkID = " . $pkID_grado;

        return $this->EjecutarConsulta($query);
    }

    public function getGrupoUsuarios($fkID_tipo_usuario, $pkID_grupo)
    {

        $query = "select usuarios.*, usuarios.nombre as nom, usuarios.apellido as apell, rol.nombre as nom_rol

                    FROM `usuario_grupo`

                    INNER JOIN usuarios ON usuarios.pkID = usuario_grupo.fkID_usuario

                    INNER JOIN rol ON rol.pkID = usuario_grupo.fkID_rol

                    LEFT JOIN grupo ON grupo.pkID = usuario_grupo.fkID_grupo

                    WHERE usuarios.fkID_tipo = " . $fkID_tipo_usuario . " AND usuario_grupo.fkID_grupo = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getNumEstudiantesGrupo($fkID_tipo_usuario, $pkID_grupo, $pkID_grado)
    {

        $query = "select count(usuarios.pkID) as num_estudiantes FROM `usuario_grupo`

                    INNER JOIN usuarios ON usuario_grupo.fkID_usuario = usuarios.pkID

                    INNER JOIN rol ON usuario_grupo.fkID_rol = rol.pkID

                    INNER JOIN tipo_usuario ON rol.fkID_tipo_usuario = tipo_usuario.pkID

                    INNER JOIN usuario_grado ON usuario_grado.fkID_usuario = usuarios.pkID

                    WHERE usuarios.fkID_tipo = " . $fkID_tipo_usuario . " AND usuario_grado.fkID_grado = " . $pkID_grado . " AND usuario_grupo.fkID_grupo = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoGrupo($fkID_grupo)
    {

        $query = "select grupo.*,proyecto_marco.nombre AS nombre_proyecto,proyecto_marco.pkID as pkIDproyecto FROM proyecto_marco
                INNER JOIN grupo ON grupo.fkID_proyecto_marco = proyecto_marco.pkID
                WHERE grupo.pkID = " . $fkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getAlbumGrupos($pkID_grupo){  
       
      $query = "select * FROM `galeria_grupo` WHERE estadoV=1 and fkID_grupo=".$pkID_grupo;

      return $this->EjecutarConsulta($query);
    }

    public function getFotosGrupo($pkID_album){  
       
      $query = "select * FROM `fotos_grupo` WHERE estadoV=1 and fkID_album=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }


    public function getEstudiantesGrupo($pkID_grupo)
    {

        $query = "select estudiante_grupo.*,CONCAT(nombre_estudiante1,' ',nombre_estudiante2) AS nombre,documento_estudiante,CONCAT(apellido_estudiante1,' ',apellido_estudiante2) AS apellido,grado.nombre AS nombre_grado FROM estudiante_grupo
            INNER JOIN estudiante ON estudiante.pkID = estudiante_grupo.fkID_estudiante
            INNER JOIN grupo ON grupo.pkID = estudiante_grupo.fkID_grupo
            INNER JOIN grado ON grado.pkID = estudiante_grupo.fkID_grado
            WHERE estudiante_grupo.estadoV=1 and grupo.pkID = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getAlbumGrupo($pkID_grupo)
    {

        $query = "select * FROM `grupo_album` WHERE estadoV=1 and fkID_grupo= " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

}
