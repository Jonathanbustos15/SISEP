<?php
/*
----------------------------------------------------------------------------------------
Parametros para que funcionen las cookies en un servidor
que no permita la creación de cookies, ya que el php.ini 
no permite estas directivas por seguridad.
----------------------------------------------------------------------------------------
ini_set("session.use_cookies", 0);
ini_set("session.use_only_cookies", 0);
ini_set("session.use_trans_sid", 1);
ini_set("session.cache_limiter", "");
session_start();
----------------------------------------------------------------------------------------
*/
//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

include_once '../DAO/usuariosDAO.php';
include_once 'helper_controller/render_table.php';


class UsuariosController extends UsuariosDAO {

    //ATRIBUTOS DE LA CLASE

    public $permisosInst;
    public $id_modulo;
    public $NameCookieApp;
    public $table_inst;
        
    //CONSTRUCTOR DE LA CLASE

    public function __construct() {
    	
    	include('../conexion/datos.php');    	

        //$this->permisosInst = new permisosController();
        $this->id_modulo = 13;
        $this->NameCookieApp = $NomCookiesApp;
    }

    //Funciones-----------------------------------------------------------------------    

    public function getSelectTipoUsuarios() {
        
        $tipo = $this->getTipoUsuarios();
        
        for($a=0;$a<sizeof($tipo);$a++){
        	echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
        }
    }


    //---------------------------------------------------------------------------------

    public function getSelectTipoUsuariosDI(){

    	$tipo = $this->getTipoUsuariosDI();

        for($a=0;$a<sizeof($tipo);$a++){
        	echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
        }
    }
    //---------------------------------------------------------------------------------
    public function getTablaUsuarios($tipo){    	

    	//permisos-------------------------------------------------------------------------
		$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
		$edita = $arrPermisos[0]["editar"];
		$elimina = $arrPermisos[0]["eliminar"];
		$consulta = $arrPermisos[0]["consultar"];
		//---------------------------------------------------------------------------------

		//Define las variables de la tabla a renderizar

    		//Los campos que se van a ver
    		$usuarios_campos = [    			
    			["nombre"=>"alias"],
    			["nombre"=>"nombre"],
    			["nombre"=>"apellido"],
    			["nombre"=>"nom_tipo"]
    		];
    		//la configuracion de los botones de opciones
    		$usuarios_btn =[

	    		 [
	    			"tipo"=>"editar",
	    			"nombre"=>"usuario",
	    			"permiso"=>$edita,
	    		 ],
	    		 [
	    			"tipo"=>"eliminar",
	    			"nombre"=>"usuario",
	    			"permiso"=>$elimina,
	    		 ]

	    	];	    	
	    //---------------------------------------------------------------------------------
	    //get de los usuarios segun sea el perfil
    	if ( $tipo == "Administrador") {    	
	    	$usuarios = $this->getUsuarios();
    	} else {    	
    		$usuarios = $this->getUsuarioId($_COOKIE[$this->NameCookieApp."_id"]);
    	}

    	//Instancia el render
    	$this->table_inst = new RenderTable($usuarios,$usuarios_campos,$usuarios_btn,[]);
		//---------------------------------------------------------------------------------     

    	//valida si hay usuarios
    	if( ($usuarios) && ($consulta==1) ){
    		
    		//ejecuta el render de la tabla
    		$this->table_inst->render();	    		

    	}elseif(($usuarios) && ($consulta==0)){

    	 $this->table_inst->render_blank();

         echo "<h3>En este momento no tiene permiso de consulta para Usuarios.</h3>";

        }else{

         $this->table_inst->render_blank();

         echo "<h3>En este momento no hay Usuarios creados.</h3>";
        };
        //---------------------------------------------------------------------------------
    	    	
    }
	
	public function AutenticarUsuario(){

		/*
		----------------------------------------------------------------------------------------		
		*/		
		//--------------------------------------------------------------------------------------
	
		$Usr_Mail=$_POST['username'];
		$Usr_Clave=$_POST['password'];			
				
		$matriz=$this->getUsuariosLogin($Usr_Mail,$Usr_Clave);		
		
		/*
		Asignacion de valores desde la base de datos segun sean los campos-------------------------
		*/
		$id=$matriz[0]['pkID'];
		$alias=$matriz[0]['alias'];
		$nombre=$matriz[0]['nombre'];
		$apellidos=$matriz[0]['apellido'];
		
		$tipo=$matriz[0]['t_usuario'];
		$id_tipo=$matriz[0]['fkID_tipo'];

		
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		if (($id!="") and ($nombre!="")){

			//El nombre de la cookie varia según el nombre de la aplicacion para no tener problemas
			//a la hora de la creacion de las mismas.
			setcookie($this->NameCookieApp."_id", $id, time() + 3600*24, "/");			
			setcookie($this->NameCookieApp."_alias", $alias, time() + 3600*24, "/");
			setcookie($this->NameCookieApp."_nombre", $nombre." ".$apellidos, time() + 3600*24, "/");			
			setcookie($this->NameCookieApp."_tipo", $tipo, time() + 3600*24, "/");
			setcookie($this->NameCookieApp."_IDtipo", $id_tipo, time() + 3600*24, "/");							

			//echo "nombre desde la cookie:".$_COOKIE[$this->NameCookieApp."_nombre"];

			echo '<script language="JavaScript">
					alert("Bienvenido '.$nombre.' '.$apellidos.'");					
			      </script>';
			
			//en login se hacen las validaciones necesarias de nuevo	
			echo "<script language=javascript> location.href='../vistas/login.php'</script>";
				
		} else {
			
			echo '<script language="JavaScript">
					alert("Usuario o password incorrecto, en otro caso por favor verifique que su usuario este activo.");
					window.location = "javascript:history.back(-1)"
				</script>';
			}
		
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
						
	}

	public function getSelectProyectosMUsuarios(){

	    	$m_u_Select = $this->getProyectosM();

	    	echo '<select id="select_proyectoM" class="form-control" data-accion="select">
                      <option></option>';
                      for ($i=0; $i < sizeof($m_u_Select); $i++) {
                              echo '<option value="'.$m_u_Select[$i]["pkID"].'" data-nombre = "'.$m_u_Select[$i]["nombre"].'" >'.$m_u_Select[$i]["nombre"].'</option>';
                          };
            echo '</select>';
	}
    
}

?>
