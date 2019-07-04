<?php

header('content-type: aplication/json; charset=utf-8'); //header para json

include '../DAO/genericoDAO.php';

include 'helper_controller/crea_sql.php';

class Generico_DAO
{

    use GenericoDAO;

}

$accion = $_POST['tipo'];

$r = array();
$r["mensaje"] = "No se ingreso.";

switch ($accion) {

        case 'insertar':

        $generico = new Generico_DAO();
        $linea_investigacion=$_POST['linea_investigacion'];
        $pregunta_investigacion =$_POST['pregunta_investigacion'];
        $objetivo_general=$_POST['objetivo_general'];
        $fkID_grupo=$_POST['fkID_grupo'];

        $q_inserta  = "insert into `proyecto_grupo`(`linea_investigacion`, `pregunta_investigacion`, `objetivo_general`, `fkID_grupo`) VALUES ('$linea_investigacion','$pregunta_investigacion','$objetivo_general','$fkID_grupo')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }

        break;
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    case 'actualizar':

        $generico = new Generico_DAO();
        $linea_investigacion=$_POST['linea_investigacion'];
        $pregunta_investigacion =$_POST['pregunta_investigacion'];
        $objetivo_general=$_POST['objetivo_general'];
        $fkID_grupo=$_POST['fkID_grupo'];

        $q_actualiza = "update `proyecto_grupo` SET `linea_investigacion`='$linea_investigacion',`pregunta_investigacion`='$pregunta_investigacion',`objetivo_general`='$objetivo_general' WHERE fkID_grupo=".$fkID_grupo;

        $resultado = $generico->EjecutaActualizar($q_actualiza);
        /**/
        if ($resultado) {

            $r["estado"]  = "ok";
            $r["mensaje"] = $resultado;
            $r["query"]   = $q_actualiza;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se actualizó.";
            $r["query"]   = $q_actualiza;
        }

        break;
 //----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------
   
        case 'consultar':
        $generico = new Generico_DAO();
        $fkID_grupo=$_POST['fkID_grupo'];
        $q_carga = "select * from `proyecto_grupo` WHERE fkID_grupo=".$fkID_grupo;

        $resultado = $generico->EjecutarConsulta($q_carga);
        /**/
        if ($resultado) {

            $r["estado"]  = "ok";
            $r["mensaje"] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No hay registros.";
        }

        break;
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
   
    case 'creardocumento':
            $fkID_grupo=$_POST['fkID_grupo'];
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
            $r["mensaje"] = "El archivo". $nombre. "se ha almacenado en forma exitosa";       
                        $q_inserta = "update `proyecto_grupo` SET url_documento='$nombre' WHERE fkID_grupo=".$fkID_grupo;
                        $r["query"] = $q_inserta;           

                        $resultado = $generico->EjecutaActualizar($q_inserta);
                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }
            } else {    
                 $r["mensaje"] = "El archivo no se ha almacenado en forma exitosa";
            }  
            break;  
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
   
    case 'crearbitacora':
            $fkID_grupo=$_POST['fkID_grupo'];
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
            $r["mensaje"] = "El archivo". $nombre. "se ha almacenado en forma exitosa";       
                        $q_inserta = "update `proyecto_grupo` SET url_bitacora='$nombre' WHERE fkID_grupo=".$fkID_grupo;
                        $r["query"] = $q_inserta;           

                        $resultado = $generico->EjecutaActualizar($q_inserta);
                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }
            } else {    
                 $r["mensaje"] = "El archivo no se ha almacenado en forma exitosa";
            }  
            break;
        //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    case 'eliminar_logico':
        $fkID_grupo=$_POST['fkID_grupo'];
          $generico = new Generico_DAO();     
                        $q_actualiza = "update `proyecto_grupo` SET `estadoV`=2 WHERE fkID_grupo=".$fkID_grupo;
                        $r["query"] = $q_actualiza;           

                        $resultado = $generico->EjecutaActualizar($q_actualiza);
                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }  
            break;    
     //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
   
    case 'eliminarbitacora':
            $fkID_grupo=$_POST['fkID_grupo'];
          $generico = new Generico_DAO();     
                        $q_actualiza = "UPDATE `proyecto_grupo` SET `url_bitacora`= '' WHERE fkID_grupo=".$fkID_grupo;
                        $r["query"] = $q_actualiza;           

                        $resultado = $generico->EjecutaActualizar($q_actualiza);
                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                            $r["mensaje"] = "No se inserto.";
                        }  
            break;    
     //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
   
    case 'eliminardocumento':
            $fkID_grupo=$_POST['fkID_grupo'];
          $generico = new Generico_DAO();     
                        $q_actualiza = "UPDATE `proyecto_grupo` SET `url_documento`= '' WHERE fkID_grupo=".$fkID_grupo;
                        $r["query"] = $q_actualiza;           

                        $resultado = $generico->EjecutaActualizar($q_actualiza);
                        /**/
                        if($resultado){
                            
                            $r[] = $resultado;          

                        }else{

                            $r["estado"] = "Error";
                        }  
            break; 

};

echo json_encode($r);  
//--------------------------------------------------------------------------------------------------------

 //imprime el json