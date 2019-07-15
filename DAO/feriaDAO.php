<?php
/**/
    include_once 'genericoDAO.php';
    include_once 'usuariosDAO.php';
        
    class feriaDAO extends UsuariosDAO {
        
        use GenericoDAO;
        
        public $q_general;
        
        
        //Funciones------------------------------------------
        //Espacio para las funciones en general de esta clase.
    public function getcpm(){

            return $this->getCookieProyectoM();
    }
        
        public function getFeria(){        
       
            $query = "select feria.pkID,fecha_feria,feria.descripcion_feria,(select count(*) FROM feria_participantes LEFT JOIN estudiante ON estudiante.pkID = feria_participantes.fkID_participante WHERE feria.pkID = feria_participantes.fkID_feria) as canti,tipo_feria.nombre,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario FROM `feria`
                INNER JOIN funcionario on funcionario.pkID = feria.fkID_tutor
                INNER JOIN tipo_feria on tipo_feria.pkID = feria.fkID_tipo_feria
                where feria.estadoV= 1";

            return $this->EjecutarConsulta($query);
        }


        public function getsesiones($pkID_sesion)
    {

        $query = "select * FROM `sesion_feria` WHERE estadoV=1 and fkID_feria_formacion=" . $pkID_sesion;

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

        public function getFeriaId($pkID)
    {

        $query = "select saber_propio.*,grupo.nombre,grupo.url_logo,(select count(*) FROM saber_estudiante LEFT JOIN estudiante ON estudiante.pkID = saber_estudiante.fkID_estudiante WHERE saber_propio.pkID = saber_estudiante.fkID_saber_propio) as canti,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario FROM `saber_propio`
            LEFT JOIN funcionario on funcionario.pkID = saber_propio.fkID_asesor
            INNER JOIN grupo on grupo.pkID = saber_propio.fkID_grupo where saber_propio.estadoV= 1 and saber_propio.pkID=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getTipoFeria(){        
       
            $query = "select * FROM `tipo_feria`";

            return $this->EjecutarConsulta($query);
        }

     public function getlistadoID($pkID)
    {

        $query = "select * FROM `sesion_feria` 
        INNER join feriaes_formacion on feriaes_formacion.pkID = sesion_feria.fkID_feria_formacion
        WHERE sesion_feria.estadoV=1 AND fkID_feria_formacion=" . $pkID;

        return $this->EjecutarConsulta2($query);
    }

        public function getAnio(){        
       
      $query = "select * FROM anio";

      return $this->EjecutarConsulta($query);
    }

    public function getAsignacionParticipantes(){        
       
      $query = "select *, concat_ws(' ',nombre_participante,apellido_participante) as nombre FROM participante where estadoV=1 and proyecto_macro=2";

      return $this->EjecutarConsulta($query);
    }

    public function getParticipantesFeria($pkID_feria)
    {

        $query = "select participante_feria.pkID,participante.documento_participante,participante.pkID as pkIDparticipante,nombre_participante as nombre,apellido_participante AS apellido,telefono_participante FROM participante_feria
            INNER JOIN participante ON participante.pkID = participante_feria.fkID_participante
            INNER JOIN feriaes_formacion ON feriaes_formacion.pkID = participante_feria.fkID_feria_formacion
            WHERE feriaes_formacion.pkID= " . $pkID_feria;

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
