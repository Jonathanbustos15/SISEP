$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevoActor").jquery_controllerV2({
	 	nom_modulo:'actor',
      	titulo_label:'Nuevo Actor',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
           upload.functionReset()     
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(ajustes){
        	console.log('Ejecutando despues de todo...');
        //console.log(ajustes);
        //destruye_cambia_pass();
      	}
	 });
	 
	 $("#btn_actionactor").jquery_controllerV2({
	 	tipo:'inserta/edita',
      	nom_modulo:'actor',
      	nom_tabla:'actor',
      //cambiando el tipo de ajax para poder crear el usuario
      //con la contraseña encriptada.
      /*tipo_ajax : {
        crear : "inserta_registro",
        editar : "actualizar"
      },*/
        recarga:false,
        auditar:true,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);  
          console.log(data)

        var accion = $("#btn_actionactor").attr("data-action")        

         if (accion == "crear") {

            var id_last_actor = data[0].last_id;
            //------------------------------------
            //"url="+val.name+"&nombre="+self.archCoincide+"&fkID_docente="+id_last_usuario
            if (upload.arregloDeArchivos.length > 0) {
                $('#fileuploadA').fileupload('send', {files:upload.arregloDeArchivos})
                .success(function (result, textStatus, jqXHR) {                            
                    upload.functionSend(id_last_actor,result);
                });
            }else{
                location.reload()
            } 

        }else{
          //cargar al editar y el last id???
          //console.log(upload.arregloDeArchivos.length)

          if (upload.arregloDeArchivos.length > 0) {

            $('#fileuploadA').fileupload('send', {files:upload.arregloDeArchivos})
              .success(function (result, textStatus, jqXHR) {           
              upload.functionSend($("#pkID").val(),result);
              });

          }else{
            location.reload()
          }
          
        }         

      }

        
	 });

    
	 $("[name*='edita_actor']").jquery_controllerV2({
	 	tipo:'carga_editar',
      	nom_modulo:'actor',
      	nom_tabla:'actor',
      	titulo_label:'Editar Actor',
      	tipo_load:1,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
       // crea_cambia_pass();
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
        
        	id_actor = data.mensaje[0].pkID


          var query_docs = "SELECT * FROM `documentos_actor` WHERE fkID_actor = "+id_actor;

          upload.functionLoad(query_docs);   

      	}
	 });

	 $("[name*='elimina_actor']").jquery_controllerV2({
	 	  tipo:'eliminar',
  		nom_modulo:'actor',
  		nom_tabla:'actor',
      auditar:true,
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes);  			
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);  		
  		}
	 });


   $("[name*='ver_archivos_actor']").click(function(event) {
        console.log($(this).data("id-registro"))        

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_actor` WHERE fkID_actor = "+$(this).data("id-registro"));

        carga_archivos.load()
    });
	//---------------------------------------------------------
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  var upload = new funcionesUpload("btn_actionactor","res_form","not_documentos","documentos_actor","fkID_actor")

  //console.log(upload)

  $('#fileuploadA').fileupload({
        dataType: 'json',
        add: function (e, data) {   

          upload.functionAdd(data)
                  
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });

  //---------------------------------------------------------

  $( "#fecha_socializacion" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true,      
  });

  $( "#fecha_vinculacion" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true,      
  });

  //------------------------------------
  //validaciones con plugin overlooker

$("#form_actor").overlooker({
    validations:[       
        {
            id : "telefono_contacto",
            expresion : "telefono",
            evento : "change"
        },
        {
            id : "email_contacto",
            expresion : "email",
            evento : "change"
        }
    ],
})
//------------------------
    

  sessionStorage.setItem("id_tab_actor",null);




});
