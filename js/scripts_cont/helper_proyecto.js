(function(){
	//
	//console.log("Hola desde helper docentes.")

	//sistema de tabs
	//var id_li_activo = sessionStorage.getItem("id_tab_proceso_gen");

	self.tabs = {
		nombre_storage : "",
		id_li_activo :  null,
		arr_no_permit : [],
		nom_tab_default : "",
		value_tab : true,
		valida_tab : function(){

			this.id_li_activo = sessionStorage.getItem(this.nombre_storage);

			console.log(this.id_li_activo)

			$.each(this.arr_no_permit, function(index, val) {
				
				console.log("index: "+index+" valor: "+val);

				
				if (val == tabs.id_li_activo) {

					/*break;*/
					//le da clase activa a default
					$("#"+tabs.nom_tab_default).addClass('active');
					
					//console.log(tabs.nom_tab_default.substr(3))

					var nom_gen = tabs.nom_tab_default.substr(3);
					
					$("#"+nom_gen).addClass('active');

					tabs.value_tab = false;

					return false;								

				}else{

					tabs.value_tab = true;
				} 

				
			});

			if (this.value_tab) {
				//console.log(tabs.id_li_activo)

				$("#"+tabs.id_li_activo).addClass('active');

				$('ul a[href="#'+tabs.id_li_activo.slice(3,20)+'"]').tab('show');

				$("#"+tabs.id_li_activo.slice(3,20)).addClass('active');

			}

		},
		setClickRole : function(){

			$("[role=presentation]").click(function(event) {
				/* Act on the event */
				tabs.id_li_activo = $(this)[0].id;

				console.log($(this)[0].id);

				// Store
				sessionStorage.setItem(tabs.nombre_storage, $(this)[0].id);
			});

		},
		setTabs : function(){

			this.valida_tab()

			this.setClickRole();
		}		

	}

	//----------------------------------------------------------------

})();

(function(){
	//validacion de los estados del proyecto
	/*
	*/
	self.valEstadoProyecto = {
		//----
		selector:"",
		cons_general:"",
		tipo_action:"",
		valida:function(tipo_action){
			
			this.tipo_action = tipo_action;

			this.cons_general = "SELECT * FROM `estado_proyecto`";

			if (tipo_action == "nuevo") {
				//carga solo creado
				this.cons_general += " where pkID = 1"
				
				//console.log(this.cons_general)
				
				this.loadSelect(this.cons_general)

				this.validaAfter()

			} else if(tipo_action == "carga_editar"){
				
				this.loadSelect(this.cons_general)
			}
		},
		validaAfter:function(){

			var valor = $("#"+this.selector).val();

			var user = leerCookie("log_sisep_IDtipo");

			console.log(valor);//1
			console.log(user);//1 o 10
		
			if (valor != 1) {				
				$("#"+this.selector).attr('disabled', 'true');
			} else {
				if ((user == 1)||(user == 10)) {
										
					$("#"+this.selector).removeAttr('disabled');
						
				} else {

					if (this.tipo_action == "nuevo") {
						$("#"+this.selector).removeAttr('disabled');
					}else {
						$("#"+this.selector).attr('disabled', 'true');	
					}	
				}
			}    
		},
		loadSelect:function(query){
			
			var self = this;

			var load = dbGen.db_general(query);

			load.success(function(data){
				console.log(data)
				if (data.estado == "ok") {
					$("#"+self.selector).html('')
					//$("#"+self.selector).append('<option></option>')
					$.each(data.mensaje, function(index, val) {
						$("#"+self.selector).append('<option value="'+val.pkID+'">'+val.nombre+'</option>')
					});

				} else {
					console.log("No se han cargado los estados.")
				}
			})
		}
	}	

})();

(function(){
	//------------------------------------------------------------------------
	//validacion si puede crear nuevo proyecto deshabilita = btn_nuevoproyecto
	self.valCreaProyecto = {
		selector:"",
		cons_general:"",
		validaNuevo:function(fkID_grupo){

			var self = this;

			var year = new Date();
			year = year.getFullYear();
			//console.log(year + 1)
			//falta validacion con el año!!
			this.cons_general = "SELECT * FROM `proyecto` where fkID_grupo = "+fkID_grupo+" AND anio_creacion = "+year;

			var valida = dbGen.db_general(this.cons_general);

			valida.success(function(data){
				console.log(data)
				if (data.estado == "ok") {
					
					if (data.mensaje.length >= 1) {
						$("#"+self.selector).attr('disabled', 'true');
					}

				} else {
					//$("#"+self.selector).removeAttr('disabled');
					console.log("Se pueden crear proyectos!")
				}
			})	
		}
	}
	//------------------------------------------------------------------------
})();

