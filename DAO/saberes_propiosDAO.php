<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class saberesDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getProyectosMarcoId($pkID)
    {

        $query = "select proyecto_marco.*, departamento.nombre_departamento as nom_departamento

                      FROM proyecto_marco

                      INNER JOIN departamento ON departamento.pkID = proyecto_marco.fkID_departamento

                      WHERE proyecto_marco.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getSaberes($filtro,$pkID_proyectoM)
    {
        if ($filtro == "Todos" || $filtro == "") {
                    $anio = "!=0";
                } else {
                    $anio = "=" . $filtro;
                }
           

        $query = "select saber_propio.*,grupo.nombre,(select count(*) FROM saber_estudiante LEFT JOIN estudiante ON estudiante.pkID = saber_estudiante.fkID_estudiante WHERE saber_propio.pkID = saber_estudiante.fkID_saber_propio) as canti,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario FROM `saber_propio`
            LEFT JOIN funcionario on funcionario.pkID = saber_propio.fkID_asesor
            INNER JOIN grupo on grupo.pkID = saber_propio.fkID_grupo where saber_propio.estadoV= 1 and year(fecha_salida) ".$anio." and saber_propio.fkID_proyectos=".$pkID_proyectoM;

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

    public function getGruposParticipante()
    {

        $query = "select pkID, concat_ws(' - ',nombre,YEAR(grupo.fecha_creacion))as nombre FROM `grupo` where estadoV=1 ORDER by nombre,YEAR(grupo.fecha_creacion)";

        return $this->EjecutarConsulta($query);
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

    public function getSaberesId($pkID)
    {

        $query = "select saber_propio.*,grupo.nombre,grupo.url_logo,(select count(*) FROM saber_estudiante LEFT JOIN estudiante ON estudiante.pkID = saber_estudiante.fkID_estudiante WHERE saber_propio.pkID = saber_estudiante.fkID_saber_propio) as canti,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario FROM `saber_propio`
            LEFT JOIN funcionario on funcionario.pkID = saber_propio.fkID_asesor
            INNER JOIN grupo on grupo.pkID = saber_propio.fkID_grupo where saber_propio.estadoV= 1 and saber_propio.pkID=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getproyectoId($pkID)
    {

        $query = "select * FROM `proyecto_grupo` WHERE estadoV=1 and fkID_grupo=". $pkID;

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

    public function getTotalEstudiantes($filtro,$pkID_proyectoM)
    {
        if ($filtro == "Todos" || $filtro == "") {
                    $anio = "!=0";
                } else {
                    $anio = "=" . $filtro;
                }

        $query = "select count(*) as cantidad FROM saber_estudiante LEFT JOIN estudiante ON estudiante.pkID = saber_estudiante.fkID_estudiante
                LEFT JOIN saber_propio on saber_propio.pkID = saber_estudiante.fkID_saber_propio
                WHERE saber_propio.pkID = saber_estudiante.fkID_saber_propio and saber_propio.estadoV=1 and year(fecha_salida)".$anio." and saber_propio.fkID_proyectos=".$pkID_proyectoM;

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

    public function getProyectosMarcoGrupo($fkID_saber)
    {

        $query = "select saber_propio.*,proyecto_marco.nombre AS nombre_proyecto, proyecto_marco.pkID as fkIDproyecto  FROM proyecto_marco
                INNER JOIN saber_propio ON saber_propio.fkID_proyectos = proyecto_marco.pkID
                WHERE saber_propio.pkID=" . $fkID_saber;

        return $this->EjecutarConsulta($query);
    }

    public function getEstudiantes($pkID_proyectoM)
    {

        $query = "select grado.pkID AS id_grado,estudiante.pkID, concat_ws(' ',nombre_estudiante1,apellido_estudiante1) as nombres, documento_estudiante, grado.nombre as grado_estudiante FROM `estudiante`
            INNER JOIN grado on grado.pkID= estudiante.fkID_grado
            WHERE estudiante.estadoV=1 and proyecto_marco=".$pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getEstudiantesSaberes($pkID_saber)
    {

        $query = "select saber_estudiante.pkID,estudiante.documento_estudiante,estudiante.pkID as pkIDestudiante,CONCAT(nombre_estudiante1,' ',nombre_estudiante2) AS nombre,CONCAT(apellido_estudiante1,' ',apellido_estudiante2) AS apellido,grado.nombre AS nombre_grado FROM saber_estudiante
                INNER JOIN estudiante ON estudiante.pkID = saber_estudiante.fkID_estudiante
                INNER JOIN saber_propio ON saber_propio.pkID = saber_estudiante.fkID_saber_propio
                INNER JOIN grado ON grado.pkID = estudiante.fkID_grado
                WHERE saber_propio.pkID= " . $pkID_saber;

        return $this->EjecutarConsulta($query);
    }


    public function getAlbumGrupo($pkID_grupo)
    {

        $query = "select * FROM `grupo_album` WHERE estadoV=1 and fkID_grupo= ". $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

}