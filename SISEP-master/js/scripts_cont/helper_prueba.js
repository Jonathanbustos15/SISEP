(function(){
	//
	//console.log("")	
	self.answersP = {
		//-------------------------
		//vars instance
		stage:"",
		append_form:"",
		//-------------------------
		//vars fijas create
		stage_answers:"div_respuestas",
		frm_rptas:"frm_respuestas_p",		
		//-------------------------
		arr_abc:[
			"a. ","b. ","c. ","d. ","e. ","f. ","g. ",
			"h. ","i. ","j. ","k. ","l. ","m. ","n. ",
			"o. ","p. ","q. ","r. ","s. ","t. ","u. ",
			"v. ","w. ","x. ","y. ","z. "
		],
		//-------------------------
		//valor constante del tipo de prueba cargado en el hidden
		tipo_prueba:$("#pkID_tipo_p").val(),
		tipo_pregunta:0,
		//-------------------------
		//methods
		init:function(){
			var self = this;
			//--------------------------------------------
			$("#"+this.stage).change(function(e) {
				//console.log($(this).parent()[0].parentElement["id"])				
				self.tipo_pregunta = $(this).val();
				//console.log(tipo_pregunta)				
				//setea el append_form
				self.append_form = $(this).parent()[0].parentElement["id"];
				//ejecuta la funcion que evalua que debe hacer segun el tipo 
				self.setFormAnswer(self.tipo_pregunta)
			});
			//--------------------------------------------
		},
		reset:function(){
			this.removeFormAdd()
            this.stateStage('enable')
		},
		setFormAnswer:function(type){
			var self = this;			
			//al definir el tipo debe crear un form
			//que lleve un boton para añadir textbox
			//y poder insertar las respuestas que lleva la pregunta.
			
			if ( (type == "2") || (type == "3") ) {
				//----------------------------------------------
				self.createFormAdd()
				//----------------------------------------------
			} else {
				
				self.removeFormAdd()
			}
		},
		createFormAdd:function(){
			var self = this;
			//----------------------------------------------
			self.removeFormAdd()
			//----------------------------------------------
			$("#"+this.append_form).after('<div id="'+self.stage_answers+'" class="col-md-12 text-right panel"></div>');

			$("#"+self.stage_answers)
			.append('<h4 class="text-left">Respuestas Pregunta</h4><hr>')
			.append('<button id="btn_add_rpta" class="btn btn-primary" title="Añadir Respuesta"><span class="glyphicon glyphicon-plus"></span> Añadir Respuesta</button><br><br>')
			.append('<form id="'+self.frm_rptas+'"></form>');
			//----------------------------------------------

			//----------------------------------------------
			//btn_add_rpta
			
			$("#btn_add_rpta").click(function(e) {
				//crea el elemento input dentro del form junto con un
				//boton para poder remover esa respuesta.
				self.addInputAns()
			});
			//----------------------------------------------
		},
		removeFormAdd:function(){
			$("#"+this.stage_answers).remove();
		},
		stateStage:function(tipo){
			//$("#"+this.stage).
			switch (tipo) {
				case "enable":
					$("#"+this.stage).removeAttr('disabled')
					break;
				case "disable":
					$("#"+this.stage).attr('disabled','true')
					break;
			}
		},
		addInputAns:function(){		
			var self = this;
			//crea ids random para garantizar que los ids de elemento
			//no se repitan.
			var rand = Math.round(Math.random()*10)
			var rand1 = Math.round(Math.random()*10)
			var id_text_rand = Math.floor((Math.random() * 100) + 1)*rand+rand1;

			//------------------------------------------------------------------
			//valida que tipo de prueba es, si es de tipo 1
			//mira de que tipo es la pregunta 
			//si es unica sale un control radio
			//para multiple salen checkbox
			
			var elem_correct = '</br></br> Correcta <select id="correcta_rpta_'+id_text_rand+'">'+
				'<option value="0">No</option>'+
				'<option value="1">Sí</option>'+
			'</select> </br></br>';
			//console.log(elem_correct)
			//------------------------------------------------------------------
			//var div_rpta = '<div id="div_rpta_'+id_text_rand+'" class="form-group"></div>';
			var input_rpta = '<input type="text" class="form-control add-selectElement" id="rpta_'+id_text_rand+'" name="respuestab" required = "true">&nbsp;<button class="btn btn-danger remove_rpta" data-id_input_rpta = "rpta_'+id_text_rand+'"><span class="glyphicon glyphicon-remove"></span></button>'
			//----------
			//añade o no el control correcta
			if (this.tipo_prueba == "1") {
				input_rpta += elem_correct;
			}			
			//----------
			$("#"+this.frm_rptas).append('<div id="div_rpta_'+id_text_rand+'" class="form-group">'+input_rpta+'</div>');

			//-------------------------------------------------------
			//retira el evento click para que quede todo una sola vez
			//sin importar el numero de botones existentes

			$("[class*='remove_rpta']").unbind('click');

			$("[class*='remove_rpta']").click(function(event) {				
				//console.log("click en remover input!")
				//console.log($(this).data("id_input_rpta"))
				var id_input_rpta = $(this).data("id_input_rpta");
				$("#"+"div_"+id_input_rpta).remove();

				return false;
			});
			
			this.prefijos()
			//-------------------------------------------------------
			//si la prueba es de conocimiento debe definir para los 
			//select de correcta una funcion change que evalue
		    //si la pregunta es de tipo unica, en ese caso debe
		    //dicha funcion deshabilitar todos los selects que sean
		    //de value 0
		    if (this.tipo_prueba == "1") {
				
				if (self.tipo_pregunta == "2") {

					$("[id^='correcta_rpta_']").unbind('change');

					$("[id^='correcta_rpta_']").change(function(event) {
						//console.log("Esta cambiando porque la prueba es de tipo "+self.tipo_prueba+" y la pregunta es de tipo "+self.tipo_pregunta)
						//debe validar que si ya existe un select con valor de 1 no lo deje cambiar
						//console.log(self.validateCorrecta());
						var cantSi = self.validateCorrecta();
						//console.log(cantSi)
						
						if (cantSi >= 1) {
							
							//$( "[id^='correcta_rpta_']" )
							self.dsEnElem($( "[id^='correcta_rpta_']" ),"disable");

						}else{

							self.dsEnElem($( "[id^='correcta_rpta_']" ),"enable");
						}

					});
				}
			}
		},
		dsEnElem:function(elem,action){

			$.each(elem, function(index, val) {
				/**/
				switch (action) {
					case "enable":
							$("#"+val["id"]).removeAttr('disabled')										
						break;
					case "disable":
							if (val["value"] == "0") {					
								//console.log(val["id"])
								$("#"+val["id"]).attr('disabled', 'true');
							}
						break;
				}				
				//console.log(val["value"])
			})
		},
		validateCorrecta:function(){
			
			var contador = 0;

			$.each($( "[id^='correcta_rpta_']" ), function(index, val) { 
				console.log(val["value"])
				if (val["value"] == "1") {
					contador += 1;
					return;
				} 
			})

			return contador;
		},
		prefijos:function(){
			//-------------------------------------------------------
			//Prefijos			
			var self = this;
			var elementos = $( "[id^='rpta_']" );

			$.each(elementos, function(index, val) {
				
				if ($("#"+val["id"]).val() === "") {
					$("#"+val["id"]).val(self.arr_abc[index])
				}
				
			});
			//-------------------------------------------------------
		},
		saveAnsw:function(fkID_pregunta_p){
			
			var cicle = $.each($("#"+this.frm_rptas)[0], function(index, val) {
				 //console.log("index:"+index+" val:"+val)
				 //console.log(val)
				 if (val.type == "text") {
				 	//console.log(val.name)
				 	if (val.value != "") {
				 		
				 		var query = "INSERT INTO `banco_respuestas_p` (`pkID`, `respuestab`, `fkID_pregunta_p`, `correcta`) VALUES (NULL, '"+val.value+"', '"+fkID_pregunta_p+"', '"+$("#correcta_"+val.id).val()+"');"
				 		
				 		//console.log(query)

				 		var ins_answ = dbGen.db_general(query);

				 		ins_answ.success(function(data){
				 			console.log(data)
				 		})

				 	}else{
				 		console.log("Este input no tiene valor.")
				 	}
				 }
			});

			$.when(cicle).then(function(){
				console.log("Insert Finished->banco respuestas.")
				setTimeout(function(){
					location.reload()
				}, 1000)
			});		
		},
		loadAnsw:function(fkID_pregunta_p,type){

			var self = this;
			//----------------------------------------------

			//----------------------------------------------
			this.stateStage("disable")
			//----------------------------------------------

			var query = "select * from `banco_respuestas_p` WHERE fkID_pregunta_p = "+fkID_pregunta_p;

			var load_answ = dbGen.db_general(query);
			

	 		load_answ.success(function(data){
	 			
	 			console.log(data)

	 			if (type != "1") {

	 				self.removeFormAdd()
					//----------------------------------------------

					self.append_form = $("#"+self.stage).parent()[0].parentElement["id"];

					$("#"+self.append_form).after('<div id="'+self.stage_answers+'" class="col-md-12 text-right panel"></div>');

					$("#"+self.stage_answers)
					.append('<button id="btn_add_rpta" class="btn btn-primary" title="Añadir Respuesta"><span class="glyphicon glyphicon-plus"></span> Añadir Respuesta</button><br><br>')
					.append('<br><ul class="list-group text-left"></ul><br>')
					.append('<form id="'+self.frm_rptas+'"></form>');

					//----------------------------------------------
					//btn_add_rpta
					
					$("#btn_add_rpta").click(function(e) {
						//crea el elemento input dentro del form junto con un
						//boton para poder remover esa respuesta.
						self.addInputAns()
						console.log(console.log(e))
					});	
					//----------------------------------------------
	 			}else{
	 				self.removeFormAdd()
	 			}		

	 			if (data.estado == "ok") {	
					
					var itera = $.each(data.mensaje, function(index, val) {

						//--------------------------------------
						var rand = Math.round(Math.random()*10)

				    	var rand1 = Math.round(Math.random()*10)
				    	//--------------------------------------			
				    	//Muestra si la respuesta es correcta o no
				    	var li_id = 'rpta_'+rand*rand1;

				    	var rpta = val.respuestab;

				    	var ok = " <span class='glyphicon glyphicon-ok' style='color: green;'></span>";
				    	var no = " <span class='glyphicon glyphicon-remove' style='color: red;'></span>";

				    	var str_correcta = val.correcta == "1" ? ok : no;

				    	if (self.tipo_prueba == "1") {
							rpta += str_correcta;
						}

						$(".list-group").append('<li id="'+li_id+'" class="list-group-item">'+rpta+'<button type="button" class="close delete-rpta" data-id-rpta="'+val.pkID+'" data-id-li="'+li_id+'" style="color: red!important;" title="Eliminar Respuesta">&times;</button></li>')
					});

					$.when(itera).then(function(){
		    			
		    			console.log("Termino de cargar las respuestas! ")

		    			$(".delete-rpta").click(function(event) {
		    			 	console.log("Elimina reg: "+$(this).data('id-rpta'))
		    			 	
			    			var confirma = confirm("En realidad quiere eliminar esta respuesta?");
						    
						    if(confirma == true){
						    	self.deleteAnsw($(this).data('id-rpta'),$(this).data('id-li'))
						    }

		    			 }); 			
		    					    			
		    		});					

	 			} else {
	 				//self.removeFormAdd()
	 			}
	 		})
		},
		deleteAnsw:function(pkID,id_li){
			
			var self = this;

			var elimina = this.delGen(pkID);

			elimina.success(function(data){
				console.log(data)

				if (data.estado == "ok") {
					// statement
					$("#"+id_li).remove()
				} else {
					alert("No se puedo eliminar la respuesta.")
				}
			})
		},
		delGen:function(pkID){

			//si confirma es true ejecuta ajax
	 		return $.ajax({
				async: false,
			    url: '../controller/ajaxController12.php',
			    data: "pkID="+pkID+"&tipo=eliminar&nom_tabla=banco_respuestas_p",
			})
			.done(function(data) {            
			    //---------------------
			    //console.log(data);		            
			})
			.fail(function() {
			    console.log("error");
			})
			.always(function() {
			    console.log("complete");
			});
		}
	}
	//----------------------------------------------------------------

})();

