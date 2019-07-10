<?php

include_once '../DAO/talento_humanoDAO.php';
include_once 'helper_controller/render_table.php';

class talento_humanoController extends talento_humanoDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $table_inst;
    public $proyectoMId;

    public function __construct()
    {

        include '../conexion/datos.php';

        $this->id_modulo     = 15; //id de la tabla modulos
        $this->NameCookieApp = $NomCookiesApp;

    }

    //Funciones-------------------------------------------
    //Espacio para las funciones de esta clase.

    public function getTablaFuncionarioCargo($pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $proyectosM_campos = [
            ["nombre" => "nombre_funcionario"],
            ["nombre" => "apellido_funcionario"],
            ["nombre" => "nombre_cargo"],
            ["nombre" => "anio_funcionario_cargo"],
            ["nombre" => "estado_funcionario_cargo"],
        ];
        //la configuracion de los botones de opciones
        $proyectosM_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "proyectoM",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "proyectoM",
                "permiso" => $elimina,
            ],

        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $proyectoM = $this->getFuncionariosCargo($pkID_proyectoM);

        //print_r($proyectoM);
        //Instancia el render
        $this->table_inst = new RenderTable($proyectoM, $proyectosM_campos, $proyectosM_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($proyectoM) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($proyectoM) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    //funcion para renderizar cuadros de proyectos marco

    public function renderPortletsProyectoM()
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $proyectoM = $this->getProyectosMarco($_COOKIE[$this->NameCookieApp . "_id"]);
        //print_r($proyectoM);

        //render portlet

        //echo '';
        /**/
        if ($proyectoM) {

            function getNombreProyM($nom, $num_max)
            {

                $nombre = '';

                $len_nomProyectoM = strlen($nom);

                if ($len_nomProyectoM > $num_max) {
                    $nombre = substr($nom, 0, $num_max) . '...';
                } else {
                    $nombre = $nom;
                }

                return $nombre;
            }

            foreach ($proyectoM as $key => $value) {
                //print_r($value["nombre"]);

                echo '<!-- BEGIN Portlet PORTLET-->
                            <div class="col-md-4">

                                <div class="portlet box blue-hoki ">

                                    <div class="portlet-title">

                                        <div class="col-md-6">
                                          <div class="caption">
                                              <h4><i class="fa fa-folder-open"><span class="titleprincipal"  title="' . $value["nombre"] . '" style="cursor: default;"> ' . getNombreProyM($value["nombre"], 12) . '</span></i></h4>
                                          </div>
                                        </div>

                                      <div class="col-md-4">
                                        <a href="detalles_proyectoM.php?id_proyectoM=' . $value["pkID"] . '&nom_proyectoM=' . $value["nombre"] . '" class="btn boton-proy" title="' . $value["nombre"] . '"> <span class="fa fa-pencil"></span> Ir a ' . getNombreProyM($value["nombre"], 12) . ' </a>
                                      </div>

                                    </div>
                                    <!--./portlet-title -->

                                    <div class="portlet-body-2">

                                      <div class="slimScrollDiv">

                                        <div class="scroller scll_body_2" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd" data-initialized="1">

                                          <!--./data -->
                                          <br><strong title="' . $value["nombre"] . '" style="cursor: default;">&nbsp;&nbsp;Nombre: </strong>' . getNombreProyM($value["nombre"], 40) . '<hr>
                                          <strong>&nbsp;&nbsp;Fecha de Inicio: </strong>' . $value["fecha_ini"] . '<hr>
                                          <strong>&nbsp;&nbsp;Fecha de Fin: </strong>' . $value["fecha_fin"] . '<hr>
                                          <strong>&nbsp;&nbsp;Operador: </strong>' . $value["operador"] . '<hr>
                                          <strong>&nbsp;&nbsp;Valor: </strong>$' . number_format($value["valor"], 0, '', '.') . '<hr>
                                          <!--./data -->

                                          <!--./toolbar -->
                                          <div class="text-center col-md-offset-4">
                                            <div class="btn-toolbar margen-div-toolbar" role="toolbar">

                                                <button title="Ver Archivos" name="ver_archivos_proyectoM" class="btn btn-success btn-xl-proyectoM" data-toggle="modal" data-target="#frm_modal_archivos" data-id-registro="' . $value["pkID"] . '"><span class="glyphicon glyphicon-new-window"></span></button>&nbsp

                                              <button type="button" id="btn_editar" name="edita_proyectoM" title="Editar" class="btn btn-warning btn-xl-proyectoM" data-toggle="modal" data-target="#frm_talento_humano" data-id-proyectoM = "' . $value["pkID"] . '"';
                //permisos del boton
                if ($edita != 1) {echo 'disabled="disabled"';}
                echo '><span class="glyphicon glyphicon-pencil"></span></button>&nbsp

        <button id="btn_eliminar" name="elimina_proyectoM" title="Eliminar" type="button" class="btn btn-danger btn-xl-proyectoM" data-id-proyectoM = "' . $value["pkID"] . '"';
                //permisos del boton
                if ($elimina != 1) {echo 'disabled="disabled"';}
                echo '>
        <span class="glyphicon glyphicon-remove"></span>
        </button>

                                            </div>
                                          </div>
                                          <!--./toolbar -->

                                        </div>

                                      </div>

                                    </div>

                                </div>

                            </div>
                          <!-- END Portlet PORTLET-->';
            }

        } else {
            # code...
        }

        //---------------------------------------------------------------------------------
    }

    public function getDataProyectoMGen($pkID)
    {

        $this->proyectoMId = $this->getProyectosMarcoId($pkID);
        //print_r($this->proyectoMId);
        /**/
        echo '
                  <div class="col-sm-12">

                    <div class="col-sm-6">

                        <strong>Nombre: </strong> ' . $this->proyectoMId[0]["nombre"] . ' <br> <br>
                        <strong>Fecha de Inicio: </strong> ' . $this->proyectoMId[0]["fecha_ini"] . ' <br> <br>
                        <strong>Fecha Final: </strong> ' . $this->proyectoMId[0]["fecha_fin"] . ' <br> <br>
                        <strong>Operador: </strong> ' . $this->proyectoMId[0]["operador"] . ' <br> <br>
                        <strong>Valor: </strong> $ ' . number_format($this->proyectoMId[0]["valor"], 0, '', '.') . ' <br> <br>


                        ';

        echo '</div>

                    <div class="col-sm-6">
                        <strong>Fuente de Recursos: </strong> ' . $this->proyectoMId[0]["fuente_recursos"] . ' <br> <br>
                        <strong>Financiadores: </strong> ' . $this->proyectoMId[0]["financiadores"] . ' <br> <br>
                        <strong>Gerente: </strong> ' . $this->proyectoMId[0]["gerente"] . ' <br> <br>
                        <strong>Interventoria: </strong> ' . $this->proyectoMId[0]["interventoria"] . ' <br> <br>
                        <strong>Supervisor: </strong> ' . $this->proyectoMId[0]["supervisor"] . ' <br><br>
                        <strong>Lugar de Ejecución</strong> <br><br>
                        <strong>Departamento: </strong> ' . $this->proyectoMId[0]["nom_departamento"] . '<br> <br>
                        <strong>Municipio: </strong> ';
        $this->renderMunicipios($pkID);
        echo '        </div>
            ';

        echo '</div>';

    }

    public function renderMunicipios($pkID)
    {
        //'.$this->renderMunicipios($pkID).'
        $municipios = $this->getDepartamentosProyectoM($pkID);
        $tam_arr    = sizeof($municipios);
        //print_r($municipios);

        if ($municipios) {
            foreach ($municipios as $key => $value) {
                $mun = $key + 1 == $tam_arr ? $value["nombre"] : $value["nombre"] . ", ";
                echo $mun;
            }
        } else {
            echo "Todo el departamento.";
        }

    }

    public function getSelectFuncionarios()
    {

        $tipo = $this->getFuncionarios();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["documento_funcionario"] . ' - ' . $tipo[$a]["nombre_funcionario"] . ' ' . $tipo[$a]["apellido_funcionario"] . "</option>";
        }
    }

    public function getSelectCargos()
    {

        $tipo = $this->getCargos();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre_cargo"] . "</option>";
        }
    }

}
