<?php
/**/
	include_once '../DAO/bitacoraDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class bitacoraController extends bitacoraDAO{
		
		public $NameCookieApp;
		public $id_modulo;
        public $id_modulo_grupo_evento;
		public $bitacoraId;
		public $id_modulo_pregunta_b;
        public $table_inst;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 41; //id de la tabla modulos
            //$this->id_modulo_grupo_evento = 41;
			$this->id_modulo_grupo_evento = 44;
			$this->NameCookieApp = $NomCookiesApp;
			
		}
		
		public function getSelectFase() {
        
            $tipo = $this->getFase();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["pkID"].". ".$tipo[$a]["nombre"]."</option>";
            }
        }


        public function getTablaBitacora(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $bitacora_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"fecha_creacion"],
                    ["nombre"=>"fase"],
                ];
                //la configuracion de los botones de opciones
                $bitacora_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"bitacora",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"bitacora",
                        "permiso"=>$elimina,
                     ]

                ];

                $array_opciones = [
		          "modulo"=>"bitacora",//nombre del modulo definido para jquerycontrollerV2
		          "title"=>"Click Ver Detalles",//etiqueta html title
		          "href"=>"detalles_bitacora.php?id_bitacora=",
		          "class"=>"detail"//clase que permite que añadir el evento jquery click
		        ];	
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $bitacoras = $this->getBitacoras();


            //Instancia el render
            $this->table_inst = new RenderTable($bitacoras,$bitacora_campos,$bitacora_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($bitacoras) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($bitacoras) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }


        public function getDataBitacoraGen($pkID){

			    $this->bitacoraId = $this->getBitacoraId($pkID);	
			
			/**/
			echo '
				  <div class="col-sm-12">

					<div class="col-sm-12">

						<strong>Nombre: </strong> '.$this->bitacoraId[0]["nombre"].'  <br> <br>
						<strong>Fecha de Creación: </strong> '.$this->bitacoraId[0]["fecha_creacion"].'<br><br>
						<strong>Fase: </strong> '.$this->bitacoraId[0]["nom_fase"].' <br> <br>
						
					</div>
				
						';					


			echo '</div>';
			
		}


		public function getTablaPreguntasBitacora($pkID){


            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_pregunta_b,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $array_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"pregunta"],
                    
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



        public function getTablaBitacoraFase($pkID){


            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
            $bitacora_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"fecha_creacion"],
                    ["nombre"=>"fase"],
                    
                    //["nombre"=>"evento",
                    // "tipo"=>"y/n"],
            ];
                //la configuracion de los botones de opciones
            $bitacora_btn =[                     
                     [
                        "tipo"=>"btn_gen",
                        "nombre"=>"bitacora"                        
                     ],                     
            ];

            $array_opciones = [
              //"modulo"=>"bitacora",//nombre del modulo definido para jquerycontrollerV2
              //"title"=>"Click Ver Detalles",//etiqueta html title
              //"href"=>"detalles_bitacora.php?id_bitacora=",
              //"class"=>"detail"//clase que permite que añadir el evento jquery click
            ];  
    
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $bitacoras = $this->getBitacoraIdFase($pkID);
            //print_r($bitacoras);
            //Instancia el render
            $this->table_inst = new RenderTable($bitacoras,$bitacora_campos,$bitacora_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($bitacoras) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($bitacoras) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            
        }

        //------------------------------------------------------------------------------------
        //tabla que carga las preguntas y respuestas.
        public function getTablaPreguntasRespuestas($pkID_bitacora,$fkID_grupo){

            //include("../conexion/datos.php");

             $preguntas = $this->getBitacoraIdPregunta($pkID_bitacora,$_COOKIE[$this->NameCookieApp."_IDtipo"]);

             if ($preguntas) {

                 echo '<div class="alert alert-info text-center" role="alert"><strong>[Hay preguntas disponibles para '.$_COOKIE[$this->NameCookieApp.'_tipo'].'.]</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: red;">&times;</span></button> </div>';
                
                //print_r($preguntas);

                 foreach ($preguntas as $key => $value) {
                     //echo $key. " ".$value["pregunta"];

                    $respuesta = $this->getRespuestaId($value["pkID"],$fkID_grupo);

                    //print_r($respuesta);

                    echo '<tr>
                            <td>'.$value["pregunta"].'</td>
                            <td>'.$respuesta[0]["respuesta"].'</td>
                            <td><button  id="btn_responder_b" name="responde_bitacora" title="Responder '.$value["pregunta"].'" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_respuesta_b" data-id-pregunta = "'.$value["pkID"].'"';
                                    if (is_null($respuesta[0]["respuesta"])) {
                                        echo ' data-action="nuevo" ';
                                    }else{
                                        echo ' data-action="carga_editar" data-id-respuesta_b = "'.$respuesta[0]["pkID"].'" ';
                                    };
                                echo '><span class="glyphicon glyphicon-hand-right"></span></button>&nbsp</td>                        
                          </tr>';


                 }

             } else {
                 echo '<div class="alert alert-danger text-center" role="alert"><strong>[No hay preguntas disponibles para '.$_COOKIE[$this->NameCookieApp.'_tipo'].'.]</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: red;">&times;</span></button> </div>';
             }
                                     
        }
        //------------------------------------------------------------------------------------

        public function getTablaGrupoEvento($fkID_grupo){
            //------------------------------
            //echo $fkID_grupo;

            //Define las variables de la tabla a renderizar

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_grupo_evento,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Los campos que se van a ver
            $array_campos = [                       
                ["nombre"=>"nom_evento"],
                ["nombre"=>"puntaje"],                        
            ];
            
            //la configuracion de los botones de opciones
            $array_btn =[                     
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"grupo_evento",
                        "permiso"=>$elimina                        
                     ],                     
            ];
            //------------------------------
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO

            $evento = $this->getGrupoEvento($fkID_grupo);

            //print_r($evento);
            
            //Instancia el render
            $this->table_inst = new RenderTable($evento,$array_campos,$array_btn,[]);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if($evento){
                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }else{

                $this->table_inst->render_blank();

                echo "<h3>En este momento no hay registros.</h3>";
            };/**/
            //---------------------------------------------------------------------------------
        }
        //------------------------------------------------------------------------------------
		
	}
?>
