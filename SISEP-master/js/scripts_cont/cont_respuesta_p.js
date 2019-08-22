$(function(){

	
	var nom_modulo = "respuesta_p",
		titulo_label = "Respuesta";


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
			
			//cargaDataRespuesta(pkID_respuesta)
			//-----------------------------------------------------------
		}

		//$("#form_"+nom_modulo)[0].reset();
	}

	var loadA = "";

	$("[name*='responde_prueba']").click(function(event) {

		console.log($(this).data("action"))

		//console.log($(this).data("id-respuesta_p"))
		//https://developer.mozilla.org/es/docs/Web/JavaScript/Referencia/Operadores/Conditional_Operator
		//valida si existe respuesta para poder cargar el id en el form o no.
		var id_respuesta = $(this).data("id-respuesta_p") ? $(this).data("id-respuesta_p") : "";

		console.log(id_respuesta);
		//-----------------------------------------------------------
		//setear formulario y acciones segun sea
		//
		formRespuesta($(this).data("action"),$(this).data("id-respuesta_p"))
		//-----------------------------------------------------------

		var pregunta = dbGen.db_general("select pregunta_p.*, tipo_pregunta_p.nombre as nom_tipo_pregunta "+

										" FROM pregunta_p"+

										" INNER JOIN tipo_pregunta_p ON tipo_pregunta_p.pkID = pregunta_p.fkID_tipo_pregunta_p "+

										" where pregunta_p.pkID = "+$(this).data("id-pregunta"));

		pregunta.success(function(data){
			console.log(data)
			if (data.estado == "ok") {
				$("#pkID").val(id_respuesta);
				$("#pregunta_p_text").html(data.mensaje[0].pregunta)
				$("#fkID_pregunta_p").val(data.mensaje[0].pkID)

				$("#lbl_form_"+nom_modulo).append(" "+data.mensaje[0].nom_tipo_pregunta);
				//usuario
				//console.log(leerCookie("log_sisep_id"));
				$("#fkID_usuario").val(leerCookie("log_sisep_id"))
				
				//------------------------------------------------
				loadA = new loadAnsw(data.mensaje[0].fkID_tipo_pregunta_p,data.mensaje[0].pkID);
				
				loadA.load()
				//------------------------------------------------

			} else {
				alert("No es posible responder a esta pregunta.")
			}
		})

	});

	/**/
	$("#btn_actionrespuesta_p").jquery_controllerV2({
		tipo:'inserta/edita',
		nom_modulo:'respuesta_p',
		nom_tabla:'respuesta_p',
		confirm_action:true,
		msg_confirm:"Esta segur@ de su respuesta?",
		recarga:false,
		auditar:true,
		/**/
		confirma_accion:function(ajustes){
			//console.log(ajustes)
			/**/
			function conf(){

				if(ajustes.confirm_action == true){

	                var conf = confirm(ajustes.msg_confirm);

	                if (conf === true) {
	                    ajustes.valida_action(ajustes.action);
	                }

	            }else{
	                ajustes.valida_action(ajustes.action);
	            }
		    }
			//valida que el tipo sea unica o multiple
            if ( (loadA.type == "2") || (loadA.type == "3") ) {
            	//valida que se halla seleccionado al menos una respuesta
            	if (loadAnsw.prototype.validaAnsw()) {
            		conf()
            	}else{
            		alert("No ha seleccionado ninguna respuesta.");
            	}
            }else{
            	conf()
            }
		},		
		functionAfter:function(data,ajustes){
			/**/
			console.log(data)
			console.log(ajustes)
			
			//hacer el insert de la respuesta en la tabla auxiliar
			if (ajustes.action == "crear") {
				var id_respuesta_p = data[0].last_id;

				loadA.insertAnsw(id_respuesta_p)
			} else {
				//------------------
				if (loadA.type == "3") {
					loadA.insertAnsw($("#pkID").val())
				} else {
					alert("No se pueden añadir respuestas a esta pregunta.")
				}
				//------------------				
			}		
		}
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

		tabs.nombre_storage = "id_tab_respuesta_p";

		tabs.arr_no_permit = ["",null,"null"];

		tabs.setTabs()
	//--------------------------------------
	//---------------------------------------------------------
});