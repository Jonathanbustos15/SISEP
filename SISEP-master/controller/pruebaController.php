<?php
/**/
//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

	include_once '../DAO/pruebaDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class pruebaController extends pruebaDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $id_modulo_pregunta_p;
		public $table_inst;
		public $pruebaId;
        public $cant_preguntas;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 22; //id de la tabla modulos
			$this->id_modulo_pregunta_p = 24;
			$this->NameCookieApp = $NomCookiesApp;
			
		}
		
		
		//Funciones-------------------------------------------
		//Espacio para las funciones de esta clase.

		public function getTablaPrueba(){       

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
                    ["nombre"=>"nombre"],
                    ["nombre"=>"descripcion"],
                    ["nombre"=>"tipo"],
                    ["nombre"=>"fecha_ini"],
                    ["nombre"=>"fecha_fin"]
                    //["nombre"=>"url_archivo"]
                ];
                //la configuracion de los botones de opciones
                $array_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"prueba",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"prueba",
                        "permiso"=>$elimina,
                     ],
                     [
                        "tipo"=>"descarga_multiple",
                        "nombre"=>"prueba",                        
                     ],
                     [
                        "tipo"=>"btn_rpta_p",
                        "nombre"=>"ir_prueba"                        
                     ]

                ];

                $array_opciones = [
		          "modulo"=>"prueba",//nombre del modulo definido para jquerycontrollerV2
		          "title"=>"Click Ver Detalles",//etiqueta html title
		          "href"=>"detalles_prueba.php?id_prueba=",
		          "class"=>"detail"//clase que permite que añadir el evento jquery click
		        ];	
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $pruebas = $this->getPrueba();


            //Instancia el render
            $this->table_inst = new RenderTable($pruebas,$array_campos,$array_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($pruebas) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($pruebas) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }


       public function getDataPruebaGen($pkID){
            //echo $pkID;
            
			$this->pruebaId = $this->getPruebaId($pkID);	
			
            //print_r($this->pruebaId);
			/**/
			echo '
				  <div class="col-sm-12">

					<div class="col-sm-12">

						<strong>Nombre: </strong> '.$this->pruebaId[0]["nombre"].'  <br> <br>
						<strong>Descripción: </strong> '.$this->pruebaId[0]["descripcion"].' <br> <br>
                        <strong>Tipo: </strong> '.$this->pruebaId[0]["tipo_p"].' <br> <br>
						<strong>Fecha Inicio: </strong> '.$this->pruebaId[0]["fecha_ini"].' <br> <br>
						<strong>Fecha Final: </strong> '.$this->pruebaId[0]["fecha_fin"].' <br> <br>
                        <input id="pkID_tipo_p" type="hidden" value="'.$this->pruebaId[0]["pkID_tipo_p"].'">  <br> <br>
					</div>

                  </div>';
			
		}


		public function getTablaPreguntasPrueba($pkID){


            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_pregunta_p,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $array_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"pregunta"],
                    ["nombre"=>"tipo_de_pregunta"]
                    //["nombre"=>"nom_prueba"]
                ];
                //la configuracion de los botones de opciones
                $array_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"preguntap",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"preguntap",
                        "permiso"=>$elimina,
                     ]

                ];
	
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            
            
            $preguntas = $this->getPruebaIdPreguntaCrud($pkID);
            //print_r($preguntas);
            //Instancia el render
            /**/
            $this->table_inst = new RenderTable($preguntas,$array_campos,$array_btn,[]);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($preguntas) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($preguntas) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            
        }

        public function getCantPreguntas($pkID){
            
            $preguntas = $this->getPruebaIdPreguntaCrud($pkID);

            $q = $preguntas ? sizeof($preguntas)+1 : sizeof($preguntas);

            $this->cant_preguntas = $q;

            return $this->cant_preguntas;
        }
        //---------------------------------------------------------------------------------

        public function getSelectTipo_p() {
        
            $tipo = $this->getTipo_p();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }


        public function getSelectPrueba() {
        
            $tipo = $this->getPrueba();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }


        public function getSelectTipoPrueba() {
        
            $tipo = $this->getTipoPrueba();
            
            echo "<select name='fkID_tipo_prueba' id='fkID_tipo_prueba' class='form-control'>";
                    echo "<option></option>";
                for($a=0;$a<sizeof($tipo);$a++){
                    echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
                }
            echo "</select>";
        }


        public function getTablaPreguntas($pkID){


	    	//Define las variables de la tabla a renderizar

	    		//Los campos que se van a ver
	    		$array_campos = [
	    			//["nombre"=>"pkID"],
	    			["nombre"=>"pregunta"],	    			
	    		];
	    		//la configuracion de los botones de opciones
	    		$array_btn =[		    		 
	    			
		    	];		    		    	
		    //---------------------------------------------------------------------------------
		    //get de los datos	    	
	    	$pregunta = $this->getPruebaIdPregunta($pkID);
		    	    	

	    	//Instancia el render
	    	$this->table_inst = new RenderTable($pregunta,$array_campos,$array_btn);

	    	$this->table_inst->render();
	    }


        public function validateInTest($pkID_prueba, $pkID_usuario, $fkID_tipo_usuario){
            //debe validar que la fecha actual este en el rango de fecha_ini y fecha_fin
            //si lo esta carga la tabla de lo contrario no
            $prueba = $this->pruebaId = $this->getPruebaId($pkID_prueba);

            //print_r($prueba);

            $start_ts = strtotime($prueba[0]["fecha_ini"]);

            //echo $start_ts."<br>";

            $end_ts = strtotime($prueba[0]["fecha_fin"]);

            //echo $end_ts."<br>";
            //fecha actual en string
            $user_ts = strtotime(date("Y")."-".date("m")."-".date("d"));

            //echo $user_ts." -- <br>";                      

            if ( ($user_ts >= $start_ts) && ($user_ts <= $end_ts) ) {
                 //echo "Esta en el rango.";
                 echo '<div class="alert alert-info text-center" role="alert"><strong>[La prueba se encuentra disponible.]</strong>  La prueba está disponible entre las fechas <strong>'.$prueba[0]["fecha_ini"].'</strong> y <strong>'.$prueba[0]["fecha_fin"].'</strong>   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: red;">&times;</span></button> </div>';
                 $this->getTablaPreguntasRespuestasP($pkID_prueba, $pkID_usuario, $fkID_tipo_usuario);

             }else{
                echo '<div class="alert alert-danger text-center" role="alert"><strong>[No es posible responder esta prueba.]</strong>  La prueba solo está disponible entre las fechas <strong>'.$prueba[0]["fecha_ini"].'</strong> y <strong>'.$prueba[0]["fecha_fin"].'</strong> </div>';
             } 
        }   

        //tabla que carga las preguntas y respuestas.
        public function getTablaPreguntasRespuestasP($pkID_prueba, $pkID_usuario, $fkID_tipo_usuario){

             include("../conexion/datos.php");
             //carga todas las preguntas
             $preguntas = $this->getPruebaIdPregunta($pkID_prueba, $fkID_tipo_usuario);


             //print_r($preguntas);

             if ($preguntas) {
                 
                 echo '<div class="alert alert-info text-center" role="alert"><strong>[Hay preguntas disponibles para '.$_COOKIE[$NomCookiesApp.'_tipo'].'.]</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: red;">&times;</span></button> </div>';                             
                 /**/
                 foreach ($preguntas as $key => $value) {
                     //echo $key. " ".$value["pregunta"];

                    //para cada pregunta carga respuestas multiples o abiertas
                    $respuestas = $this->getRespuestaId($value["pkID"], $pkID_usuario);
                    $rpta_mult = $this->getRespuestasMult($value["pkID"], $pkID_usuario);

                    //print_r($respuestas);
                    //print_r($rpta_mult);

                    //echo $respuestas[0]["pkID"];

                    echo '<tr>
                            <td>'.$value["pregunta"].'</td>
                            <td>'.$respuestas[0]["respuesta"];

                            foreach ($rpta_mult as $key => $value) {
                                //echo $key."--".$value;

                                foreach ($value as $llave => $val) {
                                    
                                    if ($llave == "respuestab") {
                                        echo $val." ";
                                    }
                                }
                                
                            }

                            //echo $rpta_mult[0]["respuestab"];

                      echo '</td>
                            <td>';
                            //echo ' data-action="carga_editar" data-id-respuesta_p = "'.$respuestas[0]["pkID"].'" ';                            
                                    //echo is_null($respuestas[0]);
                                    if (is_null($respuestas[0])) {

                                        echo '<button  id="btn_responder_p" name="responde_prueba" title="Responder '.$value["pregunta"].'" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_respuesta_p"  data-id-pregunta = "'.$value["pkID"].'"';
                                        echo ' data-action="nuevo" ';
                                        echo '><span class="glyphicon glyphicon-hand-right"></span></button>&nbsp';   
                                        
                                    };                            

                        echo '</td>                        
                          </tr>';
                 }

             } else {
                
                echo '<div class="alert alert-danger text-center" role="alert"><strong>[No hay preguntas disponibles para '.$_COOKIE[$NomCookiesApp.'_tipo'].'.]</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: red;">&times;</span></button> </div>';
             }
            
        }


        public function getLinksResultadosUsuariosPrueba($pkID_prueba){

          $users_prueba = $this->getUsuariosPrueba($pkID_prueba);

          foreach ($users_prueba as $ll => $val) {

            echo "<span class='glyphicon glyphicon-import'></span> Resultados de ".$val["nombre"]." ".$val["apellido"]." 

            <a target='_blank' href='../controller/reporte_prueba.php?id_prueba=".$pkID_prueba."&id_usuario=".$val["pkID_usuario"]."'><img src='../img/icon_excel.png' height='20' width='20' title='Descarga Excel'></a>
            <a target='_blank' href='../controller/reporte_prueba_fpdf.php?id_prueba=".$pkID_prueba."&id_usuario=".$val["pkID_usuario"]."'><img src='../img/icon_pdf.png' height='20' width='20' title='Descarga PDF'></a><br>";
          }
        }

        public function resTableUsersPrueba($pkID_prueba){
          
          $new_users_prueba = [];
          
          $users_prueba = $this->getUsuariosPrueba($pkID_prueba);

          foreach ($users_prueba as $key => $value) {
            
            $value["links"] = "
              <a target='_blank' href='../controller/reporte_prueba.php?id_prueba=".$pkID_prueba."&id_usuario=".$value["pkID_usuario"]."'><img src='../img/icon_excel.png' height='30' width='30' title='Descarga Excel'></a>
              <a target='_blank' href='../controller/reporte_prueba_fpdf.php?id_prueba=".$pkID_prueba."&id_usuario=".$value["pkID_usuario"]."'><img src='../img/icon_pdf.png' height='30' width='30' title='Descarga PDF'></a>
            ";

            array_push($new_users_prueba, $value);            
          }

          //print_r($new_users_prueba);

          //Los campos que se van a ver
          $array_campos = [
             // ["nombre"=>"pkID"],
              ["nombre"=>"numero_documento"],
              ["nombre"=>"nombre"],
              ["nombre"=>"apellido"],
              ["nombre"=>"links"]                    
          ];                

          $this->table_inst = new RenderTable($new_users_prueba,$array_campos,[],[]);

          $this->table_inst->render();
          
        }

		
	}
?>

