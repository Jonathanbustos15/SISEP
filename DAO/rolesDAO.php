<?php
	/*Clase hija de usuarios*/
	include_once 'usuariosDAO.php';
		
	class RolesDAO extends UsuariosDAO {
		
		public $q_general;
		

		public function getRoles(){

			$this->q_general = "select permisos.*,tipo_usuario.nombre as nom_tUsuario, modulos.Nombre as nom_modulo 

								FROM `permisos`

								INNER JOIN tipo_usuario ON tipo_usuario.pkID = permisos.fkID_tipo_usuario

								INNER JOIN modulos ON modulos.pkID = permisos.fkID_modulo

								ORDER BY tipo_usuario.nombre";		
			
			return $this->EjecutarConsulta($this->q_general);
		}

		public function getModulos(){

			$this->q_general = "select * FROM `modulos`";		
			
			return $this->EjecutarConsulta($this->q_general);
		}
	}

?>
