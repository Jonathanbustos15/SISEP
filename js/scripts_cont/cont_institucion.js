$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevoInstitucion").jquery_controllerV2({
	 	nom_modulo:'institucion',
      	titulo_label:'Nueva Institución',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);        
      	},
      	functionAfter:function(ajustes){
        	console.log('Ejecutando despues de todo...');        
      	}
	 });     
	 
	 $("#btn_actioninstitucion").jquery_controllerV2({
	 	tipo:'inserta/edita',
      	nom_modulo:'institucion',
      	nom_tabla:'institucion',
        auditar:true,
        recarga:false,      
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);        
      	},
      	functionAfter:function(data,ajustes){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
            console.log(ajustes);
            //dbGen.db_general
            if (ajustes.action == "crear") {
                
                //(tabla_aux,nom_id_ini,id_ini,reload)
                
                var institucion_proyectoM = new ins_proyectoM("institucion_proyectoM","fkID_institucion",data[0].last_id,true);

                institucion_proyectoM.insProyM();
                
            }else{
                location.reload();
            }            
      	}           
	 });
	 
	 $("[name*='edita_institucion']").jquery_controllerV2({
	 	tipo:'carga_editar',
      	nom_modulo:'institucion',
      	nom_tabla:'institucion',
      	titulo_label:'Editar Institución',
      	tipo_load:1,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);       
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
        
        	id_institucion = data.mensaje[0].pkID

      	}
	 });

	 $("[name*='elimina_institucion']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'institucion',
  		nom_tabla:'institucion',
      auditar:true, 
      functionBefore:function(ajustes){
        //-----------------------------------------------------
        console.log(ajustes.id)

        id_institucion = ajustes.id;
      },
      functionAfter:function(data){
        console.log(data)

        if (data.estado == "ok") {
          eliminaSedes(id_institucion)
        }           
      } 		
	 });


   //----Función para elimina los registros de la tabla sede, esta función se ejecuta despues de haber eliminado la institución asociada a esa tabla.
   function eliminaSedes(institucion){

    var query = "DELETE FROM `sede` WHERE fkID_institucion = "+institucion;

    $.ajax({
      async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });
   }


	 //---------------------------------------------------
    function validarEmail( email ) {
      expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
      if ( !expr.test(email) ){
        alert("Error: La dirección de correo " + email + " es incorrecta.");
        $("#email").val('');
        $("#email").focus();
      }else{
        return true;
      }     
  	}

  	$("#email").change(function(event) {
    /* Act on the event */
    	validarEmail( $(this).val() )
  	});
	 
	//---------------------------------------------------------

  //
  sessionStorage.setItem("id_tab_institucion",null);
  //---------------------------------------------------------

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
        window.location.href = $(this).attr('href');
    });
});
