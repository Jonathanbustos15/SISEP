(function(){

	//console.log("Hola desde helper de detalles grupo.")
	//---------------------------------------------------
	
	self.valBitacora = function(selector,selector_form){
		this.selector = selector;//selector del id de la lista de estudiantes.
		this.selector_form = selector_form;//selector del formulario padre
		//---------------------------------		
		this.arr_bitacora_fases = [];//array donde se cargan las fases		
	}

	self.valBitacora.prototype = {

		setFuncSelect:function(){

			var self = this;

			$("#"+this.selector_form+" #"+this.selector).focus(function(event) {				

				self.loadSelect()

			});
		},
		loadSelect:function(){
			/**/
			var self = this;

			var cons = "select fase.*"+

					   " FROM `fase`";


			var load = this.dbBitacora(cons);

			self.setBitacoraFases()

			load.success(function(data){
				//console.log(data)				
				//console.log(self.arr_grupo_usuarios)
				//console.log("Usuarios del grado")

				$("#"+self.selector_form+" #"+self.selector).html("")
				$("#"+self.selector_form+" #"+self.selector).append('<option></option>')
				
				var ciclo = $.each(data.mensaje, function(index, val) {
					//console.log("llave: "+index+" val: "+val.pkID)
					//--------------------------------------------
						//console.log("Usuarios asignados al grupo")						
						
						var res = self.arr_bitacora_fases.indexOf(val.pkID)

						//console.log(res)

						if (res === -1) {
							console.log("No esta en una bitacora.")
							$("#"+self.selector_form+" #"+self.selector).append('<option value="'+val.pkID+'">'+val.pkID+'. '+val.nombre+'</option>')
						} else {
							console.log("Si está en una bitacora.")
						}						
					//--------------------------------------------
				});

				$.when(ciclo).then(function(){					
					console.log("Se cargó el select!")
				});				

			});
		},
		setBitacoraFases:function(){

			var self = this;

			var cons = "select * from bitacora where fkID_proyectoM = "+leerCookie("id_proyectoM");
			
			var load = this.dbBitacora(cons);

			load.success(function(data){
				//carga solo los id de los estudiantes asociados a x grupo
				console.log(data)
				if (data.estado == "ok") {

					$.each(data.mensaje, function(index, val) {
						self.arr_bitacora_fases.push(val.fkID_fase);
					});

				}			

			});
		},
		dbBitacora:function(query){

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
	//---------------------------------------------------

})();