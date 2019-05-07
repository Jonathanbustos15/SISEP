<?php
/**/
	include_once 'genericoDAO.php';
		
	class institucionDAO {
		
		use GenericoDAO;
		
		public $q_general;

    public function getcpm(){

            return $this->getCookieProyectoM();
    }

		public function getInstituciones(){

            $this->q_general = "select  institucion.pkID, institucion.nombre, institucion.codigo_dane,COUNT(sede.pkID) as num_sedes
        

                                FROM `institucion`

                                INNER JOIN institucion_proyectoM ON institucion.pkID = institucion_proyectoM.fkID_institucion

                                LEFT JOIN sede ON sede.fkID_institucion = institucion.pkID 

                                WHERE institucion_proyectoM.fkID_proyectoM = ".$this->getcpm()."
                                
                                GROUP BY institucion.pkID, institucion.nombre, institucion.codigo_dane";                                                

         return $this->EjecutarConsulta($this->q_general);
    }


    public function getNumeroSedesInstitucion(){

      $query = "select count(sede.pkID) FROM sede 

                INNER JOIN institucion ON institucion.pkID = sede.fkID_institucion";

      return $this->EjecutarConsulta($query);          


    }

    public function getInstitucionId($pkID){        
       
          $query = "select institucion.*

                    FROM institucion 
          
                    WHERE institucion.pkID = ".$pkID;

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

    	public function getMunicipiosDepartamento($depar){

    		$query = "select municipio.* FROM `municipio`
	                  INNER JOIN departamento ON departamento.pkID=municipio.fkID_departamento
                      WHERE municipio.fkID_departamento=".$depar;

            return $this->EjecutarConsulta($query);
        }              

    	public function getZonas(){        
       
      		$query = "select * FROM `zona`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getTipoS(){        
       
      		$query = "select * FROM `tipo`";

      		return $this->EjecutarConsulta($query);
    	}

    	public function getSedes(){        
       
      		$query = "select * 

          FROM sede 

          INNER JOIN institucion_proyectoM ON sede.fkID_institucion = institucion_proyectoM.fkID_institucion

          WHERE institucion_proyectoM.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}
		
	}
?>
