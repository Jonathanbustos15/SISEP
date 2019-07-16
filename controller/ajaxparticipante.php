 <?php

    include('../DAO/genericoDAO.php');

    class Generico_DAO{
 
        use GenericoDAO;

    }

    $r = array();  
    $tipo  = isset($_POST['tipo'])? $_POST['tipo'] : "";
    $id      = isset($_POST['pkID'])? $_POST['pkID'] : "";  
    $nombref  = isset($_POST['nombre'])? $_POST['nombre'] : "";
    $apellido  = isset($_POST['apellido'])? $_POST['apellido'] : "";
    $fk_tipo  = isset($_POST['fk_tipo'])? $_POST['fk_tipo'] : "";
    $documento  = isset($_POST['documento'])? $_POST['documento'] : "";
    $telefono  = isset($_POST['telefono'])? $_POST['telefono'] : "";
    $direccion  = isset($_POST['direccion'])? $_POST['direccion'] : "";
    $email  = isset($_POST['email'])? $_POST['email'] : "";

    switch ($tipo) {
        case 'crear':
            $generico = new Generico_DAO();       
                        $q_inserta = "insert into participante(nombre_participante, apellido_participante, fkID_tipo_documento, documento_participante, telefono_participante, direccion_participante, email_participante) VALUES ('$nombref', '$apellido', '$fk_tipo', '$documento', '$telefono', '$direccion', '$email')";
                        $r["query"] = $q_inserta;           

                        $resultado = $generico->EjecutaInsertar($q_inserta);
                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }
            break;
            case 'editar':
                    $generico = new Generico_DAO();
                    $q_inserta = "update participante SET nombre_participante='$nombref',apellido_participante='$apellido',fkID_tipo_documento='$fk_tipo',documento_participante='$documento',telefono_participante='$telefono',direccion_participante='$direccion',email_participante='$email' where pkID='$id' ";
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
            case 'eliminar':
                    $generico = new Generico_DAO();
                    $q_inserta = "update participante SET estadoV=2 where pkID='$id' ";
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
                case 'eliminarasignacion':
                    $generico = new Generico_DAO();
                    $q_inserta = "delete FROM `participante_taller` WHERE pkID='$id' ";
                    $r["query"] = $q_inserta;           
                    $resultado = $generico->EjecutaEliminar($q_inserta);
                    /**/
                    if($resultado){                    
                        $r[] = $resultado;          

                    }else{
                      $r["estado"] = "Error";
                      $r["mensaje"] = "No se inserto.";
                        }
                break;
                case 'eliminarasignacionf':
                    $generico = new Generico_DAO();
                    $q_inserta = "delete FROM `feria_participantes` WHERE pkID='$id' ";
                    $r["query"] = $q_inserta;           
                    $resultado = $generico->EjecutaEliminar($q_inserta);
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
    
?>