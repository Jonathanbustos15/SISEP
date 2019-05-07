<?php
/**/
	include_once 'genericoDAO.php';
		
	class pruebaDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.

		public function getcpm(){

            return $this->getCookieProyectoM();
    	}

		public function getTipo_p(){

            $this->q_general = "select * FROM `tipo_pregunta_p`";        

            return $this->EjecutarConsulta($this->q_general);
        }


		public function getPrueba(){

            $this->q_general = "select prueba.*,tipo_prueba.nombre as tipo 

								FROM `prueba`

								INNER JOIN tipo_prueba ON tipo_prueba.pkID = prueba.fkID_tipo_prueba

            					WHERE prueba.fkID_proyectoM = ".$this->getcpm();        

            return $this->EjecutarConsulta($this->q_general);
        }

        public function getTipoPrueba(){

            $this->q_general = "select * FROM `tipo_prueba`";        

            return $this->EjecutarConsulta($this->q_general);
        }

        public function getPruebaId($pkID){        
       
	      $query = "select prueba.*, tipo_prueba.nombre as tipo_p, tipo_prueba.pkID as pkID_tipo_p    

					from `prueba`

                    
                    INNER JOIN tipo_prueba ON tipo_prueba.pkID = prueba.fkID_tipo_prueba

					WHERE prueba.pkID = ".$pkID;

	      return $this->EjecutarConsulta($query);
	    }


	    public function getPruebaIdPregunta($pkID,$fkID_tipo_usuario){        
       
	    	$query = "select prueba.nombre as nom_prueba,pregunta_p.*, pregunta_p.pkID, pregunta_p.pregunta as pregunta, tipo_pregunta_p.nombre as 				

	      		    tipo_de_pregunta 

	      		    from `prueba` 

	      			INNER JOIN pregunta_p ON pregunta_p.fkID_prueba = prueba.pkID 

	      			INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p 

					WHERE prueba.pkID = ".$pkID;

					//el admin puede ver todo					
					$query = $fkID_tipo_usuario != "1" ? $query." AND pregunta_p.fkID_tipo_usuario = ".$fkID_tipo_usuario : $query;					
					
		
	    	return $this->EjecutarConsulta($query);
	    }


	    public function getPruebaIdPreguntaCrud($pkID){        
       
	    	$query = "select prueba.nombre as nom_prueba,pregunta_p.*, pregunta_p.pkID, pregunta_p.pregunta as pregunta, tipo_pregunta_p.nombre as 				

	      		    tipo_de_pregunta 

	      		    from `prueba` 

	      			INNER JOIN pregunta_p ON pregunta_p.fkID_prueba = prueba.pkID 

	      			INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p 

					WHERE prueba.pkID = ".$pkID;

		
	    	return $this->EjecutarConsulta($query);
	    }   


	    public function getRespuestaId($fkID_pregunta, $fkID_usuario){
	    
        	$query = "select respuesta_p.*,pregunta_p.pregunta

					  from `respuesta_p`

					  INNER JOIN pregunta_p on pregunta_p.pkID = respuesta_p.fkID_pregunta_p

					  WHERE respuesta_p.fkID_pregunta_p = ".$fkID_pregunta." AND respuesta_p.fkID_usuario = ".$fkID_usuario;					  

	      	return $this->EjecutarConsulta($query);
		}

		/**/
		public function getRespuestasMult($fkID_pregunta, $fkID_usuario){
	    
        	$query = "select respuesta_p.*,banco_respuestas_p.respuestab,pregunta_p.pregunta 

						FROM `respuesta_p`

						INNER JOIN respuesta_p_banco ON respuesta_p_banco.fkID_respuesta_p = respuesta_p.pkID

						INNER JOIN banco_respuestas_p ON banco_respuestas_p.pkID = respuesta_p_banco.fkID_banco

						INNER JOIN pregunta_p ON respuesta_p.fkID_pregunta_p = pregunta_p.pkID

						WHERE respuesta_p.fkID_pregunta_p = ".$fkID_pregunta." AND respuesta_p.fkID_usuario = ".$fkID_usuario;					  

	      	return $this->EjecutarConsulta($query);
		}

		public function getUsuariosPrueba($pkID_prueba){
			/**/
				$query = " select DISTINCT usuarios.pkID as pkID_usuario ,usuarios.nombre, usuarios.apellido, usuarios.numero_documento

						FROM `respuesta_p` 

						INNER JOIN pregunta_p ON respuesta_p.fkID_pregunta_p = pregunta_p.pkID

						INNER JOIN prueba ON pregunta_p.fkID_prueba = prueba.pkID						

						INNER JOIN usuarios ON respuesta_p.fkID_usuario = usuarios.pkID

						WHERE prueba.pkID = ".$pkID_prueba;

				return $this->EjecutarConsulta($query);
			
		}



	   /* public function getPruebaIdPreguntaRespuestas($pkID_prueba){        
       
	    	 $query = "select pregunta_p.pkID as cod_pregunta, pregunta_p.pregunta as pregunta, pregunta_p.fkID_tipo_pregunta_p as tipo,
	    	 			
	    	 			(IF ((pregunta_p.fkID_tipo_pregunta_p = 2) || (pregunta_p.fkID_tipo_pregunta_p = 3),

	    	 			(select banco_respuestas_p.respuestab

   						FROM `pregunta_p`

   						INNER JOIN banco_respuestas_p ON banco_respuestas_p.fkID_pregunta_p = pregunta_p.pkID

   						INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba

   						INNER JOIN respuesta_p ON respuesta_p.fkID_banco_rta_p = banco_respuestas_p.pkID

   						WHERE prueba.pkID = ".$pkID_prueba."), respuesta_p.respuesta)) as rta 

						FROM `respuesta_p`

						INNER JOIN pregunta_p ON pregunta_p.pkID = respuesta_p.fkID_pregunta_p

						INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba WHERE prueba.pkID = ".$pkID_prueba;*/

