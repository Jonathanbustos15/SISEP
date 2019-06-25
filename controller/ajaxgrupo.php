  <?php

    include('../DAO/genericoDAO.php');

    class Generico_DAO{

        use GenericoDAO;

    }

    $r = array();  
    $tipo  = $_POST['tipo'];
    $id      = $_POST['pkID'];  
    $nombref  = $_POST['nombre'];
    $fk_tipo_grupo  = $_POST['fkID_tipo_grupo'];
    $fk_grado  = $_POST['fkID_grado'];
    $fk_institucion  = $_POST['fkID_institucion'];
    $fecha  = $_POST['fecha_creacion'];

    switch ($tipo) {
        case 'crear':
            $generico = new Generico_DAO();
            $nombre =$_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombre = str_replace(" ", "_", $nombre);
            $nombre = str_replace("%", "_", $nombre);
            $nombre = str_replace("-", "_", $nombre);
            $nombre = str_replace(";", "_", $nombre);
            $nombre = str_replace("#", "_", $nombre);
            $nombre = str_replace("!", "_", $nombre);
            //carga el archivo en el servidor
            $destino = "../vistas/logos/" . $nombre;  
            if(move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {        
                        $q_inserta = "insert into `grupo`(nombre, fkID_tipo_grupo, fkID_grado, fkID_institucion, url_logo, fecha_creacion) VALUES ('$nombref', '$fk_tipo_grupo', '$fk_grado', '$fk_institucion', '$nombre', '$fecha')";
                        $r["query"] = $q_inserta;           

                        $resultado = $generico->EjecutaInsertar($q_inserta);
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }

            } else {    
                 $mensaje = "El archivo $nombre no se ha almacenado en forma exitosa";
            }
            echo json_encode($nombre);
            break;
        case 'editar':
            $generico = new Generico_DAO();
            $nombre =$_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombre = str_replace(" ", "_", $nombre);
            $nombre = str_replace("%", "_", $nombre);
            $nombre = str_replace("-", "_", $nombre);
            $nombre = str_replace(";", "_", $nombre);
            $nombre = str_replace("#", "_", $nombre);
            $nombre = str_replace("!", "_", $nombre);
            //carga el archivo en el servidor
            $destino = "../vistas/subidas/" . $nombre;  
            if(move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {        
                        $q_inserta = "update funcionario SET nombre_funcionario='$nombref',apellido_funcionario='$apellido',fkID_tipo_documento='$fk_tipo',documento_funcionario='$documento',telefono_funcionario='$telefono',direccion_funcionario='$direccion',email_funcionario='$email',url_funcionario='$nombre' where pkID='$id'";
                        $r["query"] = $q_inserta;           
                        $resultado = $generico->EjecutaInsertar($q_inserta);
                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }

            } else {    
                 $mensaje = "El archivo $nombre no se ha almacenado en forma exitosa";
            }
            echo json_encode($nombre);
            break;
            case 'editarsin':
                    $generico = new Generico_DAO();
                    $q_inserta = "update funcionario SET nombre_funcionario='$nombref',apellido_funcionario='$apellido',fkID_tipo_documento='$fk_tipo',documento_funcionario='$documento',telefono_funcionario='$telefono',direccion_funcionario='$direccion',email_funcionario='$email' where pkID='$id' ";
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
                case 'crearsin':
                    $generico = new Generico_DAO();
                    $q_inserta = "insert into `grupo`(nombre, fkID_tipo_grupo, fkID_grado, fkID_institucion, fecha_creacion) VALUES ('$nombref', '$fk_tipo_grupo', '$fk_grado', '$fk_institucion', '$fecha')";
                        $r["query"] = $q_inserta;           

                        $resultado = $generico->EjecutaInsertar($q_inserta);
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