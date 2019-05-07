<?php
/**/
	include_once 'genericoDAO.php';
		
	class auditoriaDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta clase.
		public function getcpm(){

            return $this->getCookieProyectoM();
    }

		public function getAuditoria(){       
       
      		$query = "select auditoria.*, proyecto_marco.nombre as nom_proyectoM, CONCAT(usuarios.nombre, ' ' , usuarios.apellido) as usuario, modulos.Nombre as nom_modulo
      				  
                FROM `auditoria`

                INNER JOIN usuarios ON usuarios.pkID = auditoria.fkID_usuario
                
                INNER JOIN modulos ON auditoria.fkID_modulo = modulos.pkID

                INNER JOIN proyecto_marco ON proyecto_marco.pkID = auditoria.fkID_proyectoM
      				  
                WHERE auditoria.fkID_proyectoM = ".$this->getcpm()." ORDER BY pkID DESC";

      		return $this->EjecutarConsulta($query);
    	}


		
	}
?>
