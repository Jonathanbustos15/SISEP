(function(){
	
	self.saludo = function(){
		console.log(" Saludo global.")
	}

	self.date;
	date = new Date();
	date = date.getFullYear() + '-' +
	    ('00' + (date.getMonth()+1)).slice(-2) + '-' +
	    ('00' + date.getDate()).slice(-2);

	
	//evalua que tabla es para hacer la instancia DataTable
    //console.log($('.table')[0])

    if ($('.table')[0] != undefined) {

	    if ($('.table')[0].id != "tbl_auditoria") {

	    	//opciones generales de las tablas
			self.table = $('.table').DataTable({	
		      //"lengthMenu": [[-1, 5, 10, 25, 50], ["Todo", 5, 10, 25, 50]],      
		      "language": {
		                "url": "../bower_components/datatables-plugins/i18n/Spanish.lang.json"
		            }       
		    });

	    }

    }

	//---------------------------------
	//deshabilita el click afuera para cerrar los modales
	$('.modal').modal({
		backdrop: 'static',
		show: false
	})
    //---------------------------------

    //---------------------------------------------------------------
    self.validarEmail = function( email ) {
	    expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
	    if ( !expr.test(email.val()) ){
	    	alert("Error: La dirección de correo " + email.val() + " es incorrecta.");
	    	email.val('');
	    	email.focus();
	    }else{
	    	return true;
	    }	    
	}
		
    self.leerCookie = function(nombre){
    	var micookie;
    	var valor = false;
    	var lista = document.cookie.split(";");
    	//console.log(lista)
	    
	    $.each(lista, function(index, val) {
	  		//console.log(index)
	  		//console.log(val)
	  		
	  		var busca = lista[index].search(nombre);
            //console.log(busca)

            if (busca != -1){
            	micookie=lista[index];
            	var igual = micookie.indexOf("=");
         		
         		valor = micookie.substring(igual+1);
            }

	    });

	    return valor;	    
    };

})();

