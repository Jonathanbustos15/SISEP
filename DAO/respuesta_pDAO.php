<?php
/**/
	include_once 'genericoDAO.php';
		
	class respuesta_pDAO {
		
		use GenericoDAO;
		
		public $q_general;

		public function getBancoRespuestasIdPregunta($pkID_pregunta){        
	       
		      $query = "select banco_respuestas_p.respuestab

						FROM banco_respuestas_p

						INNER JOIN pregunta_p ON pregunta_p.pkID = banco_respuestas_p.fkID_pregunta_p
						
						WHERE banco_respuestas_p.fkID_pregunta_p = ".$pkID_pregunta;

		      return $this->EjecutarConsulta($query);
		}
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		
	}
?>
