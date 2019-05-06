(function(){

	//console.log("Hola desde helper de detalles grupo.")
	//---------------------------------------------------
	
	self.valGrupo = function(selector,selector_form){
		this.selector = selector;//selector del id de la lista de estudiantes.
		this.selector_form = selector_form;//selector del formulario padre

		//this.sel_grado_grupo = "grado_grupo";
		//this.sel_institucion_grupo = "institucion_grupo";
		this.tipo_cons = 1;//valida estudiantes y 2 valida docentes

		//this.fkID_grado = 0;
		//this.fkID_institucion = 0;		
		this.arr_grupof_usuarios = [];//array donde se cargan los usuarios		
	}

	self.valGrupo.prototype = {

		setFuncSelect:function(){

			var self = this;

			$("#"+this.selector_form+" #"+this.selector).focus(function(event) {				

				//self.fkID_grado = $("#"+self.sel_grado_grupo).val();
				//self.fkID_institucion = $("#"+self.sel_institucion_grupo).val();

				//console.log(self.fkID_grado)

				self.loadSelect()

			});
		},
		loadSelect:function(){
			/**/
			var self = this;

			var cons = "select usuarios.*"+

					   " FROM `usuarios`";

			if (this.tipo_cons == 1) {
				cons += " WHERE usuarios.fkID_tipo = 12";
			} else if(this.tipo_cons == 2){
				cons += " WHERE usuarios.fkID_tipo = 8";
			}			

			var load = this.dbGrupo(cons);

			self.setGrupoUsuarios()

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
						
						var res = self.arr_grupof_usuarios.indexOf(val.pkID)

						//console.log(res)

						if (res === -1) {
							console.log("No esta en un grupo.")
							$("#"+self.selector_form+" #"+self.selector).append('<option value="'+val.pkID+'">'+val.nombre+" "+val.apellido+'</option>')
						} else {
							console.log("Si está en un grupo.")
						}						
					//--------------------------------------------
				});

				$.when(ciclo).then(function(){					
					console.log("Se cargó el select!")
				});				

			});
		},
		setGrupoUsuarios:function(){

			var self = this;

			var cons = "select * from usuario_grupo_formacion";

			/*if (this.tipo_cons != 1) {
				cons += " WHERE fkID_rol = 6";
			}
			*/	
			var load = this.dbGrupo(cons);

			load.success(function(data){
				//carga solo los id de los estudiantes asociados a x grupo
				console.log(data)
				if (data.estado == "ok") {

					$.each(data.mensaje, function(index, val) {
						self.arr_grupof_usuarios.push(val.fkID_usuario);
					});

				}			

			});
		},
		dbGrupo:function(query){

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