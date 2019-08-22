$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevocontenido").click(function() {
        $("#lbl_form_contenido").html("Nuevo contenido")
        $("#lbl_btn_actioncontenido").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actioncontenido").attr("data-action", "crear");
        $("#form_contenido")[0].reset();
        id = $("#btn_nuevocontenido").attr('data-proyecto');
        $("#fkID_proyecto_marco").val(id);
        $("#pdf_documento").remove();
        cargar_input_documento();
    });

    function cargar_input_documento() {
        $("#form_contenido").append('<div class="form-group" id="pdf_documento">' + '<label for="adjunto" id="lbl_url_acompanamiento" class=" control-label">Documento</label>' + '<input type="file" class="form-control" id="url_documento" name="documento" placeholder="Email del acompanamiento" required = "true">' + '</div>')
    }
    //Definir la acción del boton del formulario 
    $("#btn_actioncontenido").click(function() {
        var validacioncon = validarcontenido();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_contenido']").click(function() {
        $("#lbl_form_contenido").html("Edita resignificación");
        $("#lbl_btn_actioncontenido").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actioncontenido").attr("data-action", "editar");
        $("#form_contenido")[0].reset();
        id = $(this).attr('data-id-contenido');
        console.log(id);
        $("#pdf_documento").remove();
        carga_contenido(id);
    });
    $("[name*='elimina_contenido']").click(function(event) {
        id_funciona = $(this).attr('data-id-contenido');
        console.log(id_funciona)
        elimina_contenido(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_contenido", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    function validarcontenido() {
        var nombre = $("#nombre_contenido").val();
        var apellido = $("#apellido_contenido").val();
        var tipo = $("#fkID_tipo_documento option:selected").val();
        var documento = $("#documento_contenido").val();
        var telefono = $("#telefono_contenido").val();
        var direccion = $("#direccion_contenido").val();
        var email = $("#email_contenido").val();
        var respuesta;
        if (nombre === "" || apellido === "" || tipo === "" || documento === "" || telefono === "" || direccion === "" || email === "") {
            respuesta = "no"
            return respuesta
        } else {
            respuesta = "ok"
            return respuesta
        }
    }
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_contenido();
        } else if (action === "editar") {
            edita_contenido();
        };
    };

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_contenido").val('');
            $("#email_contenido").focus();
        } else {
            return true;
        }
    }
    $("#email_contenido").change(function(event) {
        validarEmail($(this).val())
    });

    function crea_contenido() {
        id_proyecto = $("#btn_nuevocontenido").attr('data-proyecto');
        data = new FormData();
        data.append('file', $("#url_documento").get(0).files[0]);
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('nombre', $("#nombre").val());
        data.append('fkID_proyecto_marco', id_proyecto);
        data.append('tipo', "crear");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxcontenido.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function edita_contenido() {
        id_proyecto = $("#btn_nuevocontenido").attr('data-proyecto');
        data = new FormData();
        if (document.getElementById("url_documento")) {
            data.append('file', $("#url_documento").get(0).files[0]);
        }
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('nombre', $("#nombre").val());
        data.append('fkID_proyecto_marco', id_proyecto);
        data.append('tipo', "editar");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxcontenido.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function carga_contenido(id_funciona) {
        console.log("Carga la contenido " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=contenido",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                if (key == "url_documento" && value != "") {
                    $("#form_contenido").append('<div id="pdf_documento" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Documento</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_Rmacompanamiento" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmadocumento" id="btn_actionRmadocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("[name*='btn_actionRmadocumento']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo(id_archivo, 'documento');
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

    function elimina_archivo(id_archivo, campo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar este archivo de contenido?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            data.append('tipo', "eliminararchivodocumento");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxcontenido.php',
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

    function elimina_contenido(id_funciona) {
        console.log('Eliminar la contenido: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este contenido?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=contenido",
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
    //valida si existe el documento
    function validaEqualIdentifica(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `documento_contenido` = '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("El Número de indetificación ya existe, por favor ingrese un número diferente.");
                $("#documento_estudiante").val("");
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }
    $("#nombre_contenido").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_contenido").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#telefono_contenido").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de Telefono NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    $("#documento_funcinario").change(function(event) {
        /* valida que no tenga menos de 8 caracteres*/
        var valores_idCli = $(this).val().length;
        console.log(valores_idCli);
        if ((valores_idCli < 5) || (valores_idCli > 12)) {
            alert("El número de identificación no puede ser menor a 5 valores.");
            $(this).val("");
            $(this).focus();
        }
        validaEqualIdentifica($(this).val());
    });
    $("#documento_contenido").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de DOCUMENTO NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevocontenido").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "contenido.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });
});