<?php
/**/
    include_once '../DAO/talleresDAO.php';
    include_once 'helper_controller/render_table.php';
        
        
    class talleresController extends tallerDAO{
        
        public $NameCookieApp;
        public $id_modulo;
        public $table_inst;
        
        
        public function __construct() {
            
            include('../conexion/datos.php');
            
            $this->id_modulo = 18; //id de la tabla modulos
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
        public function getSelectTipoTaller() {
        
            $tipo = $this->getTipoTaller();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }

        public function getDataTallerGen($pkID)
    {

        $this->talleresId = $this->getSaberesId($pkID);

        //print_r($this->gruposId);

        echo '<div class="col-sm-6">
                <div class="form-group " hidden>                     
                            <input type="text" class="form-control" id="fkID_grupo" name="fkID_grupo" value='.$this->talleresId[0]["fkID_grupo"].'>
                        </div>
              <strong>Fecha del Taller: </strong> ' . $this->talleresId[0]["fecha_salida"] . ' <br> <br>
              <strong>Tipo de Taller: </strong> ' . $this->talleresId[0]["nombre"] . ' <br> <br>
              <strong>Descripción: </strong> ' . $this->talleresId[0]["comunidad_visitada"] . ' <br> <br>
              <strong>Numero de participantes: </strong> ' . $this->talleresId[0]["canti"] . ' <br> <br>
              <strong>Asesor Asignado: </strong> ' . $this->talleresId[0]["nombres_funcionario"] . ' <br> <br>
                </div>
            <div class="col-sm-6"> 
                
            <div  class="">
            <label class="align-center">Documento Taller de Formación:</label><br><br>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class=""  target="_blank" ><span> <img  src="../img/pdfdescargable.png"></span></a>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class="" href = "../server/php/files/'.$this->talleresId[0]["url_documento"].'" target="_blank" >'.$this->talleresId[0]["url_documento"].'</a><br><br><br>
              </div>
              <div  class="">
            <label class="align-center">Lista de Asistencia:</label><br><br>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class=""  target="_blank" ><span> <img  src="../img/pdfdescargable.png"></span></a>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class="" href = "../server/php/files/'.$this->talleresId[0]["url_lista"].'" target="_blank" >'.$this->talleresId[0]["url_lista"].'</a><br><br><br>
              </div>
              ';

        echo '</div>';

    }

    




        public function getSelectTutor() {
        
            $tipo = $this->getTutor();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }

        public function getSelectDepartamentos() {
        
            $tipo = $this->getDepartamentos();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }

        public function getSelectMunicipios() {
        
            $tipo = $this->getMunicipios();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }

        public function getSelectAnioFiltro()
    {

        $tipo = $this->getAnio();

        echo '<select name="anio_filtrog" id="anio_filtrog" class="form-control" required = "true">
                        <option value="" selected>Todos</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }




        public function getTablaTaller(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $taller_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"fecha_taller"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"descripcion"],
                    ["nombre"=>"canti"],
                    ["nombre"=>"nombres_funcionario"]
                ];
                //la configuracion de los botones de opciones
                $taller_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"taller",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"taller",
                        "permiso"=>$elimina,
                     ]
                ];

                $array_opciones = [ 
                    "modulo" => "taller_formacion", //nombre del modulo definido para jquerycontrollerV2
                    "title"  => "Click Ver Detalles", //etiqueta html title
                    "href"   => "detalle_taller_formacion.php?id_taller_formacion=",
                    "class"  => "detail", //clase que permite que añadir el evento jquery click
                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $taller = $this->getTalleres();


            //Instancia el render
            $this->table_inst = new RenderTable($taller,$taller_campos,$taller_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($taller) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($taller) && ($consulta==0)){

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
