$(function() {
    var arrParticipante = [];
    var arrParticipantes = [];
    var arrParticipantesasignados = []
    var arrEstado = [];
    $("#btn_documento").click(function() {
        $("#lbl_form_documento").html("Crear documento");
        $("#lbl_btn_actiondocumento").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actiondocumento").attr("data-action", "crear");
        $("#form_documento")[0].reset();
        limpia_inputs();
        cargar_input_documento();
    });
    $("[name*='edita_documento']").click(function() {
        $("#lbl_form_documento").html("Edita Documento");
        $("#lbl_btn_actiondocumento").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actiondocumento").attr("data-action", "editar");
        $("#form_documento")[0].reset();
        id = $(this).attr('data-documento');
        console.log(id);
        limpia_inputs();
        carga_documento(id);
    });

    function carga_documento(id_funciona) {
        console.log("Carga el documento " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=documentos_aibd",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                if (key == "url_documento" && value != "") {
                    $("#form_documento").append('<div id="pdf_documento" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Imagen</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_Rmdocumento" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmadocumento" id="btn_actionRmadocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_imagen").remove();
                    $("#url_imagen").remove();
                    $("[name*='btn_actionRmadocumento']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_documento(id_archivo, 'documento');
                    });
                } else {
                    if (key == "url_documento") {
                        cargar_input_documento();
                    } else {
                        $("#" + key).val(value);
                    }
                }
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function limpia_inputs() {
        $("#pdf_documento").remove();
    }

    function cargar_input_documento() {
        $("#form_documento").append('<div class="form-group" id="pdf_documento">' + '<label for="adjunto" id="lbl_//imagen" class=" control-label">Imagen</label>' + '<input type="file" class="form-control" id="url_documento" name="documento" placeholder="Email del documento" >' + '</div>')
    }
    $("#btn_actiondocumento").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='elimina_archivo']").click(function(event) {
        id_documento = $(this).attr('data-id-documento_aibd');
        console.log(id_documento)
        deleteSaberNumReg(id_documento);
    });
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_documento();
        } else {
            edita_documento();
        }
    };

    function crea_documento() {
        ok = $('#form_documento').valida();
        if (ok.estado === true) {
            data = new FormData();
            data.append('file', $("#url_documento").get(0).files[0]);
            id_proyecto = $("#btn_documento").attr('data-id-proyecto');
            data.append('pkID', $("#pkID").val());
            data.append('fecha_doc', $("#fecha_doc").val());
            data.append('nombre', $("#nombre").val());
            data.append('fkID_proyecto_marco', id_proyecto);
            data.append('tipo', "crear_documento");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaibd.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })
        } else {
            alert('Faltan campos por llenar :(');
        }
    }

    function deleteSaberNumReg(numReg) {
        var confirma = confirm("En realidad quiere eliminar el documento?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + numReg + "&tipo=eliminar_logico&nom_tabla=documento_aibd",
            }).done(function(data) {
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("error");
            }).always(function() {
                console.log("complete");
            });
        }
    }

    function edita_documento() {
        ok = $('#form_documento').valida();
        if (ok.estado === true) {
            var data = new FormData();
            if (document.getElementById("url_documento")) {
                data.append('file', $("#url_documento").get(0).files[0]);
            }
            data.append('pkID', $("#pkID").val());
            data.append('fecha_doc', $("#fecha_doc").val());
            data.append('nombre', $("#nombre").val());
            data.append('tipo', "editar_documento");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaibd.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })
        } else {
            alert('Faltan campos por llenar :(');
        }
    }

    function elimina_archivo_documento(id_archivo, campo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar este documento?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            if (campo == 'documento') {
                data.append('tipo', "eliminararchivodocumento");
            }
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxaibd.php',
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
        } else {
            //no hace nada
        }
    };
    $("[name*='elimina_documento_aibd']").click(function(event) {
        id_funciona = $(this).attr('data-id-documento');
        console.log(id_funciona)
        elimina_documento_aibd(id_funciona);
    });

    function elimina_documento_aibd(id_funciona) {
        console.log('Eliminar el documento: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este documento?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=documentos_aibd",
            }).done(function(data) {
                //---------------------
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("errorfatal");
            }).always(function() {
                console.log("complete");
            });
        } else {
            //no hace nada
        }
    };
});