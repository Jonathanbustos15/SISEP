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
        
        public function getFeria($pkID_proyectoM,$filtro,$filtro2){  
            if ($filtro == "Todos") {
            $where_anio = "!= 0";
        } else {
            $where_anio = "=" . $filtro;
        }     

        if ($filtro2 == "Todos") {
            $where_tipo = "!='0'";
        } else { 
            $where_tipo = "= '$filtro2'";
        }       
       
            $query = "select feria.pkID,fecha_feria,feria.lugar_feria,(select count(*) FROM feria_participantes LEFT JOIN participante ON participante.pkID = feria_participantes.fkID_participante WHERE feria.pkID = feria_participantes.fkID_feria) as canti,tipo_feria.nombre FROM `feria`
                INNER JOIN tipo_feria on tipo_feria.pkID = feria.fkID_tipo_feria
                where feria.estadoV= 1 and feria.proyecto_macro=".$pkID_proyectoM." and year(fecha_feria) ".$where_anio." and tipo_feria.nombre".$where_tipo;

            return $this->EjecutarConsulta($query);
        }

        public function getTotalEstudiantes($filtro,$pkID_proyectoM,$filtro2)
    {
        if ($filtro == "Todos" || $filtro == "") {
                    $anio = "!=0";
                } else {
                    $anio = "=" . $filtro;
                }
        if ($filtro2 == "Todos") {
            $where_tipo = "!='0'";
        } else { 
            $where_tipo = "= '$filtro2'";
        }

        $query = "select count(*) as cantidad FROM feria_participantes LEFT JOIN participante ON participante.pkID = feria_participantes.fkID_participante
            LEFT JOIN feria on feria.pkID = feria_participantes.fkID_feria
            INNER JOIN tipo_feria on tipo_feria.pkID = feria.fkID_tipo_feria
            WHERE feria.estadoV= 1 and feria.pkID = feria_participantes.fkID_feria and  year(fecha_feria)".$anio." and feria.proyecto_macro=".$pkID_proyectoM." and tipo_feria.nombre".$where_tipo;

        return $this->EjecutarConsulta($query);
    }


        public function getsesiones($pkID_sesion)
    {

        $query = "select * FROM `sesion_feria` WHERE estadoV=1 and fkID_feria_formacion=" . $pkID_sesion;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoFeria($fkID_proyecto)
    {

        $query = "select feria.*,proyecto_marco.nombre AS nombre_proyecto,proyecto_marco.pkID as pkIDproyecto FROM proyecto_marco
                LEFT JOIN feria ON feria.proyecto_macro = proyecto_marco.pkID
                WHERE proyecto_marco.pkID= " . $fkID_proyecto;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoDetalleFeria($fkID_feria)
    {

        $query = "select feria.*,proyecto_marco.nombre AS nombre_proyecto,proyecto_marco.pkID as pkIDproyecto FROM proyecto_marco
                LEFT JOIN feria ON feria.proyecto_macro = proyecto_marco.pkID
                WHERE feria.pkID=" . $fkID_feria;

        return $this->EjecutarConsulta($query);
    }

    
      public function getTalleresId($pkID)
    {

        $query = "select talleres_formacion.*,(select count(*) FROM participante_taller LEFT JOIN participante ON participante.pkID = participante_taller.fkID_participante WHERE talleres_formacion.pkID = participante_taller.fkID_taller_formacion) as canti,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario , tipo_taller.nombre FROM talleres_formacion
            LEFT JOIN funcionario on funcionario.pkID = talleres_formacion.fkID_tutor
            INNER JOIN tipo_taller on tipo_taller.pkID = talleres_formacion.fkID_tipo_taller
            where talleres_formacion.estadoV= 1 and talleres_formacion.pkID=" . $pkID;

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

        $query = "select feria.*,(select count(*) FROM feria_participantes LEFT JOIN participante ON participante.pkID = feria_participantes.fkID_participante WHERE feria.pkID = feria_participantes.fkID_feria) as canti, tipo_feria.nombre FROM feria
            INNER JOIN tipo_feria on tipo_feria.pkID = feria.fkID_tipo_feria
            where  feria.pkID=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getTipoFeria(){        
       
            $query = "select * FROM `tipo_feria` ORDER by nombre";

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

        $query = "select feria_participantes.pkID,participante.documento_participante,participante.pkID as pkIDparticipante,nombre_participante as nombre,apellido_participante AS apellido,telefono_participante FROM feria_participantes
            INNER JOIN participante ON participante.pkID = feria_participantes.fkID_participante
            INNER JOIN feria ON feria.pkID = feria_participantes.fkID_feria
            WHERE feria.pkID= " . $pkID_feria;

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
