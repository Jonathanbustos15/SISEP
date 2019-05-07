<?php
/**/
	include_once '../DAO/preguntas_bDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class preguntas_bController extends preguntas_bDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 43; //id de la tabla modulos
			$this->NameCookieApp = $NomCookiesApp;
			
		}
		
		
		public function getTablaPreguntasBitacora($pkID){


            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $array_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"pregunta"],                    
                    ["nombre"=>"nom_tipo_usuario"],
                    ["nombre"=>"estado"],
                    //["nombre"=>"nom_bitacora"]
                ];
                //la configuracion de los botones de opciones
                $array_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"preguntab",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"preguntab",
                        "permiso"=>$elimina,
                     ]

                ];
	
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $preguntasb = $this->getBitacoraIdPregunta($pkID);
            //print_r($preguntasb);
            //Instancia el render
            $this->table_inst = new RenderTable($preguntasb,$array_campos,$array_btn,[]);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($preguntasb) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($preguntasb) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            
        }


        public function getTablaPreguntasBitacor(){


            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $array_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"pregunta"],
                    ["nombre"=>"nom_bitacora"]
                ];
                //la configuracion de los botones de opciones
                $array_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"preguntab",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"preguntab",
                        "permiso"=>$elimina,
                     ]

                ];

                $array_opciones = [
                  "modulo"=>"preguntab",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_preguntab.php?id_preguntab=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];
    
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $preguntasb = $this->getPreguntasBitacora();
            
            //Instancia el render
            $this->table_inst = new RenderTable($preguntasb,$array_campos,$array_btn);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($preguntasb) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($preguntasb) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            
        }



        public function getSelectEstadoPreguntaB() {
        
            $tipo = $this->getEstadoPreguntaB();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }


		
	}
?>
