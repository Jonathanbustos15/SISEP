<?php
/**/
	include_once 'genericoDAO.php';
		
	class apropiacion_socialDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.

    public function getcpm(){

            return $this->getCookieProyectoM();
    }

		public function getApropiacionS(){       
       
      		$query = "select apropiacion_social.*,nombre_apropiacionS.nombre as nombre, lugar_apropiacion.nombre as nom_lugar, 		
      				  tipo_apropiacion_social.nombre as nom_tipo, tematica.nombre as nom_tematica 
      				  
                FROM `apropiacion_social`
      				  
                INNER JOIN tematica ON tematica.pkID = apropiacion_social.fkID_tematica

                INNER JOIN nombre_apropiacionS ON nombre_apropiacionS.pkID = apropiacion_social.fkID_nombre
      				  
                INNER JOIN tipo_apropiacion_social ON tipo_apropiacion_social.pkID = apropiacion_social.fkID_tipo
      				  
                INNER JOIN lugar_apropiacion ON lugar_apropiacion.pkID = apropiacion_social.fkID_lugar WHERE apropiacion_social.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}


      public function getAproS($pkID){        
       
          $query = "select apropiacion_social.*, nombre_apropiacionS.nombre as nombre, lugar_apropiacion.nombre as nom_lugar, 

                    tipo_apropiacion_social.nombre as nom_tipo, tematica.nombre as nom_tematica 

                    FROM `apropiacion_social` 

                    INNER JOIN tematica ON tematica.pkID = apropiacion_social.fkID_tematica 

                    INNER JOIN nombre_apropiacionS ON nombre_apropiacionS.pkID = apropiacion_social.fkID_nombre 

                    INNER JOIN tipo_apropiacion_social ON tipo_apropiacion_social.pkID = apropiacion_social.fkID_tipo 

                    INNER JOIN lugar_apropiacion ON lugar_apropiacion.pkID = apropiacion_social.fkID_lugar 

                    WHERE apropiacion_social.pkID = ".$pkID;

          return $this->EjecutarConsulta($query);
      }


    	public function getApropiacionSocial(){        
       
      		$query = "select * FROM `apropiacion_social`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getTipoA(){        
       
      		$query = "select * FROM `tipo_apropiacion_social`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getTematicas(){        
       
      		$query = "select tematica.* FROM `tematica` WHERE tematica.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}

      public function getNombresApropiacionS(){        
       
          $query = "select * FROM `nombre_apropiacionS`";

          return $this->EjecutarConsulta($query);
      }

    	public function getLugarA(){        
       
      		$query = "select *,MAX(pkID) FROM `lugar_apropiacion`";

      		return $this->EjecutarConsulta($query);
    	}

      public function getCoordinador(){        
       
        $query = "select usuarios.pkID as pkIDA, usuarios.nombre as nombreA, usuarios.apellido as apellidoA, tipo_usuario.nombre FROM usuarios

                  INNER JOIN tipo_usuario ON tipo_usuario.pkID = usuarios.fkID_tipo

                  INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_usuario = usuarios.pkID

                  WHERE usuarios.fkID_tipo = 10 AND usuario_proyectoM.fkID_proyectoM = ".$this->getcpm();

        return $this->EjecutarConsulta($query);
    }



		
	}
?>



                    