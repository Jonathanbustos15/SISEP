$(function(){

	var objt_cond = {
		'fkID_grupo':''
	};


	var id = ''; 


	function crea_consultae(){
		//----------------------------------------------------------
		console.log(objt_cond)
		
		var arr_cond = [];

		$.each(objt_cond, function(index, val) {
			 
			 console.log('index:'+index+' val:'+val);

			 if (val != '') {
			 	arr_cond.push('proyectos.'+index+'='+val);
			 };
		});

		console.log(arr_cond)
		//----------------------------------------------------------
		var cons_final = '';

		if (arr_cond.length > 1) {
			cons_final = arr_cond.join(' AND ');
		}else if (arr_cond.length == 0) {
			cons_final = '*';
		} else{
			cons_final = arr_cond.join();
		};

		console.log(cons_final)
		/**/
		location.href="proyectos.php?filter="+cons_final;
		//----------------------------------------------------------
	}

	//empresa_filtro
	$("#anio_filtrog").change(function(event) {		
		
		id = $(this).val();
		if (id == "") {
			objt_cond.fkID_grupo = '';
		} else{
			objt_cond.fkID_grupo = id;
		};
		
		id_grupo = id;

		fill_empresa();

		console.log(objt_cond)		
	});


	$("#btn_filtrar").click(function(event) {		
		crea_consultae();
	});
	
});