(function(){

	//---------------------------------------------------------------
    //clase para hacer selecciones de muchos a muchos

	self.matrixRelation = function(seleccionador,btn_accion,nombre_modulo,nombre_modulo2,formulario_add,nombre_tabla,obtHE){

		this.seleccionador = seleccionador;
		this.btn_accion = btn_accion;
		this.nombre_modulo = nombre_modulo;
		this.nombre_modulo2 = nombre_modulo2;
		this.formulario_add = formulario_add;
		this.nombre_tabla = nombre_tabla;
		this.obtHE = obtHE;
		this.id = 0;
    	this.nombre = "";
    	this.arrElementos = [];
    	this.arrElementosRelation = [];
    	//-----------------------------------
    	this.selector_id_usuario = "pkID";
    	//-----------------------------------
    	this.msg_err_consulta = "En este momento no hay registros.";
    	this.msg_err_consulta_clase = "warning";
	}

	self.matrixRelation.prototype = {

		valida_accion: function(){
	    	return $("#"+this.btn_accion).attr("data-action");	    	
	    },
	    valida_elemento : function(){
	    	//console.log(id)
	    	//console.log(nombre)
	    	
	    	if(document.getElementById("fkID_"+this.nombre_modulo+"_"+this.id)){
	    		return true;
	    	}else{
	    		return false;
	    	}

	    },
		setup : function() {

			var self = this;

		    $("#"+this.seleccionador).change(function(event){

		    	self.setup_change(this);

		    });
		},
		setup_change : function(elem){

			this.id = $(elem).val()
			this.nombre = $(elem).find("option:selected").data('nombre')
			
			var accion = this.valida_accion();

			//console.log(accion)
			/**/
			if ( accion == "crear" ) {

				this.select_elemento('select',accion)

				//console.log(accion)

			} else if ( accion == "editar" ) {
				
				this.arrElementos.length = 0;

				this.select_elemento('select',accion)

				this.serializa_array(this.crea_array(this.arrElementos,this.getIdUsuario()));
			}
		},
		getIdUsuario : function(){
			return $("#"+this.selector_id_usuario).val();
		},
		setSelectorIdUsuario : function(selector){
			this.selector_id_usuario = selector;
		},
		select_elemento : function(type,numReg) {

	    	//console.log(" ")

	    	var self = this;

	    	var rand = Math.round(Math.random()*10)

	    	var rand1 = Math.round(Math.random()*10)

			if(this.id!=""){

				if (this.valida_elemento()) {
	    			alert("Este elemento ya fue seleccionado.")
	    		} else {
	    			
	    			if (type=='select') {

	    				var frm = 'frm_group'+this.id+rand*rand1;

	    				$("#"+this.formulario_add).append(
	    					'<div class="form-group" id="'+frm+'">'+		                
				                '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_'+this.nombre_modulo+'_'+this.id+'" name="fkID_'+this.nombre_modulo+'" value="'+this.nombre+'" readonly="true"> <button name="btn_actionRm_'+this.id+frm+'" data-id-'+this.nombre_modulo+'="'+this.id+'" data-id-frm-group="'+frm+'" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+		                
				            '</div>'
	    				);

	    			}else {

	    				var frm = 'frm_group'+this.id+rand*rand1;

	    				$("#"+this.formulario_add).append(
							'<div class="form-group" id="frm_group'+this.id+frm+'">'+		                
				                '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_'+this.nombre_modulo+'_'+this.id+'" name="fkID_'+this.nombre_modulo+'" value="'+this.nombre+'" readonly="true"> <button name="btn_actionRm_'+this.id+frm+'" data-id-'+this.nombre_modulo+'="'+this.id+'" data-id-frm-group="'+frm+'" data-numReg = "'+numReg+'" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+		                
				            '</div>'
				        );
	    			}
	    			
	    			$("[name*='btn_actionRm_"+this.id+frm+"']").click(function(event) {
						//tarea identificador unico?? para poderlo remover
						console.log('click remover '+$(this).data('id-frm-group'));
						
						self.remove_elemento($(this).data('id-frm-group'));
						/**/
						//buscar el indice
						var id_elemento = $(this).attr("data-id-"+self.nombre_modulo);
						console.log('el elemento es:'+id_elemento);
						var indexArr = self.arrElementos.indexOf(id_elemento);
						console.log("El indice encontrado es:"+indexArr);
						//quitar del array
						if(indexArr >= 0){
							self.arrElementos.splice(indexArr,1);
							console.log(self.arrElementos);
						}else{
							console.log('salio menor a 0');
							console.log(self.arrElementos);
						}

						if (type=='load') {
							// statement
							self.deleteElementoNumReg(numReg);
						}
						
					});

					this.arrElementos.push(this.id);
					console.log(this.arrElementos);
					//---------------------------------------

	    		}

			}else{
	    		alert("No se seleccionó ningún elemento.")
	    	}
		},
		remove_elemento : function(id_elem){
	    	$("#"+id_elem).remove();
	    	//console.log($("#"+id_elem))
	    },
	    deleteElementoNumReg : function(numReg){

	    	var self = this;
    	
	    	$.ajax({
	            url: '../controller/ajaxController12.php',
	            data: "pkID="+numReg+"&tipo=eliminar&nom_tabla="+self.nombre_tabla,
	        })
	        .done(function(data) {            
	            //---------------------
	            console.log(data);

	            alert(data.mensaje.mensaje);
	            
	            location.reload();
	        })
	        .fail(function() {
	            console.log("error");
	        })
	        .always(function() {
	            console.log("complete");
	        });
	    },
	    serializa_array : function(array){

	    	var self = this;

	    	var cadenaSerializa = "";

	  		var ciclo_array = $.each(array, function(index, val) {

	  			var dataCadena = "";

	  			$.each(val, function(llave, valor) {
			 	          	 
				 	console.log("llave="+llave+" valor="+valor);

				 	dataCadena = dataCadena+llave+"="+valor+"&";	          	 	 	          	 	
				 	//insertaEstudio(cadenaSerializa);
				});

				dataCadena = dataCadena.substring(0,dataCadena.length - 1);

				console.log(dataCadena);
								
				self.inserta_serializa(dataCadena);	

	  		});

	  		$.when(ciclo_array).then(function(){
	  			console.log(" Terminó la inserción.")
	  		});
	  		
	    },
	    crea_array : function(array,id){

	    	var self = this;
    	
			this.arrElementosRelation = [];

			array.forEach(function(element, index){				

				var strObjt = '{"fkID_'+self.nombre_modulo+'":'+element+',"fkID_'+self.nombre_modulo2+'":'+id+'}';

				console.log(strObjt)

				var convObjt = JSON.parse(strObjt); 
			
				self.obtHE = convObjt;
				//setobtHE(convObjt)

				self.arrElementosRelation.push(self.obtHE);
				//getArrElementosRelation().push(getobtHE());

			});

			//console.log(matrixRelation.arrElementosRelation);

			return this.arrElementosRelation;
	    },
	    inserta_serializa : function(data){

	    	var self = this;

	    	$.ajax({
	    	  async: false,
	          url: "../controller/ajaxController12.php",
	          data: data+"&tipo=inserta&nom_tabla="+self.nombre_tabla,
	        })
	        .done(function(data) {	          
	          //---------------------
	          console.log(data);
	          //alert(data[0].mensaje);
	          //location.reload();
	          if (self.valida_accion() == "editar") {
	          	alert(data[0].mensaje);
	          	location.reload();
	          }          
	        })
	        .fail(function(data) {
	          console.log(data);	          
	          //alert(data[0].mensaje);          
	        })
	        .always(function() {
	          console.log("complete");
	        });
	    },
	    carga_elementos : function(query){
    		
    		var self = this;

	        $.ajax({
		        url: '../controller/ajaxController12.php',
		        data: "query="+query+"&tipo=consulta_gen",
		    })
		    .done(function(data) {	    	

		    	console.log(data);	    	

		    	$("#"+self.formulario_add).html("");

		    	$("#"+self.seleccionador).attr('data-accion', 'load');

		    	self.arrElementos.length = 0;
			    self.arrElementosRelation.length=0;

		    	if(data.estado != "Error"){	    	
			    	/**/
			    	for(var i = 0; i < data.mensaje.length; i++){

			    		self.id = data.mensaje[i].pkID;
			    		self.nombre = data.mensaje[i].nombre;
			    		
			    		self.select_elemento($("#"+self.seleccionador).data('accion'),data.mensaje[i].numReg);
			    	}

		    	}else{

		    		var msg_err = '<div class="alert alert-'+self.msg_err_consulta_clase+'" role="alert">'+self.msg_err_consulta+'</div>';
		    	
		    		$("#"+self.formulario_add).append(msg_err);
		    	}
		   
		    })
		    .fail(function() {
		        console.log("error");
		    })
		    .always(function() {
		        console.log("complete");
		    });
	    },
	    setMsgError : function(msg){
	    	this.msg_err_consulta = msg;
	    },
	    setMsgErrorClase : function(clase){
	    	this.msg_err_consulta_clase = clase;
	    }
		
	}

})();

