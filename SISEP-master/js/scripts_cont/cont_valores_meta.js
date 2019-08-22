$(function(){

   //var x = location.search;

   ///var id_indicador = x.slice(-1);

   //https://github.com/jsmorales/jquery_controllerV2

    //calendario para la fecha de inicio
  $( "#fecha_iniM" ).datepicker({
    dateFormat: "yy-mm-dd",
    onClose: function( selectedDate ) {
          $( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );
        }     
  });
  //calendario para la fecha de inicio
  $( "#fecha_finM" ).datepicker({
    dateFormat: "yy-mm-dd"      
  }); 

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 

   $("#btn_valoresM").jquery_controllerV2({
      nom_modulo:'valoresM',
      titulo_label:'Nuevo valor'
   });
  

   $("#btn_actionvaloresM").jquery_controllerV2({
      tipo:'inserta/edita',     
      nom_modulo:'valoresM',
      nom_tabla:'valores_meta', 
      auditar:true,
      functionBefore:function(ajustes){
        if($("#script").val() == ""){
              alert("Por favor escriba una consulta sql en el campo script");
              //$("#btn_actionindicador").attr('disabled', 'disabled');
        }else{    
            $("#script").val(crypt.encripta($("#script").val()));
            //$("#btn_actionindicador").removeAttr('disabled', 'disabled');
        }  
      },
      functionAfter:function(data,ajustes){

        console.log('Ejecutando despues de todo...');
        console.log(ajustes);

        if(ajustes.action == "crear"){

          id_valoresM = data[0].last_id;

          if (data[0].estado == "ok") {
            insertMetaValor($('#meta').val(), id_valoresM)
          }                  
        }

      }   
   });



//Función para insertar en la tabla auxiliar meta_valor, despues de insertar en la tabla valores_meta
   function insertMetaValor(meta, valor){

      var query = " INSERT INTO `meta_valor` VALUES (NULL, "+meta+", "+valor+")";

      console.log(query);

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

   };


   $("[name*='edita_valoresM']").jquery_controllerV2({
      tipo:'carga_editar',
      nom_modulo:'valoresM',
      nom_tabla:'valores_meta',
      titulo_label:'Edita Valor',
      tipo_load:2,
      functionAfter:function(data,ajustes){
            //console.log(data)
          if($("#script").val() != ""){
            $("#script").val(crypt.desencripta(data.mensaje[0].script));
          }else{
            alert("Por favor escriba una consulta sql en el campo script");
          }
            
      }  
    });

   $("[name*='elimina_valoresM']").jquery_controllerV2({
      tipo:'eliminar',
      nom_modulo:'valoresM',
      nom_tabla:'valores_meta',
      auditar:true,
      functionBefore:function(ajustes){
        //-----------------------------------------------------
        console.log(ajustes.id)

        id_valoresM = ajustes.id;
      },
      functionAfter:function(data){
        console.log(data)

        if (data.estado == "ok") {
          eliminaValorMV(id_valoresM);
        }           
      }    
   });

   //----Función para elimina los registros de la tabla meta_valor, esta función se ejecuta despues de haber eliminado un valor asociada a esa tabla.
   function eliminaValorMV(valor){

    var query = "DELETE FROM `meta_valor` WHERE fkID_valor_meta = "+valor;

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
    //validaciones con plugin overlooker

  $("#form_valoresM").overlooker({
    validations:[
        {
            id : "valor",
            expresion : "solo_numeros",
            evento : "change"
        }
    ],
  })
//------
      
  
   
 

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //click al detalle en cada fila----------------------------
   /*$('.table').on( 'click', '.detail', function () {
      window.location.href = $(this).attr('href');
    });
*/
  //
   // sessionStorage.setItem("id_tab_valoresM",null);
  //--------------------------------------------------------
  //--------------------------------------

    
    //-------------------------------------------------------------------------
    
});


