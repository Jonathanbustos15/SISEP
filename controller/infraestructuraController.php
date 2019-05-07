<?php
/**/

    //ini_set('error_reporting', E_ALL|E_STRICT);
    //ini_set('display_errors', 1);

	include_once '../DAO/infraestructuraDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class infraestructuraController extends infraestructuraDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
        public $infraestructuraId;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 17; //id de la tabla modulos
			$this->NameCookieApp = $NomCookiesApp;
			
		}

    public function getSelectSede() {
        
            $tipo = $this->getSede();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }

		public function getTablaInfraestructura(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $infraestructura_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"descripcion"],
                    ["nombre"=>"sede"]
                    //["nombre"=>"url_archivo"]
                ];
                //la configuracion de los botones de opciones
                $infraestructura_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"infraestructura",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"infraestructura",
                        "permiso"=>$elimina,
                     ],
                     [
                        "tipo"=>"descarga_multiple",
                        "nombre"=>"infraestructura",                        
                     ]
                                          
                ];

                $array_opciones = [
                  "modulo"=>"infraestructura",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_infraestructura.php?id_infraestructura=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $infraestructura = $this->getInfraestructuras();
            //print_r($infraestructura);

            //Instancia el render
            $this->table_inst = new RenderTable($infraestructura,$infraestructura_campos,$infraestructura_btn,[]);
            //---------------------------------------------------------------------------------     
            //echo $this->table_inst;
            //valida si hay usuarios y permiso de consulta
            /**/
            if( ($infraestructura) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($infraestructura) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }
		
		
		public function getDataInfraestructuraGen($pkID){

            $this->infraestructuraId = $this->getInfraestructuraId($pkID);    
            
            /**/
            echo '
                  <div class="col-sm-12">

                    <div class="col-sm-6">

                        <strong>Nombre: </strong> '.$this->infraestructuraId[0]["nombre"].' <br> <br>
                        <strong>Descripción: </strong> '.$this->infraestructuraId[0]["descripcion"].' <br> <br>
                        ';                  

            echo    '</div>

                    <div class="col-sm-6">

                    
                       
                    </div>
            ';

            echo '</div>';
            
        }
		
	}
?>
