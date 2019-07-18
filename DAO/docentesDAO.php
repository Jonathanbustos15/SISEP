<?php
/**/

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

include_once 'usuariosDAO.php';

class docentesDAO extends UsuariosDAO
{

    public function getDocente($pkID_proyectoM)
    {

        $query = "select docente.pkID, CONCAT_WS(' ',docente.nombre_docente,docente.apellido_docente) as nombres, docente.documento_docente,institucion.nombre_institucion as institucion, docente.email_docente FROM `docente`
INNER JOIN institucion on institucion.pkID = docente.fkID_institucion WHERE docente.estadoV = 1 and proyecto_macro=".$pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getDocentesNoLogin($pkID_proyectoM)
    {

        $query = "select usuarios.*, cargo.nombre as nom_cargo, rol.nombre as nom_rol

					from usuarios

	      			INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_usuario = usuarios.pkID

                    INNER JOIN cargo ON usuarios.fkID_cargo = cargo.pkID

                    INNER JOIN rol ON usuarios.fkID_rol = rol.pkID

	      			WHERE fkID_tipo = 8

	      			AND usuario_proyectoM.fkID_proyectoM = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getDocentesId($pkID)
    {

        $query = "select usuarios.*, tipo_documento_id.nombre as nom_tdoc, cargo.nombre as nom_cargo, nivel_formacion.nombre as nom_nformacion, grupo_etnico.nombre as nom_getnico, institucion.nombre as nom_institucion, genero.nombre as nom_genero

					from usuarios

					INNER JOIN tipo_documento_id ON tipo_documento_id.pkID = usuarios.fkID_tipo_documento

					INNER JOIN cargo ON cargo.pkID = CASE

				        WHEN usuarios.fkID_cargo = 0 THEN 6

				        WHEN usuarios.fkID_cargo != 0 THEN usuarios.fkID_cargo

				    END

					INNER JOIN nivel_formacion ON nivel_formacion.pkID = usuarios.fkID_nivel_formacion

					INNER JOIN grupo_etnico ON grupo_etnico.pkID = CASE

				        WHEN usuarios.fkID_grupo_etnico = 0 THEN 6

				        WHEN usuarios.fkID_grupo_etnico != 0 THEN grupo_etnico.pkID

				    END

				    INNER JOIN institucion ON institucion.pkID = usuarios.fkID_institucion

				    INNER JOIN genero on genero.pkID = usuarios.fkID_genero

					WHERE usuarios.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getDocentesMaterias($pkID)
    {

        $query = "select materia.*, usuarios.alias

					FROM materia

					INNER JOIN usuario_materia ON usuario_materia.fkID_materia = materia.pkID

					INNER JOIN usuarios ON usuario_materia.fkID_usuario = usuarios.pkID

					WHERE usuarios.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getDocentesGrados($pkID)
    {

        $query = "select grado.*, usuarios.alias

					FROM grado

					INNER JOIN usuario_grado ON usuario_grado.fkID_grado = grado.pkID

					INNER JOIN usuarios ON usuario_grado.fkID_usuario = usuarios.pkID

					WHERE usuarios.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getDepartamentos()
    {

        $query = "select * FROM `departamento`";

        return $this->EjecutarConsulta($query);
    }

    public function getMunicipios()
    {

        $query = "select * FROM `municipio`";

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

    public function getInstitucionNoLogin($proyectoM_docente)
    {

        $query = "select *

					FROM sede

					INNER JOIN institucion_proyectoM ON sede.fkID_institucion = institucion_proyectoM.fkID_institucion

					WHERE institucion_proyectoM.fkID_proyectoM = " . $proyectoM_docente;

        return $this->EjecutarConsulta($query);
    }

    public function getRoles($pkID_tipo)
    {

        $query = "select * FROM `rol` WHERE fkID_tipo_usuario = " . $pkID_tipo;

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
