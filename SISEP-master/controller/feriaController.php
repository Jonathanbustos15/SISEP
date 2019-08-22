<?php
/**/
    include_once '../DAO/feriaDAO.php';
    include_once 'helper_controller/render_table.php';
        
        
    class feriaController extends feriaDAO{
        
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


        public function getDataFeriaGen($pkID)
    {

        $this->feriaId = $this->getFeriaId($pkID);
        //print_r($this->gruposId);

        echo '<div class="col-sm-1 ">
        </div>
        <div class="col-sm-5 align-center">
                <div class="form-group " hidden>                     
                            <input type="text" class="form-control" id="fkID_grupo" name="fkID_grupo" value='.$this->feriaId[0]["fkID_grupo"].'>
                        </div>
              <strong>Fecha de la Feria: </strong> ' . $this->feriaId[0]["fecha_feria"] . ' <br> <br>
              <strong>Tipo de Feria: </strong> ' . $this->feriaId[0]["nombre"] . ' <br> <br>
              <strong>Lugar de la Feria:</strong> ' . $this->feriaId[0]["lugar_feria"] . ' <br> <br>
              <strong>Numero de participantes: </strong> ' . $this->feriaId[0]["canti"] . ' <br> <br>
              
                </div>
        <div class="col-sm-5 align-center"> 
                <div class="form-group " hidden>                     
                            <input type="text" class="form-control" id="fkID_grupo" name="fkID_grupo" value='.$this->feriaId[0]["fkID_grupo"].'>
                        </div>
              <strong>Informe de la Feria:</strong><br> <br><a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class=""  target="_blank" ><span> <img  src="../img/pdfdescargable.png"></span></a>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class="" href = "../server/php/files/'.$this->feriaId[0]["url_documento"].'" target="_blank" >'.$this->feriaId[0]["url_documento"].'</a><br><br>
              <strong>Lista de Asistencia de la Feria:</strong><br> <br><a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class=""  target="_blank" ><span> <img  src="../img/pdfdescargable.png"></span></a>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class="" href = "../server/php/files/'.$this->feriaId[0]["url_lista"].'" target="_blank" >'.$this->feriaId[0]["url_lista"].'</a><br><br>
              
                </div>';
    
              

    }


    public function getTablasesione($pkID_sesion)
    {

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //la configuracion de los botones de opciones
                $sesion_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"sesion",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"sesion",
                        "permiso"=>$elimina,
                     ]
                ];

        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $sesion_campos = [
            ["nombre" => "fecha_sesion"],
            ["nombre" => "descripcion_sesion"],
            ["nombre" => "url_lista"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $sesion = $this->getsesiones($pkID_sesion);    
        //print_r($feria);

        //Instancia el render
        $this->table_inst = new RenderTable($sesion, $sesion_campos, $sesion_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($sesion) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($sesion) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------
    }

    public function getTablasesiones($pkID_sesion)
    {

        //$sesion = $this->getsesiones($pkID_sesion); 
        $this->sesion = $this->getsesiones($pkID_sesion);
        //print_r($this->personal);

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        if (($this->sesion)) {

            for ($a = 0; $a < sizeof($this->sesion); $a++) {
                $id              = $this->sesion[$a]["pkID"];
                $fecha_sesion    = $this->sesion[$a]["fecha_sesion"];
                $descripcion = $this->sesion[$a]["descripcion_sesion"];
                $url_lista       = $this->sesion[$a]["url_lista"];

                echo '   
                             <tr>

                                 <td title="Click Ver Detalles" href="" class="detail">' . $fecha_sesion . '</td>
                                 <td title="Click Ver Detalles" href="" class="detail">' . $descripcion . '</td>
                                 <td title="Descargar Archivo"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class="" href = "../server/php/files/'.$url_lista.'" target="_blank" >'.$url_lista.'</a></td>
                                 <td>
                                     <button id="edita_sesion" title="Editar" name="edita_sesion" type="button" class="btn btn-warning" data-toggle="modal" data-target="#frm_modal_sesion" data-id-sesion = "' . $id . '" ';echo '><span class="glyphicon glyphicon-pencil"></span></button>

                                     <button id="btn_elimina_sesion" title="Eliminar" name="elimina_sesion" type="button" class="btn btn-danger" data-id-sesion = "' . $id . '" ';echo '><span class="glyphicon glyphicon-remove"></span></button>
                                 </td>
                             </tr>';
            };

        } 
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

        public function getSelectAnioFiltro()
    {

        $tipo = $this->getAnio();

        echo '<select name="anio_filtrof" id="anio_filtrof" class="form-control" required = "true">
                        <option value="" selected>Todos</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectTipoFeriaFiltro()
    {

        $tipo = $this->getTipoFeria();

        echo '<select name="tipo_filtrof" id="tipo_filtrof" class="form-control" required = "true">
                        <option value="" selected>Todos</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getTablaParticipantesFeria($pkID_Feria)
    { 

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

        //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita    = $arrPermisos[0]["editar"];
        $elimina  = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];

        //la configuracion de los botones de opciones
        $feria_btn = [

            [
                "tipo"    => "eliminar",
                "nombre"  => "asignar_participante",
                "permiso" => $elimina,
            ],

        ];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $feria_campos = [
            ["nombre" => "nombre"],
            ["nombre" => "apellido"],
            ["nombre" => "documento_participante"],
            ["nombre" => "telefono_participante"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $feria = $this->getParticipantesFeria($pkID_Feria);    
        //print_r($feria);

        //Instancia el render
        $this->table_inst = new RenderTable($feria, $feria_campos, $feria_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($feria) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($feria) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------
    }

    public function getSelectParticipante()
    {

        $tipo = $this->getAsignacionParticipantes();

        echo '<select name="fkID_participante" id="fkID_participante" class="form-control" required = "true">
                        <option value="" selected>Elija el Participante</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
        echo "<option id='fkID_participante_form_' data-nombre='" . $tipo[$a]["nombre"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
         }
        echo "</select>";
    }

    public function getSelectAlbumFeria($pkID_feria)
    {

        $album = $this->getAlbumFeria($pkID_feria);

        if ($album[0]["pkID"]!="") {
            for ($a = 0; $a < sizeof($album); $a++) {
        $fotos = $this->getFotosFeria($album[$a]["pkID"]); 
        if ($fotos[0]["pkID"]=="") {
                 echo '<div class="col-md-2 text-center">
                                <button id="edita_album" title="Editar" name="edita_album" type="button" class="btn btn-warning" data-toggle="modal" data-target="#frm_modal_album_feria" data-id-album = "' . $album[$a]["pkID"] . '" ';
                    echo '><span class="glyphicon glyphicon-pencil"></span></button>
                     <button id="btn_elimina_album" title="Eliminar" name="elimina_album" type="button" class="btn btn-danger" data-id-album = "' . $album[$a]["pkID"] . '" ';
                     echo '><span class="glyphicon glyphicon-remove"></span></button>
                     <a title="album" href="fotos_album_feria.php?id_album='.$album[$a]["pkID"].'">
                               <img data-album="' . $album[$a]["pkID"] . '" class="img-responsive img-thumbnail" src="../img/sin_foto.png" style=" width: 150px; height: 130px"></a>
                              <label class="text-center">'.$album[$a]["nombre_album"].'    </label>
                              
                        </div>';
             } else {
                 echo '<div class="col-md-2 text-center">
                 <button id="edita_album" title="Editar" name="edita_album" type="button" class="btn btn-warning" data-toggle="modal" data-target="#frm_modal_album_feria" data-id-album = "' . $album[$a]["pkID"] . '" ';
                    echo '><span class="glyphicon glyphicon-pencil"></span></button>
                     <button id="btn_elimina_album" title="Eliminar" name="elimina_album" type="button" class="btn btn-danger" data-id-album = "' . $album[$a]["pkID"] . '" ';
                      echo '><span class="glyphicon glyphicon-remove"></span></button>
                        <a title="album" href="fotos_album_feria.php?id_album='.$album[$a]["pkID"].'" >
                               <img data-album="' . $album[$a]["pkID"] . '" class="img-responsive img-thumbnail" src="../img/'.$fotos[0]["url_foto"].'" style=" width: 150px; height: 130px"></a>
                              <label class="text-center">'.$album[$a]["nombre_album"].'  </label>
                        </div>';
             }
         }
        } else {
            echo '<div class="col-md-12 text-center">
            <h3>No Existen Álbumes</h3>
            </div>';
        }
    }

    public function getSelectTotal($filtro,$pkID_proyectoM,$filtro2)
    {

        $m_u_Select = $this->getTotalEstudiantes($filtro,$pkID_proyectoM,$filtro2);

        echo '<span class="input-group-addon">#</span>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<input type="text" class="form-control" id="total_estudiantes" name="total_estudiantes" readonly="true" value='. $m_u_Select[$i]["cantidad"].'>';
        }
    }

    public function getSelectTipoFeria() {
        
            $tipo = $this->getTipoFeria();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }




        public function getTablaFeria($pkID_proyectoM,$filtro,$filtro2){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $Feria_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"fecha_feria"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"lugar_feria"],
                    ["nombre"=>"canti"],
                ];
                //la configuracion de los botones de opciones
                $Feria_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"feria",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"feria",
                        "permiso"=>$elimina,
                     ]
                ];

                $array_opciones = [ 
                    "modulo" => "Feria", //nombre del modulo definido para jquerycontrollerV2
                    "title"  => "Click Ver Detalles", //etiqueta html title
                    "href"   => "detalle_feria.php?id_Feria=",
                    "class"  => "detail", //clase que permite que añadir el evento jquery click
                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $Feria = $this->getFeria($pkID_proyectoM,$filtro,$filtro2);


            //Instancia el render
            $this->table_inst = new RenderTable($Feria,$Feria_campos,$Feria_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($Feria) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($Feria) && ($consulta==0)){

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
