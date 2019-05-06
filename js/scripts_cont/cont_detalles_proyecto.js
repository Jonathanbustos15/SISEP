$(function(){
	
	console.log("Js de proyecto.")
	//--------------------------------------
	tabs.nom_tab_default = "li_general";

	tabs.nombre_storage = "id_tab_proyecto";

	tabs.arr_no_permit = ["",null,"null"];

	tabs.setTabs()
	//--------------------------------------

	//---------------------------------------------------------------
   $("[name*='ver_archivos_asesoria']").click(function(event) {
        console.log($(this).data("id-registro"))

        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_asesoria` WHERE fkID_asesoria = "+$(this).data("id-registro"));

        carga_archivos.load()
    });
   //---------------------------------------------------------------
  

	//--------------------------------------
	//crear link para responder pregunta desde
	//el detalle del proyecto.
	$("[name*='btn_bitacora']").attr({
		class: 'btn btn-primary',
		title: 'Responder Bitácora'
	}).append(
		'<span class="glyphicon glyphicon-circle-arrow-right"></span>'
	).click(function(event) {
		//console.log("Click al responder")
		location.href = "respuestas_b.php"+location.search
	});
	//--------------------------------------
		
	//--------------------------------------
	//usetear id_tab_respuesta_b
	sessionStorage.setItem("id_tab_respuesta_b",null);
	//--------------------------------------
});