$(function(){
   var x = location.search;

   console.log(x);
   //slice.(14) -- devuelve el valor de la cadena x, despues de la posicion 14 que es el signo =
   var id_indicador = x.slice(14);

   console.log(id_indicador);

   //https://github.com/jsmorales/jquery_controllerV2

   //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
   
   $("#btn_nuevometa").jquery_controllerV2({
    nom_modulo:'meta',
      titulo_label:'Nueva Meta',
      functionBefore:function(){
        
      },
      functionAfter:function(){
        
        //-------------------------------------       
      }
   });
   
   $("#btn_actionmeta").jquery_controllerV2({
    tipo:'inserta/edita',     
      nom_modulo:'meta',
      nom_tabla:'meta',
      auditar:true,    
      //recarga : false,
      functionBefore:function(ajustes){
      //-----------------------------------------------------
        console.log(ajustes)        
      },
      functionAfter:function(data,ajustes){

        console.log('Ejecutando despues de todo...');
        console.log(ajustes);

        if(ajustes.action == "crear"){

          id_meta = data[0].last_id;

          if (data[0].estado == "ok") {
            updateIndicador(id_meta,id_indicador)
          }                  
        }

      }
   });

   
   $("[name*='edita_meta']").jquery_controllerV2({
      tipo:'carga_editar',
      nom_modulo:'meta',
      nom_tabla:'meta',
      titulo_label:'Edita Meta',
      tipo_load:1,
      functionBefore:function(ajustes){
        //-----------------------------------------------------
        
      },
      functionAfter:function(data){
        console.log('Ejecutando despues de todo...');
        console.log(data);
        id_meta = data.mensaje[0].pkID
          
      }
   });

   function updateIndicador(meta, indicador){

      var query = " UPDATE `indicador` SET indicador.fkID_meta = "+meta+" WHERE indicador.pkID = "+indicador;

      console.log(query);
/**/
    $.ajax({
      async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });


   }
   
   $("[name*='eliminar_meta']").jquery_controllerV2({
    tipo:'eliminar',
      nom_modulo:'meta',
      nom_tabla:'meta',
      recarga: false,
      auditar:true,
      functionBefore:function(ajustes){
        //-----------------------------------------------------
        console.log(ajustes.id)

        id_meta = ajustes.id;
      },
      functionAfter:function(data){
        console.log(data)

        if (data.estado == "ok") {
          eliminaMetaIndicador(id_meta);
          eliminaMetaMV(id_meta);
          eliminaValor()
        }           
      }
   });


//---------Función para actualizar el campo fkID_meta de la tabla indicador, esta función se ejecuta despues de haber eliminado la tabla meta. 
   function eliminaMetaIndicador(meta){

    var query = " UPDATE `indicador` SET fkID_meta = null WHERE fkID_meta ="+meta;

    $.ajax({
      async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });
   }

//----Función para elimina los registros de la tabla meta_valor, esta función se ejecuta despues de haber eliminado la meta asociada a esa tabla.
   function eliminaMetaMV(meta){

    var query = "DELETE FROM `meta_valor` WHERE fkID_meta = "+meta;

    $.ajax({
      async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });
   }
   
  //---------------------------------------------------------
    function eliminaValor(){

      var query = "DELETE FROM valores_meta WHERE valores_meta.pkID NOT IN (select meta_valor.fkID_valor_meta FROM meta_valor)";
  
      $.ajax({
      async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });
    }


  //validaciones con plugin overlooker

$("#form_meta").overlooker({
    validations:[
        {
            id : "total",
            expresion : "solo_numeros",
            evento : "change"
        }
    ],
})
//--------------------------------



  /**/

  //calendario para la fecha de inicio
  $( "#fecha_ini" ).datepicker({
    dateFormat: "yy-mm-dd",
    onClose: function( selectedDate ) {
          $( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );
        }     
  });
  //calendario para la fecha de inicio
  $( "#fecha_fin" ).datepicker({
    dateFormat: "yy-mm-dd"      
  }); 
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //click al detalle en cada fila----------------------------
    /*$('.table').on( 'click', '.detail', function () {
      window.location.href = $(this).attr('href');
    });
*/
  //
   // sessionStorage.setItem("id_tab_meta",null);
  //--------------------------------------------------------
  //--------------------------------------

    
    //-------------------------------------------------------------------------
    
});


