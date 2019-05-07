<?php
/**/
include_once '../DAO/grupo_formacionDAO.php';
include_once 'helper_controller/render_table.php';

class grupo_formacionController extends grupo_formacionDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $gruposFId;
    public $id_modulo_docentes;
    public $id_modulo_capacitadores;
    public $table_inst;
    public $id_modulo_usuario;

    public function __construct()
    {

        include '../conexion/datos.php';
        $this->id_modulo_usuario                           = 13;
        $this->id_modulo                                   = 46; //id de la tabla modulos
        $this->id_modulo_detalles_grupo_formacion_docentes = 48;
        $this->id_modulo_capacitadores                     = 49;
        $this->NameCookieApp                               = $NomCookiesApp;

    }

    public function getSelectCursos()
    {

        $m_u_Select = $this->getCursos();
        //print_r($m_u_Select);

        echo '<select id="fkID_curso" name="fkID_curso" class="form-control" required="true">
                      <option></option>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '">' . $m_u_Select[$i]["nombre"] . '</option>';
        };
        echo '</select>';
    }

    public function getSelectCapacitadores()
    {

        $m_u_Select = $this->getCapacitadores();

        echo '<select id="fkID_usuario" name="fkID_usuario" class="form-control" required="true">
                      <option></option>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '">' . $m_u_Select[$i]["capacitador"] . '</option>';
        };
        echo '</select>';
    }

    public function getSelectDocentes($pkID_grupof)
    {

        $tipo = $this->getDocente($pkID_grupof);

        echo "<select name='fkID_usuario' id='fkID_usuario' class='form-control'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["docente"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectDocente($pkID_grupof)
    {

        $tipo = $this->getDocente($pkID_grupof);

        echo "<select name='fkID_usuario' id='fkID_usuario' class='form-control'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["docente"] . "</option>";
        }
        echo "</select>";
    }
    /**/

    public function getTablaGruposF()
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupof_campos = [
            // ["nombre"=>"pkID"],
            //["nombre"=>"nombre"],
            ["nombre" => "curso"],
            ["nombre" => "fecha_inicio"],
            ["nombre" => "fecha_fin"],
        ];
        //la configuracion de los botones de opciones
        $grupof_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "grupof",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "grupof",
                "permiso" => $elimina,
            ],
            [
                "tipo"   => "descarga_multiple",
                "nombre" => "grupof",
            ],
        ];

        $array_opciones = [
            "modulo" => "grupof", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "detalles_grupo_formacion.php?id_grupof=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupof = $this->getGruposF();

        //Instancia el render
        $this->table_inst = new RenderTable($grupof, $grupof_campos, $grupof_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupof) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupof) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getDataGrupoFGen($pkID)
    {

        $this->gruposFId = $this->getGruposFId($pkID);

        //print_r($this->gruposFId);

        echo '
                      <div class="col-sm-12">
                            <strong>Curso: </strong> ' . $this->gruposFId[0]["curso"] . ' <br> <br>
                            <strong>Fecha de Inicio: </strong> ' . $this->gruposFId[0]["fecha_inicio"] . ' <br> <br>
                            <strong>Fecha Final: </strong> ' . $this->gruposFId[0]["fecha_fin"] . ' <br> <br>
                      </div>';

    }

    public function getTablaGrupoFUsuarios($fkID_tipo_usuario, $pkID_grupof)
    {

        //permisos-------------------------------------------------------------------------
        if ($fkID_tipo_usuario == 12) {

            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_usuario, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
            $edita       = $arrPermisos[0]["editar"];
            $elimina     = $arrPermisos[0]["eliminar"];
            $consulta    = $arrPermisos[0]["consultar"];

            //la configuracion de los botones de opciones
            $grupof_btn = [

                /*[
                "tipo"=>"editar",
                "nombre"=>"grupof_capacitador",
                "permiso"=>$edita,
                ],*/
                [
                    "tipo"    => "eliminar",
                    "nombre"  => "usuario",
                    "permiso" => $elimina,
                ],

            ];

        } else if ($fkID_tipo_usuario == 8) {

            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_detalles_grupo_formacion_docentes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
            $edita       = $arrPermisos[0]["editar"];
            $elimina     = $arrPermisos[0]["eliminar"];
            $consulta    = $arrPermisos[0]["consultar"];

            //la configuracion de los botones de opciones
            $grupof_btn = [

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
        $grupof_campos = [
            ["nombre" => "nombre"],
            ["nombre" => "apellido"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupof = $this->getGrupoFUsuarioId($fkID_tipo_usuario, $pkID_grupof);

        //Instancia el render
        $this->table_inst = new RenderTable($grupof, $grupof_campos, $grupof_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupof) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupof) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------

    }

}
