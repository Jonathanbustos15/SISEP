<?php
/**/
	include_once 'genericoDAO.php';
		
	class valores_metaDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getValoresM(){        
       
      		$query = "select valores_meta.* FROM `valores_meta`

      				  INNER JOIN meta_valor ON meta_valor.fkID_valor_meta = valores_meta.pkID

      				  INNER JOIN meta ON meta.pkID = fkID_meta";

      		return $this->EjecutarConsulta($query);
    	}

		
	}
?>
