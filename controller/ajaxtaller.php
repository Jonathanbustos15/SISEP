<?php

    include('../DAO/genericoDAO.php');

    class Generico_DAO{
        use GenericoDAO;
    }

    $r = array();  
    $tipo  = $_POST['tipo'];
    $id      = isset($_POST['pkID'])? $_POST['pkID'] : "";
    $fecha  = isset($_POST['fecha_taller'])? $_POST['fecha_taller'] : ""; 
    $fk_tipo_t  = isset($_POST['fkID_tipo_taller'])? $_POST['fkID_tipo_taller'] : "";
    $descripcion  = isset($_POST['descripcion'])? $_POST['descripcion'] : ""; 
    $fk_tutor  = isset($_POST['fkID_tutor'])? $_POST['fkID_tutor'] : "";
    $proyecto  = isset($_POST['fkID_proyectoM'])? $_POST['fkID_proyectoM'] : "2";

    switch ($tipo) {
        case 'crear':
            $generico = new Generico_DAO();
            if (isset($_FILES['file']["name"])) {
                $nombre1=$_FILES['file']["name"];
            } else {
                $nombre1="";
            }
            if (isset($_FILES['file2']["name"])) {
                $nombre2=$_FILES['file2']["name"];
            } else {
                $nombre2="";
            }
            if ($nombre1!="") {
                $nombre1 = str_replace(" ", "_", $nombre1);
                $destino = "../server/php/files/" . $nombre1;
                if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
                   $nombre1=$nombre1; 
                   $r["estado"] = "Error servidor";
                }else{
                    $nombre1="";
                    $r["estado"] = "Error servidor";
                }
            }

            if ($nombre2!="") {
                $nombre2 = str_replace(" ", "_", $nombre2);
                $destino = "../server/php/files/" . $nombre2;
                if (move_uploaded_file($_FILES['file2']["tmp_name"], $destino)) {
                   $nombre2=$nombre2; 
                }else{
                    $nombre2="";
                }
            }

            $q_inserta = "insert INTO `talleres_formacion`(`fkID_tipo_taller`, `fecha_taller`, `fkID_tutor`, `descripcion`, `url_documento`, `url_listado`, `fkID_proyectoM`) VALUES ('$fk_tipo_t', '$fecha', '$fk_tutor','$descripcion', '$nombre1', '$nombre2', '$proyecto')";
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
            if (isset($_FILES['file']["name"])) {
                $nombre1=$_FILES['file']["name"];
            } else {
                $nombre1="";
            }
            if (isset($_FILES['file2']["name"])) {
                $nombre2=$_FILES['file2']["name"];
            } else {
                $nombre2="";
            }
            if ($nombre1!="") {
                $nombre1 = str_replace(" ", "_", $nombre1);
                $destino = "../server/php/files/" . $nombre1;
                if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
                   $nombre1=$nombre1; 
                   $r["estado"] = "Error servidor";
                }else{
                    $nombre1="";
                    $r["estado"] = "Error servidor";
                }
            }
            if ($nombre2!="") {
                $nombre2 = str_replace(" ", "_", $nombre2);
                $destino = "../server/php/files/" . $nombre2;
                if (move_uploaded_file($_FILES['file2']["tmp_name"], $destino)) {
                   $nombre2=$nombre2; 
                }else{
                    $nombre2="";
                }
            }
            if ($nombre1=="" && $nombre2=="") {
                       $q_inserta = "update `talleres_formacion` SET `fkID_tipo_taller`='$fk_tipo_t',`fecha_taller`='$fecha',`fkID_tutor`='$fk_tutor',`descripcion`='$descripcion' where pkID='$id'";
            }
            if ($nombre1=="" && $nombre2!="") {
                       $q_inserta = "update `talleres_formacion` SET `fkID_tipo_taller`='$fk_tipo_t',`fecha_taller`='$fecha',`fkID_tutor`='$fk_tutor',`descripcion`='$descripcion',`url_listado`='$nombre2' where pkID='$id'";
            }
            if ($nombre1!="" && $nombre2=="") {
                       $q_inserta = "update `talleres_formacion` SET `fkID_tipo_taller`='$fk_tipo_t',`fecha_taller`='$fecha',`fkID_tutor`='$fk_tutor',`descripcion`='$descripcion',`url_documento`='$nombre1' where pkID='$id'";
            } 
            if ($nombre1!="" && $nombre2!="") {
                       $q_inserta = "update `talleres_formacion` SET `fkID_tipo_taller`='$fk_tipo_t',`fecha_taller`='$fecha',`fkID_tutor`='$fk_tutor',`descripcion`='$descripcion',`url_documento`='$nombre1',`url_listado`='$nombre2' where pkID='$id'";
            }
            $r["query"] = $q_inserta;           
            $resultado = $generico->EjecutaActualizar($q_inserta);
            if($resultado){
                            
                $r[] = $resultado;          

            }else{

                $r["estado"] = "Error";
                $r["mensaje"] = "No se inserto.";
            }
            break;
            case 'eliminarlista':
                    $generico = new Generico_DAO();
                    $q_inserta = "update `talleres_formacion` SET url_listado='' where pkID='$id' ";
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
            case 'eliminardocumento':
                    $generico = new Generico_DAO();
                    $q_inserta = "update `talleres_formacion` SET url_documento='' where pkID='$id' ";
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
            case 'eliminarlogico':
                    $generico = new Generico_DAO();
                    $q_inserta = "update `talleres_formacion` SET estadoV=2 where pkID='$id' ";
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