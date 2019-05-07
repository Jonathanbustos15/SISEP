<?php
/**/
	include_once 'genericoDAO.php';
		
	class curso_formacionDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getcpm(){

            return $this->getCookieProyectoM();
    	}

		public function getCursos(){        
       
      		$query = "select distinct curso_formacion.* 

					  FROM `curso_formacion` 

					  INNER JOIN cursosF_proyectoM ON cursosF_proyectoM.fkID_cursosF = curso_formacion.pkID

					  WHERE cursosF_proyectoM.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}
		
	}
?>