/*

						-----------------CORREGIR CONSULTA FALTA QUE SALGAN LAS RESPUESTAS

						select pregunta_p.pkID as cod_pregunta, pregunta_p.pregunta as pregunta, pregunta_p.fkID_tipo_pregunta_p as tipo,
	    	 			
	    	 			(IF ((pregunta_p.fkID_tipo_pregunta_p = 1) || (pregunta_p.fkID_tipo_pregunta_p = 3),

	    	 			(select banco_respuestas_p.respuestab

   						FROM `pregunta_p`

   						INNER JOIN banco_respuestas_p ON banco_respuestas_p.fkID_pregunta_p = pregunta_p.pkID

   						INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba

   						INNER JOIN respuesta_p ON respuesta_p.fkID_banco_rta_p = banco_respuestas_p.pkID                     
                        

   						WHERE prueba.pkID = 2), null)) as rta 

						FROM `pregunta_p`

						INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba WHERE prueba.pkID = 1





						---------------------------------

						select DISTINCT prueba.pkID, pregunta_p.pkID as cod_pregunta, pregunta_p.pregunta as pregunta, pregunta_p.fkID_tipo_pregunta_p as tipo,
	    	 			
	    	 			(IF ((pregunta_p.fkID_tipo_pregunta_p = 2) || (pregunta_p.fkID_tipo_pregunta_p = 3),

	    	 			(select DISTINCT banco_respuestas_p.respuestab

   						FROM `respuesta_p`

   						INNER JOIN banco_respuestas_p ON banco_respuestas_p.pkID = respuesta_p.fkID_banco_rta_p                                                                                                                                                                      
 						INNER JOIN pregunta_p ON (pregunta_p.pkID = respuesta_p.fkID_pregunta_p) || (pregunta_p.pkID <> respuesta_p.fkID_pregunta_p                        )  
                        INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba 
                         
                        INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p 
                                                 
   						WHERE prueba.pkID = 2), respuesta_p.respuesta)) as rta 

						FROM `pregunta_p`

						INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba 
                        
                        INNER JOIN respuesta_p ON (respuesta_p.fkID_pregunta_p = pregunta_p.pkID) || (respuesta_p.fkID_pregunta_p <> pregunta_p.pkID)
                        
                        INNER JOIN banco_respuestas_p ON (banco_respuestas_p.fkID_pregunta_p = pregunta_p.pkID) || (banco_respuestas_p.fkID_pregunta_p <> pregunta_p.pkID)
                        
                        INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p 
                        WHERE prueba.pkID = 1
                        GROUP BY pregunta_p.pkID



                        --------


                        select DISTINCT prueba.pkID, pregunta_p.pkID as cod_pregunta, pregunta_p.pregunta as pregunta, pregunta_p.fkID_tipo_pregunta_p as tipo,
	    	 			
	    	 			(IF ((pregunta_p.fkID_tipo_pregunta_p = 2) || (pregunta_p.fkID_tipo_pregunta_p = 3),

	    	 			(select DISTINCT banco_respuestas_p.respuestab

   						FROM `respuesta_p`

   						INNER JOIN banco_respuestas_p ON banco_respuestas_p.pkID = respuesta_p.fkID_banco_rta_p                                                                                                                                                                      
 						INNER JOIN pregunta_p ON ((pregunta_p.pkID = respuesta_p.fkID_pregunta_p) || (pregunta_p.pkID <> respuesta_p.fkID_pregunta_p                        ))  
                        INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba 
                         
                        INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p 
                                                 
   						WHERE prueba.pkID = 2), (select DISTINCT respuesta_p.respuesta FROM respuesta_p INNER JOIN pregunta_p ON pregunta_p.pkID = respuesta_p.fkID_pregunta_p WHERE pregunta_p.fkID_prueba = 1 AND pregunta_p.fkID_tipo_pregunta_p =1 ))) as rta 

						FROM `pregunta_p`

						INNER JOIN prueba ON prueba.pkID = pregunta_p.fkID_prueba 
                        
                        INNER JOIN respuesta_p ON ((respuesta_p.fkID_pregunta_p = pregunta_p.pkID) || (respuesta_p.fkID_pregunta_p <> pregunta_p.pkID))
                        
                        INNER JOIN banco_respuestas_p ON ((banco_respuestas_p.fkID_pregunta_p = pregunta_p.pkID) || (banco_respuestas_p.fkID_pregunta_p <> pregunta_p.pkID))
                        
                        INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p 
                        WHERE prueba.pkID = 1
                        GROUP BY pregunta_p.pkID

                        ||(pregunta_p.pkID <> respuesta_p.fkID_pregunta_p)
	      		
*/		
	    /*  return $this->EjecutarConsulta($query);
	    }



	*/	
	}
?>


<!--UPDATE `respuesta_p` SET `fkID_pregunta_p` = '2' WHERE `respuesta_p`.`pkID` = 1;


UPDATE `respuesta_p` SET `respuesta` = 'Si, gracias a que los docentes estan muy bien capacitados' WHERE `respuesta_p`.`pkID` = 1;-->


<!--
select DISTINCT (IF ((pregunta_p.fkID_tipo_pregunta_p = 1) || (pregunta_p.fkID_tipo_pregunta_p = 3), banco_respuestas_p.respuestab, respuesta_p.respuesta)) as rtas
FROM `respuesta_p`
INNER JOIN pregunta_p ON (pregunta_p.pkID = respuesta_p.fkID_pregunta_p)||(pregunta_p.pkID <> respuesta_p.fkID_pregunta_p)
INNER JOIN banco_respuestas_p ON (banco_respuestas_p.pkID = respuesta_p.fkID_banco_rta_p)||(banco_respuestas_p.pkID = respuesta_p.fkID_banco_rta_p)                
WHERE respuesta_p.fkID_pregunta_p = 1-->