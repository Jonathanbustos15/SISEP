$(function(){
   
   //https://github.com/jsmorales/jquery_controllerV2
   
   $("#btn_nuevoPrueba").jquery_controllerV2({
    nom_modulo:'prueba',
      titulo_label:'Nueva Prueba',
      functionBefore:function(){
         upload.functionReset()  
        
      },
      functionAfter:function(){
        
        //-------------------------------------       
      }
   });
   
   $("#btn_actionprueba").jquery_controllerV2({
    tipo:'inserta/edita',     
      nom_modulo:'prueba',
      nom_tabla:'prueba',    
      recarga : false,
      auditar:true,
      functionAfter:function(data){

        console.log(data)

        var accion = $("#btn_actionprueba").attr("data-action")      

        if (accion == "crear") {

            var id_last_prueba = data[0].last_id;
            //------------------------------------
            //"url="+val.name+"&nombre="+self.archCoincide+"&fkID_docente="+id_last_usuario
            if (upload.arregloDeArchivos.length > 0) {
                $('#fileuploadPR').fileupload('send', {files:upload.arregloDeArchivos})
                .success(function (result, textStatus, jqXHR) {                        
                    upload.functionSend(id_last_prueba,result);
                });
            }else{
                location.reload()
            }
            
        }else{
          //cargar al editar y el last id???
          //console.log(upload.arregloDeArchivos.length)

          if (upload.arregloDeArchivos.length > 0) {

            $('#fileuploadPR').fileupload('send', {files:upload.arregloDeArchivos})
              .success(function (result, textStatus, jqXHR) {           
              upload.functionSend($("#pkID").val(),result);
              });

          }else{
            location.reload()
          }
          
        }         

      }
   });

   
   $("[name*='edita_prueba']").jquery_controllerV2({
    tipo:'carga_editar',
      nom_modulo:'prueba',
      nom_tabla:'prueba',
      titulo_label:'Edita Prueba',
      functionAfter:function(data){
        console.log('Ejecutando despues de todo...');
        console.log(data);

          id_prueba = data.mensaje[0].pkID

          var query_docs = "SELECT * FROM `documentos_prueba` WHERE fkID_prueba = "+id_prueba;

          upload.functionLoad(query_docs);    
          
      }
   });
   
   $("[name*='elimina_prueba']").jquery_controllerV2({
    tipo:'eliminar',
      nom_modulo:'prueba',
      nom_tabla:'prueba',
      auditar:true
   });

   $("[name*='ver_archivos_prueba']").click(function(event) {
        console.log($(this).data("id-registro"))

        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_prueba` WHERE fkID_prueba = "+$(this).data("id-registro"));

        carga_archivos.load()
    });
   
  //---------------------------------------------------------

  //---------------------------------------------------------
  $( "#fecha_creacion" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true,      
  });
    

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  var upload = new funcionesUpload("btn_actionprueba","res_form","not_documentos","documentos_prueba","fkID_prueba")

  //console.log(upload)

  $('#fileuploadPR').fileupload({
        dataType: 'json',
        add: function (e, data) {   

          upload.functionAdd(data)
                  
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });

  //---------------------------------------------------------

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
      window.location.href = $(this).attr('href');
    });

  //
    sessionStorage.setItem("id_tab_prueba",null);
  //---------------------------------------------------------

  //--------------------------------------
  //crear link para responder pregunta desde
  //el detalle del proyecto.
  /**/
  $("[name*='btn_ir_prueba']").click(function(event) {
    console.log($(this).data('id-prueba'))
    location.href = "respuesta_p.php?id_prueba="+$(this).data('id-prueba');
  });
  //--------------------------------------
    
  //--------------------------------------
  //usetear id_tab_respuesta_b
  sessionStorage.setItem("id_tab_respuesta_p",null);
  //--------------------------------------

    
    //-------------------------------------------------------------------------
    
});