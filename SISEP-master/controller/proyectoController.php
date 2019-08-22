<?php
/**/
include_once '../DAO/proyectoDAO.php';
include_once 'helper_controller/render_table.php';

class proyectoController extends proyectoDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $table_inst;
    public $proyectoId;

    public function __construct()
    {

        include '../conexion/datos.php';

        $this->id_modulo     = 32; //id de la tabla modulos
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

    public function getSelectLineaI()
    {

        $tipo = $this->getLineaI();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getSelectTipoP()
    {

        $tipo = $this->getTipoP();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getSelectEstadoP()
    {

        $tipo = $this->getEstadoP();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getSelectAsesor()
    {

        $tipo = $this->getAsesor();
        print_r($tipo);

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkIDA"] . "'>" . $tipo[$a]["nombreA"] . ' ' . $tipo[$a]["apellidoA"] . "</option>";
        }
    }

    public function getSelectFase()
    {

        $tipo = $this->getFase();
        //echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["pkID"] . ". " . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getTablaProyecto()
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $proyectos_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nom_grupo_inv"],
            ["nombre" => "nombre"],
            ["nombre" => "descripcion"],
            ["nombre" => "pregunta_investigacion"],
            //["nombre"=>"fkID_asesor"],
            //["nombre"=>"tipo_p"],
            //["nombre"=>"estado_p"]
        ];
        //la configuracion de los botones de opciones
        $proyectos_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "proyecto",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "proyecto",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [
            "modulo" => "proyecto", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "detalles_proyecto.php?id_proyecto=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $proyectos = $this->getProyectos();
        //print_r($proyectos);

        //Instancia el render
        $this->table_inst = new RenderTable($proyectos, $proyectos_campos, $proyectos_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($proyectos) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($proyectos) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablaProyectosGrupo($pkID)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $proyectos_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "descripcion"],
            ["nombre" => "pregunta_investigacion"],
            //["nombre"=>"fkID_asesor"],
            //["nombre"=>"tipo_p"],
            //["nombre"=>"estado_p"]
        ];
        //la configuracion de los botones de opciones
        $proyectos_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "proyecto",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "proyecto",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [
            "modulo" => "proyecto", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "detalles_proyecto.php?id_proyecto=&id_grupo=" . $pkID . "",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $proyectos = $this->getProyectoGrupo($pkID);

        //Instancia el render
        $this->table_inst = new RenderTable($proyectos, $proyectos_campos, $proyectos_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($proyectos) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($proyectos) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getDataProyectoGen($pkID)
    {

        $this->proyectoId = $this->getProyectoId($pkID);

        /**/
        echo '
				  <div class="col-sm-12">

					<div class="col-sm-12">

						<strong>Nombre: </strong> ' . $this->proyectoId[0]["nombre"] . '  <br> <br>
                        <strong>Descripción: </strong> ' . $this->proyectoId[0]["descripcion"] . '  <br> <br>
						<strong>Linea de Investigación: </strong> ' . $this->proyectoId[0]["linea_inv"] . ' <br> <br>
						<strong>Pregunta de Investigación: </strong> ' . $this->proyectoId[0]["pregunta_investigacion"] . ' <br> <br>
						<strong>Asesor: </strong> ' . $this->proyectoId[0]["nom_asesor"] . ' ' . $this->proyectoId[0]["ape_asesor"] . ' <br> <br>
						<strong>Tipo de Proyecto: </strong> ' . $this->proyectoId[0]["tipo_p"] . ' <br> <br>
						<strong>Estado del Proyecto: </strong> ' . $this->proyectoId[0]["estado_p"] . ' <br> <br>
                        <strong>Fase: </strong> ' . $this->proyectoId[0]["fase"] . ' <br> <br>

					</div>

						';

        echo '</div>';

    }

}
