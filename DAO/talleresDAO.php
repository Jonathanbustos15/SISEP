<?php
/**/
    include_once 'genericoDAO.php';
    include_once 'usuariosDAO.php';
        
    class tallerDAO extends UsuariosDAO {
        
        use GenericoDAO;
        
        public $q_general;
        
        
        //Funciones------------------------------------------
        //Espacio para las funciones en general de esta clase.
    public function getcpm(){

            return $this->getCookieProyectoM();
    }
        
        public function getTalleres(){        
       
            $query = "select talleres_formacion.pkID,fecha_taller,talleres_formacion.descripcion,(select count(*) FROM talleres_participantes LEFT JOIN estudiante ON estudiante.pkID = talleres_participantes.fkID_participantes WHERE talleres_formacion.pkID = talleres_participantes.fkID_taller_formacion) as canti,tipo_taller.nombre,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario FROM `talleres_formacion`
                INNER JOIN funcionario on funcionario.pkID = talleres_formacion.fkID_tutor
                INNER JOIN tipo_taller on tipo_taller.pkID = talleres_formacion.fkID_tipo_taller
                 where talleres_formacion.estadoV= 1";

            return $this->EjecutarConsulta($query);
        }

        public function getTipoTaller(){        
       
            $query = "select * FROM `tipo_taller`";

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

    public function getPermisosModulo_Tipo($fkID_modulo, $fkID_tipo_usuario)
    {

        $this->q_general = "select permisos.*, tipo_usuario.nombre as nom_tipo, modulos.Nombre as nom_modulo

                                FROM `permisos`

                                INNER JOIN tipo_usuario ON tipo_usuario.pkID = permisos.fkID_tipo_usuario

                                INNER JOIN modulos ON modulos.pkID = permisos.fkID_modulo

                                WHERE permisos.fkID_modulo = " . $fkID_modulo . " AND permisos.fkID_tipo_usuario = " . $fkID_tipo_usuario;

        return $this->EjecutarConsulta($this->q_general);
    }

        public function getSaberesId($pkID)
    {

        $query = "select saber_propio.*,grupo.nombre,grupo.url_logo,(select count(*) FROM saber_estudiante LEFT JOIN estudiante ON estudiante.pkID = saber_estudiante.fkID_estudiante WHERE saber_propio.pkID = saber_estudiante.fkID_saber_propio) as canti,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario FROM `saber_propio`
            LEFT JOIN funcionario on funcionario.pkID = saber_propio.fkID_asesor
            INNER JOIN grupo on grupo.pkID = saber_propio.fkID_grupo where saber_propio.estadoV= 1 and saber_propio.pkID=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

        public function getAnio(){        
       
      $query = "select * FROM anio";

      return $this->EjecutarConsulta($query);
    }

        public function getTutor(){        
       
            $query = "select pkID,concat_ws(' ',nombre_funcionario,apellido_funcionario) as nombre FROM `funcionario` where estadoV=1";

            return $this->EjecutarConsulta($query);
        }

        public function getDepartamentos(){        
       
            $query = "select * FROM `departamento`";

            return $this->EjecutarConsulta($query);
        }

        public function getMunicipios(){        
       
            $query = "select * FROM `municipio`";

            return $this->EjecutarConsulta($query);
        }
        
    }
?>
