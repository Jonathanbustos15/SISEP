<?php
/*

    ini_set('error_reporting', E_ALL|E_STRICT);
    ini_set('display_errors', 1);
*/
	include_once '../DAO/indicadorDAO.php';
	include_once 'helper_controller/render_table.php';
    

		
	class indicadorController extends indicadorDAO{
		
	public $NameCookieApp;
	public $id_modulo;
  public $id_modulo_meta;
	public $table_inst;
  public $indicadorId;
  public $valoresM;
  public $rta;
  public $rta1;
  public $enc;
    	
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 53; //id de la tabla modulos
            $this->id_modulo_meta = 55;
			$this->NameCookieApp = $NomCookiesApp;

            include_once 'helper_controller/class_crypt.php';

            $this->enc = new crypt();			
		}
		
		
		//Funciones-------------------------------------------
		//Espacio para las funciones de esta clase.
		
		//permisos---------------------------------------------------------------------
		//$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
		//$edita = $arrPermisos[0]["editar"];
		//$elimina = $arrPermisos[0]["eliminar"];
		//$consulta = $arrPermisos[0]["consultar"];
		//-----------------------------------------------------------------------------
    public function getSelectTipoIndicador() {
        
          $tipo = $this->getTipoIndicador();
          
          echo "<select name='fkID_tipoI' id='fkID_tipoI' class='form-control'>";
              echo "<option></option>";
            for($a=0;$a<sizeof($tipo);$a++){
              echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        echo "</select>";
      }


		public function getTablaIndicador(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $indicador_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"descripcion"],
                    ["nombre"=>"tipo"],
                    //["nombre"=>"url_archivo"]
                ];
                //la configuracion de los botones de opciones
                $indicador_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"indicador",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"indicador",
                        "permiso"=>$elimina,
                     ]
                    /* [
                        "tipo"=>"descargar_1",
                        "nombre"=>"url_archivo"
                     ]*/

                ];

                $array_opciones = [
                  "modulo"=>"indicador",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_indicador.php?id_indicador=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $indicador = $this->getIndicadores();
            //print_r($infraestructura);

            //Instancia el render
            $this->table_inst = new RenderTable($indicador,$indicador_campos,$indicador_btn,$array_opciones);
            //---------------------------------------------------------------------------------     
            //echo $this->table_inst;
            //valida si hay usuarios y permiso de consulta
            /**/
            if( ($indicador) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($indicador) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }

        public function getDataIndicadorGen($pkID){
          

          
          $this->indicadorId = $this->getIndicadorId($pkID); 

          //$query=mysql_query($this->indicadorId[0]["script"]);

          $this->rta = $this->enc->desencriptar($this->indicadorId[0]["script"]);

          //echo $this->rta;
          
          $arr_gen = $this->getConsultas($this->rta);
          
          /**/
          //----------------------------------------------------------------
          if ($arr_gen) {
                              
                /**/
                if ($arr_gen["error"]) {
                    echo '<div class="alert alert-danger" role="alert"><strong>Error SQl!</strong> -- ['.$arr_gen["error"].']</div>';
                } else {
                    $this->mkTABLE($arr_gen);
                }
                
          } else {
              //print_r($arr_gen);
              echo '<div class="alert alert-danger" role="alert"><strong>Error SQl!</strong> -- Este query tiene un error de sintaxis, por favor revíselo en inténtelo de nuevo.</div>';
          };                    
          
        }

        public function mkTABLE($arr){

            //arary de los campos de la tabla
            $arr_campos = [];

            echo '<div class="table-responsive">
                    <table class="display table table-striped table-bordered table-hover" id="tbl_indicador_gen">';


                echo '<thead>';
                    echo '<tr>';


                foreach ($arr[0] as $key => $value) {                    

                    //contruye el array para el renderTable de campos
                    array_push($arr_campos, ["nombre"=>$key]);
                    //-----------------------------------------------                    
                    echo "<th>";
                    echo $key;
                    echo "</th>";                    
                };

                    echo '<!--<th data-orderable="false">Opciones</th>-->
                          </tr>';

                echo '</thead>';

                echo '<tbody>';
                    //--------------------------------------                
                    //print_r($arr_campos);
                    $this->table_inst = new RenderTable($arr,$arr_campos,[],[]);

                    $this->table_inst->render();
                    //--------------------------------------
                echo'</tbody>';

            echo '  </table>
                  </div>';
        } 

          



        public function getSelectMetas(){

          $m_u_Select = $this->getMetas();

          echo '<select id="fkID_meta" name="fkID_meta" class="form-control" required="true">
                  <option></option>';
                  for ($i=0; $i < sizeof($m_u_Select); $i++) {
                          echo '<option value="'.$m_u_Select[$i]["pkID"].'">'.$m_u_Select[$i]["nombre"].'</option>';
                      };
          echo '</select>';
        }


       public function getTablaMetasIndicador($pkID_meta,$pkID_indicador){


            //include ('helper_controller/class_crypt.php');    
                
            // $ence = new crypt();
             $metas = $this->getMetasIndicador($pkID_indicador);             

             
             foreach ($metas as $key => $value) {
                 //echo $key. " ".$value["pregunta"];
                //print_r($value);

              echo '<tr>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["total"].'</td>';

                        


                        echo '<td>';


                            echo '<table class="display table-striped table-bordered table-hover">


                                <tr>
                                    <td scope="colgroup">Valores</td>
                                    <td>Resultado del Script</td>
                                    <td colspan="2">Opciones</td>
                                </tr>';
                        $this->valoresM = $this->getValoresMetaIndicador($pkID_indicador);

                        $numValores = $this->getNumMetasIndicador($pkID_meta);

                        $nv = $numValores[0]['numVal'];

                        


                        //$cont = 0;
                        for($i = 0; $i < $nv; $i++){

                           // $cont = $cont + 1;
                         echo   '<tr>       

                                        <td>'.$this->valoresM[$i]["valor"].'</td>';
                                                                 
                                       echo '<td>';
                                       
                                       $this->rta1 = $this->enc->desencriptar($this->valoresM[$i]["scriptM"]);

                                       //echo "$this->rta1";
                                       $arr_gen = $this->getConsultas($this->rta1);
                                       //print_r($arr_gen);
                                        foreach($arr_gen as $key=>$value){
                                            //echo "$key";
                                            //echo "$value";
                                            foreach($value as $llave=>$val){
                                               // echo "$llave";
                                                echo "$val";
            
                                            }
                                        }
                                        echo '</td>';

            

                                   echo   '<td>
                                            <button  id="btn_valoresMED" name="edita_valoresM" title="Editar valor" type="button" class="btn btn-warning" data-toggle="modal" data-id-valoresM = "'.$this->valoresM[$i]['pkID_vm'].'" data-target="#frm_modal_valoresM"><span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                
                                            <button  id="btn_valoresMEL" name="elimina_valoresM" title="eliminar valor" type="button" data-id-valoresM = "'.$this->valoresM[$i]['pkID_vm'].'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </td>

                                </tr>';  
                        };
                        
                        echo '</table>
                              </td>';


                        
                        echo '<td>

                                <button  id="btn_valoresM" name="crear_valor" title="nuevo valor" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_valoresM"><span class="glyphicon glyphicon-plus"></span>
                                </button>

                                <button  id="btn_metaE" name="edita_meta" title="editar meta" type="button" class="btn btn-warning" data-toggle="modal" data-target="#frm_modal_meta" data-id-meta = "'.$metas[0]["pkID"].'"><span class="glyphicon glyphicon-pencil"></span>
                                </button>

                                <button  id="btn_metaEL" name="eliminar_meta" title="Eliminar valor" type="button" class="btn btn-danger" data-id-meta = "'.$metas[0]["pkID"].'"><span class="glyphicon glyphicon-remove"></span>
                                </button>
                              
                              </td>

                            </tr>';
                                        
                      
             }
            
        }


         public function getTablaValoresMetasIndicador($pkID_meta,$pkID_indicador){

             $totalValores = $this->getTotalValoresMeta($pkID_meta);

             $sumavm = $totalValores[0]["totalM"];

             $totam = $totalValores[0]["total"];
 

             $numValores = $this->getNumMetasIndicador($pkID_meta);

             $nv = $numValores[0]['numVal'];

             //echo "$nv";
        
            $this->rta1 = $this->enc->desencriptar($this->indicadorId[0]["scriptI"]);

          //echo $this->rta;
          
            $arr_genI = $this->getConsultas($this->rta1);
            //En desarrollo

             echo '<div class="col-sm-7">';
                $valoresM = $this->getValoresMetaIndicador($pkID_indicador);
                echo '<label>Indicador :</label> ';
                echo $valoresM[0]["indicador"];
                echo '<br><br>';
                echo '<label>Detalles del Indicador</label><br>';
                echo $valoresM[0]["desInd"];
                echo '<br><br>';
                echo '<label>Meta :</label> ';
                echo $valoresM[0]["meta"]; 
                echo '<br><br>';
                echo '</div>';
             

             


             echo '<div class="col-sm-5">';
              if($nv == 0){
                echo '<div class="alert alert-danger">La meta no tiene valores</div>';
                
             }else{
                echo '<table class="display table-striped table-bordered table-hover" border="1">
                        <label>Información de la Meta : '.$valoresM[0]["meta"].'</label><br>
                            <tr>
                                <td><strong>Periodicidad</strong></td>
                                <td><strong>Valor</strong></td>
                                <td><strong>Resultado del Script</strong></td>
                                <td><strong>Resultado</strong></td>
                            </tr>';
                $cont = 0;
                $sum = 0;
                for($i = 0; $i < $nv; $i++){
                    $cont = $cont + 1;
                     
                    echo '  
                            <tr> 
                                <td>'.$valoresM[$i]["fecha_ini"].'-------'.$valoresM[$i]["fecha_fin"].'</td>       
                                <td>'.$valoresM[$i]["valor"].'</td>';
                            echo '<td>';
                                       $this->rta = $this->enc->desencriptar($this->valoresM[$i]["scriptM"]);

                                       //echo "$this->rta1";
                                       $arr_gen = $this->getConsultas($this->rta);
                                       //print_r($arr_gen);
                                        foreach($arr_gen as $key=>$value){
                                            //echo "$key";
                                            //echo "$value";
                                            foreach($value as $llave=>$val){
                                               // echo "$llave";
                                                echo "$val";
                                                
            
                                            }

                                        }
                                echo   '</td>';
                                echo '<td>';

                                    
                                        if($val<$valoresM[$i]["valor"]){
                                            echo '<div class="alert alert-danger">Meta no cumplida</div>';
                                        }else{
                                            echo '<div class="alert alert-success">Meta cumplida</div>';
                                        }
                                         


                                echo '</td>';        

                        echo '</tr>';
                        $sum = $sum + $val;

                  }

            }
                echo '</table>';
                echo '<br>';
              
                echo '<label>Total Valor Esperado Meta :  </label>';
                echo $totam; 
                echo '<br>';

                echo '<label>Total Valores Meta : </label>';
                echo $sumavm;
                echo '<br>';

                echo '<label>Total Valores Script Meta :  </label>';
                echo $sum;
                echo '<br>';
                $this->rta1 = $this->enc->desencriptar($this->valoresM[0]["scriptI"]);

                                       //echo "$this->rta1";
                                       $arr_genI = $this->getConsultas($this->rta1);
                                       //print_r($arr_gen);
                                        foreach($arr_genI as $keyI=>$valueI){
                                            //echo "$key";
                                            //echo "$value";
                                            foreach($valueI as $llaveI=>$valI){
                                               // echo "$llave";
                                                //echo "$valI";
            
                                            }
                                        };
                echo '<label>Resultado Script del Indicador :  </label>';
                echo $valI;
                echo "<br>";
                echo ''; 
                
                

                
                /*if($tv<$valoresM[$i]["valor"]){
                    echo '<div class="alert alert-danger">Meta no cumplida</div>';
                }else{
                    echo '<div class="alert alert-success">Meta cumplida</div>';
                } */
             echo '</div>';  
            
        }

		
    }
?>