(function(){

	self.loadAnsw = function(type,fkID_pregunta_p){

		this.type = type;
		this.fkID_pregunta_p = fkID_pregunta_p;
		//-----------------------
		this.stage = "div-rptas";
		this._form = "form_respuesta_p";
		this.nombre_tabla = "respuesta_p_banco";
	}

	self.loadAnsw.prototype = {
		
		load:function(){
			var self = this;

			this.resetStage()
			//---------------------------------------------------
			
			self.fecthData()
			//---------------------------------------------------
		},
		resetStage:function(){
			$("#"+this.stage).html("");
			$(".respuesta").remove();
		},
		fecthData:function(){

			var self = this;

			var query = "SELECT * FROM `banco_respuestas_p` WHERE fkID_pregunta_p = "+this.fkID_pregunta_p;

			var cons = dbGen.db_general(query);

			cons.success(function(data){
				console.log(data)

				self.createDomAnsw(data.mensaje)
				
			})
		},
		createDomAnsw:function(data){

			var self = this,
				tipo_input = "",
				name = "";

			/**/
			//-----------------------------
			switch (self.type) {
				case "1":
						name = "respuesta";
						tipo_input = "text";
						createAnsw()
					break;
				case "2":
					// unica
						//carga las respuestas como radiobutton
						name = "fkID_banco_rta_p";
						tipo_input = "radio";
						createMultAnsw()
					break;
				case "3":
					// multiple
						//carga las respuestas como checkbox
						name = "fkID_banco_rta_p";
						tipo_input = "checkbox";
						createMultAnsw()
					break;
			};
			//-----------------------------

			function createMultAnsw(){				

				$.each(data, function(index, val) {

					//--------------------------------------
					var rand = Math.round(Math.random()*10)

			    	var rand1 = Math.round(Math.random()*10)
			    	//--------------------------------------

					 console.log("llave: "+index+" val: "+val.respuestab)
					 //<input type="checkbox" name="vehicle" value="Bike">I have a bike<br>
					 $("#"+self.stage).append('<input type="'+tipo_input+'" id="rpta_'+rand*rand1+'" name="'+name+'" value="'+val.pkID+'"> '+val.respuestab+'<br>')
				});
			}

			function createAnsw(){
				//<textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción breve del grupo"></textarea>
				$("#"+self._form).append('<textarea class="form-control respuesta" name="'+name+'" placeholder="Respuesta a la pregunta." required="true"></textarea>');
			}
			
		},
		validaAnsw:function(){

			var elems = $("[name*='fkID_banco_rta_p']")
			var valid = false;

			$.each(elems, function(index, val) {
				 //console.log(val)
				 console.log(document.getElementById(val["id"]).checked)

				 if (document.getElementById(val["id"]).checked) {
				 	valid = true;
				 	return;
				 }
			});

			return valid;
		},
		insertAnsw:function(id_respuesta_p){
			var self = this;
			//fkID_banco_rta_p
			//document.getElementById(chk_t.selector).checked
			
			/**/
			if ( (self.type == "2") || (self.type == "3") ) {			 	
			
				var itera = $.each($("[name*='fkID_banco_rta_p']"), function(index, val) {
					 //console.log("llave: "+index+" val: "+val)
					 console.log(val["id"])
					 //---------------------------------
					 console.log($("#"+val["id"]).val())
					 console.log(id_respuesta_p)
					 var data = "fkID_respuesta_p="+id_respuesta_p+"&fkID_banco="+$("#"+val["id"]).val();
					 console.log(data)
					 //---------------------------------
					 console.log(document.getElementById(val["id"]).checked)
					 
					 /*inserta si el control esta seleccionado*/
					 if (document.getElementById(val["id"]).checked) {
					 	var ins = self.insertGen(data);
					 	var estado = true;

					 	ins.success(function(data){
					 		console.log(data)
					 		if (data[0].estado == "ok") {
					 			estado = true;
					 		} else {
					 			estado = false;
					 		}
					 	});

					 	console.log(estado);
					 }
				});

				$.when(itera).then(function(){
					console.log("Termino de recorrer los elementos.")
					location.reload()
				});
				

			} else {
				console.log("No se inserta aca. reload()")
				location.reload()
			}
		},
		insertGen:function(data){
			
			var self = this;

			return $.ajax({
	    	  async: false,
	          url: "../controller/ajaxController12.php",
	          data: data+"&tipo=inserta&nom_tabla="+self.nombre_tabla,
	        })
	        .done(function(data) {	          
	          //---------------------	                 
	        })
	        .fail(function(data) {	                
	          //alert(data[0].mensaje);          
	        })
	        .always(function() {
	          //console.log("complete");
	        });
		}

	}

})();