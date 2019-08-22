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
		
		public function getActores($pkID_proyectoM,$filtro,$filtro2){

          if ($filtro == "Todos") {
            $where_anio = "!= 0";
        } else {
            $where_anio = "=" . $filtro;
        }     

        if ($filtro2 == "Todos") {
            $where_tipo = "!='0'";
        } else { 
            $where_tipo = "= '$filtro2'";
        }   
       
      		$query = "select actor.*, tipo_actor.nombre as nom_tipo, concat_ws(' ',actor.nombre_contacto,apellido_contacto) as nombres  FROM `actor`
                  INNER JOIN tipo_actor ON tipo_actor.pkID = actor.fkID_tipo
                  where estadoV=1 and fkID_proyectoM=".$pkID_proyectoM." and year(fecha_socializacion)".$where_anio."  and tipo_actor.nombre".$where_tipo;

      		return $this->EjecutarConsulta($query);
    	}

    	public function getTipoActor(){        
       
      		$query = "select * FROM `tipo_actor`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getAnio(){        
       
	      $query = "select * FROM anio";

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