//----------------------------------------------------------------------------
(function(){
	//validacion de cambio de fase para proyecto
	self.validaChangeFase = function(selector_fase, fkID_proyecto, fkID_grupo){
		//-----------------------------------------------------------
		this.selector_fase = selector_fase;
		this.fkID_proyecto = fkID_proyecto;
		this.fkID_grupo = fkID_grupo;
		//-----------------------------------------------------------
		this.selector_estado = "form_proyecto #fkID_estado_proyecto";
		//-----------------------------------------------------------
		this.cons_asesoria = "SELECT * FROM `asesoria` WHERE fkID_proyecto = ";
		//-----------------------------------------------------------
		this.valor_selector;
	}

	self.validaChangeFase.prototype = {
		validar: function(){
						
			if (this.validar_estado_proyecto()) {
				//el proyecto está aprobado
				if (this.valida_fase_null()) {
					console.log("No hay fase, puede pasar a fase1 solamente.")
				} else {
					console.log("ya hay una fase, puede pasar a otra?")
					
					//valida las asesorias
					if( (this.valida_asesoria()) && (this.valida_respuestas_b()) ) {

						console.log("Si puede pasar de fase.")
						
						this.disable_control_fase(false);

					}else{
						console.log("No puede pasar de fase.")

						this.disable_control_fase(true);
					}
					
				}
			} else {
				console.log("El proyecto no está aprobado.")
			}
						
		},
		validar_estado_proyecto: function(){				
			var valor_estado = $("#"+this.selector_estado).val();								
			var res = valor_estado == "2" ? true : false;			
			return res;
		},
		valida_fase_null: function(){
			this.valor_selector = $("#"+this.selector_fase).val();
			var res = this.valor_selector == null ? true : false;
			return res;
		},
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		valida_asesoria: function(){
			var res = false;
			var asesoria = dbGen.db_general(this.cons_asesoria+this.fkID_proyecto+" AND fkID_fase = "+this.valor_selector);
			asesoria.success(function(data){
				console.log(data)
				res = data.estado == "Error" ? false : true;
			})

			return res;
		},
		valida_respuestas_b: function(){
			//valida la bitacora-------------------------------
			//fase en la que se encuentra
			//console.log(this.valor_selector)

			//la bitacora
			//SELECT * FROM `bitacora` WHERE fkID_fase = 1 AND fkID_proyectoM = 1 [pkID=1]
			
			//las preguntas de esa bitácora?
			//SELECT * FROM `preguntas_b` WHERE fkID_bitacora = 1 [3 preguntas]

			//las respuestas
			//"select * FROM `respuestas_b` WHERE fkID_pregunta = ".$fkID_pregunta." AND fkID_grupo = ".$fkID_grupo;
			//-------------------------------------------------
			//console.log(this.getIdBitacora());
			//console.log(this.getPreguntasBitacora());

			var self = this;
			var res = false;
			var p_bitacora = this.getPreguntasBitacora();
			//
			//valida pregunta por pregunta si tiene respuesta o no
			var itera = $.each(p_bitacora, function(index, val) {
				
				var cons_respuesta_b = "select * FROM `respuestas_b` WHERE fkID_pregunta = "+val+" AND fkID_grupo = "+self.fkID_grupo;
				
				console.log(cons_respuesta_b)
				
				//self.getRespuestaB(cons_respuesta_b);

				if (self.getRespuestaB(cons_respuesta_b)) {
					console.log("Esta pregunta si tiene rpta.")
					res = true;
				} else {
					console.log("Esta pregunta no tiene rpta.")
					//detiene la iteracion y retorna false
					res = false;
					return false;
				}
			});

			$.when(itera).then(function(){
				console.log("Termino el ciclo de las preguntas de la bitácora.")
			});

			return res;
			
		},
		getIdBitacora: function(){
			//retorna el id de la bitácora en la que se encuentra
			var id_bitacora = 0;
			var cons_bitacora = "select * from bitacora where fkID_fase = "+this.valor_selector+" AND fkID_proyectoM = "+leerCookie("id_proyectoM");
			//console.log(cons_bitacora);
			var bitacora = dbGen.db_general(cons_bitacora);

			bitacora.success(function(data){
				console.log(data)
				if (data.estado == "ok") {
					id_bitacora = data.mensaje[0].pkID;
				} else {
					console.log("No coincide bitacora para esta fase.")
				}
			})

			return id_bitacora;
		},
		getPreguntasBitacora: function(){
			//retorna un array con los ids de las preguntas de esa bitacora
			var preguntas = [];
			var cons_preguntas_bitacora = "SELECT * FROM `preguntas_b` WHERE fkID_bitacora = "+this.getIdBitacora()+" AND fkID_estado = 1";
			var preguntas_b = dbGen.db_general(cons_preguntas_bitacora);

			preguntas_b.success(function(data){
				console.log(data)
				if (data.estado == "ok") {
					$.each(data.mensaje, function(index, val) {
						preguntas.push(val.pkID)
					});
				} else {
					console.log("Esta bitacora no tiene preguntas.")
				}
			})

			//console.log(preguntas)
			return preguntas;
		},
		getRespuestaB: function(query){
			var res = false;
			var respuesta_b = dbGen.db_general(query);

			respuesta_b.success(function(data){
				console.log(data)
				if (data.estado == "ok") {
					res = true;
				} else {
					res = false;
				}
			})

			return res;
		},
		disable_control_fase: function(tipo){
			$("#"+this.selector_fase).prop('disabled', tipo);			
		}
	}	
})();
//----------------------------------------------------------------------------