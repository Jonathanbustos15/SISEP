$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevosede").jquery_controllerV2({
	 	nom_modulo:'sede',
      	titulo_label:'Nueva Sede',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(ajustes){
        	console.log('Ejecutando despues de todo...');
        //console.log(ajustes);
        //destruye_cambia_pass();
      	}
	 });
	 
	 $("#btn_actionsede").jquery_controllerV2({
	 	tipo:'inserta/edita',
      	nom_modulo:'sede',
      	nom_tabla:'sede',
        auditar:true,
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
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);      
      	}           
	 });
	 
	 $("[name*='edita_sede']").jquery_controllerV2({
	 	tipo:'carga_editar',
      	nom_modulo:'sede',
      	nom_tabla:'sede',
      	titulo_label:'Editar Sede',
      	tipo_load:2,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
       // crea_cambia_pass();
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
        
        	id_sede = data.mensaje[0].pkID

      	}
	 });

	 $("[name*='elimina_sede']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'sede',
  		nom_tabla:'sede',
      auditar:true,
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes);  			
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);  		
  		}
	 });


  //validaciones con plugin overlooker

  $("#form_sede").overlooker({
    validations:[
        {
            id : "email",
            expresion : "email",
            evento : "change"
        },                
        {
            id : "telefono",
            expresion : "telefono",
            evento : "change"
        }
    ],
  });
//---------------
    
  //
  sessionStorage.setItem("id_tab_sede",null);
  //---------------------------------------------------------

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //click al detalle en cada fila----------------------------
    //$('.table').on( 'click', '.detail', function () {
      //  window.location.href = $(this).attr('href');
    //});
});
