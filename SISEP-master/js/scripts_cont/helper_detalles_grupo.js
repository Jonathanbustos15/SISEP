(function(){

	//console.log("Hola desde helper de detalles grupo.")
	//---------------------------------------------------
	/*

	\|/
   - o -
    /-`-.
    :   :
    :TNT: Advertencia.
    :___:

	-- La validación del docente se hace a partir del rol 
	-- el cual debe ser principal con pkID = 6

	*/

	self.valGrupo = function(selector,selector_form,selector_roles){
		this.selector = selector;//selector del id de la lista de estudiantes.
		this.selector_form = selector_form;//selector del formulario padre
		this.selector_roles = selector_roles;

		this.sel_grupo = "grupo_id";
		this.sel_grado_grupo = "grado_grupo";
		this.sel_institucion_grupo = "institucion_grupo";


		this.tipo_cons = 1;//valida estudiantes y 2 valida docentes

		this.id_grupo = 0;
		this.fkID_grado = 0;
		this.fkID_institucion = 0;		
		this.arr_grupo_usuarios = [];//array donde se cargan los usuarios		
	}

	self.valGrupo.prototype = {

		setFuncSelect:function(){

			var self = this;

			$("#"+this.selector_form+" #"+this.selector).focus(function(event) {				

				self.id_grupo = $("#"+self.sel_grupo).val();
				self.fkID_grado = $("#"+self.sel_grado_grupo).val();
				self.fkID_institucion = $("#"+self.sel_institucion_grupo).val();

				console.log(self.fkID_grado)

				self.loadSelect()

			});
		},
		loadSelect:function(){
			/**/
			var self = this;

			var cons = "select usuarios.*, grado.nombre as nom_grado, sede.nombre as nom_institucion"+

					   " FROM `usuarios`"+

					   " INNER JOIN usuario_grado ON usuario_grado.fkID_usuario = usuarios.pkID"+

					   " INNER JOIN grado ON usuario_grado.fkID_grado = grado.pkID"+

					   " INNER JOIN sede ON sede.pkID = usuarios.fkID_institucion";

			if (this.tipo_cons == 1) {
				cons += " WHERE grado.pkID = "+this.fkID_grado+" AND sede.pkID = "+this.fkID_institucion+" AND usuarios.fkID_tipo = 9";
			} else if(this.tipo_cons == 2){
				cons += " WHERE grado.pkID = "+this.fkID_grado+" AND sede.pkID = "+this.fkID_institucion+" AND usuarios.fkID_tipo = 8";
			}			

			var load = this.dbGrupo(cons);

			self.setGrupoUsuarios(" WHERE fkID_grupo = "+this.id_grupo+" AND fkID_rol = 6")

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
						
						var res = self.arr_grupo_usuarios.indexOf(val.pkID)

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
					//si el tipo es == 2 se valida si el docente ya aparece
					//como lider en cualquier parte.
					//si ya ha salido lider carga los roles excepto el de principal.
					if (self.tipo_cons == 2) {
						//valida en el selector que rol debe cargar
						//segun el usuario seleccionado
						self.setSelectBlur()
					}
				});				

			});
		},
		setSelectBlur:function(){
			
			var self = this;

			$("#"+this.selector_form+" #"+this.selector).blur(function(event) {
				console.log($(this).val())

				var val_docente_principal = self.dbGrupo(" select * from usuario_grupo where fkID_usuario = "+$(this).val()+" and fkID_rol = 6;");

				val_docente_principal.success(function(data){
					console.log(data)
					if (data.estado == "Error") {
						//carga todos los roles
						self.loadSelectRoles(0)
					} else {
						//carga todos los roles excepto el principal.
						self.loadSelectRoles(1)
					}
				})

			});
		},
		loadSelectRoles:function(tipo){

			var self = this;

			var cons = "select * from rol where fkID_tipo_usuario = 8";

			if (tipo == 1) {
				cons += " and pkID != 6 ";
			}

			var loadRoles = this.dbGrupo(cons);

			loadRoles.success(function(data){
				
				console.log(data.mensaje)
				
				if(data.estado == "ok"){

					$("#"+self.selector_form+" #"+self.selector_roles).html("")
					$("#"+self.selector_form+" #"+self.selector_roles).append("<option></option>")

					$.each(data.mensaje, function(index, val) {
						$("#"+self.selector_form+" #"+self.selector_roles).append('<option value="'+val.pkID+'">'+val.nombre+'</option>') 
					});

				}else{
					console.log("No hay roles.")
				}
			})
		},
		setGrupoUsuarios:function(cons_con){

			var self = this;

			var cons = "select * from usuario_grupo";

			if (this.tipo_cons != 1) {
				cons += cons_con;
			}

			var load = this.dbGrupo(cons);

			load.success(function(data){
				//carga solo los id de los estudiantes asociados a x grupo
				console.log(data)
				if (data.estado == "ok") {

					$.each(data.mensaje, function(index, val) {
						self.arr_grupo_usuarios.push(val.fkID_usuario);
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