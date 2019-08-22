$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevodocente").jquery_controllerV2({
	 	nom_modulo:'docente',
  		titulo_label:'Nuevo Docente',
  		functionBefore:function(){
  			//$("#pass").removeAttr('readonly');
  			//funcion para resetear el div de carga de los archivos
  			upload.functionReset()
  		},
  		functionAfter:function(){
  			
  			//limpia el form
  			$("#"+rel_materias.formulario_add).html("");

  			$("#"+rel_grados.formulario_add).html("");  			
  			//console.log(rel_grados)

  			//console.log(rel_materias)

  			//setea el valor de los arrays
  			rel_materias.arrElementos.length = 0;
			  rel_materias.arrElementosRelation.length=0;

			  rel_grados.arrElementos.length = 0;
			  rel_grados.arrElementosRelation.length=0;
  			//-------------------------------------  		  
  		}
	 });
	 
	 $("#btn_actiondocente").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'docente',
	    nom_tabla:'usuarios',
        recarga : false,
	    tipo_ajax : {
	        crear : "inserta_registro",
	        editar : "actualizar"
	    },
	    functionAfter:function(data){

	    	//console.log(data)

	    	var proyectoM = $("#fkID_proyectoM").val();

        var alias = $("#alias").val();

        console.log(alias);

	    	var accion = $("#btn_actiondocente").attr("data-action")

	    	if (accion == "crear") {

	    		var id_last_usuario = data[0].last_id;

	    		if (data[0].estado == "ok") {

                    insertUsuarioProyectoM(id_last_usuario, proyectoM);
                    alert("Su nombre de usuario es:  "+alias+"  con contraseña: 12345");
                    


                    //insertDocenteGrupo(id_last_usuario, $('#grupo').val(), $('#form_docente #fkID_rol').val())	    		             

          }   
		    	//------------------------------------
		        rel_materias.serializa_array(rel_materias.crea_array(rel_materias.arrElementos,id_last_usuario));
		        //++++++++++++++++++++++++++++++++++++
		        rel_grados.serializa_array(rel_grados.crea_array(rel_grados.arrElementos,id_last_usuario));
		        //------------------------------------
		        //------------------------------------
		        //"url="+val.name+"&nombre="+self.archCoincide+"&fkID_docente="+id_last_usuario
                console.log(upload.arregloDeArchivos.length)

                if (upload.arregloDeArchivos.length > 0) {
    		        $('#fileupload').fileupload('send', {files:upload.arregloDeArchivos})
    		        .success(function (result, textStatus, jqXHR) {	        	
    				    upload.functionSend(id_last_usuario,result);
    		        });
                }else{
                    //location.reload()
                    window.location.href = "cont_login.php";
                }   
                             
	    	}else{
	    		//cargar al editar y el last id???
	    		//console.log(upload.arregloDeArchivos.length)

	    		if (upload.arregloDeArchivos.length > 0) {

	    			$('#fileupload').fileupload('send', {files:upload.arregloDeArchivos})
			        .success(function (result, textStatus, jqXHR) {	        	
					    upload.functionSend($("#pkID").val(),result);
			        });

	    		}else{
	    			//location.reload()
            window.location.href = "cont_login.php";
	    		}
	    		
	    	}	        

	    }
	 });



	 //Función para insertar en la tabla auxiliar usuario_grupo, despues de insertar en la tabla usuarios, haciendo referencia a docentes
   	function insertDocenteGrupo(docente, grupo, rol){

      var query = " INSERT INTO `usuario_grupo` VALUES (NULL, "+docente+", "+grupo+", "+rol+")";

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

	 //Función para insertar en la tabla auxiliar usuario_grupo_formacion , despues de insertar en la tabla usuarios, haciendo referencia a docentes
   	function insertDocenteGF(docente, grupof){

      var query = " INSERT INTO `usuario_grupo_formacion` VALUES (NULL, "+docente+", "+grupof+")";

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


   	//Función para insertar en la tabla auxiliar usuario_proyectoM, despues de insertar en la tabla usuarios
   function insertUsuarioProyectoM(usuario, proyectoM){

      var query = " INSERT INTO `usuario_proyectoM` VALUES (NULL, "+usuario+", "+proyectoM+")";

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
	 
	 $("[name*='edita_docente']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'docente',
  		nom_tabla:'usuarios',
  		titulo_label:'Edita Docente',        
  		tipo_load:2,
  		functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
       
      	},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);
        	//$("#pass").attr('readonly', 'true');
        	
        	id_docente = data.mensaje[0].pkID

        	console.log(id_docente)

        	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        	var query = "select materia.*, usuarios.alias, usuario_materia.pkID as numReg"+ 

                " FROM materia"+

                " INNER JOIN usuario_materia ON usuario_materia.fkID_materia = materia.pkID"+

                " INNER JOIN usuarios ON usuario_materia.fkID_usuario = usuarios.pkID"+

                " WHERE usuarios.pkID = "+id_docente;

        	rel_materias.carga_elementos(query);
        	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        	/**/
        	var query_grados = "select grado.*, usuarios.alias, usuario_grado.pkID as numReg"+ 

                " FROM grado"+

                " INNER JOIN usuario_grado ON usuario_grado.fkID_grado = grado.pkID"+

                " INNER JOIN usuarios ON usuario_grado.fkID_usuario = usuarios.pkID"+

                " WHERE usuarios.pkID = "+id_docente;

        	rel_grados.carga_elementos(query_grados);
        	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        	//console.log(rel_materias.getArrElementosC())

        	var query_docs = "SELECT * FROM `documentos_docente` WHERE fkID_docente = "+id_docente;

        	upload.functionLoad(query_docs);   	

  		}
	 });
	 
	 $("[name*='elimina_docente']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'docente',
  		nom_tabla:'usuarios',
  		recarga:false,
  		functionBefore:function(ajustes){
        //-----------------------------------------------------
        console.log(ajustes.id)

        id_usuario = ajustes.id;
      },
      functionAfter:function(data){
        console.log(data)

        if (data.estado == "ok") {
          eliminaUsuarioGrupoF(id_usuario)
          eliminaUsuarioProyectoM(id_usuario)
        }           
      }
	 });


   $("[name*='ver_archivos_docente']").click(function(event) {
        console.log($(this).data("id-registro"))

        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_docente` WHERE fkID_docente = "+$(this).data("id-registro"));

        carga_archivos.load()
    });
	 
	//---------------------------------------------------------
	//----Función que elimina los registros de la tabla auxiliar usuario_grupo_formacion, despues de eliminar un usuario-docente
  	function eliminaUsuarioGrupoF(fkID_usuario){

    	var query = " DELETE FROM `usuario_grupo_formacion` WHERE fkID_usuario = "+fkID_usuario;

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


  	 //----Función que elimina los registros de la tabla auxiliar usuario_proyectoM
  function eliminaUsuarioProyectoM(fkID_usuario){

    var query = " DELETE FROM `usuario_proyectoM` WHERE fkID_usuario = "+fkID_usuario;

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
	//---------------------------------------------------------
	/*$( "#fecha_nacimiento" ).datepicker({
		dateFormat: "yy-mm-dd",
		yearRange: "1930:2040",
		changeYear: true,
		showButtonPanel: true,			
	});*/

  $( "#fecha_nacimientoD" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2001",
    changeYear: true,
    showButtonPanel: true,      
  });

	$("#fecha_vinculacion").datepicker({
		dateFormat: "yy-mm-dd",
		yearRange: "1930:2040",
		changeYear: true		
	});

	$("#form_docente #email").change(function(event) {
		validarEmail( $(this) )
	});


  ////////////////////////////////////////////////
  function validarTelefono(telefono){
 
    //if(formulario.telefono.value.length>2) { //comprueba que no esté vacío
      //formulario.telefono.val('');
    valor = /^\d{5,15}$/;
    if( !valor.test(telefono) ) {
      alert("Error : El numero de teléfono "+ telefono +" es incorrecto. ");
       $("#form_docente #numero_telefono").val('');
        $("#form_docente #numero_telefono").focus();

    return false;
    } else{
      return true;
    } 

  }

  $("#form_docente #numero_telefono").change(function(event) {
    /* Act on the event */
      validarTelefono( $(this).val() )
    });
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++

  ////////////////////////////////////////////////
  function validarDocumento(documento){
 
    valor =  /^\d{6,12}$/;
    if( !valor.test(documento) ) {
      alert("Error : El numero de documento "+ documento +" es incorrecto. ");
       $("#form_docente #numero_documento").val('');
        $("#form_docente #numero_documento").focus();

    return false;
    } else{
      return true;
    } 

  }

  $("#form_docente #numero_documento").change(function(event) {
    /* Act on the event */
      validarDocumento( $(this).val() )
    });
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

	//---------------------------------------------------------
	//Instancias del complemento matrixRelation
	
	//(seleccionador,btn_accion,nombre_modulo,nombre_modulo2,formulario_add,nombre_tabla,obtHE)
	var obtHE = {
    	"fkID_materia" : 0,
    	"fkID_usuario" : 0
    }

	var rel_materias = new matrixRelation("select_materia", "btn_actiondocente", "materia", "usuario", "frm_usuarios_materias", "usuario_materia", obtHE);

	rel_materias.setup();



	var obtHE_grados = {
    	"fkID_grado" : 0,
    	"fkID_usuario" : 0
    }

	var rel_grados = new matrixRelation("form_docente #select_grado", "btn_actiondocente", "grado", "usuario", "frm_usuarios_grados_doc", "usuario_grado", obtHE_grados);

	rel_grados.setup();

	//---------------------------------------------------------

	//---------------------------------------------------------
	//File upload

	var upload = new funcionesUpload("btn_actiondocente","res_form","not_documentos","documentos_docente","fkID_docente")

	$('#fileupload').fileupload({
        dataType: 'json',
        add: function (e, data) { 	

        	upload.functionAdd(data)
			        		
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });
	//---------------------------------------------------------

  //-------------------------------------------------------------------------
  //complemento usuarios
  var docentes_f = new usersGen("form_docente");
  docentes_f.init()
  //-------------------------------------------------------------------------

  //-------------------------------------------------------------------------
  //complemento validacion numero de documento
  var validacion_docente = new validaCampoLike('numero_documento','usuarios','numero_documento','form_docente','btn_actiondocente');
  //-------------------------------------------------------------------------

	//
	sessionStorage.setItem("id_tab_docentes",null);
	//---------------------------------------------------------

});
