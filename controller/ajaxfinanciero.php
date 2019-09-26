  <?php

include '../DAO/genericoDAO.php';  

class Generico_DAO
{
    use GenericoDAO;
}

$r    = array();
$tipo = isset($_POST['tipo'])? $_POST['tipo'] : "";
$id            = isset($_POST['pkID'])? $_POST['pkID'] : "";
$id_anticipo            = isset($_POST['pkID_anticipo'])? $_POST['pkID_anticipo'] : "";
$numero_factura      = isset($_POST['numero_factura'])? $_POST['numero_factura'] : "";
$valor_factura       = isset($_POST['valor_factura'])? $_POST['valor_factura'] : "";
$valor_factura = str_replace('.', '', $valor_factura);
$valor_anticipo       = isset($_POST['valor_anticipo'])? $_POST['valor_anticipo'] : "";
$valor_anticipo = str_replace('.', '', $valor_anticipo);
$valor_legalizado       = isset($_POST['anticipo_legalizado'])? $_POST['anticipo_legalizado'] : "";
$valor_legalizado = str_replace('.', '', $valor_legalizado);
$fecha_factura       = isset($_POST['fecha_factura'])? $_POST['fecha_factura'] : "";
$fecha_anticipo       = isset($_POST['fecha_anticipo'])? $_POST['fecha_anticipo'] : "";
$fecha_anticipo_legalizado = isset($_POST['fecha_anticipo_legalizado'])? $_POST['fecha_anticipo_legalizado'] : "";
$fkID_objetivo       = isset($_POST['fkID_objetivo'])? $_POST['fkID_objetivo']: "";
$fkID_actividad      = isset($_POST['fkID_actividad'])? $_POST['fkID_actividad'] : "";
$proyecto_marco      = isset($_POST['proyecto_marco'])? $_POST['proyecto_marco'] : "";
$fkID_proyecto_marco = isset($_POST['fkID_proyecto_marco'])? $_POST['fkID_proyecto_marco'] : "";
$valor               = isset($_POST['valor'])? $_POST['valor'] : "";
$valor = str_replace('.', '', $valor);

switch ($tipo) {
    case 'crear':
        $generico = new Generico_DAO();
            $q_inserta  = "insert into `factura`(`numero_factura`, `valor_factura`, `fecha_factura`, `fkID_proyecto_marco`) VALUES ('$numero_factura', '$valor_factura', '$fecha_factura', '$fkID_proyecto_marco')";
                    $r["query"] = $q_inserta;   

            $resultado = $generico->EjecutaInsertar($q_inserta);
            if ($resultado) {
                $r[] = $resultado;
            } else {
                $r["mensaje"] = "No se inserto.";
            }
        break;
    case 'crear_anticipo':
        $generico = new Generico_DAO();
            $q_inserta  = "insert into `anticipo`(`valor_anticipo`, `fecha_anticipo`, `anticipo_legalizado`, `fecha_anticipo_legalizado`, `fkID_proyecto_marco`) VALUES ('$valor_anticipo', '$fecha_anticipo', '$valor_legalizado', '$fecha_anticipo_legalizado', '$fkID_proyecto_marco')";
                    $r["query"] = $q_inserta;   

            $resultado = $generico->EjecutaInsertar($q_inserta);
            if ($resultado) {
                $r[] = $resultado;
            } else {
                $r["mensaje"] = "No se inserto.";
            }
        break;
    case 'editar':
        $generico = new Generico_DAO();
            $q_inserta  = "update `factura` SET `numero_factura`='$numero_factura',`valor_factura`='$valor_factura',`fecha_factura`='$fecha_factura' where pkID='$id'";
                    $r["query"] = $q_inserta;
            $resultado  = $generico->EjecutaActualizar($q_inserta);
            /**/
            if ($resultado) {
                $r[] = $resultado;
            } else {
                $r["estado"]  = "Error";
                $r["mensaje"] = "No se inserto.";
            }
        break;
    case 'editar_anticipo':
        $generico = new Generico_DAO();
            $q_inserta  = "update `anticipo` SET `valor_anticipo`='$valor_anticipo',`fecha_anticipo`='$fecha_anticipo',`anticipo_legalizado`='$valor_legalizado',`fecha_anticipo_legalizado`='$fecha_anticipo_legalizado' where pkID='$id_anticipo'";
                    $r["query"] = $q_inserta;
            $resultado  = $generico->EjecutaActualizar($q_inserta);
            /**/
            if ($resultado) {
                $r[] = $resultado;
            } else {
                $r["estado"]  = "Error";
                $r["mensaje"] = "No se inserto.";
            }
        break;
    case 'consultaractividad':
            $generico = new Generico_DAO();

            $q_carga = "select *, concat_ws(' ',numero,actividad) as actividades FROM `actividad` WHERE estadoV=1 and fkID_objetivo=".$id." ORDER BY numero";

            $resultado = $generico->EjecutarConsulta2($q_carga);
            /**/
            if ($resultado) {
                while ($row = mysqli_fetch_row($resultado)) {
                $codigo=$row[0];
                $nombre=$row[6];
                $r[] = array('codigo'=> $codigo, 'nombre'=> $nombre);
        }
            } else {
                $r["estado"]  = "Error";
            }

        break;   
    default: 
        # code...
        break;
}

echo json_encode($r);

?>