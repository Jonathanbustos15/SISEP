$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevotaller").click(function(){
    $("#lbl_form_taller").html("Crear taller");
        $("#lbl_btn_actiontaller").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actiontaller").attr("data-action","crear");
        $("#btn_actiontaller").removeAttr('disabled', 'disabled');
        $("#form_taller")[0].reset();
        $("#btn_actionHvida").removeAttr('disabled');
        $("#adjunto_lista2").remove();
        $("#adjunto_lista").remove();
        $("#adjunto_documento").remove();
        $("#adjunto_documento2").remove();
        cargar_input();
	 });

   $("#btn_actiontaller").click(function() {
        var validacioncon = validartaller();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
      }
    });

   $("[name*='edita_taller']").click(function(event) {
      $("#lbl_form_taller").html("Editar Registro taller");
        $("#lbl_btn_actiontaller").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actiontaller").attr("data-action","editar");
        $("#btn_actiontaller").removeAttr('disabled', 'disabled');
        $("#form_taller")[0].reset();
        id_taller = $(this).attr('data-id-taller');
        $("#btn_actionHvida").removeAttr('disabled');
        $("#adjunto_documento").remove();
        $("#adjunto_documento2").remove();
        cargar_input();
        carga_taller(id_taller); 
        var ope = $("#fkID_tipo option:selected").val();
    });

	 $("[name*='elimina_taller']").click(function(event) {
        id_taller = $(this).attr('data-id-taller');
        elimina_taller(id_taller);
    });

  sessionStorage.setItem("id_tab_taller",null);

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

    function validartaller(){
      var fecha = $("#fecha_taller").val();
      var asesor = $("#fkID_tutor option:selected").val();
      var tipo = $("#fkID_tipo_taller option:selected").val();
        var respuesta;
        if (fecha === "" || asesor === "" || tipo === "") {
            respuesta = "no"
            return respuesta
        }else{
            respuesta = "ok"
            return respuesta
        }
    }

    function carga_taller(id_taller) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_taller + "&tipo=consultar&nom_tabla=talleres_formacion",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, valu) {
                if (key=="url_documento" && valu != "") {
                  $("#form_taller").append('<div id="adjunto_documento2" class="form-group">'+'<label for="adjunto" id="lbl_pkID_archivo_documento" name="lbl_pkID_archivo_documento" class="custom-control-label">Documento Taller de Formación</label>'+'<br>'+'<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_documento" name="btn_Rmtaller_documento" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmtaller_documento" id="btn_actionRmtaller_documento" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                  $("#lbl_url_documento").remove();
                  $("#url_documento").remove(); 
                  $("[name*='btn_actionRmtaller_documento']").click(function(event) {
                    var id_archivo = $("#pkID").val();
                    console.log("este es el numero"+id_archivo);
                    elimina_archivo_documento(id_archivo); 
                });
                 } else {
                $("#" + key).val(valu);
              }
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function cargar_input(){
      $("#form_taller").append('<div class="form-group" id="adjunto_documento">'+
                        '<label for="adjunto" id="lbl_url_documento" class=" control-label">Adjuntar Documento</label>'+ 
                        '<input type="file" class="form-control" id="url_documento" name="url_documento" placeholder="Documento del taller de formación" required = "">'+
                    '</div>')
    }

    

    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crear_taller();
        } else if (action === "editar") {
            editar_taller();
        };
    };

    function crear_taller() {
        var data = new FormData();
        data.append('fecha_taller', $("#fecha_taller").val());
        data.append('fkID_tipo_taller', $("#fkID_tipo_taller option:selected").val());
        data.append('descripcion', $("#descripcion").val());
        data.append('fkID_tutor', $("#fkID_tutor option:selected").val());
        if (document.getElementById("url_documento").files.length) {
          data.append('file', $("#url_documento").get(0).files[0]);
        }
        data.append('tipo',"crear");
        console.log('Datos serializados: '+data);
        $.ajax({
            type: "POST",
            url: "../controller/ajaxtaller.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
              console.log(data);
              location.reload();
            }
        });
    }

    function editar_taller() {
        var data = new FormData();
        data.append('fecha_taller', $("#fecha_taller").val());
        data.append('fkID_tipo_taller', $("#fkID_tipo_taller option:selected").val());
        data.append('descripcion', $("#descripcion").val());
        data.append('fkID_tutor', $("#fkID_tutor option:selected").val());
        if ($("#url_documento").length) {
        if (document.getElementById("url_documento").files.length) {
          data.append('file', $("#url_documento").get(0).files[0]);
        }
        }
        data.append('tipo',"editar");
        data.append('pkID', $("#pkID").val());
        console.log('Datos serializados: '+data);
        $.ajax({
            type: "POST",
            url: "../controller/ajaxtaller.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
              console.log(data);
              location.reload();
            }
        });
    }

    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

function elimina_taller(id) {
        var confirma = confirm("En realidad quiere eliminar este taller?");
        console.log(confirma);
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID',id);
            data.append('tipo',"eliminarlogico");
            $.ajax({
              type: "POST", 
                url: '../controller/ajaxtaller.php',  
                data: data,
                contentType: false,
                processData: false,
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

  function elimina_archivo_lista(id_archivo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar la lista de asistencia?");
        console.log(confirma);
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID',id_archivo);
            data.append('tipo',"eliminarlista");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxtaller.php',
                data: data,
                contentType: false,
                processData: false,
            }).done(function(data) {
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("error");
            }).always(function() {
                console.log("complete");
            });
        } 
    };

    function elimina_archivo_documento(id_archivo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar el documento?");
        console.log(confirma);
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID',id_archivo);
            data.append('tipo',"eliminardocumento");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxtaller.php',
                data: data,
                contentType: false,
                processData: false,
            }).done(function(data) {
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("error");
            }).always(function() {
                console.log("complete");
            });
        } 
    };




});
