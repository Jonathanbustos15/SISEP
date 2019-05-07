<?php
/**/
	
  include_once '../controller/helper_controller/render_table.php';
  include_once '../DAO/auditoriaDAO.php';
		
	class auditoriaController extends auditoriaDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 58; //id de la tabla modulos
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

		public function getTablaAuditoria(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $auditoria_campos = [                   
                    ["nombre"=>"usuario"],
                    ["nombre"=>"accion"],
                    ["nombre"=>"nom_modulo"],
                    ["nombre"=>"fecha"],
                    [
                      "nombre"=>"consulta_sql",
                      "tipo"=>"decrypt",
                    ]
                ];
                //la configuracion de los botones de opciones
                $auditoria_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"auditoria",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"auditoria",
                        "permiso"=>$elimina,
                     ]
                     /*[
                        "tipo"=>"descarga_multiple",
                        "nombre"=>"apropiacionS",                        
                     ]*/

                ];

                $array_opciones = [
                  "modulo"=>"auditoria",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_apropiacionS.php?id_apropiacionS=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $auditoria = $this->getAuditoria();


            //Instancia el render
            $this->table_inst = new RenderTable($auditoria,$auditoria_campos,[],[]);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($auditoria) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($auditoria) && ($consulta==0)){

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
