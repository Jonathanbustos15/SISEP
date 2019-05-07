<?php
/**/
	include_once '../DAO/valores_metaDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class valores_metaController extends valores_metaDAO{
		
		public $NameCookieApp;
		public $id_modulo;
    public $table_inst;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 56; //id de la tabla modulos
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

		public function getTablaValoresM(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $valoresM_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"valor"],
                    //["nombre"=>"url_archivo"]
                ];
                //la configuracion de los botones de opciones
                $valoresM_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"valoresM",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"valoresM",
                        "permiso"=>$elimina,
                     ]
                    /* [
                        "tipo"=>"descargar_1",
                        "nombre"=>"url_archivo"
                     ]*/

                ];

               /* $array_opciones = [
                  "modulo"=>"meta",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_indicador.php?id_indicador=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];*/
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $valoresM = $this->getValoresM();
            //print_r($infraestructura);

            //Instancia el render
            $this->table_inst = new RenderTable($valoresM,$valoresM_campos,$valoresM_btn,[]);
            //---------------------------------------------------------------------------------     
            //echo $this->table_inst;
            //valida si hay usuarios y permiso de consulta
            /**/
            if( ($valoresM) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($valoresM) && ($consulta==0)){

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
