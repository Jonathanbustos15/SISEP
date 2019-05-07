<?php
	/**/
	include_once '../DAO/rolesDAO.php';
	include_once 'helper_controller/render_table.php';
	
		
	class RolesController extends RolesDAO{
		
		public $permisosInst;
		public $roles;
		public $id_modulo;
		public $NameCookieApp;
		public $table_inst;
		
		//Funciones-------------------------------------------
		//Espacio para las funciones en general de esta clase.

		 public function __construct() {
    	
	    	include('../conexion/datos.php');
        
	        $this->id_modulo = 14;
	        $this->NameCookieApp = $NomCookiesApp;
	        //$this->permisosInst = new permisosController();
	    }

		public function getTablaRoles(){	    	

	    	$this->roles = $this->getRoles();
	    	
	    	//permisos-------------------------------------------------------------------------
    		$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
    		$edita = $arrPermisos[0]["editar"];
    		$elimina = $arrPermisos[0]["eliminar"];
    		$consulta = $arrPermisos[0]["consultar"];
    		//---------------------------------------------------------------------------------
    		//Define las variables de la tabla a renderizar

    		//Los campos que se van a ver, se renderizan en este orden
    		$roles_campos = [
    			["nombre"=>"nom_tUsuario"],
    			["nombre"=>"nom_modulo"],
    			["nombre"=>"crear"],
    			["nombre"=>"editar"],
    			["nombre"=>"eliminar"],
    			["nombre"=>"consultar"]
    		];
    		//la configuracion de los botones de opciones
    		$roles_btn =[

	    		 [
	    			"tipo"=>"editar",
	    			"nombre"=>"rol",
	    			"permiso"=>$edita,
	    		 ],
	    		 [
	    			"tipo"=>"eliminar",
	    			"nombre"=>"rol",
	    			"permiso"=>$elimina,
	    		 ]

	    	];
	    	//--------------------------------------------------------------------------------- 

	    	if( ($this->roles) && ($consulta==1) ){

	    		//Instancia el render
	    		$this->table_inst = new RenderTable($this->roles,$roles_campos,$roles_btn,[]);

	    		$this->table_inst->render();

	    	}elseif(($this->roles) && ($consulta==0)){
	    	 
	    	 $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta para Roles.</h3>";
            }else{
             
             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay Roles creados.</h3>";
            };

	    }

	    public function getSelectTipoUsuario(){

			$TipoUsuarioSelect = $this->getTipoUsuarios();

			echo '<select name="fkID_tipo_usuario" id="fkID_tipo_usuario" class="form-control add-selectElement" required = "true">
                        <option></option>';
                        for ($i=0; $i < sizeof($TipoUsuarioSelect); $i++) {
                                echo '<option value="'.$TipoUsuarioSelect[$i]["pkID"].'" >'.$TipoUsuarioSelect[$i]["nombre"].'</option>';
                            };
            echo '</select>';
		}

		public function getSelectModulos(){

			$ModulosSelect = $this->getModulos();

			echo '<select name="fkID_modulo" id="fkID_modulo" class="form-control add-selectElement" required = "true">
                        <option></option>';
                        for ($i=0; $i < sizeof($ModulosSelect); $i++) {
                                echo '<option value="'.$ModulosSelect[$i]["pkID"].'" >'.$ModulosSelect[$i]["Nombre"].'</option>';
                            };
            echo '</select>';
		}
	}
?>