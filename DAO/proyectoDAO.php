<?php
/**/
	include_once 'genericoDAO.php';
		
	class proyectoDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
        public function getcpm(){

            return $this->getCookieProyectoM();
        }

        public function getcnpm(){

            return $this->getCookieNombreProyectoM();
        }
        
		public function getProyectos(){

            $this->q_general = "select proyecto.*, linea_investigacion.nombre as linea_inv, tipo_proyecto.nombre as tipo_p, estado_proyecto.nombre as estado_p, grupo.nombre as nom_grupo_inv 

                            FROM `proyecto`

                            INNER JOIN linea_investigacion ON linea_investigacion.pkID = proyecto.fkID_linea_investigacion
                            
                            INNER JOIN tipo_proyecto ON tipo_proyecto.pkID = proyecto.fkID_tipo_proyecto

                            INNER JOIN estado_proyecto ON estado_proyecto.pkID = proyecto.fkID_estado_proyecto

                            INNER JOIN grupo ON grupo.pkID = proyecto.fkID_grupo";        

            return $this->EjecutarConsulta($this->q_general);
    }

    public function getProyectoId($pkID){        
       
	      $query = "select proyecto.*, linea_investigacion.nombre as linea_inv, 
                                tipo_proyecto.nombre as tipo_p, estado_proyecto.nombre as estado_p, usuarios.nombre as nom_asesor, usuarios.apellido as ape_asesor, fase.nombre as fase

            				FROM `proyecto`

                            LEFT JOIN fase ON fase.pkID = proyecto.fkID_fase

            				LEFT JOIN linea_investigacion ON linea_investigacion.pkID = proyecto.fkID_linea_investigacion
            				
                            INNER JOIN tipo_proyecto ON tipo_proyecto.pkID = proyecto.fkID_tipo_proyecto

            				INNER JOIN estado_proyecto ON estado_proyecto.pkID = proyecto.fkID_estado_proyecto

                            LEFT JOIN usuarios ON usuarios.pkID = proyecto.fkID_asesor

							WHERE proyecto.pkID = ".$pkID;

	      return $this->EjecutarConsulta($query);
	  }

    public function getProyectoGrupo($pkID_grupo){        
       
        $query = "select proyecto.*, linea_investigacion.nombre as linea_inv, 
                                tipo_proyecto.nombre as tipo_p, estado_proyecto.nombre as estado_p 

                    FROM `proyecto`

                    LEFT JOIN linea_investigacion ON linea_investigacion.pkID = proyecto.fkID_linea_investigacion
                    
                    INNER JOIN tipo_proyecto ON tipo_proyecto.pkID = proyecto.fkID_tipo_proyecto

                    INNER JOIN estado_proyecto ON estado_proyecto.pkID = proyecto.fkID_estado_proyecto

                    LEFT JOIN grupo ON grupo.pkID = proyecto.fkID_grupo 

                    WHERE proyecto.fkID_grupo = ".$pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getAsesor(){        
       
        $query = "select usuarios.pkID as pkIDA, usuarios.nombre as nombreA, usuarios.apellido as apellidoA, tipo_usuario.nombre

                  FROM usuarios
                  
                  INNER JOIN tipo_usuario ON tipo_usuario.pkID = usuarios.fkID_tipo

                  INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_usuario = usuarios.pkID
                  
                  WHERE usuarios.fkID_tipo = 11 AND usuario_proyectoM.fkID_proyectoM =".$this->getcpm();

        return $this->EjecutarConsulta($query);
    }


    public function getLineaI(){        
       
      		$query = "select * FROM `linea_investigacion`";

      		return $this->EjecutarConsulta($query);
    }

    public function getTipoP(){        
       
      		$query = "select * FROM `tipo_proyecto`";

      		return $this->EjecutarConsulta($query);
    }

    public function getEstadoP(){        
       
      		$query = "select * FROM `estado_proyecto`";

      		return $this->EjecutarConsulta($query);
    }

    public function getFase(){        
       
            $query = "select * FROM `fase`";

            return $this->EjecutarConsulta($query);
    }


	}
?>
