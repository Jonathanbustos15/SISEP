$(function(){
	
	$("#btn_nuevoRol").jquery_controllerV2({
		nom_modulo:'rol',
  		titulo_label:'Nuevo Rol',
	});

	$("#btn_actionrol").jquery_controllerV2({
		tipo:'inserta/edita',
  		nom_modulo:'rol',
  		nom_tabla:'permisos'
	});

	$("[name*='edita_rol']").jquery_controllerV2({
		tipo:'carga_editar',
  		nom_modulo:'rol',
  		nom_tabla:'permisos',
  		titulo_label:'Editar Rol'
	});

	$("[name*='elimina_rol']").jquery_controllerV2({
		tipo:'eliminar',
  		nom_modulo:'rol',
  		nom_tabla:'permisos'
	});

	//------------------------------------------------------------------------------------------------
	//
	carga_data_cons = function(consulta,id){

		return $.ajax({
	        url: '../controller/ajaxController12.php',
	        data: "query="+consulta+"&tipo=consulta_gen",
	        async : false
	    })
	    .done(function(data) {
	    	/**/	    	
	        console.log(data)
	        /**/
	    	$("#"+id).html('')
	    	
	        console.log(data)

	        $("#"+id).append('<option></option>')	        
	        	
        	$.each(data.mensaje, function(index, val) {
	        	 /* iterate through array or object */
	        	 console.log(index+"--"+val)
	        	 console.log(val)

	        	 if (val.nombre) {
	        	 	$("#"+id).append('<option value="'+val.pkID+'">'+val.nombre+'</option>')
	        	 } else {
	        	 	$("#"+id).append('<option value="'+val.pkID+'">'+val.pkID+' - '+val.Nombre+'</option>')
	        	 }
	        	 
	        });
        
        	$("#"+id).click();
	    })
	    .fail(function() {
	        console.log("error");
	    })
	    .always(function() {
	        console.log("complete");
	    });
	}

	$("#fkID_tipo_usuario").focus(function(event) {
		/* Act on the event */
		console.log('cargando datos...')
		
		var consulta_categorias = "select * FROM tipo_usuario";

		var data_tUsuarios = carga_data_cons(consulta_categorias,"fkID_tipo_usuario")
	});

	$("#btn_nuevotUsuario").jquery_controllerV2({
		nom_modulo:'tUsuario',
  		titulo_label:'Nuevo Tipo de Usuario',
  		functionAfter:function(ajustes){                
            //console.log('Ejecutando antes de cualquier cosa!!!');
            
            $('#frm_modal_rol').modal('hide');
            
            $('#form_modal_tUsuario').on('hidden.bs.modal', function (e) {
			  $('#frm_modal_rol').modal('show');
			});

			$("#btn_actiontUsuario").removeAttr('disabled');                
        },
	});

	$("#btn_actiontUsuario").jquery_controllerV2({
		tipo:'inserta/edita',
  		nom_modulo:'tUsuario',
  		nom_tabla:'tipo_usuario',
  		recarga: false,
  		functionAfter:function(ajustes){

  			console.log('Ejecutando después.');

  			$('#form_modal_tUsuario').modal('hide');
  		},
  		validarCampo:true,           
        nom_campo:'nombre'
	});

	//------------------------------------------------------------------------------------------------

	//------------------------------------------------------------------------------------------------
	$("#fkID_modulo").focus(function(event) {
		/* Act on the event */
		var consulta_modulos = "select * FROM modulos";

		var data_modulos = carga_data_cons(consulta_modulos,"fkID_modulo")
	});

	$("#btn_nuevomodulo").jquery_controllerV2({
		nom_modulo:'modulo',
  		titulo_label:'Nuevo Módulo',
  		functionAfter:function(ajustes){                
            //console.log('Ejecutando antes de cualquier cosa!!!');
            
            $('#frm_modal_rol').modal('hide');

		  	$("#btn_actionmodulo").removeAttr('disabled');

		  	$('#form_modal_modulo').on('hidden.bs.modal', function (e) {			  
			  $('#frm_modal_rol').modal('show');
			});                
        },
	});

	$("#btn_actionmodulo").jquery_controllerV2({
		tipo:'inserta/edita',
  		nom_modulo:'modulo',
  		nom_tabla:'modulos',
  		recarga: false,
  		functionAfter:function(ajustes){

  			console.log('Ejecutando después.');

  			$('#form_modal_modulo').modal('hide');
  		},
  		validarCampo:true,           
        nom_campo:'Nombre'
	});
	//------------------------------------------------------------------------------------------------

});