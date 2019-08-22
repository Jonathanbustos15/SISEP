$(function(){
	
	//console.log('hola selects municipio')------------------------------------
	
	function carga_Municipio(pkID_departamento,id_form){

		var consulta_municipio = "SELECT * FROM `municipio` WHERE fkID_departamento = "+pkID_departamento;
		//---------------------------------------------------------------
	    $.ajax({
	        url: '../controller/ajaxController12.php',
	        data: "query="+consulta_municipio+"&tipo=consulta_gen",
	    })
	    .done(function(data) {
	    	
	    	
	        console.log(data)
	        /**/

	        $("#"+id_form+" #fkID_municipio").html('');


	        if (data.mensaje != "No hay registros.") {

	        	$("#"+id_form+" #fkID_municipio").append('<option></option>')

	        	$.each(data.mensaje, function(index, val) {
		        	 
		        	 console.log(index+"--"+val)
		        	 console.log(val)

		        	 $("#"+id_form+" #fkID_municipio").append('<option value="'+val.pkID+'">'+val.nombre+'</option>')	        	 
		        });

	        
	        	$("#fkID_municipio").click();

	        };	        
	    })
	    .fail(function() {
	        console.log("error");
	        $("#"+id_form+" #fkID_municipio").html('');
	    })
	    .always(function() {
	        console.log("complete");
	    });
	    //---------------------------------------------------------------
	}

	

	$("#form_estudiante #fkID_departamento").change(function(event) {
		carga_Municipio($(this).val(),"form_estudiante")
		//console.log(event)
	});

	$("#form_docente #fkID_departamento").change(function(event) {
		carga_Municipio($(this).val(),"form_docente")
		//console.log(event)
	});

	//-------------------------------------------------------------------
	
    //--------------------------------------------------------------------    
	//estilo z index para hacer visible el autocompletado
    $("#ui-id-1").attr('style', 'display: none; top: 365px; left: 407px; z-index: 2147483647; width: 443px;');
    //-------------------------------------------------------------------

});