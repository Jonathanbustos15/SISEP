$(function(){

  //chk_t.selector = "chk_admin";

	$("#btn_nuevoUsuario").jquery_controllerV2({
  		nom_modulo:'usuario',
  		titulo_label:'Nuevo Usuario',      
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');			
        
  		},
  		functionAfter:function(ajustes){
  			console.log('Ejecutando despues de todo...');

        users.init()

  			//console.log(ajustes);
  			destruye_cambia_pass();

        //limpia el form
        $("#"+rel_proyectosM.formulario_add).html("");
       
        //console.log(rel_grados)

        //console.log(rel_materias)

        //setea el valor de los arrays
        rel_proyectosM.arrElementos.length = 0;
        rel_proyectosM.arrElementosRelation.length=0;
  		}
  	});	

  	$("#btn_actionusuario").jquery_controllerV2({
  		tipo:'inserta/edita',
  		nom_modulo:'usuario',
  		nom_tabla:'usuarios',
      auditar:true,
      //cambiando el tipo de ajax para poder crear el usuario
      //con la contraseña encriptada.
      validarCampo:true,           
      nom_campo:'numero_documento',
      tipo_ajax : {
        crear : "inserta_registro",
        editar : "actualizar"
      },
  		recarga:false,
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes);
  			//$("#btn_actionusuario").html("Esto es antes...")
  		},
  		functionAfter:function(data){

        var proyectoM = leerCookie("id_proyectoM")

        var accion = $("#btn_actionusuario").attr("data-action")

        if (accion == "crear") {

          var id_last_usuario = data[0].last_id;          
          //insertUsuarioProyectoM(id_last_usuario, proyectoM)           
          rel_proyectosM.serializa_array(rel_proyectosM.crea_array(rel_proyectosM.arrElementos,id_last_usuario));  

          location.reload()
        }
      }		  
  	});

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

  	$("[name*='edita_usuario']").jquery_controllerV2({
		  tipo:'carga_editar',
  		nom_modulo:'usuario',
  		nom_tabla:'usuarios',
  		titulo_label:'Editar Usuario',
  		tipo_load:1,
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes);
  			crea_cambia_pass();
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);
        
        id_usuario = data.mensaje[0].pkID

        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
          var query = "select proyecto_marco.*, usuarios.alias, usuario_proyectoM.pkID as numReg"+ 

                " FROM proyecto_marco"+

                " INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_proyectoM = proyecto_marco.pkID"+

                " INNER JOIN usuarios ON usuario_proyectoM.fkID_usuario = usuarios.pkID"+

                " WHERE usuarios.pkID = "+id_usuario;

          rel_proyectosM.carga_elementos(query);
          //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

  		}
	});	

  	$("[name*='elimina_usuario']").jquery_controllerV2({
  		tipo:'eliminar',
  		nom_modulo:'usuario',
  		nom_tabla:'usuarios',
      auditar:true,
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes); 
        id_usuario = ajustes.id; 			
  		},
  		functionAfter:function(data){
        console.log(data)
        if (data.estado == "ok") {
          eliminaUsuarioProyectoM(id_usuario)
        }           
      }
  	});

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

  	//funciones cambiar de pass---------------------------------------------------------------------

    function crea_cambia_pass(){

    	destruye_cambia_pass();

    	$("#pass").attr("readonly","true");

    	$(".modal-footer").append('<button id="btn_passUsuario" type="button" class="btn btn-warning" data-action="-">'+
            '<span id="lbl_btn_passUsuario"></span>'+
        '</button>');

        
        $("#btn_passUsuario").html("Cambiar Contraseña");

        $("#btn_passUsuario").attr('data-action', 'cambia_pass');

        
        $("#btn_passUsuario").click(function(event) {
  	  		/* Act on the event */
  	  		$("#btn_actionusuario").attr('class', 'hidden');
  	  		pass = $("#pass").val();

  	  		var action_pass = $(this).attr('data-action');
  	  		valida_action_pass(action_pass);
  	  	});

	  	function valida_action_pass(action_pass){

	  		if(action_pass == "cambia_pass"){
	  			cambia_pass();
	  		}else if(action_pass == "edita_pass"){
	  			
	  			edita_pass(pass);
	  		}
	  	}

	  	function cambia_pass(){

	  		$("#btn_passUsuario").attr('data-action', 'edita_pass');
	  		$("#btn_passUsuario").html("Guardar Contraseña");

	  		$("#pass").removeAttr('readonly');

	  		$("#pass").val("");

	  		$("#pass").focus();
	  	}

	  	function edita_pass(pass){

	    	console.log("Carga pass "+pass);

		    $.ajax({
		        url: '../controller/ajaxController12.php',
		        data: "pkID="+id_usuario+"&pass="+pass+"&tipo=actualiza_usuario&nom_tabla=usuarios",
		    })
		    .done(function(data) {
		    	console.log(data);
		    	alert(data.mensaje);
		    	location.reload();
		    })
		    .fail(function() {
		        console.log("error");
		    })
		    .always(function() {
		        console.log("complete");
		    });

	    }

    };    
    

    function destruye_cambia_pass(){

    	//$("#pass").removeAttr('readonly');

    	$("#btn_passUsuario").remove();
    }

    //-------------------------------------------------------------------------
    //complemento usuarios
    self.users = new usersGen("form_usuario");
    
    //-------------------------------------------------------------------------
    //complemento validar numero de cedula
    //self.validaCampoLike = function(nom_campo,nom_tabla,selector_input,selector_form,selector_btn_action)
    self.validacion = new validaCampoLike('numero_documento','usuarios','numero_documento','form_usuario','btn_actionusuario');

    $("#numero_documento").keyup(function(e) {
      validacion.validar()
    });
    //-------------------------------------------------------------------------
    //console.log(table.column(5))

    //-------------------------------------------------------------------------
      //---------------------------------------------------------
  //Instancias del complemento matrixRelation
  
  //(seleccionador,btn_accion,nombre_modulo,nombre_modulo2,formulario_add,nombre_tabla,obtHE)
    var obtHE = {
      "fkID_proyectoM" : 0,
      "fkID_usuario" : 0
    }

    var rel_proyectosM = new matrixRelation("select_proyectoM", "btn_actionusuario", "proyectoM", "usuario", "frm_usuarios_proyectosM", "usuario_proyectoM", obtHE);

    rel_proyectosM.setup();

     //complemento usuarios
   self.proyectoM_users = new usersGen("form_usuario");
   proyectoM_users.init()
  //-------------------------------------------------------------------------
    
});