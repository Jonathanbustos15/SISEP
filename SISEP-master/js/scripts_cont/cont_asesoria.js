$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevoasesoria").jquery_controllerV2({
	 	nom_modulo:'asesoria',
      	titulo_label:'Nueva Asesoría',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
          //$("#form_asesoria #fkID_fase").attr("disabled", "disabled");    
          upload.functionReset() 

        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(ajustes){
        	console.log('Ejecutando despues de todo...');

        //console.log(ajustes);
        //destruye_cambia_pass();
      	}
	 });
	 
	 $("#btn_actionasesoria").jquery_controllerV2({
	 	tipo:'inserta/edita',
      	nom_modulo:'asesoria',
      	nom_tabla:'asesoria',
      //cambiando el tipo de ajax para poder crear el usuario
      //con la contraseña encriptada.
      /*tipo_ajax : {
        crear : "inserta_registro",
        editar : "actualizar"
      },*/
        recarga:false,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data)
          var accion = $("#btn_actionasesoria").attr("data-action")        

          if (accion == "crear") {

            var id_last_asesoria = data[0].last_id;
            //------------------------------------
            //"url="+val.name+"&nombre="+self.archCoincide+"&fkID_docente="+id_last_usuario
            if (upload.arregloDeArchivos.length > 0) {
                
                  $('#fileuploadAS').fileupload('send', {files:upload.arregloDeArchivos})
                  .success(function (result, textStatus, jqXHR) {                                
                      upload.functionSend(id_last_asesoria,result);
                  });

            }else{
                location.reload()
            } 

        }else{
          //cargar al editar y el last id???
          //console.log(upload.arregloDeArchivos.length)

          if (upload.arregloDeArchivos.length > 0) {

            $('#fileuploadAS').fileupload('send', {files:upload.arregloDeArchivos})
              .success(function (result, textStatus, jqXHR) {           
              upload.functionSend($("#pkID").val(),result);
              });

          }else{
            location.reload()
          }
          
        }         

      }      
	 });

	 
	 $("[name*='edita_asesoria']").jquery_controllerV2({
	 	tipo:'carga_editar',
      	nom_modulo:'asesoria',
      	nom_tabla:'asesoria',
      	titulo_label:'Editar Asesoría',
      	tipo_load:1,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
       // crea_cambia_pass();
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
        
        	id_asesoria = data.mensaje[0].pkID

          var query_docs = "SELECT * FROM `documentos_asesoria` WHERE fkID_asesoria = "+id_asesoria;

          upload.functionLoad(query_docs);  

      	}
	 });

	 $("[name*='elimina_asesoria']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'asesoria',
  		nom_tabla:'asesoria',
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes);  			
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);  		
  		}
	 });


	 
	//---------------------------------------------------------
   //---------------------------------------------------------
  $( "#fecha" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true,      
  });
    

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/
   //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  var upload = new funcionesUpload("btn_actionasesoria","res_form","not_documentos","documentos_asesoria","fkID_asesoria")

  //console.log(upload)

  $('#fileuploadAS').fileupload({
        dataType: 'json',
        add: function (e, data) {   

          upload.functionAdd(data)
                  
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });

  //---------------------------------------------------------



    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
      window.location.href = $(this).attr('href');
    });

  //
    sessionStorage.setItem("id_tab_asesoria",null);
  //---------------------------------------------------------

});
