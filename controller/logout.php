<?php 
//------------------------
error_reporting(0);
//------------------------

	class salir {

		//------------------------------------------
		//variables
		public $accion;
		//------------------------------------------

		//------------------------------------------
		//funciones
		public function __construct($accion){
			$this->accion = $accion;
		}

		private function destruye_cookies(){

			/*
			----------------------------------------------------------------------------------------
			Nombre de las cookies que viene del archivo de datos, según sea el nombre de la app.
			*/
			include_once '../conexion/datos.php';
			//--------------------------------------------------------------------------------------

			//El nombre de la cookie varia según el nombre de la aplicacion para no tener problemas
			//a la hora de la creacion de las mismas.

			unset($_COOKIE[$NomCookiesApp."_id"]);
			unset($_COOKIE[$NomCookiesApp."_nombre"]);
			unset($_COOKIE[$NomCookiesApp."_alias"]);
			//unset($_COOKIE[$NomCookiesApp."_num_cc"]);
			unset($_COOKIE[$NomCookiesApp."_tipo"]);
			unset($_COOKIE[$NomCookiesApp."_IDtipo"]);

			setcookie($NomCookiesApp."_id", null, -1, '/');
			setcookie($NomCookiesApp."_nombre", null, -1, '/');
			setcookie($NomCookiesApp."_alias", null, -1, '/');
			//setcookie($NomCookiesApp."_num_cc", null, -1, '/');
			setcookie($NomCookiesApp."_tipo", null, -1, '/');
			setcookie($NomCookiesApp."_IDtipo", null, -1, '/');

		}

		private function valida(){

			$valida = count($_COOKIE);

			if($valida == 0){
				//echo '<script language="JavaScript"> alert("Ha salido  exitosamente"); window.location = "index.php"; </script>';
				return true;	
			}else{
				//echo '<script language="JavaScript"> alert("Ha ocurrido un error, su sesión permanecerá abierta."); window.location = "javascript:history.back(-1)"; </script>';
				return $_COOKIE;
			}
		}

		private function confirma(){

			echo '
			<script language="JavaScript">
				if (!confirm("Esta a punto de cerrar su sesion, esta seguro ?")){
					window.location = "javascript:history.back(-1)";
					}else{
					window.location = "logout.php?conf=s";			
					}
			</script>';

		}

		public function exe_salir(){

			if($this->accion == "s"){

				$this->destruye_cookies();
				$var_validacion=$this->valida();

				if($var_validacion == true){
					echo '<script language="JavaScript"> localStorage.removeItem("sesion_time"); alert("Ha salido  exitosamente"); window.location = "../index.php"; </script>';
				}else{
					
					print_r($var_validacion);

					echo '<script language="JavaScript"> localStorage.removeItem("sesion_time"); alert("Ha ocurrido un error, no se puede cerrar la sesión."); window.location = "javascript:history.back(-1)"; </script>';
					
				}

			}else{
				
				$this->confirma();
			}

		}
		//------------------------------------------
	}

	//--------------------------------------------------------------------------------------------------------
	$salir = new salir($conf=$_GET['conf']);
	$salir->exe_salir();
	//--------------------------------------------------------------------------------------------------------
 ?>