(function(){

	//funciones de subida de archivos

	self.funcionesUpload = function(btn_accion,selector_form_res,notificador,nom_tabla,fkID){
		//this.data = {};
		this.btn_accion = btn_accion;
		this.selector_form_res = selector_form_res;
		this.notificador = notificador;
		this.nom_tabla = nom_tabla;
		this.fkID = fkID;
		this.action_actual = "";
		this.contDetailName = 0;
		this.arregloDeArchivos = [];
		this.archCoincide = "";
	}

	self.funcionesUpload.prototype = {

		functionAdd : function(data){

			var self = this,

				rand = Math.round(Math.random()*10),

	    		rand1 = Math.round(Math.random()*10);

	    	var frm = 'frm_group_'+this.selector_form_res+rand*rand1;			

			data.context = $("#"+this.selector_form_res).append(

			'<div class="form-group" id="'+frm+'">'+

	    		'<label class="control-label">Nombre para el archivo: '+data.files[0].name+'</label>'+

	    		'<input type="text" class="form-control add-selectElement" name="nombres['+this.contDetailName+']" data-name-file="'+data.files[0].name+'" required="true" /> <button name="btn_actionRm_'+frm+'" data-id-frm-group="'+frm+'" data-name-file="'+data.files[0].name+'" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button> <br>'+

			'</div>'

			);

			this.contDetailName++;

			this.arregloDeArchivos.push(data.files[0]);

			console.log(this.arregloDeArchivos);

			//------------------------------------------------------------
				$("[name*='btn_actionRm_"+frm+"']").click(function(event) {
					//console.log($(this).data('name-file'))
					//console.log($(this).data('id-frm-group'))

					//remueve el elemento del DOM
					self.removeElemento($(this).data('id-frm-group'))
					//console.log(self.indexElemento($(this).data('name-file')))

					//quita el elemento del array de archivos segun el index que indique
					//el nombre del archivo dentro del mismo.
					self.arregloDeArchivos.splice(self.indexElemento($(this).data('name-file')),1);

					console.log(self.arregloDeArchivos)
				});
			//------------------------------------------------------------        	

		},
		removeElemento : function(id_elem){
	    	$("#"+id_elem).remove();	    	
	    },
	    indexElemento : function(searchTerm){
	    	//http://stackoverflow.com/questions/8668174/indexof-method-in-an-object-array
			    index = -1;

			for(var i = 0, len = this.arregloDeArchivos.length; i < len; i++) {
			    if (this.arregloDeArchivos[i].name === searchTerm) {
			        index = i;
			        break;
			    }
			}

			return index;
	    },
	    validateUpload : function(result){
	    	//------------------------------------------------------
	    		var self = this,
	    		    valor = true;

	    		$.each(result.files, function(index, val) {
	    			console.log("index: "+index+" val: "+val)
	    			if(val.error){
	    				console.log("Hubo un error, no se subió el archivo.")
	    				//$("#"+self.notificador).html("Error: No se pudo subir un archivo -> "+val.error)
	    				console.log(val.error)
	    				valor = false;
	    				//return
	    			}else{
	    				console.log("Subió el archivo correctamente.")
	    				//$("#"+self.notificador).html("Ok: Subió el archivo -> "+val.name)
	    			};
	    		});

	    		return valor;
	    	//------------------------------------------------------
	    },
		functionSend : function(id_last,result){

			var self = this;
			//result del send del complemento
			if (this.validateUpload(result)) {

				console.log("Salio todo bien vamos a insertar!")

				//-----------------------------------------------------------------
				var iterate = $.each(this.arregloDeArchivos, function(index, val) {
		          	 
			      	 
			      	 //notificacion de subida de archivo
			      	 $("#"+self.btn_accion).attr('disabled', 'true');

			      	 $("#"+self.notificador).html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
			        												'Guardando registro archivo: '+val.name);
			      	 
			      	 self.getValoresDesc(val.name);
			    
					 //inserta_documento("ruta="+val.name+"&nom_doc="+archCoincide+"&fkID_tipo="+$("#fkID_tipo").val()+"&fkID_subtipo="+$("#fkID_subtipo").val()+"&fkID_proyecto="+$("#fkID_proyecto").val());
					 console.log("url="+val.name+"&nombre="+self.archCoincide+"&"+self.fkID+"="+id_last);

					 var insert = self.inserta_doc("url="+val.name+"&nombre="+self.archCoincide+"&"+self.fkID+"="+id_last);
				
					
					 insert.success(function(data){
					 	console.log(data);
					 });

			    });
				//-----------------------------------------------------------------

			    //-----------------------------------------------------------------
				$.when(iterate).then(subidaOK, subidaFail );

				function subidaOK(){
					//-----------------------------------------------------------------------------------
			        $("#"+self.notificador).html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
			    												' Subida de archivos Realizada con éxito. Por favor espere...');	        
			        
			        setTimeout(function() {
			           location.reload();
			        }, 2000);
			        //-----------------------------------------------------------------------------------
			    }

				function subidaFail(){
					$("#"+self.notificador).html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
			    												'Hubo un error en la creación de registro.');	
				}
				//-----------------------------------------------------------------
				/**/

			} else {
				
				console.log("Algo salió mal!")

				$("#"+self.notificador).html("Error: No se puede(n) subir este(os) archivo(s).")
				
				setTimeout(function() {
		           //location.reload();
		        }, 2000);				
			}		

		},
		getValoresDesc : function(nomArch){

			var self = this;

			console.log("nomArch: "+nomArch)
			
			var nombreControl = "";					

			$.each($("[name*='nombres']"), function(index, val) {
				 
				 nombreControl = $(this).attr("data-name-file");

				 console.log("nombreControl: "+nombreControl)				 

				 if(nomArch == nombreControl){
				 	self.archCoincide = val.value;
				 	console.log("Coicidió: "+val.value)				 	
				 }
			});

		},
		inserta_doc : function(srlz){

			var self = this;
	    		      	
	        return $.ajax({
	          async: false,
	          url: "../controller/ajaxController12.php",
	          data: srlz+"&tipo=inserta&nom_tabla="+self.nom_tabla,                 
	        })
	        .done(function(data) {	          
	          	                   
	        })
	        .fail(function(data) {
	          console.log(data);	          
	        })
	        .always(function() {
	          console.log("complete");
	        });	      

	    },
	    cons_doc : function(query) {
	    	
	    	var self = this;

	    	return $.ajax({
	          async: false,
	          url: "../controller/ajaxController12.php",
	          data: "query="+query+"&tipo=consulta_gen",                 
	        })
	        .done(function(data) {	          
	          	                   
	        })
	        .fail(function(data) {
	          console.log(data);	          
	        })
	        .always(function() {
	          console.log("complete");
	        });

	    },
	    elimina_doc : function(pkID) {
	    	
	    	  var self = this;

		      //si confirma es true ejecuta ajax
		      return $.ajax({
		      		async: false,
		            url: '../controller/ajaxController12.php',
		            data: "pkID="+pkID+"&tipo=eliminar&nom_tabla="+self.nom_tabla,
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
		    
	    },
	    functionLoad : function(query){

	    	var self = this;

	    	var cons = this.cons_doc(query);

	    	cons.success(function(data){
	    		
	    		console.log(data)

	    		$("#"+self.selector_form_res).html("");
	    		//------------------------------------------

	    		if (data.estado == "ok") {
	    		
		    		var itera = $.each(data.mensaje, function(index, val) {
		    			 
		    			 console.log("index: "+index+" val: "+val.nombre)

		    			 $("#"+self.selector_form_res).append(

			        		'<div class="form-group">'+

			        			' <button type="button" class="close delete-doc" data-id-doc="'+val.pkID+'" style="color: red!important;" title="Eliminar Documento">&times;</button>'+

				        		'<strong>Nombre: </strong>'+val.nombre+'<br>'+

				        		' <strong>Archivo: </strong> <a target="_blank" href="../server/php/files/'+val.url+'">'+val.url+'</a><br>'+			        		

			        		'</div>'

			        	 );

		    			 
		    		});

	    		

		    		$.when(itera).then(function(){
		    			
		    			console.log("Termino de cargar los documentos! ")

		    			$(".delete-doc").click(function(event) {
		    			 	console.log("Elimina reg doc: "+$(this).data('id-doc'))
		    			 	
			    			var confirma = confirm("En realidad quiere eliminar este documento?");
						    
						    if(confirma == true){

						    	var elimina = self.elimina_doc($(this).data('id-doc'));

						    	elimina.success(function(data){
						    		console.log(data)
						    		alert(data.mensaje.mensaje);			            
				            		location.reload();
			    				});
						    }

		    			 });    			
		    			

		    		});

	    		}
	    		
	    		//------------------------------------------
	    	});

	    },
	    functionReset:function(){

	    	$("#"+this.selector_form_res).html("")
	    }


	}

})();

