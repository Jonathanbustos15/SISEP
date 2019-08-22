$(function(){
	
	console.log("Js de proyecto marco.")
	//--------------------------------------
	tabs.nom_tab_default = "li_general";

	tabs.nombre_storage = "id_tab_proyectoM";

	tabs.arr_no_permit = ["",null,"null"];

	tabs.setTabs();
	//--------------------------------------


	$("#btnD").click(function(){

        var conf = confirm("Realmente desea cerrar el año?, esto cambiará todos los grupos a estado inactivo.");

        if (conf) {

    	  var activos = dbGen.db_general("select  pkID, fkID_estado FROM `grupo` WHERE fkID_estado = 1 ");

            activos.success(function(data){
                  //console.log(data)
                  //-------------------------
                  if (data.estado == "ok") {
                        //tomar los grupos activos y pasarlos a inactivo
                        //insertar el cambio de estado con la fecha
                        console.log(data.mensaje)

                        var itera = $.each(data.mensaje, function(index, val) {
                           //console.log("llave: "+index+" valor: "+val)
                           console.log(val)
                           //actualiza el estado de los grupos
                           //console.log("UPDATE `grupo` SET `fkID_estado` = '2' WHERE `grupo`.`pkID` = "+val.pkID)
                           //console.log("INSERT INTO `cambio_estado_grupo_inv` VALUES (null, '"+date+"', '2', '"+val.pkID+"')")
                           /**/
                           var actualiza_grupo = dbGen.db_general("UPDATE `grupo` SET `fkID_estado` = '2' WHERE `grupo`.`pkID` = "+val.pkID);

                           actualiza_grupo.success(function(data){
                                console.log(data)

                                var inserta_cambio_estado = dbGen.db_general("INSERT INTO `cambio_estado_grupo_inv` VALUES (null, '"+date+"', '2', '"+val.pkID+"')");

                                inserta_cambio_estado.success(function(data){
                                    console.log(data)
                                })
                           })
                           //+++++++++++++++++++++++++++++++++
                        });

                        $.when(itera).then(function(){
                            alert("El cierre de año se ha efectuado satisfactoriamente.");
                            location.reload();
                        });
                        

                  } else {
                    //console.log("No se puedo ejecutar la consulta.")
                    alert("No hay grupos activos en este momento.");
                  }
                  //-------------------------
            });

        };
	  
    });    
  

});