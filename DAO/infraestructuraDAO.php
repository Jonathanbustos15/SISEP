<?php

	include_once 'genericoDAO.php';
		
	class infraestructuraDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.

		public function getcpm(){

            return $this->getCookieProyectoM();
        }

		public function getInfraestructuras(){        
       
      		$query = "select infraestructura.*, sede.nombre as sede FROM `infraestructura`

      				 INNER JOIN sede ON sede.pkID = infraestructura.fkID_sede

      				 WHERE fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}

    	public function getInfraestructuraId($pkID){

            $query = "select infraestructura.* FROM infraestructura

					  WHERE infraestructura.pkID = ".$pkID;

	      return $this->EjecutarConsulta($query);
	  }

	  public function getSede(){        
       
      		$query = "select sede.* 

			          FROM sede 

			          INNER JOIN institucion ON institucion.pkID = sede.fkID_institucion

			          INNER JOIN institucion_proyectoM ON institucion_proyectoM.fkID_institucion = sede.fkID_institucion 

			          WHERE institucion_proyectoM.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}
		
	}
?>
