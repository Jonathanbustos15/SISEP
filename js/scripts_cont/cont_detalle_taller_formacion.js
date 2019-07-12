$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevosesion").click(function(){
    $("#lbl_form_sesion").html("Crear sesion");
        $("#lbl_btn_actionsesion").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionsesion").attr("data-action","crear");
        $("#btn_actionsesion").removeAttr('disabled', 'disabled');
        $("#form_sesion")[0].reset();
        $("#adjunto_lista2").remove();
        $("#adjunto_lista").remove();
        cargar_input_lista();
	 });
	 
	 $("#btn_actionsesion").click(function() {
        var validacioncon = validarsesion();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
      }
    });

   $("[name*='edita_sesion']").click(function(event) {
      $("#lbl_form_sesion").html("Editar Registro sesion");
        $("#lbl_btn_actionsesion").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionsesion").attr("data-action","editar");
        $("#btn_actionsesion").removeAttr('disabled', 'disabled');
        $("#form_sesion")[0].reset();
        id_sesion = $(this).attr('data-id-sesion');
        $("#adjunto_lista2").remove();
        $("#adjunto_lista").remove();
        console.log(id_sesion)
        cargar_input_lista();
        carga_sesion(id_sesion);
    });

	 $("[name*='elimina_sesion']").click(function(event) {
        id_sesion = $(this).attr('data-id-sesion');
        elimina_sesion(id_sesion);
    });


  function validarsesion(){
      var fecha = $("#fecha_sesion").val();
      var descripcion = $("#descripcion_sesion").val();
        var respuesta;
        if (fecha === "" || descripcion === "") {
            respuesta = "no"
            return respuesta
        }else{
            respuesta = "ok"
            return respuesta
        }
    }


  //--------------------------------------------------------

    

  sessionStorage.setItem("id_tab_sesion",null);

 function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crear_sesion();
        } else if (action === "editar") {
            editar_sesion();
        };
    };

    function crear_sesion() {
        var data = new FormData();
        data.append('fecha_sesion', $("#fecha_sesion").val());
        data.append('descripcion', $("#descripcion_sesion").val());
        if (document.getElementById("url_lista").files.length) {
          data.append('file2', $("#url_lista").get(0).files[0]);
        }
        data.append('fkID_taller_formacion', $("#fkID_taller_formacion").val());
        data.append('tipo',"crearsesion");
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


    function cargar_input_lista(){
      $("#form_sesion").append('<div class="form-group" id="adjunto_lista">'+
                        '<label for="adjunto" id="lbl_url_lista" class=" control-label">Adjuntar Lista</label>'+ 
                        '<input type="file" class="form-control" id="url_lista" name="url_lista" placeholder="Lista de asistencia del sesion de formación" required = "">'+
                    '</div>')
    }

    function carga_sesion(id_sesion) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_sesion + "&tipo=consultar&nom_tabla=sesion_taller",
        }).done(function(data) {
          console.log(data)
            $.each(data.mensaje[0], function(key, valu) {
               if (key=="url_lista" && valu != "") {
                  $("#form_sesion").append('<div id="adjunto_lista2" class="form-group">'+'<label for="lista" id="lbl_pkID_archivo_lista" name="lbl_pkID_archivo_lista" class="custom-control-label">Lista de asistencia</label>'+'<br>'+'<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_sesion name="btn_Rmtaller_documento" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmsesion_lista" id="btn_actionRmsesion_lista" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                  $("#lbl_url_lista").remove();
                  $("#url_lista").remove(); 
                  $("[name*='btn_actionRmsesion_lista']").click(function(event) {
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
  
    function editar_sesion() {
        var data = new FormData();
        data.append('fecha_sesion', $("#fecha_sesion").val());
        data.append('descripcion', $("#descripcion_sesion").val());
        if ($("#url_lista").length) {
        if (document.getElementById("url_lista").files.length) {
          data.append('file2', $("#url_lista").get(0).files[0]);
        }
        }
        data.append('tipo',"editarsesion");
        data.append('fkID_taller_formacion', $("#fkID_taller_formacion").val());
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

   

function elimina_sesion(id) {
        var confirma = confirm("En realidad quiere eliminar este sesion?");
        console.log(confirma);
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID',id);
            data.append('tipo',"eliminarlogicos");
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





});