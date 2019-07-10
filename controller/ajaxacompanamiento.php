<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r         = array();
$tipo      = $_POST['tipo'];
$id        = $_POST['pkID'];
$nombref   = $_POST['nombre'];
$apellido  = $_POST['apellido'];
$fk_tipo   = $_POST['fk_tipo'];
$documento = $_POST['documento'];
$telefono  = $_POST['telefono'];
$direccion = $_POST['direccion'];
$email     = $_POST['email'];

switch ($tipo) {
    case 'crear':
        $generico = new Generico_DAO();
        $nombre   = $_FILES['file']["name"];
        //Reemplaza los caracteres especiales por guiones al piso
        $nombre = str_replace(" ", "_", $nombre);
        $nombre = str_replace("%", "_", $nombre);
        $nombre = str_replace("-", "_", $nombre);
        $nombre = str_replace(";", "_", $nombre);
        $nombre = str_replace("#", "_", $nombre);
        $nombre = str_replace("!", "_", $nombre);
        //carga el archivo en el servidor
        $destino = "../vistas/subidas/" . $nombre;
        if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
            $q_inserta  = "insert into funcionario(nombre_funcionario, apellido_funcionario, fkID_tipo_documento, documento_funcionario, telefono_funcionario, direccion_funcionario, email_funcionario, url_funcionario) VALUES ('$nombref', '$apellido', '$fk_tipo', '$documento', '$telefono', '$direccion', '$email', '$nombre')";
            $r["query"] = $q_inserta;

            $resultado = $generico->EjecutaInsertar($q_inserta);
            /**/
            if ($resultado) {

                $r[] = $resultado;

            } else {

                $r["estado"]  = "Error";
                $r["mensaje"] = "No se inserto.";
            }

        } else {
            $mensaje = "El archivo $nombre no se ha almacenado en forma exitosa";
        }
        echo json_encode($nombre);
        break;
    case 'editar':
        $generico = new Generico_DAO();
        $nombre   = $_FILES['file']["name"];
        //Reemplaza los caracteres especiales por guiones al piso
        $nombre = str_replace(" ", "_", $nombre);
        $nombre = str_replace("%", "_", $nombre);
        $nombre = str_replace("-", "_", $nombre);
        $nombre = str_replace(";", "_", $nombre);
        $nombre = str_replace("#", "_", $nombre);
        $nombre = str_replace("!", "_", $nombre);
        //carga el archivo en el servidor
        $destino = "../vistas/subidas/" . $nombre;
        if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
            $q_inserta  = "update funcionario SET nombre_funcionario='$nombref',apellido_funcionario='$apellido',fkID_tipo_documento='$fk_tipo',documento_funcionario='$documento',telefono_funcionario='$telefono',direccion_funcionario='$direccion',email_funcionario='$email',url_funcionario='$nombre' where pkID='$id'";
            $r["query"] = $q_inserta;
            $resultado  = $generico->EjecutaInsertar($q_inserta);
            /**/
            if ($resultado) {

                $r[] = $resultado;

            } else {

                $r["estado"]  = "Error";
                $r["mensaje"] = "No se inserto.";
            }

        } else {
            $mensaje = "El archivo $nombre no se ha almacenado en forma exitosa";
        }
        echo json_encode($nombre);
        break;
    case 'editarsin':
        $generico   = new Generico_DAO();
        $q_inserta  = "update funcionario SET nombre_funcionario='$nombref',apellido_funcionario='$apellido',fkID_tipo_documento='$fk_tipo',documento_funcionario='$documento',telefono_funcionario='$telefono',direccion_funcionario='$direccion',email_funcionario='$email' where pkID='$id' ";
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
    default:
        # code...
        break;
}

echo json_encode($r);
