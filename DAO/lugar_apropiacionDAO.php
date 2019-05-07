<?php
/**/
	include_once 'genericoDAO.php';
		
	class lugar_apropiacionDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getLugarA(){        
       
      		$query = "select * FROM `lugar_apropiacion`";

      		return $this->EjecutarConsulta($query);
    	}

		
	}
?>
