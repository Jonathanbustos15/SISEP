<?php

    include('../DAO/genericoDAO.php');

    class Generico_DAO{
        use GenericoDAO;
    }

    $r = array();  
    $tipo  = $_POST['tipo'];
    $id      = isset($_POST['pkID'])? $_POST['pkID'] : "";
    $fecha  = isset($_POST['fecha_feria'])? $_POST['fecha_feria'] : ""; 
    $fecha2  = isset($_POST['fecha_sesion'])? $_POST['fecha_sesion'] : "";
    $fk_tipo_t  = isset($_POST['fkID_tipo_feria'])? $_POST['fkID_tipo_feria'] : "";
    $fk_feria  = isset($_POST['fkID_feria_formacion'])? $_POST['fkID_feria_formacion'] : "";
    $descripcion  = isset($_POST['descripcion'])? $_POST['descripcion'] : ""; 
    $fk_tutor  = isset($_POST['fkID_tutor'])? $_POST['fkID_tutor'] : "";
    $proyecto  = isset($_POST['fkID_proyectoM'])? $_POST['fkID_proyectoM'] : "2";
    $descripcion_foto = isset($_POST['descripcion_foto_feria'])? $_POST['descripcion_foto_feria'] : "";
$fkID_album  = isset($_POST['fkID_album'])? $_POST['fkID_album'] : "";  
  
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

            $q_inserta = "insert INTO `feria`(`fecha_feria`, `fkID_tipo_feria`, `lugar_feria`, `url_documento`, `url_lista`, `proyecto_macro`) VALUES ('$fecha', '$fk_tipo_t','$descripcion', '$nombre1', '$nombre2','$proyecto')";
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
            case 'eliminarlogico':
                    $generico = new Generico_DAO();
                    $q_inserta = "update `feria` SET estadoV=2 where pkID='$id' ";
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
        case 'crear_foto':
            $generico = new Generico_DAO();  
            if ($descripcion_foto=="") {
                $descripcion_foto="foto";
            }
            if(!empty($_FILES['url_foto'])){
    // File upload configuration
            $targetDir = "../img/";
            $allowTypes = array('jpg','png','jpeg','gif');
            
            $images_arr = array();  
            foreach($_FILES['url_foto']['name'] as $key=>$val){
                $image_name = $_FILES['url_foto']['name'][$key];
                
                // File upload path
                $fileName = basename($_FILES['url_foto']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){    
                    // Store images on the server
                    if(move_uploaded_file($_FILES['url_foto']['tmp_name'][$key],$targetFilePath)){
                        $nombre = $_FILES['url_foto']['name'][$key];
                        $q_inserta  = "insert into `fotos_feria`(`url_foto`, `descripcion`, `fkID_album`) VALUES ('$nombre', '$descripcion_foto', '$fkID_album')";
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
        }
            break;
        default:
            # code...
            break;
    }
    
    echo json_encode($r);
    
?>