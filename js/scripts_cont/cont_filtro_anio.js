$(function(){

	var objt_cond = {
		'YEAR':''
	};

	var variable='YEAR(grupo.fecha_creacion)';
	var id = ''; 
	var idt='';


	function crea_consultae(){
		//----------------------------------------------------------
		console.log(objt_cond)
		
		var arr_cond = [];

		$.each(objt_cond, function(index, val) {
			 
			 console.log('index:'+index+' val:'+val);

			 if (val != '') {
			 	arr_cond.push('grupo.'+index+'='+val);
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
		if (idt=="") {idt = "*";}
		console.log(cons_final)
		/**/
		location.href="grupo.php?filter="+cons_final+" "+idt;
		//----------------------------------------------------------
	}

	//empresa_filtro
	$("#tipo_filtrog").change(function(event) {		
		idt = $(this).val();
		console.log(idt);
		if (idt == "") {
			idt = "*";
		} else{
			idt = idt;
		};
				
	});
	//Año_filtro
	$("#anio_filtrog").change(function(event) {		
		id = $(this).val();
		console.log(id);
		if (id == "") {
			objt_cond.YEAR = '';
		} else{
			objt_cond.YEAR = id;
		};
		
		id_grupo = id;

		console.log(objt_cond)		
	});


	$("#btn_filtrarg").click(function(event) {	
		console.log("hola")	
		crea_consultae();
	});
	
});