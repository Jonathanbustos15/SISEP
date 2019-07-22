<?php
/**/

include_once '../DAO/anuarioDAO.php';
include_once 'helper_controller/render_table.php';

class anuarioController extends anuarioDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $id_modulo_estudiantes;
    public $id_modulo_docentes;
    public $table_inst;
    public $gruposId;

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

    public function getTablaAnuario($filtro, $pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "anio"],
            ["nombre" => "url_documento"],
        ];
        //la configuracion de los botones de opciones
        $grupo_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "anuario",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "anuario",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [
            "modulo" => "anuario", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        if ($filtro == "'Todos'") {
            $grupo = $this->getAnuarios($pkID_proyectoM);
        } else {
            $grupo = $this->getAnuario($filtro, $pkID_proyectoM);
        }

        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablaGruposUsuario($pkID_user)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "nom_tipo"],
            ["nombre" => "fecha_creacion"],
            ["nombre" => "nom_institucion"],
            ["nombre" => "nom_grado"],
        ];
        //la configuracion de los botones de opciones
        $grupo_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "grupo",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "grupo",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [
            "modulo" => "grupo", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "detalles_grupo.php?id_acompanamiento=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getAnuariosUsuario($pkID_user);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

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

    public function getSelectAsesores()
    {
        $tipo = $this->getTutor();

        echo '<select name="fkID_asesor" id="fkID_asesor" class="form-control" required = "true">
                        <option value="" selected>Elija el asesor</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_participante_form_' data-nombre='" . $tipo[$a]["nombres"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombres"] . "</option>";
        }
        echo "</select>";
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

    public function getSelectAnioFiltro()
    {

        $tipo = $this->getAnio();

        echo '<select name="anio_filtro" id="anio_filtro" class="form-control" required = "true">
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

    public function getSelectTipoGrupos()
    {

        $tipo = $this->getTipoGrupo();

        echo '<select name="fkID_tipo_grupo" id="fkID_tipo_grupo" class="form-control" required = "true">
                        <option value="" selected>Elija el Tipo de Grupo</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectTutor()
    {

        $tipo = $this->getTutor();

        echo '<select name="fkID_tutor" id="fkID_tutor" class="form-control" required = "true">
                        <option value="" selected>Elija el Tutor del Grupo</option>';
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

    public function getGeneral($pkID)
    {

        $this->gruposId = $this->getAnuariosId($pkID);

        //print_r($this->gruposId);

        echo '<div class="col-sm-6">

                <div class="text-center">
                  <img src="../server/php/files/' . $this->gruposId[0]["url_logo"] . '" alt="..." height="250" width="250" class="img-thumbnail">
                </div>

              </div>

            <div class="col-sm-6">

              <strong>Fecha resignificación: </strong> ' . $this->gruposId[0]["fecha"] . ' <br> <br>
              <strong>Descripción: </strong> ' . $this->gruposId[0]["descripcion"] . ' <br> <br>
              <strong>Institución Educativa: </strong> ' . $this->gruposId[0]["nombre_institucion"] . ' </a><br> <br>
              <strong>Asesor: </strong> ' . $this->gruposId[0]["asesor"] . ' <br> <br>
              ';

        echo '</div>';

    }

    public function getDataProyectoGen($pkID)
    {

        $this->grupoId = $this->getproyectoId($pkID);

        //print_r($this->gruposId);
        if ($this->grupoId[0]["linea_investigacion"] == "") {
            echo '<div class="col-md-12 text-center">
                             <button id="btn_crearproyectogrupo" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="" data-target="#frm_modal_proyecto_grupo" ><span class="glyphicon glyphicon-plus"></span> Crear Proyecto</button>
                          </div>';

        } else if ($this->grupoId[0]["url_documento"] == "" && $this->grupoId[0]["url_bitacora"] == "") {
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
              <strong></strong>' . $this->grupoId[0]["linea_investigacion"] . ' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' . $this->grupoId[0]["pregunta_investigacion"] . '<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>' . $this->grupoId[0]["objetivo_general"] . ' <br> <br>
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
        } else if ($this->grupoId[0]["url_bitacora"] != "" && $this->grupoId[0]["url_documento"] == "") {
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
              <strong></strong>' . $this->grupoId[0]["linea_investigacion"] . ' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' . $this->grupoId[0]["pregunta_investigacion"] . '<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>' . $this->grupoId[0]["objetivo_general"] . ' <br> <br>
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
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value=' . $this->grupoId[0]["url_bitacora"] . ' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' . $this->grupoId[0]["url_bitacora"] . '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmBitacora" id="btn_actionRmBitacora" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>
            ';
            echo '</div>';
        } else if ($this->grupoId[0]["url_bitacora"] == "" && $this->grupoId[0]["url_documento"] != "") {
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
              <strong></strong>' . $this->grupoId[0]["linea_investigacion"] . ' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' . $this->grupoId[0]["pregunta_investigacion"] . '<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>' . $this->grupoId[0]["objetivo_general"] . ' <br> <br>
              </div>
              </div>
              <div  class="col-sm-5 panel panel-primary">
              <label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Documento Técnico</label><br><br>
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value=' . $this->grupoId[0]["url_documento"] . ' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' . $this->grupoId[0]["url_documento"] . '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmDocumento" id="btn_actionRmDocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>

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
        } else {
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
              <strong></strong>' . $this->grupoId[0]["linea_investigacion"] . ' <br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
                <label class="align-center">Pregunta de Investigación:</label><br> <br>
              <strong> </strong>' . $this->grupoId[0]["pregunta_investigacion"] . '<br> <br>
              </div>
        <div class="col-sm-12 panel panel-info">
              <label class="align-center">Objetivo General:</label><br> <br>
              <strong></strong>' . $this->grupoId[0]["objetivo_general"] . ' <br> <br>
              </div>
              </div>
              <div  class="col-sm-5 panel panel-primary">
              <label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Documento Técnico</label><br><br>
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value=' . $this->grupoId[0]["url_documento"] . ' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' . $this->grupoId[0]["url_documento"] . '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmDocumento" id="btn_actionRmDocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>

              </div>

              <div class="col-sm-2">

              </div>
              <div  class="col-sm-5 panel panel-primary">
              <label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Bitacora</label><br><br>
              <input type="text" style="width: 79%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value=' . $this->grupoId[0]["url_bitacora"] . ' readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' . $this->grupoId[0]["url_bitacora"] . '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmBitacora" id="btn_actionRmBitacora" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><br><br><br>
            ';
            echo '</div>';

        }

    }

    public function getTablaGrupoUsuarios($fkID_tipo_usuario, $pkid_acompanamiento)
    {

        //permisos-------------------------------------------------------------------------
        if ($fkID_tipo_usuario == 9) {

            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

            //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita    = $arrPermisos[0]["editar"];
            $elimina  = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];

            //la configuracion de los botones de opciones
            $grupo_btn = [

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
            $grupo_btn = [

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
        $grupo_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "apellido"],
            ["nombre" => "nom_rol"],
            //["nombre"=>"nom_tUsuario"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getGrupoUsuarios($fkID_tipo_usuario, $pkid_acompanamiento);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------

    }

    public function getTablaEstudiantesGrupo($pkid_acompanamiento)
    {

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

        //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita    = $arrPermisos[0]["editar"];
        $elimina  = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];

        //la configuracion de los botones de opciones
        $grupo_btn = [
            [
                "tipo"    => "eliminar",
                "nombre"  => "estudiante",
                "permiso" => $elimina,
            ],

        ];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            ["nombre" => "nombre"],
            ["nombre" => "documento_docente"],
            ["nombre" => "estado_acompanamiento"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getEstudiantesGrupo($pkid_acompanamiento);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------
    }

    public function getTablaEvidencias($pkid_evidencia)
    {

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

        //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita    = $arrPermisos[0]["editar"];
        $elimina  = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];

        //la configuracion de los botones de opciones
        $grupo_btn = [
            [
                "tipo"    => "eliminar",
                "nombre"  => "evidencia",
                "permiso" => $elimina,
            ],

        ];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            ["nombre" => "fecha"],
            ["nombre" => "descripcion"],
            ["nombre" => "url_evidencia"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getEvidencias($pkid_evidencia);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------
    }
    public function getTablaAlbumGrupo($pkid_acompanamiento)
    {

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

        //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita    = $arrPermisos[0]["editar"];
        $elimina  = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];

        //la configuracion de los botones de opciones
        $grupo_btn = [

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
        $grupo_campos = [
            ["nombre" => "nombre_album"],
            ["nombre" => "fecha_creacion_album"],
            ["nombre" => "observacion_album"],
        ];

        $array_opciones = [
            "modulo" => "grupo", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "../gallery/admin/bannerlist.php?id_acompanamiento=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getAlbumGrupo($pkid_acompanamiento);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------

    }

    public function getTablaAsistencia($pkid_acompanamiento)
    {

        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

        //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita    = $arrPermisos[0]["editar"];
        $elimina  = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];

        //la configuracion de los botones de opciones
        $grupo_btn = [

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
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            ["nombre" => "fecha_acompanamiento_asistencia"],
            ["nombre" => "url_asistencia"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getAsistencias($pkid_acompanamiento);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------
    }

    public function getSelectEstado()
    {
        $tipo = $this->getEstado();

        echo '<select name="fkID_estado" id="fkID_estado" class="form-control" required = "true">
                        <option value="" selected>Elija el estado</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_estado_form_' data-nombre='" . $tipo[$a]["estado_acompanamiento"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["estado_acompanamiento"] . "</option>";
        }
        echo "</select>";
    }
}
