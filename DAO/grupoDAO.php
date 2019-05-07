<?php
/**/
include_once 'genericoDAO.php';

class grupoDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getGrupos($pkID_grupo)
    {

        $query = "select distinct grupo.*,YEAR(grupo.fecha_creacion) as anio, grado.nombre as nom_grado, sede.nombre as nom_institucion, grupo.pkID as numero, proyecto.pregunta_investigacion, tipo_proyecto.nombre as nom_tipo,(select count(*)

					FROM usuario_grupo

					INNER JOIN usuarios ON usuarios.pkID = usuario_grupo.fkID_usuario

					INNER JOIN rol ON rol.pkID = usuario_grupo.fkID_rol

					LEFT JOIN grupo ON grupo.pkID = usuario_grupo.fkID_grupo

					WHERE usuarios.fkID_tipo = 9 AND usuario_grupo.fkID_grupo = numero) as canti

						FROM grupo

						INNER JOIN proyecto ON proyecto.fkID_grupo = grupo.pkID

						INNER JOIN tipo_proyecto ON tipo_proyecto.pkID =  proyecto.fkID_tipo_proyecto

						INNER JOIN usuario_grupo ON usuario_grupo.fkID_grupo =  grupo.pkID

						INNER JOIN grupos_proyectoM ON grupos_proyectoM.fkID_grupo = grupo.pkID

						INNER JOIN sede ON sede.pkID = grupo.fkID_institucion

						INNER JOIN grado ON grado.pkID = (CASE

							WHEN grupo.fkID_grado = 0 THEN 6

						    WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado

						END)

						WHERE grupos_proyectoM.fkID_proyectoM = " . $this->getcpm();

        return $this->EjecutarConsulta($query);
    }

    public function getGruposUsuario($pkID)
    {

        $query = "select DISTINCT grupo.*, grado.nombre as nom_grado, sede.nombre as nom_institucion, proyecto.pregunta_investigacion,

	    			 FROM usuarios

	    			 INNER JOIN proyecto ON proyecto.fkID_grupo = grupo.pkID

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

        $query = "select grupo.pkID, grupo.nombre as nombre, grupo.fkID_estado,

						FROM `grupo`


						WHERE fkID_estado = 2";

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

    public function getGruposId($pkID)
    {

        $query = "select grupo.*, grado.nombre as nom_grado, sede.nombre as nom_institucion

						FROM `grupo`

						INNER JOIN grado ON grado.pkID = CASE

							WHEN grupo.fkID_grado = 0 THEN 6

						    WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado

						END

						INNER JOIN sede ON sede.pkID = grupo.fkID_institucion

						WHERE grupo.pkID = " . $pkID;

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

}
