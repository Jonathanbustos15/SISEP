<?php
/**/
	include_once 'genericoDAO.php';
		
	class asesoriaDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getcpm(){

            return $this->getCookieProyectoM();
    	}

		
		public function getAsesorias(){        
       
      		$query = "select asesoria.* FROM `asesoria`
      		
      				 INNER JOIN proyecto ON proyecto.pkID = asesoria.fkID_proyecto";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getAsesoriasProyecto($pkIDProyecto){        
       
      		$query = "select asesoria.*, fase.nombre as fase FROM `asesoria`
      				 
      				 INNER JOIN proyecto ON proyecto.pkID = asesoria.fkID_proyecto

               INNER JOIN fase ON fase.pkID = asesoria.fkID_fase

      				 WHERE fkID_proyecto = ".$pkIDProyecto;

      		return $this->EjecutarConsulta($query);
    	}

    	public function getFase(){        
       
            $query = "select * FROM `fase`";

            return $this->EjecutarConsulta($query);
    }

		
	}
?>
