<?php
/**/
	include_once 'genericoDAO.php';
		
	class bitacoraDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getcpm(){

            return $this->getCookieProyectoM();
    	}


		public function getBitacoras(){

	            $this->q_general = "select bitacora.*,fase.nombre as fase FROM bitacora

	            					INNER JOIN fase ON fase.pkID = bitacora.fkID_fase

	            					INNER JOIN proyecto_marco ON proyecto_marco.pkID = bitacora.fkID_proyectoM

	            					WHERE bitacora.fkID_proyectoM = ".$this->getcpm();        

	            return $this->EjecutarConsulta($this->q_general);
	    }

	    public function getBitacoraId($pkID){        
	       
		      $query = "select bitacora.*, fase.nombre as nom_fase FROM bitacora

	            		INNER JOIN fase ON fase.pkID = bitacora.fkID_fase

		    		    WHERE bitacora.pkID = ".$pkID;

		      return $this->EjecutarConsulta($query);
		}

		public function getFase(){        
	       
	      		$query = "select * FROM `fase`";

	      		return $this->EjecutarConsulta($query);
	    }

	    public function getBitacoraIdPregunta($pkID,$fkID_tipo_usuario){        
	       
		    	 $query = "select bitacora.nombre as nom_bitacora, preguntas_b.pkID,preguntas_b.pregunta as pregunta, tipo_usuario.nombre as nom_tipo_usuario 

		    	 		  FROM `bitacora` 

		      			  INNER JOIN preguntas_b ON preguntas_b.fkID_bitacora = bitacora.pkID
                          
                          INNER JOIN tipo_usuario ON tipo_usuario.pkID = preguntas_b.fkID_tipo_usuario



                          INNER JOIN estado_pregunta_bitacora ON estado_pregunta_bitacora.pkID = preguntas_b.fkID_estado

	    				  WHERE preguntas_b.fkID_estado = 1 AND bitacora.pkID = ".$pkID;

	    		$query = $fkID_tipo_usuario != "1" ? $query." AND preguntas_b.fkID_tipo_usuario = ".$fkID_tipo_usuario : $query;	    		
			
		      return $this->EjecutarConsulta($query);
		}

		public function getGrupoEvento($fkID_grupo){

			$query = "select grupo_evento.*, nombre_apropiacionS.nombre as nom_evento

					  FROM `grupo_evento`

					  INNER JOIN apropiacion_social ON grupo_evento.fkID_evento = apropiacion_social.pkID
                      
                      INNER JOIN nombre_apropiacionS ON apropiacion_social.fkID_nombre = nombre_apropiacionS.pkID

					  WHERE grupo_evento.fkID_grupo = ".$fkID_grupo;

      		return $this->EjecutarConsulta($query);
		}

		public function getBitacoraIdFase($fkID_fase){        
	       
		    	 $query = "select DISTINCT bitacora.*,fase.nombre as fase 

		    	 		   FROM fase 
						   
						   INNER JOIN bitacora ON bitacora.fkID_fase = fase.pkID 
						   
						   INNER JOIN proyecto ON proyecto.fkID_fase = fase.pkID

						   INNER JOIN proyecto_marco ON proyecto_marco.pkID = bitacora.fkID_proyectoM

	    				   WHERE proyecto.fkID_fase = ".$fkID_fase." AND bitacora.fkID_proyectoM = ".$this->getcpm();

			
		      return $this->EjecutarConsulta($query);
		}

		public function getProyectoFase($pkID){        
	       
	    	 $query = "select proyecto.fkID_fase as fase, fase.nombre as nom_fase

	    	 		   FROM proyecto 
					   
					   INNER JOIN fase ON fase.pkID = proyecto.fkID_fase 

					   WHERE proyecto.pkID = ".$pkID;

		
	      return $this->EjecutarConsulta($query);
	    }

		public function getRespuestaId($fkID_pregunta,$fkID_grupo){

			$query = "select * FROM `respuestas_b` WHERE fkID_pregunta = ".$fkID_pregunta." AND fkID_grupo = ".$fkID_grupo;
		
	      	return $this->EjecutarConsulta($query);
		}


		public function getNumBitacorasProyectoM($proyectoM){

			$query = "select COUNT(bitacora.pkID) as numBPM

					  FROM `bitacora` 

					  INNER JOIN proyecto_marco ON proyecto_marco.pkID = bitacora.fkID_proyectoM 

					  WHERE bitacora.fkID_proyectoM = ".$proyectoM;

			return $this->EjecutarConsulta($query);		  
		}
	}
?>
