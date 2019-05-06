(function(){
	//
	self.valida_grupoEvento = {
		selector:'',		
		arrEventos:[],
		loadSelect:function(fkID_grupo){
			this.fkID_grupo = fkID_grupo;
			this.setData();
			//validar que se carga dentro del select
		},
		setData:function(){
			var query = "SELECT * FROM `grupo_evento` where fkID_grupo = "+this.fkID_grupo;
			var cons = dbGen.db_general(query);
			var self = this;
			cons.success(function(data){
				console.log(data)
				if(data.estado == "ok"){
					
					self.arrEventos = [];

					$.each(data.mensaje, function(index, val) {
						self.arrEventos.push(val.fkID_evento)
					});
				}

				console.log(self.arrEventos)
				//-------------------------------------------
				self.setOptionsSelect()
			})
		},
		setOptionsSelect:function(){
			var query = "select apropiacion_social.*, nombre_apropiacionS.nombre as nombre"+

					  " FROM `apropiacion_social`"+					  
                      
                      " INNER JOIN nombre_apropiacionS ON apropiacion_social.fkID_nombre = nombre_apropiacionS.pkID";
			
			var cons = dbGen.db_general(query);
			var self = this;
			cons.success(function(data){
				console.log(data)
				//----------------------------------------
				$("#"+self.selector).html("")
				$("#"+self.selector).append('<option></option>')
				//----------------------------------------
				if (data.estado == "ok") {

					$.each(data.mensaje, function(index, val) {
						
						var res = self.arrEventos.indexOf(val.pkID)

						if (res === -1) {
							//console.log("No esta en un grupo.")
							$("#"+self.selector).append('<option value="'+val.pkID+'" data-puntaje="'+val.puntaje+'">'+val.nombre+'</option>')
						}

					});

				}
				//----------------------------------------
			})
		}
	}
})()