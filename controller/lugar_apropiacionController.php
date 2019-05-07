<?php
/**/
	include_once '../DAO/lugar_apropiacionDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class lugar_apropiacionController extends lugar_apropiacionDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 20; //id de la tabla modulos
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

		public function getTablaLugarA(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $lugarA_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"direccion"],
                    ["nombre"=>"telefono"]
                ];
                //la configuracion de los botones de opciones
                $lugarA_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"lugarA",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"lugarA",
                        "permiso"=>$elimina,
                     ]

                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $lugarA = $this->getlugarA();


            //Instancia el render
            $this->table_inst = new RenderTable($lugarA,$lugarA_campos,$lugarA_btn);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($lugarA) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($lugarA) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }

		
	}
?>
