<?php
/**/
	include_once 'genericoDAO.php';
		
	class respuestas_bDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getRespuestasB($fkID_pregunta){

            $this->q_general = "select respuestas_b.* 

            					FROM respuestas_b

            					INNER JOIN preguntas_b ON preguntas_b.pkID = respuestas_b.fkID_pregunta

            					WHERE fkID_pregunta = ".$fkID_pregunta;        

            return $this->EjecutarConsulta($this->q_general);
    	}
		
	}
?>
