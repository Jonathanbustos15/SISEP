<?php 
	
	//-----------------
	//error_reporting(0);
	//-----------------
	include("../DAO/genericoDAO.php");

	class valida {

		use GenericoDAO;
		//---------------------------------------------------------
	    //variables de sesion
	    public $id;
	    public $nombre;
	    public $tipo;
	    public $id_tipo;
	    //-----------------------------------------
	    public $nameCookieApp;	  
	    //-----------------------------------------

	    public function construye(){
	    	include('../conexion/datos.php');
	    	$this->nameCookieApp = $NomCookiesApp;

	    	//echo "nombre de la app "+$this->nameCookieApp;
	    }
	    //funciones
	    public function asigna_vals(){

	    	$this->construye();

	    	//echo "nombre de la app "+$this->nameCookieApp;
	    	//print_r($_COOKIE);

	    	if(sizeof($_COOKIE) <= 2){ 

	    		$this->id = "";
		        $this->nombre = "";
		        $this->tipo = "";
		        $this->id_tipo = "";

	    	}else{
		        $this->id = $_COOKIE[$this->nameCookieApp."_id"];
		        $this->nombre = $_COOKIE[$this->nameCookieApp."_nombre"];
		        $this->tipo = $_COOKIE[$this->nameCookieApp."_tipo"];
		        $this->id_tipo = $_COOKIE[$this->nameCookieApp."_IDtipo"];
	        }

	    }

	    public function valida_vals(){

	    	$this->asigna_vals();

	        if($this->id == "" || $this->nombre == "" || $this->tipo == "" || $this->id_tipo == ""){	            
	            return false;
	        }else{	            	           
	            return true;
	        }
	    }

	    //-------------------------------------------------------------------
	    //funcion para validar el perfil de usuario
	    public function valida_perfil(){

	    	return $this->tipo;
	    }

	    public function getIDtipo(){

	    	return $this->id_tipo;
	    }

	    public function getIdUser(){

	    	return $this->id;
	    }

	    public function valida_entrada_perfil($id_modulo,$id_perfil_actual){

	    	//Devuelve TRUE si needle se encuentra en el array, FALSE de lo contrario.

	    	$permisos = $this->getPermisosModulo_Tipo($id_modulo,$id_perfil_actual);
	    	
	    	if (sizeof($permisos[0]) > 0 ) {	    		
	    		return true;
	    	}else{	    		
	    		return false;
	    	}	    		    	
	    }
	    //-------------------------------------------------------------------

	    public function mensaje_error(){

	    	if($this->valida_vals() == true){
	    		echo '<script language="JavaScript"> alert("No tiene permisos para acceder a esta página."); history.back(1); //window.location = "login.php"; </script>';
	    	}else{
	    		echo '<script language="JavaScript"> localStorage.removeItem("sesion_time"); alert("Usuario no identificado o su tiempo de sesion termino, por favor identifíquese."); window.location = "login.php"; </script>';
	    	}    	

	    }

	    //-----------------------------------------
	}

 ?>