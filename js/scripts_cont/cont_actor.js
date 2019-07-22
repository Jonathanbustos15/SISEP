$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevoActor").click(function(){
    $("#lbl_form_actor").html("Crear Actor");
        $("#lbl_btn_actionactor").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionactor").attr("data-action","crear");
        $("#btn_actionactor").removeAttr('disabled', 'disabled');
        $("#form_actor")[0].reset();
        $("#selectMunicipio").remove();
        $("#selectDepartamento").remove();
        $("#selectPais").remove();
	 });
	 
	 $("#btn_actionactor").jquery_controllerV2({
	 	tipo:'inserta/edita',
      	nom_modulo:'actor',
      	nom_tabla:'actor',
      //cambiando el tipo de ajax para poder crear el usuario
      //con la contraseña encriptada.
      /*tipo_ajax : {
        crear : "inserta_registro",
        editar : "actualizar"
      },*/
        recarga:false,
        auditar:true,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);  
          console.log(data)

        var accion = $("#btn_actionactor").attr("data-action")        

         if (accion == "crear") {

            var id_last_actor = data[0].last_id;
            //------------------------------------
            //"url="+val.name+"&nombre="+self.archCoincide+"&fkID_docente="+id_last_usuario
            if (upload.arregloDeArchivos.length > 0) {
                $('#fileuploadA').fileupload('send', {files:upload.arregloDeArchivos})
                .success(function (result, textStatus, jqXHR) {                            
                    upload.functionSend(id_last_actor,result);
                });
            }else{
                location.reload()
            } 

        }else{
          //cargar al editar y el last id???
          //console.log(upload.arregloDeArchivos.length)

          if (upload.arregloDeArchivos.length > 0) {

            $('#fileuploadA').fileupload('send', {files:upload.arregloDeArchivos})
              .success(function (result, textStatus, jqXHR) {           
              upload.functionSend($("#pkID").val(),result);
              });

          }else{
            location.reload()
          }
          
        }         

      }

        
	 });

   $("[name*='edita_actor']").click(function(event) {
      $("#lbl_form_actor").html("Editar Registro Actor");
        $("#lbl_btn_actionactor").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionactor").attr("data-action","editar");
        $("#btn_actionactor").removeAttr('disabled', 'disabled');
        $("#form_actor")[0].reset();
        id_actor = $(this).attr('data-id-actor');
        $("#btn_actionHvida").removeAttr('disabled');
        $("#selectMunicipio").remove();
        $("#selectDepartamento").remove();  
        $("#selectPais").remove();
        carga_actor(id_actor); 
        var ope = $("#fkID_tipo option:selected").val();
            console.log("aqui ta"+ope);
            var query_docs = "SELECT * FROM `documentos_actor` WHERE fkID_actor = "+id_actor;
          upload.functionLoad(query_docs); 
        cargar_ubicacion();
        carga_select(id_actor);
    });

	 $("[name*='elimina_actor']").click(function(event) {
        id_actor = $(this).attr('data-id-actor');
        elimina_actor(id_actor);
    });


   $("[name*='ver_archivos_actor']").click(function(event) {
        console.log($(this).data("id-registro"))        

        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_actor` WHERE fkID_actor = "+$(this).data("id-registro"));

        carga_archivos.load()
    });
	//---------------------------------------------------------
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  var upload = new funcionesUpload("btn_actionactor","res_form","not_documentos","documentos_actor","fkID_actor")

  //console.log(upload)

  $('#fileuploadA').fileupload({
        dataType: 'json',
        add: function (e, data) {   

          upload.functionAdd(data)
                  
        },
        done: function (e, data) {            
            console.log('Load finished.');            
        }
    });

  //---------------------------------------------------------

  $( "#fecha_socializacion" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true,      
  });

  $( "#fecha_vinculacion" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true,      
  });

  //------------------------------------
  //validaciones con plugin overlooker

$("#form_actor").overlooker({
    validations:[       
        {
            id : "telefono_contacto",
            expresion : "telefono",
            evento : "change"
        },
        {
            id : "email_contacto",
            expresion : "email",
            evento : "change"
        }
    ],
})
//------------------------
    

  sessionStorage.setItem("id_tab_actor",null);

  $(document).ready(function(){
        $("#fkID_tipo").change(function(){
            cargar_ubicacion();
        });
        });


  $(document).ready(function(){
        $("#fkID_municipio").change(function(){
            console.log("chavoo");
        });
        });


  function cargar_selectregional(){
      $("#selectMunicipio").remove();
      $("#selectDepartamento").remove();
      $("#selectPais").remove();
      $("#div_actor").append('<div class="form-group" id="selectMunicipio">'+
                        '<label for="fkID_municipio" class="control-label">Municipio</label>'+ 
                        '<select name="fkID_municipio" id="fkID_municipio" class="form-control" required = "true">'+
                            '</select>'+
                    '</div>')
    }

  function cargar_selectDepartamento(){
      $("#selectMunicipio").remove();
      $("#selectDepartamento").remove();
      $("#selectPais").remove();
      $("#div_actor").append('<div class="form-group" id="selectDepartamento">'+
                        '<label for="fkID_departamento" class="control-label">Departamento</label>'+ 
                        '<select class="form-control" id="fkID_departamento" name="fkID_departamento" required = "true">'+
                            '</select>'+
                    '</div>');
      $("#div_actor").append('<div class="form-group" id="selectMunicipio">'+
                        '<label for="fkID_municipio" class="control-label">Municipio</label>'+ 
                        '<select name="fkID_municipio" id="fkID_municipio" class="form-control" required ="true">'+
                              '<option value="" selected="selected">Elije la Ciudad</option>'+
                            '</select>'+
                    '</div>')
    }



    function cargar_selectpais(){
      $("#selectMunicipio").remove();
      $("#selectDepartamento").remove();
      $("#selectPais").remove();
      $("#div_actor").append('<div class="form-group" id="selectPais">'+
                        '<label for="fkID_pais" class="control-label">País</label>'+ 
                        '<select name="fkID_pais" id="fkID_pais" class="form-control" required ="true">'+
                            '</select>'+
                    '</div>')
    }

    function carga_actor(id_actor) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_actor + "&tipo=consultar&nom_tabla=actor",
        }).done(function(data) {
            /**/
            $.each(data.mensaje[0], function(key, valu) {
                $("#" + key).val(valu);
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function cargar_ubicacion(){
      var ope = $("#fkID_tipo option:selected").val();
            if (ope==1) {
                cargar_selectregional()
                completamunicipio();
            } else if (ope==2) { 
                cargar_selectDepartamento()
                completadepartamento()
            } else if (ope==3) { 
                console.log("Internacional");
                cargar_selectpais();
                completapais();
            } else {ope==""
                $("#selectMunicipio").remove();
                $("#selectDepartamento").remove();
                $("#selectPais").remove();
            }
          };

    function carga_select(id) {
      console.log(id)
        var ruta = "../controller/ajaxactor.php"; 
          $.ajax({
              url: ruta,
              type: 'POST',  
              data: {tipo: "consultarciudad2",id: id},
              success: function(data){
                console.log(data)
                  var cod = 0
                  var tipos = JSON.parse(data);
                        console.log(tipos[x])
                      if (tipos[0].fkID_pais != 0) {
                        $("#fkID_departamento option[value="+ tipos[0].fkID_pais+"]").attr("selected",true);
                      } if (tipos[0].fkID_departamento != 0) {
                        $("#fkID_departamento option[value="+ tipos[0].fkID_departamento+"]").attr("selected",true);
                        
                      }  if (tipos[0].fkID_municipio != 0 ) {
                        console.log("si llega")
                        $('#fkID_municipio').append('<option value='+tipos[0].fkID_municipio+' selected="selected">'+tipos[0].nombre+'</option>');
                      } 
              }
          }) 
    };

    function cargar_selectmunicipio(valu){
      $("#fkID_municipio option[value="+ valu +"]").attr("selected",true);

      console.log("este es "+valu);

    }

    function completamunicipio(){
    var ruta = "../controller/ajaxactor.php"; 
          $.ajax({
              url: ruta,
              type: 'POST',  
              data: {tipo: "consultarmunicipio"},
              success: function(data){
                  //convierte la cadena que se recibe json
                  var tipos = JSON.parse(data);
                  $('#fkID_municipio').append('<option value="" selected="selected">Elije el Municipio</option>');
                  for(x=0; x<tipos.length; x++) {
                      $('#fkID_municipio').append('<option value='+tipos[x].codigo+'>'+tipos[x].nombre+'</option>');
                  }
              }
          })
      };

    function completadepartamento(){
    var ruta = "../controller/ajaxactor.php"; 
          $.ajax({
              url: ruta,
              type: 'POST',  
              data: {tipo: "consultardepartamento"},
              success: function(data){
                  //convierte la cadena que se recibe json
                  var tipos = JSON.parse(data);
                  $('#fkID_departamento').append('<option value="" selected="selected">Elije el Departamento</option>');
                  for(x=0; x<tipos.length; x++) {
                      $('#fkID_departamento').append('<option value='+tipos[x].codigo+'>'+tipos[x].nombre+'</option>');
                  }
              }
          })
      };

    function completapais(){
    var ruta = "../controller/ajaxactor.php"; 
          $.ajax({
              url: ruta,
              type: 'POST',  
              data: {tipo: "consultarpais"},
              success: function(data){
                  //convierte la cadena que se recibe json
                  var tipos = JSON.parse(data);
                  $('#fkID_pais').append('<option value="" selected="selected">Elije el País</option>');
                  for(x=0; x<tipos.length; x++) {
                      $('#fkID_pais').append('<option value='+tipos[x].codigo+'>'+tipos[x].nombre+'</option>');
                  }
              }
          })
      };

    function completaciudad(id){
    var ruta = "../controller/ajaxactor.php"; 
          $.ajax({
              url: ruta,
              type: 'POST',  
              data: {tipo: "consultarciudad",id: id},
              success: function(data){
                  //convierte la cadena que se recibe json
                  var tipos = JSON.parse(data);
                  $('#fkID_municipio').append('<option value="" selected="selected">Elije la Ciudad</option>');
                  for(x=0; x<tipos.length; x++) {
                      $('#fkID_municipio').append('<option value='+tipos[x].codigo+'>'+tipos[x].nombre+'</option>');
                  }
              }
          })
      };

        $(document).ready(function () {   
    $('body').on('change','#fkID_departamento', function() {
        var id = $("#fkID_departamento option:selected").val();
        document.getElementById ("fkID_municipio") .options.length = 0;
         completaciudad(id);
    });
}); 

function elimina_actor(id) {
        var confirma = confirm("En realidad quiere eliminar este Actor?");
        console.log(confirma);
        if (confirma == true) {
            $.ajax({
              type: "POST", 
                url: '../controller/ajaxactor.php',  
                data: {tipo: "eliminarlogico",id: id},
            }).done(function(data) {
                //---------------------
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("errorfatal");
            }).always(function() {
                console.log("complete");
            });
        }
    };

    $("#btn_filtrara").click(function(event) {
        proyecto = $("#btn_nuevoActor").attr("data-proyecto");
        nombre = $('select[name="anio_filtroa"] option:selected').text();
        tipo = $('select[name="tipoa_filtro"] option:selected').text();
        location.href = "actor.php?id_proyectoM=" + proyecto + "&anio=" + nombre + "&tipo=" + tipo  ;
    });





});
