<?php
/**/
	include_once 'genericoDAO.php';
		
	class sedeDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getcpm(){

            return $this->getCookieProyectoM();
    }
		
		
		public function getSedes(){

            $this->q_general = "select sede.*
                                
                                FROM sede"; 

            return $this->EjecutarConsulta($this->q_general);
    	}


    	public function getSedeInstitucionId($pkID_institucion){        
       
          $query = "select sede.*

                    FROM sede 
                               
                    INNER JOIN institucion ON institucion.pkID = sede.fkID_institucion
          
                    WHERE sede.fkID_institucion = ".$pkID_institucion;

          return $this->EjecutarConsulta($query);
      }
	}
?>
