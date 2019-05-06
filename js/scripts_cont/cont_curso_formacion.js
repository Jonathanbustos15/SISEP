$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 //console.log(date)
	 
	 $("#btn_nuevocursof").jquery_controllerV2({
	 	nom_modulo:'cursof',
  		titulo_label:'Nuevo Curso de Formación',
  		functionBefore:function(ajustes){
  			//funciones de novedades  				
  			//novedades.hideParent(true)
  			//---------------------------
  		}
	 });
	 
	 $("#btn_actioncursof").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'cursof',
	    nom_tabla:'curso_formacion',	  
	    recarga : false,
      auditar:true,
	    functionBefore:function(ajustes){
	    	//novedades.newOwner(ajustes.action)
	    },
	    functionAfter:function(data,ajustes){
			console.log('Ejecutando despues de todo...');
        	console.log(data);
            console.log(ajustes);
            //dbGen.db_general
            if (ajustes.action == "crear") {
                
                //(tabla_aux,nom_id_ini,id_ini,reload)
                
                var cursosF_proyectoM = new ins_proyectoM("cursosF_proyectoM","fkID_cursosF",data[0].last_id,true);

                cursosF_proyectoM.insProyM();
                
            }else{
                location.reload();
            }            
      	}          
	 });

	 
	 $("[name*='edita_cursof']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'cursof',
  		nom_tabla:'curso_formacion',
  		titulo_label:'Edita curso de formación',
  		tipo_load:1,
  		functionBefore:function(ajustes){
  			//-----------------------------------------------------
	    	//novedades.hideParent(false)
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);

        	id_cursof = data.mensaje[0].pkID
        	
  		}
	 });
	 
	 $("[name*='elimina_cursof']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'cursof',
  		nom_tabla:'curso_formacion',
        //recarga:false,
      auditar:true,
	 });
	 

	//
	sessionStorage.setItem("id_tab_cursof",null);
	//---------------------------------------------------------

	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //click al detalle en cada fila----------------------------
    /*
    $('.table').on( 'click', '.detail', function () {
        window.location.href = $(this).attr('href');
    });*/
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
});
