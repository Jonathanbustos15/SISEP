$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevoferia").click(function(){
    $("#lbl_form_feria").html("Crear feria");
        $("#lbl_btn_actionferia").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionferia").attr("data-action","crear");
        $("#btn_actionferia").removeAttr('disabled', 'disabled');
        $("#form_feria")[0].reset();
        $("#btn_actionHvida").removeAttr('disabled');
        $("#adjunto_listado").remove();
        $("#adjunto_listado2").remove();
        $("#adjunto_documento").remove();
        $("#adjunto_documento2").remove();
        cargar_input();
	 });

   $("#btn_actionferia").click(function() {
        var validacioncon = validarferia();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
      }
    });

   $("[name*='edita_feria']").click(function(event) {
      $("#lbl_form_feria").html("Editar Registro feria");
        $("#lbl_btn_actionferia").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionferia").attr("data-action","editar");
        $("#btn_actionferia").removeAttr('disabled', 'disabled');
        $("#form_feria")[0].reset();
        id_feria = $(this).attr('data-id-feria');
        $("#btn_actionHvida").removeAttr('disabled');
        $("#adjunto_listado").remove();
        $("#adjunto_listado2").remove();
        $("#adjunto_documento").remove();
        $("#adjunto_documento2").remove();
        cargar_input();
        carga_feria(id_feria); 
        var ope = $("#fkID_tipo option:selected").val();
    });

	 $("[name*='elimina_feria']").click(function(event) {
        id_feria = $(this).attr('data-id-feria');
        elimina_feria(id_feria);
    });

  sessionStorage.setItem("id_tab_feria",null);

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

    function validarferia(){
      var fecha = $("#fecha_feria").val();
      var lugar = $("#lugar_feria").val();
      var tipo = $("#fkID_tipo_feria option:selected").val();
        var respuesta;
        if (fecha === "" || lugar === "" || tipo === "") {
            respuesta = "no"
            return respuesta
        }else{
            respuesta = "ok"
            return respuesta
        }
    }

    function carga_feria(id_feria) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_feria + "&tipo=consultar&nom_tabla=feria",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, valu) {
                if (key=="url_documento" && valu != "") {
                  $("#form_feria").append('<div id="adjunto_documento2" class="form-group">'+'<label for="adjunto" id="lbl_pkID_archivo_documento" name="lbl_pkID_archivo_documento" class="custom-control-label">Informe feria de Ciencia</label>'+'<br>'+'<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_documento" name="btn_Rmferia_documento" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmferia_documento" id="btn_actionRmferia_documento" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                  $("#lbl_url_documento").remove();
                  $("#url_documento").remove(); 
                  $("[name*='btn_actionRmferia_documento']").click(function(event) {
                    var id_archivo = $("#pkID").val();
                    console.log("este es el numero"+id_archivo);
                    elimina_archivo_documento(id_archivo); 
                });
                 } else if (key=="url_lista" && valu != "") {
                    $("#form_feria").append('<div id="adjunto_listado2" class="form-group">'+'<label for="adjunto" id="lbl_pkID_archivo_listado" name="lbl_pkID_archivo_listado" class="custom-control-label">Listado de la feria de ciencia</label>'+'<br>'+'<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_listado" name="btn_Rmferia_listado" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmferia_listado" id="btn_actionRmferia_listado" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                  $("#lbl_url_lista").remove();
                  $("#url_lista").remove(); 
                  $("[name*='btn_actionRmferia_listado']").click(function(event) {
                    var id_archivo = $("#pkID").val();
                    console.log("este es el numero"+id_archivo);
                    elimina_archivo_lista(id_archivo);
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
      $("#form_feria").append('<div class="form-group" id="adjunto_documento">'+
                        '<label for="adjunto" id="lbl_url_documento" class=" control-label">Adjuntar Informe</label>'+ 
                        '<input type="file" class="form-control" id="url_documento" name="url_documento" placeholder="Documento del feria de ciencias" required = "">'+
                    '</div>')
      $("#form_feria").append('<div class="form-group" id="adjunto_listado">'+
                        '<label for="adjunto" id="lbl_url_lista" class=" control-label">Adjuntar Lista</label>'+ 
                        '<input type="file" class="form-control" id="url_lista" name="url_lista" placeholder="Lista de la Feria de ciencias" required = "">'+
                    '</div>')
    }


    

    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crear_feria();
        } else if (action === "editar") {
            editar_feria();
        };
    };

    function crear_feria() {
        var data = new FormData();
        data.append('fecha_feria', $("#fecha_feria").val());
        data.append('fkID_tipo_feria', $("#fkID_tipo_feria option:selected").val());
        data.append('descripcion', $("#lugar_feria").val());
        if (document.getElementById("url_documento").files.length) {
          data.append('file', $("#url_documento").get(0).files[0]);
        }
        if (document.getElementById("url_lista").files.length) {
          data.append('file2', $("#url_lista").get(0).files[0]);
        }
        data.append('tipo',"crear");
        console.log('Datos serializados: '+data);
        $.ajax({
            type: "POST",
            url: "../controller/ajaxferia.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
              console.log(data);
              location.reload();
            }
        });
    }

    function editar_feria() {
        var data = new FormData();
        data.append('fecha_feria', $("#fecha_feria").val());
        data.append('fkID_tipo_feria', $("#fkID_tipo_feria option:selected").val());
        data.append('descripcion', $("#lugar_feria").val());
        if ($("#url_documento").length) {
        if (document.getElementById("url_documento").files.length) {
          data.append('file', $("#url_documento").get(0).files[0]);
        }
        }
        if ($("#url_lista").length) {
        if (document.getElementById("url_lista").files.length) {
          data.append('file2', $("#url_lista").get(0).files[0]);
        }
        }
        data.append('tipo',"editar");
        data.append('pkID', $("#pkID").val());
        console.log('Datos serializados: '+data);
        $.ajax({
            type: "POST",
            url: "../controller/ajaxferia.php",
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

function elimina_feria(id) {
        var confirma = confirm("En realidad quiere eliminar esta feria?");
        console.log(confirma);
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID',id);
            data.append('tipo',"eliminarlogico");
            $.ajax({
              type: "POST", 
                url: '../controller/ajaxferia.php',  
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
                url: '../controller/ajaxferia.php',
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
                url: '../controller/ajaxferia.php',
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
