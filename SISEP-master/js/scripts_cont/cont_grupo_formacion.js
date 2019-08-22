$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 //console.log(date)
	 
	 $("#btn_nuevogrupof").jquery_controllerV2({
	 	nom_modulo:'grupof',
  		titulo_label:'Nuevo Grupo de Formación',
  		functionBefore:function(ajustes){
        upload.functionReset();     

  		}
	 });
	 
	 $("#btn_actiongrupof").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'grupof',
	    nom_tabla:'grupo_formacion',	  
	    recarga : false,
      auditar:true,
	    functionBefore:function(ajustes){
	    	
	    },
	    functionAfter:function(data,ajustes){

	    	console.log(data)

	    	var accion = $("#btn_actiongrupof").attr("data-action") 

	    	 if (accion == "crear") {

            var tipo_user = leerCookie("log_sisep_IDtipo");
            //console.log(tipo_user);

            var pkID_user = leerCookie("log_sisep_id");

            var id_last_grupof= data[0].last_id;

            if(tipo_user == 12){
               insertFormadorGrupoF(pkID_user, id_last_grupof);
            }else{}

           
            //------------------------------------
            //"url="+val.name+"&nombre="+self.archCoincide+"&fkID_docente="+id_last_usuario

            if (upload.arregloDeArchivos.length > 0) {

                $('#fileuploadGF').fileupload('send', {files:upload.arregloDeArchivos})
                .success(function (result, textStatus, jqXHR) {
                   
                    upload.functionSend(id_last_grupof,result);
                });
                
            }else{
                location.reload()
            }

        }else{
          //cargar al editar y el last id???
          //console.log(upload.arregloDeArchivos.length)

          if (upload.arregloDeArchivos.length > 0) {

            $('#fileuploadGF').fileupload('send', {files:upload.arregloDeArchivos})
              .success(function (result, textStatus, jqXHR) {           
              upload.functionSend($("#pkID").val(),result);
              });

          }else{
            location.reload()
          }
          
        }         

      }
	 });


   //Función para insertar en la tabla auxiliar usuario_grupo_formacion, despues de insertar en la tabla grupo_formacion
   function insertFormadorGrupoF(formador, grupof){

      var query = " INSERT INTO `usuario_grupo_formacion` VALUES (NULL, "+formador+", "+grupof+")";

      console.log(query);

      $.ajax({
          async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          //location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });

   };

	 	 
	 $("[name*='edita_grupof']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'grupof',
  		nom_tabla:'grupo_formacion',
  		titulo_label:'Edita grupo de formación',
  		functionBefore:function(ajustes){
  			//-----------------------------------------------------
	    	
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);

        	id_grupof = data.mensaje[0].pkID

          var query_docs = "SELECT * FROM `documentos_grupoF` WHERE fkID_grupoF = "+id_grupof;

          upload.functionLoad(query_docs);    
        	
  		}
	 });
	 
	 $("[name*='elimina_grupof']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'grupof',
  		nom_tabla:'grupo_formacion',
      auditar:true
	 });
	 
	//---------------------------------------------------------

		
  $("[name*='ver_archivos_grupof']").click(function(event) {
        console.log($(this).data("id-registro"))

        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_grupoF` WHERE fkID_grupoF = "+$(this).data("id-registro"));

        carga_archivos.load()
    });
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	//inicializacion del plugin de fecha datetimepicker

	//calendario para la fecha de inicio
	$( "#fecha_inicio" ).datepicker({
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );
	      }			
	});
	//calendario para la fecha de inicio
	$( "#fecha_fin" ).datepicker({
		dateFormat: "yy-mm-dd"			
	});	
	//---------------------------------------------------------------
	 //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  var upload = new funcionesUpload("btn_actiongrupof","res_form","not_documentos","documentos_grupoF","fkID_grupoF")

  //console.log(upload)

  $('#fileuploadGF').fileupload({
        dataType: 'json',
        add: function (e, data) {   

          upload.functionAdd(data)
                  
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });

  //---------------------------------------------------------

  //
	
	//
	sessionStorage.setItem("id_tab_grupof",null);
	//---------------------------------------------------------

	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
        window.location.href = $(this).attr('href');
    });
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
});
