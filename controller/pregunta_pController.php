<?php
/**/
	include_once '../DAO/pregunta_pDAO.php';
		
	class pregunta_pController extends pregunta_pDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 51; //id de la tabla modulos
			$this->NameCookieApp = $NomCookiesApp;
			
		}
		
		
		//Funciones-------------------------------------------
		//Espacio para las funciones de esta clase.
		
		//permisos---------------------------------------------------------------------
		//$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
		//$edita = $arrPermisos[0]["editar"];
		//$elimina = $arrPermisos[0]["eliminar"];
		//$consulta = $arrPermisos[0]["consultar"];
		//-----------------------------------------------------------------------------
		
	}
?>
