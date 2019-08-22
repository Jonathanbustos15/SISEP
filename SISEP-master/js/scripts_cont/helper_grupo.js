(function(){
	//helper para ingresos general

	self.id_grupo = 0;
	self.selector_filtro = '';

	self.options_format = {
		symbol : "$",
		decimal : ",",
		thousand: ".",
		precision : 0,
		format: "%s%v"
	};


	self.remplazar = function (texto, buscar, nuevo){
	    var temp = '';
	    var long = texto.length;
	    for (j=0; j<long; j++) {
	        if (texto[j] == buscar) 
	        {
	            temp += nuevo;
	        } else
	            temp += texto[j];
	    }
	    return temp;
	}

	//---------------------------------------------------------------------------------------------------
	self.cons_grupo=function(){

		var consulta_grupo = "select distinct grupo.*,YEAR(grupo.fecha_creacion) as anio, grado.nombre as nom_grado, institucion.nombre_institucion as nom_institucion, grupo.pkID as numero, tipo_proyecto.nombre as nom_tipo FROM grupo INNER JOIN tipo_proyecto ON tipo_proyecto.pkID = grupo.fkID_tipo_grupo INNER JOIN institucion ON institucion.pkID = grupo.fkID_institucion INNER JOIN grado ON grado.pkID = (CASE WHEN grupo.fkID_grado = 0 THEN 6 WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado END) where grupo.estadoV = 1 and YEAR(grupo.fecha_creacion)="+id_grupo;

		return $.ajax({
	        url: '../controller/ajaxController12.php',
	        data: "query="+consulta_grupo+"&tipo=consulta_gen",
	    })
	    .done(function(data) {
	    	//------------------------------------------
	        //this.paso_reciente = data.mensaje[0].idPaso2;		        
	    })
	    .fail(function() {
	        console.log("error");
	        //quita todo? o pone todo?
	        //location.reload();
	    })
	    .always(function() {
	        console.log("complete");
	    });
		/*---------------------------------------------------*/
	}

	self.cons_grupos_todo=function(){

		var consulta_grupo = "select distinct grupo.*,YEAR(grupo.fecha_creacion) as anio, grado.nombre as nom_grado, institucion.nombre_institucion as nom_institucion, grupo.pkID as numero, tipo_proyecto.nombre as nom_tipo FROM grupo INNER JOIN tipo_proyecto ON tipo_proyecto.pkID = grupo.fkID_tipo_grupo INNER JOIN institucion ON institucion.pkID = grupo.fkID_institucion INNER JOIN grado ON grado.pkID = (CASE WHEN grupo.fkID_grado = 0 THEN 6 WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado END) where grupo.estadoV = 1";

		return $.ajax({
	        url: '../controller/ajaxController12.php',
	        data: "query="+consulta_grupo+"&tipo=consulta_gen",
	    })
	    .done(function(data) {
	    	//------------------------------------------
	        //this.paso_reciente = data.mensaje[0].idPaso2;		        
	    })
	    .fail(function() {
	        console.log("error");
	        //quita todo? o pone todo?
	        //location.reload();
	    })
	    .always(function() {
	        console.log("complete");
	    });
	}

	self.fill_empresa=function(){

		if (id_grupo=='') {
			
			var fecha_todo = cons_grupos_todo();

			fecha_todo.success(function(data){
				console.log(data);
				//itera_fecha(data);
			});

		} else{

			var data_fecha = cons_grupo();

			data_fecha.success(function(data){
				console.log(data);			
			});

		};
		
	}

	self.itera_fecha=function(data){

		$("#"+selector_filtro).html('');
					
		$("#"+selector_filtro).append('<option></option>');

		if (data.estado == "ok") {

			$("#"+selector_filtro).removeAttr('disabled');

			$.each(data.mensaje, function(index, val) {							
				 $("#"+selector_filtro).append('<option value="\''+val.fecha_aprobacion+'\'">'+val.fecha_aprobacion+'</option>');			 
			});

		} else{

			$("#"+selector_filtro).html('');
			$("#"+selector_filtro).attr('disabled', 'true');
		};
	}
	//---------------------------------------------------------------------------------------------------

})();