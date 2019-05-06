$(function(){

	 
	var nom_modulo = "respuesta_b",
		titulo_label = "Respuesta";	 	 

	/**/

	function formRespuesta(action,pkID_respuesta){

		$("#lbl_form_"+nom_modulo).html(titulo_label);

		if (action == "nuevo") {
			//-----------------------------------------------------------
			//setear formulario y acciones segun sea
			//		 	
			$("#lbl_btn_action"+nom_modulo).html("Responder<span class='glyphicon glyphicon-chevron-right'></span>");
			$("#btn_action"+nom_modulo).attr("data-action","crear");

			$("#form_"+nom_modulo)[0].reset();
			//-----------------------------------------------------------
		} else if(action == "carga_editar"){
			//-----------------------------------------------------------
			$("#lbl_btn_action"+nom_modulo).html("Cambiar Respuesta<span class='glyphicon glyphicon-chevron-right'></span>");
			$("#btn_action"+nom_modulo).attr("data-action","editar");
			//-----------------------------------------------------------
			//carga la respuesta previa para poderla editar
			cargaDataRespuesta(pkID_respuesta)
			//-----------------------------------------------------------
		}

		//$("#form_"+nom_modulo)[0].reset();
	}

	function cargaDataRespuesta(pkID_respuesta){

		var respuesta = dbGen.db_general("select * from respuestas_b where pkID = "+pkID_respuesta);

		respuesta.success(function(data){
			console.log(data)
			if (data.estado == "ok") {
				$.each(data.mensaje[0], function(index, val) {
					
					$("#form_"+nom_modulo)[0][index]["value"] = val;

					console.log($("#form_"+nom_modulo)[0][index]["value"])
					console.log(val)
				});
			}
		})
	}

	function sh_Puntaje(puntaje){
		console.log(puntaje)
		//$("#div_puntaje")
		if (puntaje==0) {
			$("#div_puntaje").attr('hidden', 'true');
		} else if (puntaje==1){
			$("#div_puntaje").removeAttr('hidden');
		}
	}

	$("[name*='responde_bitacora']").click(function(event) {


		console.log($(this).data("action"))

		//-----------------------------------------------------------
		//setear formulario y acciones segun sea
		//
		formRespuesta($(this).data("action"),$(this).data("id-respuesta_b"))
		//-----------------------------------------------------------

		var pregunta = dbGen.db_general("select * from preguntas_b where pkID = "+$(this).data("id-pregunta"));

		pregunta.success(function(data){
			console.log(data)
			if (data.estado == "ok") {
				$("#pregunta_b_text").html(data.mensaje[0].pregunta)
				$("#fkID_pregunta").val(data.mensaje[0].pkID)
				//usuario
				//console.log(leerCookie("log_sisep_id"));
				$("#fkID_usuario").val(leerCookie("log_sisep_id"))
			} else {
				alert("No es posible responder a esta pregunta.")
			}
		})

	});

	$("#btn_actionrespuesta_b").jquery_controllerV2({
		tipo:'inserta/edita',
		nom_modulo:'respuesta_b',
		nom_tabla:'respuestas_b'
	});
	//---------------------------------------------------------

	//---------------------------------------------------------

	//---------------------------------------------------------
	//
	$("#btn_nuevogrupo_evento").jquery_controllerV2({
	 	nom_modulo:'grupo_evento',
      	titulo_label:'Asignar Evento (Apropiación Social)',
      	functionAfter:function(){
      		sh_Puntaje(0)
      	}
    });

    //---------------------------------------------------------
    valida_grupoEvento.selector='fkID_evento'
    //---------------------------------------------------------

    $("#fkID_evento").change(function(eventData,handler) {
    	sh_Puntaje($(this).find(':selected').data('puntaje'));    	
    });

    $("#fkID_evento").focus(function(event) {
    	//----------------------------------------------------
    	valida_grupoEvento.loadSelect($("#fkID_grupo").val())   	
    });

	$("#btn_actiongrupo_evento").jquery_controllerV2({
		tipo:'inserta/edita',
      	nom_modulo:'grupo_evento',
      	nom_tabla:'grupo_evento',
	});

	$("[name*='elimina_grupo_evento']").jquery_controllerV2({
      tipo:'eliminar',
      nom_modulo:'grupo_evento',
      nom_tabla:'grupo_evento'
    });
	//---------------------------------------------------------

	//---------------------------------------------------------
	//Fade out para los alert	
	setTimeout(function(){
		$('.alert-info').fadeOut('slow');
	},10000)	
	//---------------------------------------------------------
	
	//---------------------------------------------------------
	//pestañas modulo
	//--------------------------------------
		tabs.nom_tab_default = "li_general";

		tabs.nombre_storage = "id_tab_respuesta_b";

		tabs.arr_no_permit = ["",null,"null"];

		tabs.setTabs()
	//--------------------------------------
	//---------------------------------------------------------
});