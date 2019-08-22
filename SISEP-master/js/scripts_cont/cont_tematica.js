$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevoTematica").jquery_controllerV2({
	 	nom_modulo:'tematica',
      	titulo_label:'Nueva Temática',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(ajustes){
        	console.log('Ejecutando despues de todo...');

        //console.log(ajustes);
        //destruye_cambia_pass();
      	},

	 });

	 
	 $("#btn_actiontematica").jquery_controllerV2({
	 	    tipo:'inserta/edita',
      	nom_modulo:'tematica',
      	nom_tabla:'tematica',
        recarga : false,
        validarCampo:true,           
        nom_campo:'nombre',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data); 

          carga_tematicas_select()

          $("#frm_modal_tematica").modal('hide');

          carga_select_id = data[0].last_id;
    
      	}           
	 });
	 
	 $("[name*='edita_tematica']").jquery_controllerV2({
	 	tipo:'carga_editar',
      	nom_modulo:'tematica',
      	nom_tabla:'tematica',
      	titulo_label:'Editar Temática',
      	tipo_load:1,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
       // crea_cambia_pass();
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
        
        	id_tematica = data.mensaje[0].pkID

      	}
	 });

	 $("[name*='elimina_lugarA']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'lugarA',
  		nom_tabla:'lugar_apropiacion',
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes);  			
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);  		
  		}
	 });


 //Oculta frm apropiación social
   $("#btn_nuevoTematica").click(function(){
        $("#frm_modal_apropiacionS").modal('hide'); 
   });


   

   $("#frm_modal_tematica").on('hidden.bs.modal', function () {
    //console.log('esconde el modal de tematica')
      $("#frm_modal_apropiacionS").modal('show');
      //--------------------------------------
   
  }); 

  var carga_select_id = 0;

  function carga_tematicas_select(){

        var proyectoM = leerCookie("id_proyectoM");

        var consulta_tematicas = "select * FROM tematica where fkID_proyectoM = "+proyectoM+" order by nombre";
        //---------------------------------------------------------------
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query="+consulta_tematicas+"&tipo=consulta_gen"
        })
        .done(function(data) {
            /**/
            $("#fkID_tematica").html('')
            console.log(data)
            if(data.estado == "ok"){
              var itera = $.each(data.mensaje, function(index, val) {
                 /* iterate through array or object */
                  console.log(index+"--"+val)
                  console.log(val)

                  $("#fkID_tematica").append('<option value="'+val.pkID+'">'+val.nombre+'</option>')               
              });

           
              $.when(itera).then(function(){
                if (carga_select_id != 0) {
                  $("#fkID_tematica").val(carga_select_id);
                }
              });
          }else{}
          
            //$( "#fkID_categoria" ).load( "formatos.php option");
          
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        //---------------------------------------------------------------
    }

    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    //complemento validar el nombre de la tematica
    //self.validaCampoLike = function(nom_campo,nom_tabla,selector_input,selector_form,selector_btn_action)
    self.validacion = new validaCampoLike('nombre','tematica','nombre','form_tematica','btn_actiontematica');

    $("#form_tematica #nombre").keyup(function(e) {
      validacion.validar()
    });
    //-------------------------------------------------------------------------

        
    //ejecucion-------------------------------------------------------------------------------------------------------------
    $("#fkID_tematica").focus(function(event) {
        /* Act on the event */
        console.log('cargando datos...')
        carga_tematicas_select()
    });

    carga_tematicas_select()

	//---------------------------------------------------------
});