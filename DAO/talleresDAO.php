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
        
        public function getTalleres($pkID_proyectoM,$filtro,$filtro2){

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
       
            $query = "select talleres_formacion.pkID,fecha_taller,talleres_formacion.descripcion,(select count(*) FROM participante_taller LEFT JOIN participante ON participante.pkID = participante_taller.fkID_participante WHERE talleres_formacion.pkID = participante_taller.fkID_taller_formacion) as canti,tipo_taller.nombre,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario FROM `talleres_formacion`
                INNER JOIN funcionario on funcionario.pkID = talleres_formacion.fkID_tutor
                INNER JOIN tipo_taller on tipo_taller.pkID = talleres_formacion.fkID_tipo_taller
                 where talleres_formacion.estadoV= 1 and talleres_formacion.fkID_proyectoM=".$pkID_proyectoM." and year(fecha_taller)".$where_anio." and tipo_taller.nombre".$where_tipo;

            return $this->EjecutarConsulta($query);
        }

        public function getTipoTaller(){        
       
            $query = "select * FROM `tipo_taller`";

            return $this->EjecutarConsulta($query);
        }

        public function getsesiones($pkID_sesion)
    {

        $query = "select * FROM `sesion_taller` WHERE estadoV=1 and fkID_taller_formacion=" . $pkID_sesion;

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

        public function getTalleresId($pkID)
    {

        $query = "select talleres_formacion.*,(select count(*) FROM participante_taller LEFT JOIN participante ON participante.pkID = participante_taller.fkID_participante WHERE talleres_formacion.pkID = participante_taller.fkID_taller_formacion) as canti,concat_ws(' ',nombre_funcionario,apellido_funcionario)nombres_funcionario , tipo_taller.nombre FROM talleres_formacion
            LEFT JOIN funcionario on funcionario.pkID = talleres_formacion.fkID_tutor
            INNER JOIN tipo_taller on tipo_taller.pkID = talleres_formacion.fkID_tipo_taller
            where talleres_formacion.estadoV= 1 and talleres_formacion.pkID=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

     public function getlistadoID($pkID)
    {

        $query = "select * FROM `sesion_taller` 
        INNER join talleres_formacion on talleres_formacion.pkID = sesion_taller.fkID_taller_formacion
        WHERE sesion_taller.estadoV=1 AND fkID_taller_formacion=" . $pkID;

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

    public function getAlbumTaller($pkID_taller){  
       
      $query = "select * FROM `galeria_taller` WHERE estadoV=1";

      return $this->EjecutarConsulta($query);
    }

    public function getTaller($pkID_album){  
       
      $query = "select galeria_taller.*, proyecto_marco.pkID as fkID_proyecto FROM galeria_taller 
                INNER JOIN talleres_formacion on talleres_formacion.pkID = galeria_taller.fkID_taller
                INNER JOIN proyecto_marco on proyecto_marco.pkID = talleres_formacion.fkID_proyectoM
                WHERE galeria_taller.pkID=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getFotosTaller($pkID_album){  
       
      $query = "select * FROM `fotos_taller` WHERE estadoV=1 and fkID_album=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoTaller($fkID_proyectoM)
    {

        $query = "select talleres_formacion.*,proyecto_marco.nombre AS nombre_proyecto, proyecto_marco.pkID as fkIDproyecto  FROM proyecto_marco
            LEFT JOIN talleres_formacion ON talleres_formacion.fkID_proyectoM = proyecto_marco.pkID
            WHERE proyecto_marco.pkID=" . $fkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getParticipantesTaller($pkID_taller)
    {

        $query = "select participante_taller.pkID,participante.documento_participante,participante.pkID as pkIDparticipante,nombre_participante as nombre,apellido_participante AS apellido,telefono_participante FROM participante_taller
            INNER JOIN participante ON participante.pkID = participante_taller.fkID_participante
            INNER JOIN talleres_formacion ON talleres_formacion.pkID = participante_taller.fkID_taller_formacion
            WHERE talleres_formacion.pkID= " . $pkID_taller;

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
