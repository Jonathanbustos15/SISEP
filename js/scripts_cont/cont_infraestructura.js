$(function(){
   
   //https://github.com/jsmorales/jquery_controllerV2
   
   $("#btn_nuevoinfraestructura").jquery_controllerV2({
      nom_modulo:'infraestructura',
      titulo_label:'Nueva Infraestructura',
      functionBefore:function(){
        upload.functionReset()     
      },
      functionAfter:function(){       
      }
   });
   
   $("#btn_actioninfraestructura").jquery_controllerV2({
      tipo:'inserta/edita',     
      nom_modulo:'infraestructura',
      nom_tabla:'infraestructura',        
      recarga : false,
      auditar:true,
      functionAfter:function(data){

        console.log(data)

        var accion = $("#btn_actioninfraestructura").attr("data-action")

        if (accion == "crear") {

            var id_last_infraestructura = data[0].last_id;
            //------------------------------------
            if (upload.arregloDeArchivos.length > 0) {

                $('#fileuploadI').fileupload('send', {files:upload.arregloDeArchivos})
                .success(function (result, textStatus, jqXHR) {
                    upload.functionSend(id_last_infraestructura,result);
                });

            }else{
                location.reload()
            }   

        }else{
          //cargar al editar y el last id???
          //console.log(upload.arregloDeArchivos.length)

          if (upload.arregloDeArchivos.length > 0) {

            $('#fileuploadI').fileupload('send', {files:upload.arregloDeArchivos})
              .success(function (result, textStatus, jqXHR) {           
              upload.functionSend($("#pkID").val(),result);
              });

          }else{
            location.reload()
          }
          
        }         

      }
   });


  
   
   $("[name*='edita_infraestructura']").jquery_controllerV2({
    tipo:'carga_editar',
      nom_modulo:'infraestructura',
      nom_tabla:'infraestructura',
      titulo_label:'Edita Infraestructura',
      functionAfter:function(data){
        console.log('Ejecutando despues de todo...');
        console.log(data);

          id_infraestructura = data.mensaje[0].pkID

          var query_docs = "SELECT * FROM `documentos_infraestructura` WHERE fkID_infraestructura = "+id_infraestructura;

          upload.functionLoad(query_docs);    
          
      }
   });
   
   $("[name*='elimina_infraestructura']").jquery_controllerV2({
    tipo:'eliminar',
      nom_modulo:'infraestructura',
      nom_tabla:'infraestructura',
      auditar:true
   });


   $( "#fecha_entrega" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true     
  });

   $("[name*='ver_archivos_infraestructura']").click(function(event) {
        console.log($(this).data("id-registro"))

        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_infraestructura` WHERE fkID_infraestructura = "+$(this).data("id-registro"));

        carga_archivos.load()
    });

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  var upload = new funcionesUpload("btn_actioninfraestructura","res_form","not_documentos","documentos_infraestructura","fkID_infraestructura")

  //console.log(upload)

  $('#fileuploadI').fileupload({
        dataType: 'json',
        add: function (e, data) {   

          upload.functionAdd(data)
                  
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });

  //---------------------------------------------------------

  //
 sessionStorage.setItem("id_tab_infraestructura",null);
  //---------------------------------------------------------

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //click al detalle en cada fila----------------------------
  /*  $('.table').on( 'click', '.detail', function () {
        window.location.href = $(this).attr('href');
    });
 */
});
