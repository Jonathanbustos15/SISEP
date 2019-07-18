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
    $proyecto_marco  = isset($_POST['proyecto_marco'])? $_POST['proyecto_marco'] : "";

    switch ($tipo) {
        case 'crear':
            $generico = new Generico_DAO();
            if (isset($_FILES['file']["name"])) {
                $nombre =$_FILES['file']["name"];
            } else {
                $nombre ="";
            }
            if ($nombre!="") {
                $nombre = str_replace(" ", "_", $nombre);
            //carga el archivo en el servidor
            $destino = "../server/php/files/" . $nombre;  
            if(move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {        
                        $q_inserta = "insert into funcionario(nombre_funcionario, apellido_funcionario, fkID_tipo_documento, documento_funcionario, telefono_funcionario, direccion_funcionario, email_funcionario, url_funcionario,proyecto_marco) VALUES ('$nombref', '$apellido', '$fk_tipo', '$documento', '$telefono', '$direccion', '$email', '$nombre', '$proyecto_marco')";
                        $r["query"] = $q_inserta;           
            } 

        }else{
                $q_inserta = "insert into funcionario(nombre_funcionario, apellido_funcionario, fkID_tipo_documento, documento_funcionario, telefono_funcionario, direccion_funcionario, email_funcionario, proyecto_marco) VALUES ('$nombref', '$apellido', '$fk_tipo', '$documento', '$telefono', '$direccion', '$email', '$proyecto_marco')";
                        $r["query"] = $q_inserta; 
            }
            $resultado = $generico->EjecutaInsertar($q_inserta);                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        };
            
            break;

        case 'editar':
            $generico = new Generico_DAO();
            if (isset($_FILES['file']["name"])) {
                $nombre =$_FILES['file']["name"];
            } else {
                $nombre ="";
            }
            if ($nombre!="") {
                $nombre = str_replace(" ", "_", $nombre);
            //carga el archivo en el servidor
            $destino = "../server/php/files/" . $nombre;  
            if(move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {        
                        $q_inserta = "update funcionario SET nombre_funcionario='$nombref',apellido_funcionario='$apellido',fkID_tipo_documento='$fk_tipo',documento_funcionario='$documento',telefono_funcionario='$telefono',direccion_funcionario='$direccion',email_funcionario='$email',url_funcionario='$nombre' where pkID='$id'";
                        $r["query"] = $q_inserta;           
            } 

            }else{
                    $q_inserta = "update funcionario SET nombre_funcionario='$nombref',apellido_funcionario='$apellido',fkID_tipo_documento='$fk_tipo',documento_funcionario='$documento',telefono_funcionario='$telefono',direccion_funcionario='$direccion',email_funcionario='$email' where pkID='$id' ";
                        $r["query"] = $q_inserta;
                }
            $resultado = $generico->EjecutaActualizar($q_inserta);
                    /**/
                    if($resultado){                    
                        $r[] = $resultado;          

                    }else{
                      $r["estado"] = "Error";
                      $r["mensaje"] = "No se inserto.";
                        }
            
            break;
            case 'eliminararchivo':
                    $generico = new Generico_DAO();
                    $q_inserta = "update funcionario SET url_funcionario='' where pkID='$id' ";
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
    
?>