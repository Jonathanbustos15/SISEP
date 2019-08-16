<?php

    include('../DAO/genericoDAO.php');

    class Generico_DAO{
        use GenericoDAO;
    }

    $r = array();  
    $tipo  = $_POST['tipo'];
    $id      = isset($_POST['pkID'])? $_POST['pkID'] : "";
    $nombre_tdoc = isset($_POST['nombre_actividad'])? $_POST['nombre_actividad'] : "";
    $nombre_subtdoc = isset($_POST['nombre_subactividad'])? $_POST['nombre_subactividad'] : ""; 
    $fkID_tipo  = isset($_POST['fkID_categoria'])? $_POST['fkID_categoria'] : "";
    $fkID_subtipo  = isset($_POST['fkID_subcategoria'])? $_POST['fkID_subcategoria'] : "";
    $proyecto  = isset($_POST['fkID_proyecto_marco'])? $_POST['fkID_proyecto_marco'] : "2"; 
  
    switch ($tipo) {
        case 'crear_actividad':
            $generico = new Generico_DAO();
            

            $q_inserta = "insert INTO `tipo_documento`(`nombre_tdoc`) VALUES ('$nombre_tdoc')";
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
        case 'crear_subactividad':
            $generico = new Generico_DAO();
            

            $q_inserta = "insert INTO `tipo_documento`(`nombre_tdoc`, `fkID_padre`) VALUES ('$nombre_subtdoc', '$fkID_tipo' )";
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
                    $r["estado"] = "Error servidor";
                }
            }
            if ($nombre1=="" && $nombre2=="") {
                       $q_inserta = "update `feria` SET `fkID_tipo_feria`='$fk_tipo_t',`fecha_feria`='$fecha',`lugar_feria`='$descripcion' where pkID='$id'";
            }
            if ($nombre1!="" && $nombre2=="") {
                       $q_inserta = "update `feria` SET `fkID_tipo_feria`='$fk_tipo_t',`fecha_feria`='$fecha',`lugar_feria`='$descripcion',`url_documento`='$nombre1' where pkID='$id'";
            } 
            if ($nombre2!="" && $nombre1=="") {
                       $q_inserta = "update `feria` SET `fkID_tipo_feria`='$fk_tipo_t',`fecha_feria`='$fecha',`lugar_feria`='$descripcion',`url_lista`='$nombre2' where pkID='$id'";
            } 
            if ($nombre1!="" && $nombre2 !="") {
                       $q_inserta = "update `feria` SET `fkID_tipo_feria`='$fk_tipo_t',`fecha_feria`='$fecha',`lugar_feria`='$descripcion',`url_documento`='$nombre1',`url_lista`='$nombre2' where pkID='$id'";
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
                    $q_inserta = "update `feria` SET url_lista='' where pkID='$id' ";
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
                    $q_inserta = "update `feria` SET url_documento='' where pkID='$id' ";
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
            case 'consultar_subactividad':
            $generico = new Generico_DAO();

            $q_carga = "select * FROM `tipo_documento` WHERE fkID_padre=".$id;

            $resultado = $generico->EjecutarConsulta2($q_carga);
            /**/
            if ($resultado) {
                while ($row = mysqli_fetch_row($resultado)) {
                $codigo=$row[0];
                $nombre=$row[1];
                $r[] = array('codigo'=> $codigo, 'nombre'=> $nombre);
        }
            } else {
                $r["estado"]  = "Error";
            }

        break; 
            case 'eliminarlogicos':
                    $generico = new Generico_DAO();
                    $q_inserta = "update `sesion_feria` SET estadoV=2 where pkID='$id' ";
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
        case 'crear_documento':
            $generico = new Generico_DAO();  
            if(!empty($_FILES['url_archivo'])){
    // File upload configuration
            $targetDir = "../server/php/files/";
            
            $images_arr = array();  
            foreach($_FILES['url_archivo']['name'] as $key=>$val){
                $image_name = $_FILES['url_archivo']['name'][$key];

                $fileName = basename($_FILES['url_archivo']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;

                    if(move_uploaded_file($_FILES['url_archivo']['tmp_name'][$key],$targetFilePath)){
                        $nombre = $_FILES['url_archivo']['name'][$key];
                        $q_inserta  = "insert into `documentos`(`nom_doc`, `ruta`, `fkID_tipo`, `fkID_subtipo`, `fkID_proyecto_marco`) VALUES ('$nombre','$nombre', '$fkID_tipo', '$fkID_subtipo', '$proyecto')";
                            $r["query"] = $q_inserta;

                            $resultado = $generico->EjecutaInsertar($q_inserta);
                          
                            if ($resultado) {

                                $r[] = $resultado;

                            } else {

                                $r["estado"]  = "Error";
                                $r["mensaje"] = "No se inserto.";
                            }
                    }
            }
        }
            break;
        default:
            # code...
            break;
    }
    
    echo json_encode($r);
    
?>