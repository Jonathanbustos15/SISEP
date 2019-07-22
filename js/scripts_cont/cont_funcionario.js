$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevofuncionario").click(function() {
        $("#lbl_form_funcionario").html("Nuevo Funcionario");
        $("#lbl_btn_actionfuncionario").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionfuncionario").attr("data-action", "crear");
        $("#form_funcionario")[0].reset();
        $("#adjun_funcio").remove();
        $("#adjunto_funcionhv").remove();
        cargar_input();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionfuncionario").click(function() {
        var validacioncon = validarfuncionario();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_funcionario']").click(function() {
        $("#lbl_form_funcionario").html("Edita Funcionario");
        $("#lbl_btn_actionfuncionario").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionfuncionario").attr("data-action", "editar");
        $("#form_funcionario")[0].reset();
        id = $(this).attr('data-id-funcionario');
        $("#adjun_funcio").remove();
        $("#adjunto_funcionhv").remove();
        cargar_input();
        console.log(id);
        carga_funcionario(id);
    });
    $("[name*='elimina_funcionario']").click(function(event) {
        id_funciona = $(this).attr('data-id-funcionario');
        console.log(id_funciona)
        elimina_funcionario(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_funcionario", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    function validarfuncionario() {
        var nombre = $("#nombre_funcionario").val();
        var apellido = $("#apellido_funcionario").val();
        var tipo = $("#fkID_tipo_documento option:selected").val();
        var documento = $("#documento_funcionario").val();
        var telefono = $("#telefono_funcionario").val();
        var direccion = $("#direccion_funcionario").val();
        var email = $("#email_funcionario").val();
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
            crea_funcionario();
        } else if (action === "editar") {
            edita_funcionario();
        };
    };

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_funcionario").val('');
            $("#email_funcionario").focus();
        } else {
            return true;
        }
    }
    $("#email_funcionario").change(function(event) {
        validarEmail($(this).val())
    });

    function crea_funcionario() {
        var data = new FormData();
        if (document.getElementById("url_funcionario").files.length) {
            data.append('file', $("#url_funcionario").get(0).files[0]);
        }
            data.append('nombre', $("#nombre_funcionario").val());
            data.append('apellido', $("#apellido_funcionario").val());
            data.append('fk_tipo', $("#fkID_tipo_documento option:selected").val());
            data.append('documento', $("#documento_funcionario").val());
            data.append('telefono', $("#telefono_funcionario").val());
            data.append('direccion', $("#direccion_funcionario").val());
            data.append('proyecto_marco', $("#proyecto_marco").val());
            data.append('email', $("#email_funcionario").val());
            data.append('tipo', "crear");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxfuncionario.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {  
                    console.log(a);
                    location.reload();
                }
            })

    }

    function cargar_input() {
        $("#form_funcionario").append('<div class="form-group" id="adjunto_funcionhv">' + '<label for="adjunto" id="lbl_url_funcionario" class=" control-label">Hoja de Vida</label>' + '<input type="file" class="form-control" id="url_funcionario" name="url_funcionario" placeholder="Email del Funcionario" required = "true">' + '</div>')
    }

    function edita_funcionario() {
        var data = new FormData();
        if ($("#url_funcionario").length) {
            if (document.getElementById("url_funcionario").files.length) {
            data.append('file', $("#url_funcionario").get(0).files[0]);
            }
            }
            data.append('nombre', $("#nombre_funcionario").val());
            data.append('apellido', $("#apellido_funcionario").val());
            data.append('fk_tipo', $("#fkID_tipo_documento option:selected").val());
            data.append('documento', $("#documento_funcionario").val());
            data.append('telefono', $("#telefono_funcionario").val());
            data.append('direccion', $("#direccion_funcionario").val());
            data.append('email', $("#email_funcionario").val());
            data.append('tipo', "editar");
            data.append('pkID', $("#pkID").val());
            $.ajax({
                type: "POST",
                url: "../controller/ajaxfuncionario.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })

    }

    function carga_funcionario(id_funciona) {
        console.log("Carga el institucion " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=funcionario",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                if (key == "url_funcionario" && value != "") {
                    $("#form_funcionario").append('<div id="adjun_funcio" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Hoja de vida</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmFuncionario" id="btn_actionRmFuncionario" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_funcionario").remove();
                    $("#url_funcionario").remove();
                    $("[name*='btn_actionRmFuncionario']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_funcionario(id_archivo);
                    });
                } else {
                    $("#" + key).val(value);
                }
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function elimina_funcionario(id_funciona) {
        var confirma = confirm("En realidad quiere eliminar este Funcionario?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=funcionario",
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

    function elimina_archivo_funcionario(id_archivo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar este archivo de Funcionario?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            data.append('tipo', "eliminararchivo");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxfuncionario.php',
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
    //valida si existe el documento
    function validaEqualIdentifica(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `funcionario` WHERE `documento_funcionario` = '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("El Número de indetificación ya existe, por favor ingrese un número diferente.");
                $("#documento_funcionario").val("");
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }
    $("#nombre_funcionario").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_funcionario").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#telefono_funcionario").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de Telefono NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    $("#documento_funcionario").change(function(event) {
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
    $("#documento_funcionario").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de DOCUMENTO NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
});