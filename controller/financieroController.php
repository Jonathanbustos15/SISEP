<?php
/**/

include_once '../DAO/financieroDAO.php';
include_once 'helper_controller/render_table.php';

class financieroController extends financieroDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $id_modulo_estudiantes;
    public $id_modulo_docentes;
    public $table_inst;
    public $financierosId;

    public function __construct() 
    {

        include '../conexion/datos.php';

        $this->id_modulo             = 25; //id de la tabla modulos
        $this->id_modulo_estudiantes = 30; //id de la tabla modulos
        $this->id_modulo_docentes    = 26; //id de la tabla modulos
        $this->NameCookieApp         = $NomCookiesApp;

    }

    public function getTablafinanciero($filtro,$pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $financiero_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "fecha_salida"],
            ["nombre" => "nombre"],
            ["nombre" => "comunidad_visitada"],
            ["nombre" => "canti"],
            ["nombre" => "nombres_funcionario"],
        ];
        //la configuracion de los botones de opciones
        $financiero_btn = [

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
            $financiero = $this->getfinanciero($filtro,$pkID_proyectoM);
        
        //print_r($financiero);

        //Instancia el render
        $this->table_inst = new RenderTable($financiero, $financiero_campos, $financiero_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($financiero) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($financiero) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablafinancieroFactura($pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $financiero_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "numero_factura"],
            ["nombre" => "valor_facturas"],
            ["nombre" => "fecha_factura"],
        ];
        //la configuracion de los botones de opciones
        $financiero_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "factura",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "factura",
                "permiso" => $elimina,
            ],

        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $financiero = $this->getFactura($pkID_proyectoM);
        //print_r($financiero);

        //Instancia el render
        $this->table_inst = new RenderTable($financiero, $financiero_campos, $financiero_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($financiero) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($financiero) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablafinancieroAnticipo($pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $financiero_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "fecha_anticipo"],
            ["nombre" => "anticipo"],
            ["nombre" => "anticipo_legalizado"],
            ["nombre" => "fecha_anticipo_legalizado"],
            ["nombre" => "valor_pendiente"],
        ];
        //la configuracion de los botones de opciones
        $financiero_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "anticipo",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "anticipo",
                "permiso" => $elimina,
            ],

        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $financiero = $this->getAnticipo($pkID_proyectoM);
        //print_r($financiero);

        //Instancia el render
        $this->table_inst = new RenderTable($financiero, $financiero_campos, $financiero_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($financiero) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($financiero) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getDetallefinanciero(){

        $objetivo = $this->getObjetivos();

        for ($a = 0; $a < sizeof($objetivo); $a++) {
            echo '<h2>'.$objetivo[$a]['objetivo'].'</h2>';
            echo '<table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                          <th colspan="1" class="text-center">Actividad</th>
                          <th colspan="1" class="text-center">Descripción</th>
                          <th colspan="1" class="text-center">Valor Actividad</th>
                          <th colspan="1" class="text-center">Valor Ejecutado</th>
                      </tr>  
                  </thead>
                  <tbody>';
            $actividad = $this->getActividad($objetivo[$a]['pkID']);
            for ($b = 0; $b < sizeof($actividad); $b++) {
               $totalac = $this->getActividadTotal($actividad[$b]['pkID']); 
            echo '<tr>
                          <td colspan="1" class="text-center" style="background-color: #F4ECF7"><h4>'.$actividad[$b]['numero'].'</h4></td>
                          <td colspan="1" class="text-left" style="background-color: #F4ECF7"><h4>'.$actividad[$b]['actividad'].'</h4></td>
                          <td colspan="1" class="text-center" style="background-color: #A3C7EE"><h4>$'. number_format($actividad[$b]['valor_actividad'],0,'.', '.').'</h4></td>
                          <td colspan="1" class="text-center" style="background-color: #95F388"><h4>$'. number_format($totalac[0]['total'],0,'.', '.').'</h4>
                          </td>
                      </tr>';

            }
            echo '</tbody>
              </table>';

        }
    }

    public function getSelectObjetivo()
    {

        $tipo = $this->getObjetivos();

        echo '<select name="fkID_objetivo" id="fkID_objetivo" class="form-control" required = "true">
                        <option value="" selected>Elija el objetivo</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_objetivo_form_' data-nombre='" . $tipo[$a]["objetivo"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["objetivo"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectActividad()
    {

        $tipo = $this->getActividad();

        echo '<select name="fkID_actividad" id="fkID_actividad" class="form-control" required = "true">
                        <option value="" selected>Elija la Actividad</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_actividad_form_' data-nombre='" . $tipo[$a]["actividad"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["actividades"] . "</option>";
        }
        echo "</select>";
    }


      

}