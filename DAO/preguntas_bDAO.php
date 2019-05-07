<?php
/**/
	include_once 'genericoDAO.php';
		
	class preguntas_bDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getPreguntasBitacora(){        
       
	    	 $query = "select bitacora.nombre as nom_bitacora, preguntas_b.pregunta as pregunta 

	    	 		  FROM `bitacora` 

	      			  INNER JOIN preguntas_b ON preguntas_b.fkID_bitacora = bitacora.pkID";

		
	      return $this->EjecutarConsulta($query);
	    }

		
		public function getBitacoraIdPregunta($pkID){        
       
	    	 $query = "select bitacora.nombre as nom_bitacora, preguntas_b.pkID,preguntas_b.pregunta as pregunta, tipo_usuario.nombre as nom_tipo_usuario, estado_pregunta_bitacora.nombre as estado

		    	 		  FROM `bitacora` 

		      			  INNER JOIN preguntas_b ON preguntas_b.fkID_bitacora = bitacora.pkID
                          
                          INNER JOIN tipo_usuario ON tipo_usuario.pkID = preguntas_b.fkID_tipo_usuario

                          INNER JOIN estado_pregunta_bitacora ON estado_pregunta_bitacora.pkID = preguntas_b.fkID_estado

	    				  WHERE bitacora.pkID = ".$pkID;

			//echo $query;

	      return $this->EjecutarConsulta($query);
	    }

	    public function getEstadoPreguntaB(){

	    	$query = "select estado_pregunta_bitacora.* FROM estado_pregunta_bitacora";

	    	return $this->EjecutarConsulta($query);
	    }
		
	}
?>
