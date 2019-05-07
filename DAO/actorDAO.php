<?php
/**/
	include_once 'genericoDAO.php';
		
	class actorDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
    public function getcpm(){

            return $this->getCookieProyectoM();
    }
		
		public function getActores(){        
       
      		$query = "select actor.*, tipo_actor.nombre as nom_tipo 

                    FROM `actor`
      	 			  
                    INNER JOIN tipo_actor ON tipo_actor.pkID = actor.fkID_tipo

                    INNER JOIN proyecto_marco ON proyecto_marco.pkID = actor.fkID_proyectoM

                    WHERE actor.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}

    	public function getTipoActor(){        
       
      		$query = "select * FROM `tipo_actor`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getTipoVinculacion(){        
       
      		$query = "select * FROM `tipo_vinculacion`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getDepartamentos(){        
       
      		$query = "select * FROM `departamento`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getMunicipios(){        
       
      		$query = "select * FROM `municipio`";

      		return $this->EjecutarConsulta($query);
    	}
		
	}
?>
