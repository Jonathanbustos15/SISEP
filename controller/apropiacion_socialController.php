<?php
/**/
	include_once '../DAO/apropiacion_socialDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class apropiacion_socialController extends apropiacion_socialDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
        public $apropiacionSId;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 19; //id de la tabla modulos
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

		public function getSelectLugarA() {
        
            $tipo = $this->getLugarA();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }

        public function getSelectTematicas() {
        
            $tipo = $this->getTematicas();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }

        public function getSelectNombresApropiacionS() {
        
            $tipo = $this->getNombresApropiacionS();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }


        public function getSelectTipoA() {
        
            $tipo = $this->getTipoA();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }


        public function getSelectCoordinador() {
        
            $tipo = $this->getCoordinador();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkIDA"]."'>".$tipo[$a]["nombreA"].' '.$tipo[$a]["apellidoA"]."</option>";
            }
        }


        public function getSelectAprSoc() {
        
            $tipo = $this->getApropiacionSocial();
            
            echo "<select id='fkID_evento' name='fkID_evento' class='form-control'>";
                echo "<option></option>";
                for($a=0;$a<sizeof($tipo);$a++){
                    echo "<option value='".$tipo[$a]["pkID"]."' data-puntaje='".$tipo[$a]["puntaje"]."'>".$tipo[$a]["nombre"]."</option>";
                }
            echo "</select>";
        }


		public function getTablaApropiacionS(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $apropiacionS_campos = [                   
                    ["nombre"=>"nombre"],
                    ["nombre"=>"nom_lugar"],
                    ["nombre"=>"fecha_inicial"],
                    ["nombre"=>"fecha_final"]
                ];
                //la configuracion de los botones de opciones
                $apropiacionS_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"apropiacionS",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"apropiacionS",
                        "permiso"=>$elimina,
                     ],
                     [
                        "tipo"=>"descarga_multiple",
                        "nombre"=>"apropiacionS",                        
                     ]

                ];

                $array_opciones = [
                  "modulo"=>"apropiacionS",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_apropiacionS.php?id_apropiacionS=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $apropiacionS = $this->getApropiacionS();


            //Instancia el render
            $this->table_inst = new RenderTable($apropiacionS,$apropiacionS_campos,$apropiacionS_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($apropiacionS) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($apropiacionS) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }


        public function getDataApropiacionSGen($pkID){

            $this->apropiacionSId = $this->getAproS($pkID);    
            
            /**/
            echo '
                  <div class="col-sm-12">

                    <div class="col-sm-6">

                        <strong>Nombre: </strong> '.$this->apropiacionSId[0]["nombre"].' <br> <br>
                        <strong>Lugar: </strong> '.$this->apropiacionSId[0]["nom_lugar"].' <br> <br>
                        <strong>Fecha de Inicio: </strong> '.$this->apropiacionSId[0]["fecha_inicial"].' <br> <br>
                        <strong>Fecha Final: </strong> '.$this->apropiacionSId[0]["fecha_final"].' <br> <br>
                        <strong>Número de Horas: </strong> '.$this->apropiacionSId[0]["numero_horas"].' <br> <br>
                        <strong>Número Total de Estudiantes: </strong> '.$this->apropiacionSId[0]["num_total_estudiantes"].' <br> <br>
                        
                       
                        
                        ';                  

            echo    '</div>

                    <div class="col-sm-6">

                         
                        <strong>Número de Docentes: </strong> '.$this->apropiacionSId[0]["num_docentes"].' <br> <br>
                        <strong>Número Total de Otros Participantes: </strong> '.$this->apropiacionSId[0]["otros_participantes"].' <br> <br>
                        <strong>Número Total de Participantes: </strong> '.$this->apropiacionSId[0]["num_total_participantes"].' <br> <br>
                        <strong>Tipo de Apropiación Social: </strong> '.$this->apropiacionSId[0]["nom_tipo"].' <br> <br>                        
                        <strong>Coordinador: </strong> '.$this->apropiacionSId[0]["coordinador"].'<br> <br>
                        <strong>Temática: </strong> '.$this->apropiacionSId[0]["nom_tematica"].' <br> <br>
                        
                    </div>
            ';

            echo '</div>';
            
        }

        //--------------------------------------------------------------------

        //--------------------------------------------------------------------		
	}
?>
