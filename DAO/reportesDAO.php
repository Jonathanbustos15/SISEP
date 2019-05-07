<?php

include_once 'genericoDAO.php';


	class ReportesDAO {

	    use GenericoDAO;

	    public function getQuery($query){        
	       
	      //$query = "select * FROM `grado` WHERE pkID != 6";

	      return $this->EjecutarConsulta($query);
	    }

	    public function getPrueba($pkID_prueba){

			$query = "select prueba.*, tipo_prueba.nombre as nom_tipo_prueba 

						FROM `prueba`

						inner JOIN tipo_prueba ON tipo_prueba.pkID = prueba.fkID_tipo_prueba

						WHERE prueba.pkID = ".$pkID_prueba;

			$this->prueba = $this->getQuery($query);
		}

		public function getPreguntasPrueba($pkID_prueba){

			$query = "select pregunta_p.*, tipo_pregunta_p.nombre as 				

		      		    tipo_de_pregunta 

		      		    from `prueba` 

		      			INNER JOIN pregunta_p ON pregunta_p.fkID_prueba = prueba.pkID 

		      			INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p 

						WHERE prueba.pkID = ".$pkID_prueba;

			$this->preguntas = $this->getQuery($query);
		}

		public function getRespuestaPregunta($pkID_pregunta){

			$query = "select respuesta_p.*,pregunta_p.pregunta

					  from `respuesta_p`

					  INNER JOIN pregunta_p on pregunta_p.pkID = respuesta_p.fkID_pregunta_p

					  WHERE respuesta_p.fkID_pregunta_p = ".$pkID_pregunta;

		  	$this->respuesta = $this->getQuery($query);
		}

		//-----------------------------------------------------------------------------------------------------------

		public function getRespuestaPreguntaMult($pkID_pregunta,$pkID_usuario){

			$query = "select banco_respuestas_p.respuestab,banco_respuestas_p.correcta

						FROM `respuesta_p`

						INNER JOIN respuesta_p_banco ON respuesta_p_banco.fkID_respuesta_p = respuesta_p.pkID

						INNER JOIN banco_respuestas_p ON banco_respuestas_p.pkID = respuesta_p_banco.fkID_banco

						INNER JOIN pregunta_p ON respuesta_p.fkID_pregunta_p = pregunta_p.pkID

						WHERE respuesta_p.fkID_pregunta_p = ".$pkID_pregunta." AND respuesta_p.fkID_usuario = ".$pkID_usuario;

			$this->respuesta_mult = $this->getQuery($query);
		}

		public function getRespuestasPrueba($pkID_prueba,$pkID_usuario){

			$query = "select prueba.nombre as nom_prueba, tipo_prueba.nombre as nom_tipo_prueba, pregunta_p.pkID as pkID_pregunta, pregunta_p.pregunta, respuesta_p.respuesta, usuarios.pkID as pkID_usuario ,usuarios.nombre, usuarios.apellido

						FROM `respuesta_p` 

						INNER JOIN pregunta_p ON respuesta_p.fkID_pregunta_p = pregunta_p.pkID

						INNER JOIN prueba ON pregunta_p.fkID_prueba = prueba.pkID

						INNER JOIN tipo_prueba ON prueba.fkID_tipo_prueba = tipo_prueba.pkID

						INNER JOIN usuarios ON respuesta_p.fkID_usuario = usuarios.pkID

						WHERE prueba.pkID = ".$pkID_prueba;

			//AND usuarios.pkID = 50
			$query = $pkID_usuario != '' ? $query = $query." AND usuarios.pkID = ".$pkID_usuario : $query;

			$this->respuesta = $this->getQuery($query);
		}

		//-----------------------------------------------------------------------------------------------------------
		
	}

?>
