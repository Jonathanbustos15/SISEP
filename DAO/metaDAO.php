<?php
/**/
	include_once 'genericoDAO.php';
		
	class metaDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getMetas(){

	            $this->q_general = "select meta.* FROM meta

	            					INNER JOIN meta_valor ON meta_valor.fkID_meta = meta.pkID 

	            					INNER JOIN valores_meta ON valores_meta.pkID = meta_valor.fkID_valor_meta";        

	            return $this->EjecutarConsulta($this->q_general);
	    }


	    public function getMetaId($pkID){        
	       
		      $query = "select meta.* FROM meta

		      			INNER JOIN meta_valor ON meta_valor.fkID_meta = meta.pkID 

	            		INNER JOIN valores_meta ON valores_meta.pkID = meta_valor.fkID_valor_meta

		    		    WHERE meta.pkID = ".$pkID;

		      return $this->EjecutarConsulta($query);
		}


		
		
	}
?>