(function(){

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
	
})();

(function(){
	//helper para novedades u observaciones

	self.follow = function(selector,btn_nuevo,parentModal,selectorModal,nomTabla,btn_action){

		this.selector = selector;
		this.btn_nuevo = btn_nuevo;
		this.parentModal = parentModal;
		this.selectorModal = selectorModal;
		this.nomTabla = nomTabla;		
		this.btn_action = btn_action;
		//valores por defecto en el form
		this.selectorFecha = "fecha_novedad";
		this.selectorIdOwner = "pkIDNovedadOwner";
		this.selectorNewNovedad = "novedadNuevo";
		this.selectorAction = "btn_actionnovedad";
		this.selectorForm = "form_novedad";		
		//variables resultantes
		this.followLast = "";
		this.followFinal = "";				
	}

	self.follow.prototype = {

		newOwner:function(action){

			if (action != "editar") {        		
        		$("#"+this.selector)[0]["value"] = date+" : Creado. -- ";        		
        	};

		},
		hideParent:function(val){			

			if (val == true) {

				$("#"+this.selector).parent().attr('hidden', 'true');				
				$("#"+this.selector).removeAttr('readonly');

			} else {

				$("#"+this.selector).parent().removeAttr('hidden');				
				$("#"+this.selector).attr('readonly', 'true');

			}
			
		},
		newFollow:function(){

			var self = this;

			$("#"+self.selectorFecha).val(date);
			$("#"+self.selectorIdOwner).val($("#pkID").val());

			this.setLastFollow($("#pkID").val())

			//cierra modal papá
			$('#'+self.parentModal).modal('hide');

			$('#'+self.selectorModal).on('hidden.bs.modal', function (e) {
			  //cuando cierra modal muestra papá
			  $('#'+self.parentModal).modal('show');
			});
			//setea la validacion de caracteres no permitidos
			$("#"+this.selectorNewNovedad).keyup(function(event) {  		
		  		$(this).val(validateFollow.valida($(this).val()))
		  	});

		},
		setLastFollow:function(pkID){

			var self = this;

			var cons = "SELECT "+this.selector+" FROM `"+this.nomTabla+"` WHERE pkID = "+pkID;
			//console.log(cons)

			var last = this.dbFollow(cons);

			last.success(function(data){
				//console.log(data)
				self.followLast = data.mensaje[0][self.selector];
			})

			//console.log(self.followLast)
		},
		updateFollow:function(){

			var self = this;

			$("#"+this.btn_action).click(function(event) {
				
				var frm_nov = $("#"+self.selectorForm).valida();

  				//console.log(frm_nov);

  				if (frm_nov.estado) {
		  			self.createFollow($("#pkID").val());		  			 
		  		} else {
		  			alert("No se permiten novedades vacías.");
		  		}
			});
		},
		createFollow:function(pkID){
			
			//var self = this;
			
			this.followFinal = this.followLast + $("#"+this.selectorFecha).val() + " : " + $("#"+this.selectorNewNovedad).val() + " -- "; 

			var cons = "UPDATE "+this.nomTabla+" SET "+this.selector+" = '"+this.followFinal+"' WHERE pkID = "+pkID;

			console.log(cons)

			var update = this.dbFollow(cons);

			update.success(function(data){
				console.log(data)
				alert("El campo se actualizó correctamente.");
	        	location.reload();
			})
		},
		dbFollow:function(query){

			return $.ajax({
				async: false,
		        url: '../controller/ajaxController12.php',
		        data: "query="+query+"&tipo=consulta_gen",
		    })
		    .done(function(data) {    	
		   
		    })
		    .fail(function() {
		        console.log("error");
		    })
		    .always(function() {
		        console.log("complete");
		    });
		},

	}

	self.validateFollow = {
 		exp : /[#%&!()\/]/g,
 		search : [],
 		res : '',
 		valida : function(str){ 			
 			this.search = str.match(this.exp);
 			if (this.search) {
 				this.reemplaza(str); 				
		 		return this.res;
		 	}else{
		 		return str;
		 	};
 		}, 		
 		reemplaza : function(str){
 			this.res = str.replace(this.exp, ""); 			
 		}
 	}

})();

(function(){
	//funcion para hacer consultas a la bd de forma general.
	self.dbGen={

		db_general:function(query){

			return $.ajax({
				async: false,
		        url: '../controller/ajaxController12.php',
		        data: "query="+query+"&tipo=consulta_gen",
		    })
		    .done(function(data) {	   
		    })
		    .fail(function() {
		        console.log("error");
		    })
		    .always(function() {
		        console.log("complete");
		    });
		}
	}
})();

(function(){
	
    self.ins_proyectoM = function(tabla_aux,nom_id_ini,id_ini,reload){

    	this.tabla_aux = tabla_aux;
    	this.nom_id_ini = nom_id_ini;
    	this.id_ini = id_ini;
    	this.id_proyectoM = leerCookie("id_proyectoM");
    	this.reload = reload;
    }

    /*;*/
    self.ins_proyectoM.prototype = {
    	insProyM:function(){
    		
    		var self = this;

    		var ins_proym = dbGen.db_general("INSERT INTO `"+this.tabla_aux+"` (`pkID`, `"+this.nom_id_ini+"`, `fkID_proyectoM`) VALUES (NULL, '"+this.id_ini+"', '"+this.id_proyectoM+"')");       

		    ins_proym.success(function(data){
		        console.log(data)
		        
		        if (self.reload) {
		        	location.reload();
		        }
		    });
    	}
    }
})();

(function(){

	self.chk_t = {

		selector : '',
		chk_rec : function(tipo){

			if (tipo == true) {	          
	          $("#"+this.selector).val('1');
	        } else{	          
	          $("#"+this.selector).val('0');	          
	        };

		},
		chk_rec_t : function(){

			$("#"+this.selector).click(function(event) {

			  chk_t.chk_rec($(this)[0]["checked"])
    
		      if(document.getElementById(chk_t.selector).checked) {
		          document.getElementById(chk_t.selector+'_hidden').disabled = true;
		      }else{
		        document.getElementById(chk_t.selector+'_hidden').disabled = false;
		      }

		    });
		}
	}
	
})();

(function(){

	self.functRara = function(){
		this.lista=[8,9,3];
		this.n = this.lista.length;
		this.simbolo=[this.n];
	}

	self.functRara.prototype = {
		exect:function(){
			var i,j,aux,izq,der,m,self = this;

			for (var i = 1; i < self.n; i++) {
				aux = self.lista[i]
				izq = 0
				der = i - 1

				while (izq <= der) {
					m = ((izq+der)/2)

					if (aux < self.lista[m]) {
						der = m-1;
						self.simbolo[i-1] = "-";
					} else {
						izq = m+1;
						self.simbolo[i-1] = "+";
					} 
				}

				j=i-1;

				while (j>=izq) {
					self.lista[j+1]=self.lista[j];
					j=j-1;
				}

				self.lista[izq]=aux;
			}

			self.simbolo[i-1]="$";

			salida = "";

			for (var i = 0; i < self.n; i++) {
				salida += self.lista[i] + self.simbolo[i];
			}

			console.log(salida)
		}
	}

	//var exe = new functRara();
	//exe.exect()
	//console.log(exe.n)

})();

(function(){

	self.crypt = {

        encripta:function(val){
            //console.log("Encriptando")
            var enc = this.sendVal(val,"encriptar");

            var res = "";

            enc.success(function(data){
            	//console.log(data.encriptado)

            	res = data.encriptado;
            })

            return res;
        },
        desencripta:function(val){
            //console.log("Encriptando")
            var enc = this.sendVal(val,"desencriptar");

            var res = "";

            enc.success(function(data){
            	//console.log(data.desencriptado)
            	res = data.desencriptado;
            })

            return res;
        },
        sendVal:function(val,type){

        	return $.ajax({
	    	  async: false,
	          url: "../controller/helper_controller/crypt.php",
	          //data: data+"&tipo=inserta&nom_tabla="+self.nombre_tabla,
	          data: "valor="+val+"&tipo="+type,
	        })
	        .done(function(data) {	          
	          //---------------------	               
	        })
	        .fail(function(data) {
	          console.log(data);	                 
	        })
	        .always(function() {
	          console.log("complete");
	        });
        }
    };

})();

(function(){
	//clase para cargar municipios con el departamento
	//se dejan fijos los selectores ya que por diseño de BD
	//siempre llevarian los mismos ID´S

	self.locationDepMun = function(){
		this.select_dep = "fkID_departamento";
		this.select_mun = "fkID_municipio";
		this.query = "SELECT * FROM `municipio` WHERE fkID_departamento = ";
	}

	self.locationDepMun.prototype = {

		init:function(){
			
			var self = this;

			$("#"+this.select_dep).change(function(event) {
				self.load_mun($(this).val())
			});
		},		
		load_mun:function(pkID_departamento){

			var self = this;			

			var cons = dbGen.db_general(self.query+pkID_departamento);
			
			cons.success(function(data){
				
				console.log(data.estado)

				self.reset_mun()

				if (data.mensaje != "No hay registros.") {

		        	$("#"+self.select_mun).append('<option></option>')

		        	$.each(data.mensaje, function(index, val) {			        	 
			        	 //console.log(index+"--"+val)
			        	 //console.log(val)
			        	 $("#"+self.select_mun).append('<option value="'+val.pkID+'" data-nombre="'+val.nombre+'">'+val.nombre+'</option>')	        	 
			        });

		        	//enfoca el control despues de cargarlo.
		        	$("#"+self.select_mun).focus()

		        };
			})
		},
		reset_mun:function(){
			$("#"+this.select_mun).html('');
		},
		//setters y getters en casos no previstos
		set_mun:function(id_select_mun){
			this.select_mun = id_select_mun;
		},
		set_dep:function(id_select_dep){
			this.select_dep = id_select_dep;
		}
		//---------------------------------------
	}

})();
//-------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------
(function(){
	//-------------------------------------------------------
	self.usersGen = function(stage_form){
		//formulario de donde esta
		this.stage_form = $("#"+stage_form);
		this.nombreInput;
		this.apellidoInput;
		this.aliasInput;
		this.passInput;
		//-----------------------
		this.inicial;
		this.complemento;
	}

	self.usersGen.prototype = {

		init:function(){
			//-----------------------------------------------
			//this.stage_form = $("#"+this.stage_form);
			//buscar los controles nombre apellido alias pass
			this.setControles()
			//-----------------------------------------------
			//setear keyup nombre y apellido
			//-----------------------------------------------
		},
		setControles:function(){

			var self = this;
			console.log(this.stage_form)
			var itera = $.each(this.stage_form[0], function(index, val) {
				 console.log(index)
				 console.log(val.id)
				 /**/
				 switch (val.id) {
				 	case "nombre":
				 			self.nombreInput = $("#"+self.stage_form[0]["id"]+" #"+val.id);
				 			//console.log(self.nombreInput)
				 		break;
				 	case "apellido":
				 			self.apellidoInput = $("#"+self.stage_form[0]["id"]+" #"+val.id);
				 			//console.log(self.nombreInput)
				 		break;
				 	case "alias":
				 			self.aliasInput = $("#"+self.stage_form[0]["id"]+" #"+val.id);
				 			//console.log(self.nombreInput)
				 		break;
				 	case "pass":
				 			self.passInput = $("#"+self.stage_form[0]["id"]+" #"+val.id);
				 			//console.log(self.nombreInput)
				 		break;				 	
				 }
			});

			$.when(itera).then(function(){
				self.setKeyupNom()
				//readonly
				self.aliasInput.attr('readonly', 'readonly');
				self.passInput.attr('readonly', 'readonly');				
			});
			
		},
		setKeyupNom:function(){

			var self = this;

			this.nombreInput.change(function(event) {
				self.setInicial($(this))
				self.validateCampos()				
			});

			this.apellidoInput.change(function(event) {				
				self.setComplemento($(this))
				self.validateCampos()
			});	
		},
		setInicial:function(elemento){
			//var self = this;
			this.inicial = elemento.val().charAt(0).toLowerCase();			
		},
		setComplemento:function(elemento){
			this.complemento = elemento.val();
			//this.complemento = this.complemento.substr(0,this.complemento.indexOf(' '));
			//console.log(this.complemento.indexOf(' '))
			this.complemento = this.complemento.indexOf(' ') != -1 ? this.complemento.substr(0,this.complemento.indexOf(' ')) : this.complemento;			
		},
		setAliasPass:function(){
			//se asigna el alias
			//hay que validar en la bd que no exista uno igual
			//en caso de que exista ponerle un character random
			//hasta que no exista uno igual en la bd

			this.validateAlias(this.inicial+this.complemento)

			this.passInput.val("12345");
		},
		validateCampos:function(){

			if ( (this.nombreInput.val() != "") && (this.apellidoInput.val() != "") ) {
				
				if (this.inicial == undefined) {
					console.log("No hay inicial.")
					this.setInicial(this.nombreInput)
				}else if(this.complemento == undefined){
					console.log("No hay complemento.")
					this.setComplemento(this.apellidoInput)
				}
				
				this.setAliasPass()
			}
		},
		validateAlias:function(alias){
			var self = this;
			var query_val_alias = "SELECT * FROM `usuarios` WHERE alias LIKE '%25"+alias+"%25'";
			var alias_validate = dbGen.db_general(query_val_alias);

			alias_validate.success(function(data){
				//console.log(data)

				if (data.estado == "ok") {
					//hay resultados, toca añadirle algo
					//this.inicial+this.complemento
					var alias_modified = self.inicial+self.letraAleatoria()+self.complemento;
					//self.aliasInput.val(alias_modified)
					//se vuelve a validar en caso de que exista de nuevo
					self.validateAlias(alias_modified)
				}else{
					//no hay que añadir nada porque nada
					//no coincide
					self.aliasInput.val(alias);
				}
			})
		},
		letraAleatoria:function(){
			var numero = Math.floor(Math.random() * 25);
			var num_complementa = numero + Math.floor(Math.random() * 200);
			var letraAleatoria = String.fromCharCode(97 + numero);
			//console.log(letraAleatoria+num_complementa)

			return letraAleatoria+num_complementa;
		}
	}
	//-------------------------------------------------------
})();

(function(){

	//-------------------------------------------------------
	self.validaCampoLike = function(nom_campo,nom_tabla,selector_input,selector_form,selector_btn_action){
		this.nom_campo = nom_campo;
		this.nom_tabla = nom_tabla;
		this.selector_input = selector_input;
		this.selector_form = selector_form;
		this.selector_btn_action = selector_btn_action;
		//-------------------------
		this.cons_validaCampo;		
		//-------------------------
		this.class_alert = "danger";
	}

	self.validaCampoLike.prototype = {

		creaConsulta: function(valor){
			//console.log(valor)
			//se debe pasar el simbolo % como %25 porque no se codifica a la hora de pasarlo por php
			this.cons_validaCampo = "select "+this.nom_campo+" from "+this.nom_tabla+" where "+this.nom_campo+" LIKE '"+valor+"%25'; ";
			//console.log(this.cons_validaCampo)
			this.ejecutaValidar(this.cons_validaCampo)
		},
		creaVisorResults:function(){
			//$("#"+this.selector_input)
			//console.log($("#"+this.selector_form+" #"+this.selector_input))
			//$("#"+this.selector_form+" #"+this.selector_input).append('<div class="alert alert-warning" role="alert">...</div>');
			
			if ($("#"+this.selector_form+" .alert-"+this.class_alert).length) {
				console.log("El alert ya existe!")
			} else {
				$( '</br> <div class="alert alert-'+this.class_alert+'" role="alert"> ... </div> ' ).insertAfter( "#"+this.selector_form+" #"+this.selector_input );
			}
		},
		validar: function(){
			this.creaVisorResults();
			this.creaConsulta($("#"+this.selector_form+" #"+this.selector_input).val());			
		},
		ejecutaValidar:function(){
			
			var self = this;

			var ejecuta = dbGen.db_general(this.cons_validaCampo);

			ejecuta.success(function(data){

				//console.log(data)

				if (data.estado != "Error") {
					
					self.resetAlert();
					$("#"+self.selector_form+" .alert-"+self.class_alert).append("Coincidencias: ");

					$.each(data.mensaje, function(index, val) {						 
						 //console.log(val[self.nom_campo]+" - ")						 
						 $("#"+self.selector_form+" .alert-"+self.class_alert).append("<strong>"+val[self.nom_campo]+"</strong> - ");
					});

					self.ableDisButtonAction("disable");

				}else{

					self.resetAlert();
					$("#"+self.selector_form+" .alert-"+self.class_alert).append("No hay coincidencias con este valor.<br>");

					self.ableDisButtonAction("enable");
				}
			})
		},
		resetAlert:function(){

			$("#"+this.selector_form+" .alert-"+this.class_alert).html("");
			$("#"+this.selector_form+" .alert-"+this.class_alert).append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		},
		ableDisButtonAction:function(type){
			//inhabilita la posibilidad de crear un registro			
			switch (type) {
				case "enable":
						$("#"+this.selector_btn_action).removeAttr('disabled');
					break;
				case "disable":
						$("#"+this.selector_btn_action).attr('disabled','true');
					break;
			}
		}

	}	
	//-------------------------------------------------------

})();


(function(){

	self.loadArchivosMult = function(query_docs){
        this.query_docs = query_docs;
        //---------------------------
        //id del div donde se van a cargar
        //los archivos.
        this.stage_results = "frm_modal_archivos .modal-body";
        this.label_results = "lbl_form_archivos";
    }

	self.loadArchivosMult.prototype = {

        load:function(){

            var cons = dbGen.db_general(this.query_docs);
            var self = this;

            cons.success(function(data){

                self.resetDivRes()
               
                if (data.estado == "ok") {
                
                    var itera = $.each(data.mensaje, function(index, val) {
                         
                         console.log("index: "+index+" val: "+val.nombre)

                         $("#"+self.stage_results).append(
                            '<div class="form-group">'+                                
                                '<strong>Nombre: </strong>'+val.nombre+'<br>'+
                                '<strong>Archivo: </strong> <a target="_blank" href="../server/php/files/'+val.url+'">'+val.url+' <span class="glyphicon glyphicon-download-alt"></span></a><br>'+
                            '</div>'
                         );
                         
                    });

                }else{
                	self.resetDivRes()                   
                    $("#"+self.stage_results).append('<div class="alert alert-info" role="alert"><strong>Este registro no tiene archivos disponibles.</strong></div>');
                }

            })
        },
        resetDivRes:function(){
        	$("#"+this.label_results).html("Archivos Disponibles");
        	$("#"+this.stage_results).html("");
        }
    }

})();

//validacion de la cookie de proyecto marco--------------------------------------------
(function(){

	self.validateCookie = function(val_cookie){
		this.val_cookie = val_cookie;
		this.selector_usuarios = "modulo-usuarios";
	}

	self.validateCookie.prototype = {
		validar: function(){
			//console.log(this.val_cookie)

			if (this.val_cookie == false) {
				//console.log("No hay cookie de proyecto marco!")
				//oculta el acceso al modulo usuarios
				this.toogleAccess('disable')
			} else {
				//console.log("Sí hay cookie de proyecto marco : "+this.val_cookie)
				this.toogleAccess('enable')
			}
		},
		toogleAccess: function(tipo){
			var self = this;
			//---------------------------------------
			switch (tipo) {
				case 'enable':
						$("."+self.selector_usuarios).removeClass('toogle-display-usuarios')
					break;
				case 'disable':						
						$("."+self.selector_usuarios).addClass('toogle-display-usuarios');
					break;				
			}
			//---------------------------------------
		} 
	}

	var valCookie = new validateCookie(leerCookie("id_proyectoM"));

	valCookie.validar()

})();

//-------------------------------------------------------------------------------------
//HELPER DE AUDITORIA INTERACTUANDO CON JQUERY_CONTROLLERV2
(function(){

	self.audit = function(accion, consulta_sql, nom_modulo){
		this.accion = accion;
		this.nom_modulo = nom_modulo;
		this.fecha = date;
		this.consulta_sql = crypt.encripta(consulta_sql);
		//------------------		
		this.fkID_modulo = $("#id_mod_page_"+nom_modulo).val();
		//------------------
		this.fkID_usuario = leerCookie("log_sisep_id");
		this.fkID_proyectoM = leerCookie("id_proyectoM");
	}

	self.audit.prototype = {

		auditar: function(){
			var self = this;
			//console.log(this.accion+"--"+this.fecha+"--"+this.fkID_usuario+"--"+this.fkID_proyectoM+"--"+this.consulta_sql+"--"+this.fkID_modulo)
			//crea json para serializarlo como data y pasarlo por ajax
			var arr_audit = {
				"accion": self.accion,
				"fecha": self.fecha,
				"consulta_sql": self.consulta_sql,
				"fkID_modulo": self.fkID_modulo,
				"fkID_usuario": self.fkID_usuario,
				"fkID_proyectoM": self.fkID_proyectoM
			};
			//console.log($.param(arr_audit))

			var creaAudit = this.insertaAudit($.param(arr_audit))
			
			creaAudit.success(function(data){
				console.log(data)
			})
		},
		insertaAudit:function(data){

			return $.ajax({
				async: false,
		        url: '../controller/ajaxController12.php',
		        data: data+"&tipo=inserta&nom_tabla=auditoria",
		    })
		    .done(function(data) {	   
		    })
		    .fail(function() {
		        console.log("error");
		    })
		    .always(function() {
		        console.log("complete");
		    });
		}
	}

})();
//-------------------------------------------------------------------------------------