$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevoAnuario").click(function() {
        $("#lbl_form_anuario").html("Nuevo anuario")
        $("#lbl_btn_actionanuario").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionanuario").attr("data-action", "crear");
        $("#form_anuario")[0].reset();
        id = $("#btn_nuevoanuario").attr('data-proyecto');
        $("#fkID_proyecto_marco").val(id);
        $("#pdf_documento").remove();
        cargar_input_documento();
    });

    function cargar_input_documento() {
        $("#form_anuario").append('<div class="form-group" id="pdf_documento">' + '<label for="adjunto" id="lbl_url_acompanamiento" class=" control-label">Documento</label>' + '<input type="file" class="form-control" id="url_documento" name="documento" placeholder="Email del acompanamiento" required = "true">' + '</div>')
    }
    //Definir la acción del boton del formulario 
    $("#btn_actionanuario").click(function() {
        var validacioncon = validaranuario();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_anuario']").click(function() {
        $("#lbl_form_anuario").html("Edita resignificación");
        $("#lbl_btn_actionanuario").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionanuario").attr("data-action", "editar");
        $("#form_anuario")[0].reset();
        id = $(this).attr('data-id-anuario');
        console.log(id);
        $("#pdf_documento").remove();
        carga_anuario(id);
    });
    $("[name*='elimina_anuario']").click(function(event) {
        id_funciona = $(this).attr('data-id-anuario');
        console.log(id_funciona)
        elimina_anuario(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_anuario", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    function validaranuario() {
        var nombre = $("#nombre_anuario").val();
        var apellido = $("#apellido_anuario").val();
        var tipo = $("#fkID_tipo_documento option:selected").val();
        var documento = $("#documento_anuario").val();
        var telefono = $("#telefono_anuario").val();
        var direccion = $("#direccion_anuario").val();
        var email = $("#email_anuario").val();
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
            crea_anuario();
        } else if (action === "editar") {
            edita_anuario();
        };
    };

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_anuario").val('');
            $("#email_anuario").focus();
        } else {
            return true;
        }
    }
    $("#email_anuario").change(function(event) {
        validarEmail($(this).val())
    });

    function crea_anuario() {
        id_proyecto = $("#btn_nuevoAnuario").attr('data-proyecto');
        data = new FormData();
        data.append('file', $("#url_documento").get(0).files[0]);
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('fkID_proyecto_marco', id_proyecto);
        data.append('tipo', "crear");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxanuario.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function edita_anuario() {
        id_proyecto = $("#btn_nuevoAnuario").attr('data-proyecto');
        data = new FormData();
        data.append('file', $("#url_documento").get(0).files[0]);
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('fkID_proyecto_marco', id_proyecto);
        data.append('tipo', "editar");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxanuario.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function carga_anuario(id_funciona) {
        console.log("Carga la anuario " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=anuario",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                if (key == "url_documento" && value != "") {
                    $("#form_anuario").append('<div id="pdf_documento" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Documento</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_Rmacompanamiento" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmadocumento" id="btn_actionRmadocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
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
        var confirma = confirm("En realidad quiere eliminar este archivo de anuario?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            data.append('tipo', "eliminararchivodocumento");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxanuario.php',
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

    function elimina_anuario(id_funciona) {
        console.log('Eliminar la anuario: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este anuario?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminarlogico&nom_tabla=anuario",
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
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `documento_anuario` = '" + num_id + "'";
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
    $("#nombre_anuario").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_anuario").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#telefono_anuario").keyup(function(event) {
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
    $("#documento_anuario").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de DOCUMENTO NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevoAnuario").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "anuario.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });
});