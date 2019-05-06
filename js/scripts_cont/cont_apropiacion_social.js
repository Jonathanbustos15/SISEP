$(function(){


  $("#btn_nuevoApropiacionS").jquery_controllerV2({
      nom_modulo:'apropiacionS',
      titulo_label:'Nueva Apropiación Social',
      functionBefore:function(ajustes){
        console.log('Ejecutando antes de todo...');
        console.log(ajustes);
        upload.functionReset()
        //$("#btn_actionusuario").html("Esto es antes...")
        $("#chk_puntaje").click(function(event) {
          console.log($(this)[0]["checked"]);
          chk_rec($(this)[0]["checked"]);         
        });
      },
      functionAfter:function(ajustes){
        console.log('Ejecutando despues de todo...');
        //console.log(ajustes);
        //destruye_cambia_pass();
      }
    });

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $("#chk_puntaje").click(function(event) {

        if(document.getElementById("chk_puntaje").checked) {
            document.getElementById('chk_puntaje_hidden').disabled = true;
        }else{
          document.getElementById('chk_puntaje_hidden').disabled = false;
        }

    });  

    function chk_rec(tipo){

        if (tipo == true) {
            $("#chk_puntaje").val('1');
        } else{
            $("#chk_puntaje").val('0');
        };
    }


    $("#btn_actionapropiacionS").jquery_controllerV2({
      tipo:'inserta/edita',
      nom_modulo:'apropiacionS',
      nom_tabla:'apropiacion_social',
      recarga : false,
      auditar:true,
      functionAfter:function(data){

        console.log(data)

        var accion = $("#btn_actionapropiacionS").attr("data-action")        

        if (accion == "crear") {

            var id_last_apropiacionS = data[0].last_id;
            //------------------------------------
            //"url="+val.name+"&nombre="+self.archCoincide+"&fkID_docente="+id_last_usuario
            if (upload.arregloDeArchivos.length > 0) {
                $('#fileuploadAS').fileupload('send', {files:upload.arregloDeArchivos})
                .success(function (result, textStatus, jqXHR) {                             
                    upload.functionSend(id_last_apropiacionS,result);
                });
            }else{
                location.reload()
            }

        }else{
          //cargar al editar y el last id???
          //console.log(upload.arregloDeArchivos.length)

          if (upload.arregloDeArchivos.length > 0) {

            $('#fileuploadAS').fileupload('send', {files:upload.arregloDeArchivos})
              .success(function (result, textStatus, jqXHR) {           
              upload.functionSend($("#pkID").val(),result);
              });

          }else{
            location.reload()
          }
          
        }                 

      }
    });


    $("[name*='edita_apropiacionS']").jquery_controllerV2({
      tipo:'carga_editar',
      nom_modulo:'apropiacionS',
      nom_tabla:'apropiacion_social',
      titulo_label:'Editar Apropiación Social',
      tipo_load:2,
      functionAfter:function(data){
        console.log('Ejecutando despues de todo...');
        console.log(data);
        
        id_apropiacionS = data.mensaje[0].pkID;

        var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+id_apropiacionS;

        upload.functionLoad(query_docs);    

        $("#chk_puntaje").click(function(event) {
          console.log($(this)[0]["checked"]);
          chk_rec($(this)[0]["checked"]);         
        });

        //---------------------------------------       
        if (data.mensaje[0].puntaje == "1") {
            $("#chk_puntaje")[0]["checked"] = true;
            chk_rec(true)
        } else{
            $("#chk_puntaje")[0]["checked"] = false;
            chk_rec(false)
        };
        //console.log(data.mensaje[0].puntaje)
        //---------------------------------------
      }
    });

    $("[name*='elimina_apropiacionS']").jquery_controllerV2({
      tipo:'eliminar',
      nom_modulo:'apropiacionS',
      nom_tabla:'apropiacion_social',
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


    $("[name*='ver_archivos_apropiacionS']").click(function(event) {
        console.log($(this).data("id-registro"))

        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro"));

        carga_archivos.load()
    });
    
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  self.upload = new funcionesUpload("btn_actionapropiacionS","res_form","not_documentos","documentos_apropiacionS","fkID_apropiacionS")

  //console.log(upload)

  $('#fileuploadAS').fileupload({
        dataType: 'json',
        add: function (e, data) {   

          upload.functionAdd(data)
                  
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });

  //---

    
    //-------------------------------------------------------------------------

    var options_format = {
		symbol : "$",
		decimal : ",",
		thousand: ".",
		precision : 0,
		format: "%s%v"
	};
    //---------------------------------------------------------------
	//inicializacion del plugin de fecha datetimepicker

	//calendario para la fecha de inicio
	$( "#fecha_inicial" ).datepicker({
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_final" ).datepicker( "option", "minDate", selectedDate );
	      }			
	});
	//calendario para la fecha de inicio
	$( "#fecha_final" ).datepicker({
		dateFormat: "yy-mm-dd"			
	});	




  

  $("#form_apropiacionS #num_total_estudiantes").keyup(function (e) {

      var estudiantes = $("#form_apropiacionS #num_total_estudiantes").val();
      var docentes = $("#form_apropiacionS #num_docentes").val();
      var otros = $("#form_apropiacionS #otros_participantes").val();
      var estdoc = parseInt(estudiantes) + parseInt(docentes);
      var estotr = parseInt(estudiantes) + parseInt(otros);
      var docotr = parseInt(docentes) + parseInt(otros);
      var totalparticipantes = parseInt(estudiantes) + parseInt(docentes) + parseInt(otros);

      if(((docentes != "")&&(estudiantes != "")&&(otros!=""))){
        $("#form_apropiacionS #num_total_participantes").val(totalparticipantes);
      }else{
          if((docentes != "")&&(estudiantes != "")&&(otros=="")){
            $("#form_apropiacionS #num_total_participantes").val(estdoc);
          }else{
              if((docentes != "")&&(estudiantes == "")&&(otros != "")){
                $("#form_apropiacionS #num_total_participantes").val(docotr);
              }else{
                 if((docentes == "")&&(estudiantes != "")&&(otros != "")){
                    $("#form_apropiacionS #num_total_participantes").val(estotr);
                 }else{
                    if((docentes != "")&&(estudiantes == "")&&(otros == "")){
                      $("#form_apropiacionS #num_total_participantes").val(docentes);
                    }else{
                       if((docentes == "")&&(estudiantes != "")&&(otros == "")){
                          $("#form_apropiacionS #num_total_participantes").val(estudiantes);
                       }else{
                          if((docentes == "")&&(estudiantes == "")&&(otros != "")){
                            $("#form_apropiacionS #num_total_participantes").val(otros);
                          }
                       }
                    }
                  }
              } 
          } 
      }
  });


   $("#form_apropiacionS #num_docentes").keyup(function (e) {

    var estudiantes = $("#form_apropiacionS #num_total_estudiantes").val();
    var docentes = $("#form_apropiacionS #num_docentes").val();
    var otros = $("#form_apropiacionS #otros_participantes").val();
    var estdoc = parseInt(estudiantes) + parseInt(docentes);
    var estotr = parseInt(estudiantes) + parseInt(otros);
    var docotr = parseInt(docentes) + parseInt(otros);
    var totalparticipantes = parseInt(estudiantes) + parseInt(docentes) + parseInt(otros);

    if(((docentes != "")&&(estudiantes != "")&&(otros!=""))){
        $("#form_apropiacionS #num_total_participantes").val(totalparticipantes);
    }else{
        if((docentes != "")&&(estudiantes != "")&&(otros=="")){
          $("#form_apropiacionS #num_total_participantes").val(estdoc);
        }else{
           if((docentes != "")&&(estudiantes == "")&&(otros != "")){
             $("#form_apropiacionS #num_total_participantes").val(docotr);
           }else{
              if((docentes == "")&&(estudiantes != "")&&(otros != "")){
                $("#form_apropiacionS #num_total_participantes").val(estotr);
              }else{
                 if((docentes != "")&&(estudiantes == "")&&(otros == "")){
                    $("#form_apropiacionS #num_total_participantes").val(docentes);
                 }else{
                    if((docentes == "")&&(estudiantes != "")&&(otros == "")){
                      $("#form_apropiacionS #num_total_participantes").val(estudiantes);
                    }else{
                       if((docentes == "")&&(estudiantes == "")&&(otros != "")){
                          $("#form_apropiacionS #num_total_participantes").val(otros);
                       }
                    }
                 }
              }
            } 
        } 
    }
  });



   $("#form_apropiacionS #otros_participantes").keyup(function (e) {
      var estudiantes = $("#form_apropiacionS #num_total_estudiantes").val();
      var docentes = $("#form_apropiacionS #num_docentes").val();
      var otros = $("#form_apropiacionS #otros_participantes").val();
      var estdoc = parseInt(estudiantes) + parseInt(docentes);
      var estotr = parseInt(estudiantes) + parseInt(otros);
      var docotr = parseInt(docentes) + parseInt(otros);
      var totalparticipantes = parseInt(estudiantes) + parseInt(docentes) + parseInt(otros);

      if(((docentes != "")&&(estudiantes != "")&&(otros!=""))){
        $("#form_apropiacionS #num_total_participantes").val(totalparticipantes);
      }else{
         if((docentes != "")&&(estudiantes != "")&&(otros=="")){
          $("#form_apropiacionS #num_total_participantes").val(estdoc);
         }else{
           if((docentes != "")&&(estudiantes == "")&&(otros != "")){
            $("#form_apropiacionS #num_total_participantes").val(docotr);
           }else{
              if((docentes == "")&&(estudiantes != "")&&(otros != "")){
                $("#form_apropiacionS #num_total_participantes").val(estotr);
              }else{
                 if((docentes != "")&&(estudiantes == "")&&(otros == "")){
                   $("#form_apropiacionS #num_total_participantes").val(docentes);
                 }else{
                    if((docentes == "")&&(estudiantes != "")&&(otros == "")){
                      $("#form_apropiacionS #num_total_participantes").val(estudiantes);
                    }else{
                       if((docentes == "")&&(estudiantes == "")&&(otros != "")){
                        $("#form_apropiacionS #num_total_participantes").val(otros);
                       }
                    }
                 }
              }
            } 
          }    
      }
  });


 

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //validaciones con plugin overlooker

$("#form_apropiacionS").overlooker({
    validations:[     
        {
            id : "num_total_estudiantes",
            expresion : "solo_numeros",
            evento : "change"
        },        
        {
            id : "num_docentes",
            expresion : "solo_numeros",
            evento : "change"
        },       
        {
            id : "otros_participantes",
            expresion : "solo_numeros",
            evento : "change"
        }
    ],
})
//---------------------------------------------------
	//---------------------------------------------------------------  
  
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
      window.location.href = $(this).attr('href');
    });

  //
    sessionStorage.setItem("id_tab_apropiacionS",null);
  //---------------------------------------------------------

    
});