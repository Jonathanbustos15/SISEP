<?php
/**/
	include_once 'docentesDAO.php';
		
	class estudiantesDAO extends docentesDAO {
		
		//use GenericoDAO;
		
		//public $q_general;
		
		
		//Funciones------------------------------------------
		//public function getcpm(){

            //return $this->getCookieProyectoM();
    	//}


		public function getEstudiantes(){        
       
	      $query = "select * from usuarios 

	      INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_usuario = usuarios.pkID 

	      WHERE fkID_tipo = 9 AND usuario_proyectoM.fkID_proyectoM = ".$this->getcpm();

	      return $this->EjecutarConsulta($query);
	    }

	    public function getRolEstudiante(){        
       
	      $query = "select usuarios.pkID as pkID_estudiante, usuarios.fkID_rol as pkID_rol, rol.nombre as rol from usuarios

					INNER JOIN rol ON rol.pkID = usuarios.fkID_rol

					LEFT JOIN usuario_grupo ON usuario_grupo.fkID_usuario = usuarios.pkID

					WHERE usuarios.fkID_tipo = 9 ";

	      return $this->EjecutarConsulta($query);
	    }
		
	    public function getRoles($pkID_tipo){        
       
	      $query = "select * FROM `rol` WHERE fkID_tipo_usuario = ".$pkID_tipo." ORDER BY nombre ASC";

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
