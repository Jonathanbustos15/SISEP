<?php
/**/

include_once '../DAO/saberes_propiosDAO.php';
include_once 'helper_controller/render_table.php';

class saberes_propioscontroller extends saberesDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $id_modulo_estudiantes;
    public $id_modulo_docentes;
    public $table_inst;
    public $saberessId;

    public function __construct() 
    {

        include '../conexion/datos.php';

        $this->id_modulo             = 25; //id de la tabla modulos
        $this->id_modulo_estudiantes = 30; //id de la tabla modulos
        $this->id_modulo_docentes    = 26; //id de la tabla modulos
        $this->NameCookieApp         = $NomCookiesApp;

    }

    //Funciones-------------------------------------------
    //Espacio para las funciones de esta clase.

    //permisos---------------------------------------------------------------------
    //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
    //$edita = $arrPermisos[0]["editar"];
    //$elimina = $arrPermisos[0]["eliminar"];
    //$consulta = $arrPermisos[0]["consultar"];
    //-----------------------------------------------------------------------------

    public function getTablasaberes($filtro,$pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $saberes_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "fecha_salida"],
            ["nombre" => "nombre"],
            ["nombre" => "comunidad_visitada"],
            ["nombre" => "canti"],
            ["nombre" => "nombres_funcionario"],
        ];
        //la configuracion de los botones de opciones
        $saberes_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "saber_propio",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "saber_propio",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [ 
            "modulo" => "saber_propio", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "detalle_saber_propio.php?id_saber_propio=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
            $saberes = $this->getSaberes($filtro,$pkID_proyectoM);
        
        //print_r($saberes);

        //Instancia el render
        $this->table_inst = new RenderTable($saberes, $saberes_campos, $saberes_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($saberes) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($saberes) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablaSaberesUsuario($pkID_user)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $saberes_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "nom_tipo"],
            ["nombre" => "fecha_creacion"],
            ["nombre" => "nom_institucion"],
            ["nombre" => "nom_grado"],
        ];
        //la configuracion de los botones de opciones
        $saberes_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "saber_propio",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "saber_propio",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [
            "modulo" => "saber_propio", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "detalle_saber_propio.php?id_saber=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $saberes = $this->getGruposUsuario($pkID_user);
        //print_r($saberes);

        //Instancia el render
        $this->table_inst = new RenderTable($saberes, $saberes_campos, $saberes_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($saberes) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($saberes) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getSelectGrados()
    {

        $m_u_Select = $this->getGrados();

        echo '<select id="fkID_grado" name="fkID_grado" class="form-control" required="true">
                  <option value="" selected>Elija el Grado</option>'
        ;
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '">' . $m_u_Select[$i]["nombre"] . '</option>';
        };
        echo '</select>';
    }

    public function getSelectTotal($filtro,$pkID_proyectoM)
    {

        $m_u_Select = $this->getTotalEstudiantes($filtro,$pkID_proyectoM);

        echo '<span class="input-group-addon">#</span>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<input type="text" class="form-control" id="total_estudiantes" name="total_estudiantes" readonly="true" value='. $m_u_Select[$i]["cantidad"].'>';
        }
    }

    public function getSelectInstituciones()
    {

        $tipo = $this->getInstitu();

        echo '<select name="fkID_institucion" id="fkID_institucion" class="form-control" required = "true">
                        <option value="" selected>Elija la institucion</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre_institucion"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectEstudiantes($pkID_proyectoM)
    {
        $tipo = $this->getEstudiantes($pkID_proyectoM);

        echo '<select name="fkID_estudiantesaber" id="fkID_estudiantesaber" class="form-control" required = "true">
                        <option value="" selected>Elija el estudiante del Grupo</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_estudiante_form_' data-nombre='" . $tipo[$a]["nombres"] . "' data-grado='" . $tipo[$a]["id_grado"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombres"] . "</option>";
        }
        echo "</select>";
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

    public function getSelectTipogrupoFiltro()
    {

        $tipo = $this->getTipogrupo();

        echo '<select name="tipo_filtrog" id="tipo_filtrog" class="form-control" required = "true">
                        <option value="" selected>Todos</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectGrupos()
    {

        $tipo = $this->getGruposParticipante();

        echo '<select name="fkID_grupo" id="fkID_grupo" class="form-control" required = "true">
                        <option value="" selected>Elija el Grupo Paticipante</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }


    public function getSelectAsesor()
    {

        $tipo = $this->getTutor();

        echo '<select name="fkID_asesor" id="fkID_asesor" class="form-control" required = "true">
                        <option value="" selected>Elija el Asesor Acompañante</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_tutor_form_' data-nombre='" . $tipo[$a]["nombres"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombres"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectDocente()
    {

        $tipo = $this->getDocente();

        echo '<select name="fkID_docente" id="fkID_docente" class="form-control" required = "true">
                        <option value="" selected>Elija el Docente del Grupo</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_docente_form_' data-nombre='" . $tipo[$a]["nombres"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombres"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectRoles($pkID_tipo)
    {

        $tipo = $this->getRoles($pkID_tipo);

        echo "<select name='fkID_rol' id='fkID_rol' class='form-control' required='true'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectDocentesGrado($pkID_grado)
    {

        $tipo = $this->getDocentesGrado($pkID_grado);

        echo "<select name='fkID_usuario' id='fkID_usuario' class='form-control'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . " " . $tipo[$a]["apellido"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectGradoUsuarios($pkID_grado, $pkID_institucion)
    {

        $m_u_Select = $this->getGradoUsuarios($pkID_grado, $pkID_institucion);

        echo '<select id="fkID_usuario" name="fkID_usuario" class="form-control" required="true">
                  <option></option>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '">' . $m_u_Select[$i]["nombre"] . " " . $m_u_Select[$i]["apellido"] . '</option>';
        };
        echo '</select>';
    }

    public function getDataSaberesGen($pkID)
    {

        $this->saberesId = $this->getSaberesId($pkID);

        //print_r($this->gruposId);

        echo '<div class="col-sm-6">

                <div class="text-center">
                  <img src="../server/php/files/' . $this->saberesId[0]["url_logo"] . '" alt="..." height="250" width="250" class="img-thumbnail">
                </div>

              </div>

            <div class="col-sm-6"> 
                <div class="form-group " hidden>                     
                            <input type="text" class="form-control" id="fkID_grupo" name="fkID_grupo" value='.$this->saberesid[0]["fkID_grupo"].'>
                        </div>
              <strong>Fecha de Salida: </strong> ' . $this->saberesId[0]["fecha_salida"] . ' <br> <br>
              <strong>Grupo: </strong> ' . $this->saberesId[0]["nombre"] . ' <br> <br>
              <strong>Comunidad Visitada: </strong> ' . $this->saberesId[0]["comunidad_visitada"] . ' <br> <br>
              <strong>Numero de participantes: </strong> ' . $this->saberesId[0]["canti"] . ' <br> <br>
              <strong>Asesor Asignado: </strong> ' . $this->saberesId[0]["nombres_funcionario"] . ' <br> <br>
            <div  class="">
            <label class="align-center">Lista de Asistencia:</label><br><br>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class=""  target="_blank" ><span> <img  src="../img/pdfdescargable.png"></span></a>
              <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="text" class="" href = "../server/php/files/'.$this->saberesId[0]["url_lista"].'" target="_blank" >'.$this->saberesId[0]["url_lista"].'</a><br><br><br>
              </div>
              ';

        echo '</div>';

    }

    public function getDataProyectoGen($pkID)
    {

        $this->grupoId = $this->getproyectoId($pkID);

        //print_r($this->gruposId);
        if ($this->grupoId[0]["linea_investigacion"]=="") {
            echo'<div class="col-md-12 text-center">
                             <button id="btn_crearproyectogrupo" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="" data-target="#frm_modal_proyecto_grupo" ><span class="glyphicon glyphicon-plus"></span> Crear Proyecto</button>
                          </div>';
            
        } else if ($this->grupoId[0]["url_documento"]=="" && $this->grupoId[0]["url_bitacora"]=="") {
            echo '<div class="panel panel-default proc-pan-def3">

                    <div class="titulohead">

                        <div class="row">
                          <div class="col-md-6">
                              <div class="titleprincipal"><h4>Proyecto de Grupo </h4></div>
                          </div>
                          <div class="col-md-6 text-right">
                             <button id="btn_editar_proyecto" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="" data-target="#frm_modal_proyecto_grupo" ><span class="glyphicon glyphicon-pencil"></span> Editar Proyecto</button>
                             <button id="btn_eliminar_proyecto" type="button" class="btn btn-danger" data-toggle="modal"  data-grupo="" data-target="" ><span class="glyphicon glyphicon-remove"></span> Eliminar proyecto</button>
                          </div>
                        </div>

                    </div>
                 </div>   


        <div class="col-sm-12 panel panel-primary">
                <label class="align-center">Datos Generales</label><br> <br>

        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Linea de Investigación: </label><br> <br>
              <strong></strong>' .$this->grupoId[0]["linea_investigacion"].' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' .$this->grupoId[0]["pregunta_investigacion"].'<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>'.$this->grupoId[0]["objetivo_general"].' <br> <br>
              </div>
              </div> 
              <div class="col-sm-1 panel panel-primary"><br>
                <img  src="../img/pdf.png"><br><br><br>
              </div>
              <div class="col-sm-4 panel panel-primary">
                <label >Documento Técnico</label><br> <br>
                <form action="" class="dropzone">
                  <div class="fallback">
                    <input id="file_documento" name="file_documento" class="file-loading" type="file" multiple />
                  </div><br>
                  <button id="btn_documentotecnico" type="button" class="btn btn-success align-center"  ><span class="glyphicon glyphicon-upload"></span> Guardar archivo</button>
                </form><br>
              </div>

              <div class="col-sm-2">
                
              </div>
              <div class="col-sm-1 panel panel-primary"><br>
                <img  src="../img/pdf.png"><br><br><br>
              </div>

            <div class="col-sm-4 panel panel-primary">
                <label class="align-center">Bitácora</label><br> <br>
                <form action="" class="dropzone">
                  <div class="fallback">
                    <input id="file_bitacora" name="file_bitacora" type="file" multiple />
                  </div><br>
                <button id="btn_bitacora" type="button" class="btn btn-success"  ><span class="glyphicon glyphicon-upload"></span> Guardar archivo</button>
                </form><br>
            ';
        echo '</div>';
        } else if($this->grupoId[0]["url_bitacora"]!="" && $this->grupoId[0]["url_documento"]=="") {
            echo '<div class="panel panel-default proc-pan-def3">

                    <div class="titulohead">

                        <div class="row">
                          <div class="col-md-6">
                              <div class="titleprincipal"><h4>Proyecto de Grupo </h4></div>
                          </div>
                          <div class="col-md-6 text-right">
                             <button id="btn_editar_proyecto" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="" data-target="#frm_modal_proyecto_grupo" ><span class="glyphicon glyphicon-pencil"></span> Editar Proyecto</button>
                             <button id="btn_eliminar_proyecto" type="button" class="btn btn-danger" data-toggle="modal"  data-grupo="" data-target="" ><span class="glyphicon glyphicon-remove"></span> Eliminar proyecto</button>
                          </div>
                        </div>

                    </div>
                 </div>   


        <div class="col-sm-12 panel panel-primary">
                <label class="align-center">Datos Generales</label><br> <br>

        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Linea de Investigación: </label><br> <br>
              <strong></strong>' .$this->grupoId[0]["linea_investigacion"].' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' .$this->grupoId[0]["pregunta_investigacion"].'<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>'.$this->grupoId[0]["objetivo_general"].' <br> <br>
              </div>
              </div> 
              
              <div class="col-sm-1 panel panel-primary"><br>
                <img  src="../img/pdf.png"><br><br><br>
              </div>
            <div class="col-sm-4 panel panel-primary">
                <label class="align-center">Documento Técnico</label><br> <br>
                <form action="" class="dropzone">
                  <div class="fallback">
                    <input id="file_documento" name="file_documento" type="file" multiple />
                  </div><br>
                <button id="btn_documento" type="button" class="btn btn-success"  ><span class="glyphicon glyphicon-upload"></span> Guardar archivo</button>
                </form><br>
              </div>

              <div class="col-sm-2">
                
              </div>
                <div  class="col-sm-5 panel panel-primary">
              <label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Bitacora</label><br><br>
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value='.$this->grupoId[0]["url_bitacora"].' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/'.$this->grupoId[0]["url_bitacora"].'" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmBitacora" id="btn_actionRmBitacora" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>
            ';
        echo '</div>';
        }else if ($this->grupoId[0]["url_bitacora"]=="" && $this->grupoId[0]["url_documento"]!="") {
            echo '<div class="panel panel-default proc-pan-def3">

                    <div class="titulohead">

                        <div class="row">
                          <div class="col-md-6">
                              <div class="titleprincipal"><h4>Proyecto de Grupo </h4></div>
                          </div>
                          <div class="col-md-6 text-right">
                             <button id="btn_editar_proyecto" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="" data-target="#frm_modal_proyecto_grupo" ><span class="glyphicon glyphicon-pencil"></span> Editar Proyecto</button>
                             <button id="btn_eliminar_proyecto" type="button" class="btn btn-danger" data-toggle="modal"  data-grupo="" data-target="" ><span class="glyphicon glyphicon-remove"></span> Eliminar proyecto</button>
                          </div>
                        </div>

                    </div>
                 </div>   


        <div class="col-sm-12 panel panel-primary">
                <label class="align-center">Datos Generales</label><br> <br>

        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Linea de Investigación: </label><br> <br>
              <strong></strong>' .$this->grupoId[0]["linea_investigacion"].' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' .$this->grupoId[0]["pregunta_investigacion"].'<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>'.$this->grupoId[0]["objetivo_general"].' <br> <br>
              </div>
              </div> 
              <div  class="col-sm-5 panel panel-primary">
              <label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Documento Técnico</label><br><br>
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value='.$this->grupoId[0]["url_documento"].' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/'.$this->grupoId[0]["url_documento"].'" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmDocumento" id="btn_actionRmDocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>

              </div>

              <div class="col-sm-2">
                
              </div>
              
              <div class="col-sm-1 panel panel-primary"><br>
                <img  src="../img/pdf.png"><br><br><br>
              </div>
            <div class="col-sm-4 panel panel-primary">
                <label class="align-center">Bitácora</label><br> <br>
                <form action="" class="dropzone">
                  <div class="fallback">
                    <input id="file_bitacora" name="file_bitacora" type="file" multiple />
                  </div><br>
                <button id="btn_bitacora" type="button" class="btn btn-success"  ><span class="glyphicon glyphicon-upload"></span> Guardar archivo</button>
                </form><br>
            ';
        echo '</div>';
        }else{
            echo '<div class="panel panel-default proc-pan-def3">

                    <div class="titulohead">

                        <div class="row">
                          <div class="col-md-6">
                              <div class="titleprincipal"><h4>Proyecto de Grupo </h4></div>
                          </div>
                          <div class="col-md-6 text-right">
                             <button id="btn_editar_proyecto" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="" data-target="#frm_modal_proyecto_grupo" ><span class="glyphicon glyphicon-pencil"></span> Editar Proyecto</button>
                             <button id="btn_eliminar_proyecto" type="button" class="btn btn-danger" data-toggle="modal"  data-grupo="" data-target="" ><span class="glyphicon glyphicon-remove"></span> Eliminar proyecto</button>
                          </div>
                        </div>

                    </div>
                 </div>   


        <div class="col-sm-12 panel panel-primary">
                <label class="align-center">Datos Generales</label><br> <br>

        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Linea de Investigación: </label><br> <br>
              <strong></strong>' .$this->grupoId[0]["linea_investigacion"].' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' .$this->grupoId[0]["pregunta_investigacion"].'<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>'.$this->grupoId[0]["objetivo_general"].' <br> <br>
              </div>
              </div> 
              <div  class="col-sm-5 panel panel-primary">
              <label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Documento Técnico</label><br><br>
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value='.$this->grupoId[0]["url_documento"].' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/'.$this->grupoId[0]["url_documento"].'" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmDocumento" id="btn_actionRmDocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>

              </div>

              <div class="col-sm-2">
                
              </div>
              <div  class="col-sm-5 panel panel-primary">
              <label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Bitacora</label><br><br>
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value='.$this->grupoId[0]["url_bitacora"].' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/'.$this->grupoId[0]["url_bitacora"].'" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmBitacora" id="btn_actionRmBitacora" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>
            ';
        echo '</div>';

        }
        

    }

    public function getTablaGrupoUsuarios($fkID_tipo_usuario, $pkID_saber)
    {

        //permisos-------------------------------------------------------------------------
        if ($fkID_tipo_usuario == 9) {

            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

            //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita    = $arrPermisos[0]["editar"];
            $elimina  = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];

            //la configuracion de los botones de opciones
            $saberes_btn = [

                [
                    "tipo"    => "editar",
                    "nombre"  => "estudiante",
                    "permiso" => $edita,
                ],
                [
                    "tipo"    => "eliminar",
                    "nombre"  => "estudiante",
                    "permiso" => $elimina,
                ],

            ];

        } else if ($fkID_tipo_usuario == 8) {

            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_docentes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

            //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita    = $arrPermisos[0]["editar"];
            $elimina  = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];

            //la configuracion de los botones de opciones
            $saberes_btn = [

                [
                    "tipo"    => "editar",
                    "nombre"  => "docente",
                    "permiso" => $edita,
                ],
                [
                    "tipo"    => "eliminar",
                    "nombre"  => "docente",
                    "permiso" => $elimina,
                ],
                [
                    "tipo"   => "descarga_multiple",
                    "nombre" => "docente",
                ],

            ];
        }

        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $saberes_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "apellido"],
            ["nombre" => "nom_rol"],
            //["nombre"=>"nom_tUsuario"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $saberes = $this->getGrupoUsuarios($fkID_tipo_usuario, $pkID_saber);
        //print_r($saberes);

        //Instancia el render
        $this->table_inst = new RenderTable($saberes, $saberes_campos, $saberes_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($saberes) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($saberes) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------

    }

    public function getTablaEstudiantesSaberes($pkID_saber)
    {

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

        //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita    = $arrPermisos[0]["editar"];
        $elimina  = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];

        //la configuracion de los botones de opciones
        $saberes_btn = [

            [
                "tipo"    => "eliminar",
                "nombre"  => "estudiante_saber_propio",
                "permiso" => $elimina,
            ],

        ];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $saberes_campos = [
            ["nombre" => "nombre"],
            ["nombre" => "apellido"],
            ["nombre" => "documento_estudiante"],
            ["nombre" => "nombre_grado"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $saberes = $this->getEstudiantesSaberes($pkID_saber);    
        //print_r($saberes);

        //Instancia el render
        $this->table_inst = new RenderTable($saberes, $saberes_campos, $saberes_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($saberes) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($saberes) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------
    }

    public function getTablaAlbumGrupo($pkID_saber)
    {

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

        //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita    = $arrPermisos[0]["editar"];
        $elimina  = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];

        //la configuracion de los botones de opciones
        $saberes_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "album_grupo",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "album_grupo",
                "permiso" => $elimina,
            ],

        ];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $saberes_campos = [
            ["nombre" => "nombre_album"],
            ["nombre" => "fecha_creacion_album"],
            ["nombre" => "observacion_album"],
        ];

        $array_opciones = [
            "modulo" => "grupo", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "../gallery/admin/bannerlist.php?id_grupo=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $saberes = $this->getAlbumGrupo($pkID_saber);
        //print_r($saberes);

        //Instancia el render
        $this->table_inst = new RenderTable($saberes, $saberes_campos, $saberes_btn,$array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($saberes) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($saberes) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------

    }
}