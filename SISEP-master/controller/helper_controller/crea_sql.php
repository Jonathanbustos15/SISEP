<?php 

	class crea_sql{
	

 		function crea_select($array_campos){
 			
 			//-----------------------------------------------------------
 			//toma el nombre de la tabla
 			$nom_tabla = $array_campos['nom_tabla'];
 			//-----------------------------------------------------------
 			//retira el campo tipo y nom_tabla de $array_campos
 			unset($array_campos['tipo']);
 			unset($array_campos['nom_tabla']);

 			// construye query...
		    $sql  = "select * from `".$nom_tabla."` where pkID = ".$array_campos['pkID'];
 			//-----------------------------------------------------------

 			return $sql;
 		}

 		function crea_insert($array_campos){
 			
 			//-----------------------------------------------------------
 			//toma el nombre de la tabla
 			$nom_tabla = $array_campos['nom_tabla'];
 			//-----------------------------------------------------------
 			//retira el campo tipo y nom_tabla de $array_campos
 			unset($array_campos['tipo']);
 			unset($array_campos['nom_tabla']);
 			//setea pkID a null ya que es autonumerico puede que esto sea condicional a futuro
 			$array_campos['pkID'] = "NULL";
 			//-----------------------------------------------------------
 			// construye query...
		    $sql  = "insert INTO `".$nom_tabla."`";

		    // implode keys of $array...
		    $sql .= " (`".implode("`, `", array_keys($array_campos))."`)";

		    // implode values of $array...
		    $sql .= " VALUES ('".implode("', '", $array_campos)."') ";
		    //-----------------------------------------------------------
		    return $sql;
 		} 		

 		function crea_update($array_campos){
 			
 			//-----------------------------------------------------------
 			//toma el nombre de la tabla
 			$nom_tabla = $array_campos['nom_tabla'];
 			//-----------------------------------------------------------
 			//retira el campo tipo y nom_tabla de $array_campos
 			unset($array_campos['tipo']);
 			unset($array_campos['nom_tabla']);
 			//-----------------------------------------------------------

 			foreach($array_campos as $field_name => $field_value) {
			   $sql_str[] = "{$field_name} = '{$field_value}'";
			}

 			$sql = "update `".$nom_tabla."` SET ";

 			$sql .= implode(',', $sql_str);

 			$sql .= " where pkID = ".$array_campos["pkID"];

 			return $sql;
 		}

 		function crea_delete($array_campos){
 			
 			//-----------------------------------------------------------
 			//toma el nombre de la tabla
 			$nom_tabla = $array_campos['nom_tabla'];
 			//-----------------------------------------------------------
 			//retira el campo tipo y nom_tabla de $array_campos
 			unset($array_campos['tipo']);
 			unset($array_campos['nom_tabla']);

 			// construye query...
		    $sql  = "delete FROM `".$nom_tabla."` where pkID = ".$array_campos['pkID'];
 			//-----------------------------------------------------------

 			return $sql;
 		}

 		function crea_deletelog($array_campos)
		    {
		        //toma el nombre de la tabla
		        $nom_tabla = $array_campos['nom_tabla'];
		        //retira el campo tipo y nom_tabla de $array_campos
		        unset($array_campos['tipo']);
		        unset($array_campos['nom_tabla']);
		        // construye query...
		        $sql = "update `" . $nom_tabla . "` SET estadoV='2' where pkID = " . $array_campos['pkID'];
		        return $sql;
		    }

 	}


 ?>
