<?php

include_once '../DAO/reporteDAO.php';
include_once 'helper_controller/render_table.php';

class reporteController extends reporteDAO
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
    public function getTablaReporte($fkID_proyecto_marco)
    {
        $this->aibd = $this->getIndicadores($fkID_proyecto_marco);

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //-----------------Contadores-----------------
        $item_objetivo     = 0;
        $item_actividad    = 0;
        $item_subactividad = 0;
        //---------------------------------------------------------------------------------

        if (($this->aibd)) {

            for ($a = 0; $a < sizeof($this->aibd); $a++) {
                $id                 = $this->aibd[$a]["id_indicador"];
                $objetivo           = $this->aibd[$a]["objetivo"];
                $numero             = $this->aibd[$a]["numero"];
                $actividad          = $this->aibd[$a]["actividad"];
                $subactividad       = $this->aibd[$a]["subactividad"];
                $indicador          = $this->aibd[$a]["indicador"];
                $meta1              = $this->aibd[$a]["meta1"];
                $consulta           = $this->aibd[$a]["cumplimiento1"];
                $this->anio         = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento1      = $this->anio[0]["cantidad"];
                $pendiente1         = $cumplimiento1 - $meta1;
                $meta2              = $this->aibd[$a]["meta2"];
                $consulta           = $this->aibd[$a]["cumplimiento2"];
                $this->anio         = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento2      = $this->anio[0]["cantidad"];
                $pendiente2         = $cumplimiento1 + $cumplimiento2 - $meta1 - $meta2;
                $meta3              = $this->aibd[$a]["meta3"];
                $consulta           = $this->aibd[$a]["cumplimiento3"];
                $this->anio         = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento3      = $this->anio[0]["cantidad"];
                $pendiente3         = $cumplimiento1 + $cumplimiento2 + $cumplimiento3 - $meta1 - $meta2 - $meta3;
                $meta4              = $this->aibd[$a]["meta4"];
                $consulta           = $this->aibd[$a]["cumplimiento4"];
                $this->anio         = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento4      = $this->anio[0]["cantidad"];
                $pendiente4         = $cumplimiento1 + $cumplimiento2 + $cumplimiento3 + $cumplimiento4 - $meta1 - $meta2 - $meta3 - $meta4;
                $meta_total         = $meta1 + $meta2 + $meta3 + $meta4;
                $cumplimiento_total = $cumplimiento1 + $cumplimiento2 + $cumplimiento3 + $cumplimiento4;
                $pendiente_total    = $cumplimiento_total - $meta_total;

                echo '
                             <tr>';

                if ($item_objetivo == 0) {
                    $this->cantObjetivo = $this->getCantObjetivo($this->aibd[$a]["fkID_objetivo"]);

                    $cant_objetivo = $this->cantObjetivo[0]["cantidad"];

                    $tdObjetivo = '<td rowspan="' . $cant_objetivo . '" title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap"><strong>' . $objetivo . '</strong></td>';

                    $item_objetivo = $cant_objetivo;
                } else {
                    $tdObjetivo = '';
                }

                echo $tdObjetivo;

                if ($item_actividad == 0) {
                    $this->cantActividad = $this->getCantActividad($this->aibd[$a]["fkID_actividad"]);

                    $cant_actividad = $this->cantActividad[0]["cantidad"];

                    $tdActividad = '<td rowspan="' . $cant_actividad . '" title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap">' . $numero . '</td>
                                 <td rowspan="' . $cant_actividad . '" title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap">' . $actividad . '</td>';

                    $item_actividad = $cant_actividad;
                } else {
                    $tdActividad = '';
                }

                echo $tdActividad;

                if ($pendiente1 >= 0) {
                    $clase_pendiente1 = "pendiente_up";
                } else {
                    $clase_pendiente1 = "pendiente_down";
                }

                if ($pendiente2 >= 0) {
                    $clase_pendiente2 = "pendiente_up";
                } else {
                    $clase_pendiente2 = "pendiente_down";
                }

                if ($pendiente3 >= 0) {
                    $clase_pendiente3 = "pendiente_up";
                } else {
                    $clase_pendiente3 = "pendiente_down";
                }

                if ($pendiente4 >= 0) {
                    $clase_pendiente4 = "pendiente_up";
                } else {
                    $clase_pendiente4 = "pendiente_down";
                }

                if ($pendiente_total >= 0) {
                    $clase_pendiente_total = "pendiente_up";
                } else {
                    $clase_pendiente_total = "pendiente_down";
                }

                echo $tdSubactividad;

                echo '

                                 <td href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap">' . $indicador . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap meta">' . $meta1 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap bg-primary text-white">' . $cumplimiento1 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap ' . $clase_pendiente1 . '">' . $pendiente1 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap meta">' . $meta2 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap bg-primary text-white">' . $cumplimiento2 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap ' . $clase_pendiente2 . '">' . $pendiente2 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap meta">' . $meta3 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap bg-primary text-white">' . $cumplimiento3 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap ' . $clase_pendiente3 . '">' . $pendiente3 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap meta">' . $meta4 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap bg-primary text-white">' . $cumplimiento4 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap ' . $clase_pendiente4 . '">' . $pendiente4 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap meta">' . $meta_total . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap bg-primary text-white">' . $cumplimiento_total . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="text-wrap ' . $clase_pendiente_total . '">' . $pendiente_total . '</td>
                                 <td>
                                     <a href="graficos.php?id_indicador=' . $id . '&cumplimiento1=' . $cumplimiento1 . '&cumplimiento2=' . $cumplimiento2 . '&cumplimiento3=' . $cumplimiento3 . '&cumplimiento4=' . $cumplimiento4 . '"><button id="edita_sesion" title="Editar" name="edita_sesion"  type="button" class="btn btn-success" ';
                echo '><span class="glyphicon glyphicon-signal"></span></button></a>
                                 </td>
                             </tr>';

                $item_objetivo     = $item_objetivo - 1;
                $item_actividad    = $item_actividad - 1;
                $item_subactividad = $item_subactividad - 1;
            };

        }
    }

    public function getPermisosModulo_Tipo($fkID_modulo, $fkID_tipo_usuario)
    {

        $this->q_general = "select permisos.*, tipo_usuario.nombre as nom_tipo, modulos.Nombre as nom_modulo

                                FROM `permisos`

                                INNER JOIN tipo_usuario ON tipo_usuario.pkID = permisos.fkID_tipo_usuario

                                INNER JOIN modulos ON modulos.pkID = permisos.fkID_modulo

                                WHERE permisos.fkID_modulo = " . $fkID_modulo . " AND permisos.fkID_tipo_usuario = " . $fkID_tipo_usuario;

        return $this->EjecutarConsulta($this->q_general);
    }
}
