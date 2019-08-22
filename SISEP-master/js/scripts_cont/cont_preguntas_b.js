$(function(){


  $("#btn_nuevoPreguntab").jquery_controllerV2({
      nom_modulo:'preguntab',
      titulo_label:'Nueva Pregunta',
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


    $("#btn_actionpreguntab").jquery_controllerV2({
      tipo:'inserta/edita',
      nom_modulo:'preguntab',
      nom_tabla:'preguntas_b',
      //cambiando el tipo de ajax para poder crear el usuario
      //con la contraseña encriptada.
      /*tipo_ajax : {
        crear : "inserta_registro",
        editar : "actualizar"
      },*/
      //recarga:false,
      auditar:true,
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


    $("[name*='edita_preguntab']").jquery_controllerV2({
      tipo:'carga_editar',
      nom_modulo:'preguntab',
      nom_tabla:'preguntas_b',
      titulo_label:'Editar Pregunta',
      tipo_load:1,
      functionBefore:function(ajustes){
        console.log('Ejecutando antes de todo...');
        console.log(ajustes);
       // crea_cambia_pass();
      },
      functionAfter:function(data){
        console.log('Ejecutando despues de todo...');
        console.log(data);
        
        id_preguntab = data.mensaje[0].pkID

      }
    }); 

    $("[name*='elimina_preguntab']").jquery_controllerV2({
      tipo:'eliminar',
      nom_modulo:'preguntab',
      nom_tabla:'preguntas_b',
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

    //+++++++++++++++++++++++++++++++++++++++

    sessionStorage.setItem("id_tab_preguntab",null);
    //-------------------------------------------------------------------------
    
});