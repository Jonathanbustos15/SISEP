<?php
/**/

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

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
        //---------------------------------------------------------------------------------

        if (($this->aibd)) {

            for ($a = 0; $a < sizeof($this->aibd); $a++) {
                $id                 = $this->aibd[$a]["pkID"];
                $objetivo           = $this->aibd[$a]["objetivo"];
                $numero             = $this->aibd[$a]["numero"];
                $actividad          = $this->aibd[$a]["actividad"];
                $subactividad       = $this->aibd[$a]["subactividad"];
                $indicador          = $this->aibd[$a]["indicador"];
                $meta1              = $this->aibd[$a]["meta1"];
                $consulta           = $this->aibd[$a]["cumplimiento1"];
                $this->anio1        = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento1      = $this->anio1[$a]["cantidad"];
                $pendiente1         = $cumplimiento1 - $meta1;
                $meta2              = $this->aibd[$a]["meta2"];
                $consulta           = $this->aibd[$a]["cumplimiento2"];
                $this->anio2        = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento2      = $this->anio2[$a]["cantidad"];
                $pendiente2         = $cumplimiento1 + $cumplimiento2 - $meta1 - $meta2;
                $meta3              = $this->aibd[$a]["meta3"];
                $consulta           = $this->aibd[$a]["cumplimiento3"];
                $this->anio3        = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento3      = $this->anio3[$a]["cantidad"];
                $pendiente3         = $cumplimiento1 + $cumplimiento2 + $cumplimiento3 - $meta1 - $meta2 - $meta3;
                $meta4              = $this->aibd[$a]["meta4"];
                $consulta           = $this->aibd[$a]["cumplimiento4"];
                $this->anio4        = $this->getConsulta($consulta, $fkID_proyecto_marco);
                $cumplimiento4      = $this->anio4[$a]["cantidad"];
                $pendiente4         = $cumplimiento1 + $cumplimiento2 + $cumplimiento3 + $cumplimiento4 - $meta1 - $meta2 - $meta3 - $meta4;
                $meta_total         = $meta1 + $meta2 + $meta3 + $meta4;
                $cumplimiento_total = $cumplimiento1 + $cumplimiento2 + $cumplimiento3 + $cumplimiento4;
                $pendiente_total    = $cumplimiento_total - $meta_total;

                echo '
                             <tr>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail"><strong>' . $objetivo . '</strong></td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $numero . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $actividad . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $subactividad . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $indicador . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $meta1 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $cumplimiento1 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $pendiente1 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $meta2 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $cumplimiento2 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $pendiente2 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $meta3 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $cumplimiento3 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $pendiente3 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $meta4 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $cumplimiento4 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $pendiente4 . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $meta_total . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $cumplimiento_total . '</td>
                                 <td title="Click Ver Detalles" href="detalles_aibd.php?id_aibd=' . $id . '" class="detail">' . $pendiente_total . '</td>
                                 <td>
                                     <a href="graficos.php"><button id="edita_sesion" title="Editar" name="edita_sesion"  type="button" class="btn btn-success" data-id-sesion = "' . $id . '" ';
                echo '><span class="glyphicon glyphicon-signal"></span></button></a>
                                 </td>
                             </tr>';
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
