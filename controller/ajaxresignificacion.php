<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r    = array();
$tipo = $_POST['tipo'];
if (isset($_POST['pkID'])) {
    $id = $_POST['pkID'];
} else {
    $id = '';
}
$fecha       = $_POST['fecha'];
$descripcion = $_POST['descripcion'];
if (isset($_POST['fkID_institucion'])) {
    $fkID_institucion = $_POST['fkID_institucion'];
} else {
    $fkID_institucion = '';
}
if (isset($_POST['fkID_asesor'])) {
    $fkID_asesor = $_POST['fkID_asesor'];
} else {
    $fkID_asesor = '';
}
if (isset($_POST['fkID_proyecto_marco'])) {
    $fkID_proyecto_marco = $_POST['fkID_proyecto_marco'];
} else {
    $fkID_proyecto_marco = '';
}
if (isset($_POST['fkID_resignificacion'])) {
    $fkID_resignificacion = $_POST['fkID_resignificacion'];
} else {
    $fkID_resignificacion = '';
}

if (isset($_POST['file'])) {
    $file = $_POST['file'];
} else {
    $file = '';
}
switch ($tipo) {
    case 'crear':
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO resignificacion (fecha,descripcion,fkID_asesor,fkID_institucion,fkID_proyecto_marco) VALUES ('$fecha', '$descripcion', '$fkID_asesor', '$fkID_institucion', '$fkID_proyecto_marco')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'crear_evidencia':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $nombreDoc = str_replace("%", "_", $nombreDoc);
            $nombreDoc = str_replace("-", "_", $nombreDoc);
            $nombreDoc = str_replace(";", "_", $nombreDoc);
            $nombreDoc = str_replace("#", "_", $nombreDoc);
            $nombreDoc = str_replace("!", "_", $nombreDoc);
            //carga el archivo en el servidor
            $destinoDoc = "../vistas/subidas/" . $nombreDoc;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $nombreDoc = '';
        }
        $q_inserta  = "INSERT INTO evidencia_resignificacion (descripcion,fecha,url_evidencia,fkID_resignificacion) VALUES ('$descripcion', '$fecha', '$nombreDoc', '$fkID_resignificacion')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'editar':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE resignificacion SET fecha='$fecha',descripcion='$descripcion',fkID_institucion='$fkID_institucion',fkID_asesor='$fkID_asesor' where pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'eliminararchivo':
        $generico   = new Generico_DAO();
        $q_inserta  = "update funcionario SET url_funcionario='' where pkID='$id' ";
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
    case 'editar_evidencia':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $nombreDoc = str_replace("%", "_", $nombreDoc);
            $nombreDoc = str_replace("-", "_", $nombreDoc);
            $nombreDoc = str_replace(";", "_", $nombreDoc);
            $nombreDoc = str_replace("#", "_", $nombreDoc);
            $nombreDoc = str_replace("!", "_", $nombreDoc);
            //carga el archivo en el servidor
            $destinoDoc = "../server/php/files/" . $nombreDoc;
            $documento  = ",url_evidencia= '" . $nombreDoc . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);  
        } else {
            $documento = '';
        }
        $q_inserta  = "update `evidencia_resignificacion` SET `fecha`='$fecha', `descripcion`='$descripcion'". $documento . " WHERE pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        };
        break;
        case 'eliminarevidencia':
                    $generico = new Generico_DAO();
                    $q_inserta = "update evidencia_resignificacion SET url_evidencia='' where pkID='$id' ";
                    $r["query"] = $q_inserta;           
                    $resultado = $generico->EjecutaActualizar($q_inserta);
                    /**/
                    if($resultado){                    
                        $r[] = $resultado;          
                    }else{
                      $r["estado"] = "Error";
                      $r["mensaje"] = "No se inserto.";
                        }
                
                break;
    default:
        # code...
        break;
}

echo json_encode($r);
