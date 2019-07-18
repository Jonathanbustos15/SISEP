<?php
/**/
include_once '../DAO/institucionDAO.php';
include_once 'helper_controller/render_table.php';

class institucionController extends institucionDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $table_inst;
    public $institucionId;

    public function __construct()
    {

        include '../conexion/datos.php';

        $this->id_modulo     = 16; //id de la tabla modulos
        $this->NameCookieApp = $NomCookiesApp;

    }

    //Funciones-------------------------------------------
    //Espacio para las funciones de esta clase.
    public function getSelectDepartamentos()
    {

        $tipo = $this->getDepartamentos();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre_departamento"] . "</option>";
        }
    }

    public function getSelectMunicipios()
    {

        $tipo = $this->getMunicipios();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getSelectTiposZona()
    {

        $tipo = $this->getZonas();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getSelectTipoS()
    {

        $tipo = $this->getTipoS();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getSelectSede()
    {

        $tipo = $this->getSedes();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getTablaInstitucion($pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $institucion_campos = [
            ["nombre" => "nombre_institucion"],
            ["nombre" => "codigo_dane"],
            ["nombre" => "fkID_municipio"],
            ["nombre" => "email_institucion"],
            ["nombre" => "persona_contacto"],

        ];
        //la configuracion de los botones de opciones
        $institucion_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "institucion",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "institucion",
                "permiso" => $elimina,
            ],

        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $institucion = $this->getInstituciones($pkID_proyectoM);
        //print_r($institucion);
        //echo $this->getCookieProyectoM();

        //Instancia el render
        $this->table_inst = new RenderTable($institucion, $institucion_campos, $institucion_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($institucion) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($institucion) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getSeleccion_Municipio()
    {
        $municipioSelect = $this->getMunicipios();

        echo '<select name="fkID_municipio" id="fkID_municipio" class="form-control" required = "true">
                        <option value="" selected>Elija el municipio</option>';
        for ($i = 0; $i < sizeof($municipioSelect); $i++) {
            echo '<option value="' . $municipioSelect[$i]["pkID"] . '" data-nom-estudio="' . $municipioSelect[$i]["nombre"] . '">' . $municipioSelect[$i]["nombre"] . '</option>';
        };
        echo '</select>';
    }

    public function getDataInstitucionGen($pkID)
    {

        $this->institucionId = $this->getInstitucionId($pkID);

        /**/
        echo '
                  <div class="col-sm-12">

                    <div class="col-sm-6">

                        <strong>Nombre: </strong> ' . $this->institucionId[0]["nombre"] . ' <br> <br>

                        ';

        echo '</div>

                    <div class="col-sm-6">


                    </div>
            ';

        echo '</div>';

    }

}
