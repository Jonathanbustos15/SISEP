<?php

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

/**
 *
 */

include "class_crypt.php";

class RenderTable
{

    /**/

    public $array_data;
    public $array_permit;
    public $array_buttons;
    public $array_options;

    //--------------------
    public $crypt_inst;

    public function __construct($a_data, $a_permit, $a_buttons, $a_options)
    {
        # code...
        $this->array_data    = $a_data;
        $this->array_permit  = $a_permit;
        $this->array_buttons = $a_buttons;
        $this->array_options = $a_options;
        $this->crypt_inst    = new crypt();
        //print_r($a_data);
    }

    public function render()
    {
        //echo "render?";

        //toma el array y lo recorre
        foreach ($this->array_data as $llave => $valor) {

            //echo "llave: ".$llave." valor: ".$valor."<br>";

            echo "<tr>";

            //pinta los valores de array_data en relacion a los valores de
            //array_permit
            foreach ($this->array_permit as $ll => $val) {
                //---------------------------------------------------------------------------------------
                //se ejecuta la funcion de renderizar el link
                //se necesita el string mas el nombre del modulo y la llave que contiene el id del registro.
                $href = $this->render_link($this->array_options["href"], $this->array_options["modulo"], $llave);
                //---------------------------------------------------------------------------------------

                echo "<td " . "title='" . $this->array_options["title"] . "' href='" . $href . "' class='" . $this->array_options["class"] . "' >";
                //--------------------------------------------------------------------------------------

                /**/
                switch ($val["tipo"]) {

                    case 'strlen':
                        //---------------------------------------------------------------

                        $len_objeto = strlen($valor[$val["nombre"]]);

                        if ($len_objeto >= 60) {
                            # code...
                            echo substr($valor[$val["nombre"]], 0, 60) . '...';
                        } else {
                            # code...
                            echo $valor[$val["nombre"]];
                        }

                        //---------------------------------------------------------------
                        break;

                    case 'number_format':
                        //---------------------------------------------------------------

                        echo '$' . number_format($valor[$val["nombre"]], 0, '', '.');

                        //---------------------------------------------------------------
                        break;

                    case 'percent':
                        //---------------------------------------------------------------
                        echo $valor[$val["nombre"]] . "%";
                        //---------------------------------------------------------------
                        break;

                    case 'image':
                        //---------------------------------------------------------------
                        if (file_exists('../server/php/files/' . $valor[$val["nombre"]])) {
                            echo '<img src="../server/php/files/' . $valor[$val["nombre"]] . '" class="img-responsive img-rounded" height="50" width="50">';
                        } else {
                            echo '--';
                        }
                        //---------------------------------------------------------------
                        break;

                    case 'y/n':
                        //---------------------------------------------------------------
                        if ($valor[$val["nombre"]] == 1) {
                            echo "Si";
                        } else {
                            echo "No";
                        }
                        //---------------------------------------------------------------
                        break;

                    case 'decrypt':
                        //---------------------------------------------------------------
                        echo $this->crypt_inst->desencriptar($valor[$val["nombre"]]);
                        //---------------------------------------------------------------
                        break;

                    default:
                        echo $valor[$val["nombre"]];
                        break;
                }

                //echo $valor[$val["nombre"]];
                //--------------------------------------------------------------------------------------
                echo '</td>';
            }

            //funcion para crear los botones de opciones
            //echo sizeof($this->array_buttons);
            //valida si hay botones y si debe crearlos o no.
            if (sizeof($this->array_buttons) > 0) {
                $this->render_buttons($valor);
            }

            echo '</tr>';

        }

    }

    public function render_link($href, $modulo, $llave_data)
    {

        $claves = preg_split("/[?,&]+/", $href);

        foreach ($claves as $llave_c => $val_c) {

            if ($val_c == 'id_' . $modulo . '=') {
                //echo "coincidio";
                $claves[$llave_c] = 'id_' . $modulo . '=' . $this->array_data[$llave_data]["pkID"];
            };

        }

        //print_r($claves);

        $join_claves = join('&', $claves);

        //echo $join_claves;

        $pos = strpos($join_claves, "&");

        //echo $pos;

        $join_claves[$pos] = "?";

        //echo $join_claves;

        return $join_claves;

    }

    public function render_blank()
    {

        echo '<tr>';
        //pinta los valores de array_data en relacion a los valores de
        //array_permit
        foreach ($this->array_permit as $ll => $val) {

            echo '<td></td>';
        }
        //,as el de las opciones
        //valida si hay botones para crear el td
        //de los mismos.
        if (sizeof($this->array_buttons) > 0) {
            echo '<td></td>';
        }

        echo '</tr>';
    }

    public function render_buttons($arr_val)
    {

        //print_r($arr_val);
        //echo $arr_val["pkID"]."<br>";

        echo '<td>';
        foreach ($this->array_buttons as $key => $value) {

            //echo "llave: ".$key." valor: ".$value."<br>";
            $this->render_button($value["tipo"], $value["nombre"], $arr_val["pkID"], $value["permiso"], $arr_val);
        }
        echo '</td>';

    }

    public function render_button($type, $name, $id, $permiso, $arr_val)
    {
        //------------------------------------------------------------------------------------------------
        /*evalua el permiso para poderlo renderizar*/
        if ($permiso == "1") {
            $permiso = "";
        } else {
            $permiso = "disabled";
        };
        //------------------------------------------------------------------------------------------------
        //carga la ruta_visor
        include "../../conexion/datos.php";
        //------------------------------------------------------------------------------------------------
        switch ($type) {
            case 'editar':
                echo '<button id="btn_editar" name="edita_' . $name . '" title="Editar" type="button" class="btn btn-warning" data-toggle="modal" data-target="#frm_modal_' . $name . '" data-id-' . $name . ' = "' . $id . '" ' . $permiso . '><span class="glyphicon glyphicon-pencil"></span></button>&nbsp';
                break;
            case 'eliminar':
                echo '<button id="btn_eliminar" name="elimina_' . $name . '" title="Eliminar" type="button" class="btn btn-danger" data-id-' . $name . ' = "' . $id . '" ' . $permiso . '><span class="glyphicon glyphicon-remove"></span></button>&nbsp';
                break;
            case 'descargar_1':
                //pasa el nombre del campo que contiene el nombre del archivo
                echo '<a title="Descargar" class="btn btn-success" href="../server/php/files/' . $arr_val[$name] . '" target="_blank"><span class="glyphicon glyphicon-file"></span></a>&nbsp';
                break;
            case 'descarga_multiple':
                //pasa el nombre del campo que contiene el nombre del archivo
                echo '<button title="Ver Archivos" name="ver_archivos_' . $name . '" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_archivos" data-id-registro="' . $id . '"><span class="glyphicon glyphicon-file"></span></button>&nbsp';
                break;
            case 'ver_docs':
                echo '<a class="btn btn-info" title="Visualizar Archivo con Google Docs" href="https://docs.google.com/viewer?url=' . $ruta_visor . '' . $arr_val[$name] . '" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a>';
                break;
            case 'btn_gen':
                //print_r($arr_val);
                echo '<button id="btn_' . $id . '_' . $name . '" name="btn_' . $name . '"></button>&nbsp';
                break;
            case 'btn_rpta_p':
                //print_r($arr_val);
                echo '<button id="btn_' . $id . '_' . $name . '" name="btn_' . $name . '" class="btn btn-primary" data-id-prueba="' . $id . '"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>&nbsp';
                break;

        }
        //------------------------------------------------------------------------------------------------
    }

}
