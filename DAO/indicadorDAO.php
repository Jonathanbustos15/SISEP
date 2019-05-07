<?php
/**/

	//ini_set('error_reporting', E_ALL|E_STRICT);
	//ini_set('display_errors', 1);

	include_once 'genericoDAO.php';
		
	class indicadorDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.

		public function getcpm(){

            return $this->getCookieProyectoM();
    	}

		public function getIndicadores(){        
       
      		$query = "select indicador.*, tipo_indicador.nombre as tipo FROM `indicador`

      				  INNER JOIN proyecto_marco ON proyecto_marco.pkID = fkID_proyectoM

      				  INNER JOIN tipo_indicador ON tipo_indicador.pkID = fkID_tipoI

      				  WHERE indicador.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}

    	public function getIndicadorId($pkID){

            $query = "select indicador.* FROM indicador

					  WHERE indicador.pkID = ".$pkID;

	      return $this->EjecutarConsulta($query);
	 	}

	 	public function getTipoIndicador(){

	 		$query = "select * FROM `tipo_indicador`";

	 		return $this->EjecutarConsulta($query);

	 	}

	 	public function getMetas(){

	            $this->q_general = "select meta.* FROM meta

	            					INNER JOIN meta_valor ON meta_valor.fkID_meta = meta.pkID 

	            					INNER JOIN valores_meta ON valores_meta.pkID = meta_valor.fkID_valor_meta";        

	            return $this->EjecutarConsulta($this->q_general);
	    }

	 	public function getMetasIndicador($pkID){

			$query = "select meta.* FROM meta 

					  INNER JOIN indicador ON indicador.fkID_meta = meta.pkID

					  WHERE indicador.pkID = ".$pkID;

			return $this->EjecutarConsulta($query);			  
		}


		public function getNumMetasIndicador($pkID_meta){

			$query = "select COUNT(valores_meta.valor) as numVal

					  FROM meta

					  LEFT JOIN meta_valor ON meta_valor.fkID_meta = meta.pkID
					  
					  LEFT JOIN valores_meta ON valores_meta.pkID = meta_valor.fkID_valor_meta

					  WHERE meta.pkID = ".$pkID_meta;

			return $this->EjecutarConsulta($query);			  
		}

		
		public function getValoresMetaIndicador($pkID_indicador){

			$query = "select indicador.nombre as indicador, indicador.descripcion as desInd, indicador.script as scriptI ,meta.nombre as meta, meta.total as total, valores_meta.nombre 

					  as nombre_valor_meta, valores_meta.valor as valor, valores_meta.pkID as pkID_vm, valores_meta.fecha_ini as fecha_ini, valores_meta.fecha_fin as fecha_fin, valores_meta.script as scriptM

					  FROM indicador
					  
					  INNER JOIN meta ON meta.pkID = indicador.fkID_meta
					  
					  LEFT JOIN meta_valor ON meta_valor.fkID_meta = meta.pkID

					  LEFT JOIN valores_meta ON valores_meta.pkID = meta_valor.fkID_valor_meta

					  WHERE indicador.pkID = ".$pkID_indicador;

			return $this->EjecutarConsulta($query);		  
		}


		public function getTotalValoresMeta($pkID_meta){

			$query = "select SUM(valores_meta.valor) as totalM, meta.total as total

					  FROM meta

					  INNER JOIN meta_valor ON meta_valor.fkID_meta = meta.pkID

					  INNER JOIN valores_meta ON valores_meta.pkID = meta_valor.fkID_valor_meta

                      WHERE meta.pkID = ".$pkID_meta;

            return $this->EjecutarConsulta($query);          

        }


	 	public function getConsultas($query){

	 		return $this->EjecutarConsulta($query);

	 	}	

		
	}
?>
						