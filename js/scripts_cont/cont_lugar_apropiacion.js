$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevoLugarA").jquery_controllerV2({
	 	    nom_modulo:'lugarA',
      	titulo_label:'Nuevo Lugar',
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

	 
	 $("#btn_actionlugarA").jquery_controllerV2({
	 	    tipo:'inserta/edita',
      	nom_modulo:'lugarA',
      	nom_tabla:'lugar_apropiacion',
        recarga : false,
      //cambiando el tipo de ajax para poder crear el usuario
      //con la contraseña encriptada.
      /*tipo_ajax : {
        crear : "inserta_registro",
        editar : "actualizar"
      },*/
      //recarga:false,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(data,ajustes){
        	console.log('Ejecutando despues de todo...');
        	console.log(data[0].last_id);
          //console.log(ajustes);
             //Oculta frm lugar de apropiación despues de insertar
             //$("#frm_modal_lugarA").modal('hide');
             //carga los lugares nuevos
             //setea el select con el valor last_id
             carga_lugar_select()
             
             $("#frm_modal_lugarA").modal('hide');

             carga_select_id = data[0].last_id;
      	}           
	 });
	 
	 $("[name*='edita_lugarA']").jquery_controllerV2({
	 	    tipo:'carga_editar',
      	nom_modulo:'lugarA',
      	nom_tabla:'lugar_apropiacion',
      	titulo_label:'Editar Lugar',
      	tipo_load:1,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
       // crea_cambia_pass();
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
        
        	id_lugarA = data.mensaje[0].pkID

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
   $("#btn_nuevoLugarA").click(function(){
        $("#frm_modal_apropiacionS").modal('hide'); 
   });


   

   $("#frm_modal_lugarA").on('hidden.bs.modal', function () {
    //console.log('esconde el modal de lugar')
      $("#frm_modal_apropiacionS").modal('show');
      //--------------------------------------
   
  }); 

   var carga_select_id = 0;

   function carga_lugar_select(){

        var proyectoM = leerCookie("id_proyectoM");

        var consulta_lugares = "select * FROM lugar_apropiacion WHERE lugar_apropiacion.fkID_proyectoM = "+proyectoM+" order by nombre";
        //---------------------------------------------------------------
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query="+consulta_lugares+"&tipo=consulta_gen"
        })
        .done(function(data) {
            /**/
            $("#fkID_lugar").html('')
            console.log(data)

            if(data.estado == "ok"){
                
              var itera = $.each(data.mensaje, function(index, val) {
                 /* iterate through array or object */
                  console.log(index+"--"+val)
                  console.log(val)

                  $("#fkID_lugar").append('<option value="'+val.pkID+'">'+val.nombre+'</option>')               
              });
           
        
              $.when(itera).then(function(){
                if (carga_select_id != 0) {
                  $("#fkID_lugar").val(carga_select_id);
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


    //---------------------------------------------------------------------------------------------------------------
    function validarTelefono(telefono){
 
    //if(formulario.telefono.value.length>2) { //comprueba que no esté vacío
      //formulario.telefono.val('');
    valor = /^\d{5,15}$/;
    if( !valor.test(telefono) ) {
      alert("Error : El numero de teléfono "+ telefono +" es incorrecto. ");
       $("#form_lugarA #telefono").val('');
       $("#form_lugarA #telefono").focus();
    return false;
    }else{
      return true;
    } 

  }

  $("#form_lugarA #telefono").change(function(event) {
    /* Act on the event */
      validarTelefono( $(this).val() )
  });
    
    //ejecucion-------------------------------------------------------------------------------------------------------------
    
    $("#fkID_lugar").focus(function(event) {
        /* Act on the event */
        console.log('cargando datos...')
        carga_lugar_select()
    });

    carga_lugar_select()

	//---------------------------------------------------------
});
