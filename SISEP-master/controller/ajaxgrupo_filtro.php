<?php
$cod = $_POST["pkID"];

  		if (!empty($cod)) {
  			comprobar($cod);  
  		}else{

  		}
  		function comprobar($cod) {
  			$salida = "";
  			$servername = "localhost";
		    $username = "root";
		  	$password = "";
		  	$dbname = "siseppbd";

			$conn = new mysqli($servername, $username, $password, $dbname);
		      if($conn->connect_error){
		        die("Conexión fallida: ".$conn->connect_error);
		      }
		  		
  			
  			$sql = mysqli_query($conn,"select distinct grupo.*,YEAR(grupo.fecha_creacion) as anio, grado.nombre as nom_grado, institucion.nombre_institucion as nom_institucion, grupo.pkID as numero, tipo_proyecto.nombre as nom_tipo FROM grupo INNER JOIN tipo_proyecto ON tipo_proyecto.pkID = grupo.fkID_tipo_grupo INNER JOIN institucion ON institucion.pkID = grupo.fkID_institucion INNER JOIN grado ON grado.pkID = (CASE WHEN grupo.fkID_grado = 0 THEN 6 WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado END) where grupo.estadoV = 1 and YEAR(grupo.fecha_creacion)=".$cod);
		  	$grupos = array();

		if ($sql->num_rows>0) {
			$salida.="<table class="."display table table-striped table-bordered table-hover"." id="."tbl_grupo".">
                  <thead>
                      <tr>
                         <!-- <th>ID Grupo</th>-->
                          <th>Nombre</th>
                          <th >Tipo de Proyecto</th>
                          <th>Año</th>
                          <th>Institución</th>
                          <th>Grado</th>
                          <th data-orderable="."false".">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>";

    	while ($fila = $sql->fetch_assoc()) {
    		$salida.=" <tr>
    	 <td title="."Click Ver Detalles"."href="."detalles_grupo.php?id_grupo=". $fila['pkID']." class="."detail".">".$fila['nombre']."</td>
                                 <td title="."Click Ver Detalles"."href="."detalles_grupo.php?id_grupo=". $fila['pkID']."class="."detail".">". $fila['nom_tipo']."</td>
                                 <td title="."Click Ver Detalles"."href="."detalles_grupo.php?id_grupo=". $fila['pkID']."class="."detail".">" . $fila['anio']."</td>
                                 <td title="."Click Ver Detalles"."href="."detalles_grupo.php?id_grupo=". $fila['pkID']."class="."detail".">". $fila['nom_institucion']."</td>
                                 <td title="."Click Ver Detalles"."href="."detalles_grupo.php?id_grupo=". $fila['pkID']."class="."detail".">". $fila['nom_grado']."</td>
		                         <td>
		                             <button id="."btn_editargrupo"." title="."Editar"." name="."edita_hv_proyecto"."type="."button". "class="."btn btn-warning"."data-toggle="."modal"."data-target="."#form_modal_grupo"." data-id-hv-proyecto =" . $fila['pkID']. "><span class="."glyphicon glyphicon-pencil"."></span></button>

		                             <button id="."btn_eliminarpersonal"." title="."Eliminar"." name="."elimina_hv_proyecto"." type="."button". "class="."btn btn-danger". "data-id-hv-proyecto = ". $fila['pkID']."><span class="."glyphicon glyphicon-remove"."></span></button>
		                         </td>
		                     </tr>";
		                      
    	}
    		$salida.="</tbody>
              </table>";
              echo $salida;
	    }else{
	    	$salida.="NO HAY DATOS ";

	    }
	}
	    

?>
