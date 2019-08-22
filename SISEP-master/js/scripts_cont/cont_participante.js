 $(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevoparticipante").click(function() {
        $("#lbl_form_participante").html("Nuevo participante");
        $("#lbl_btn_actionparticipante").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionparticipante").attr("data-action", "crear");
        $("#form_participante")[0].reset();
        $("#adjun_funcio").remove();
        $("#adjunto_funcionhv").remove();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionparticipante").click(function() {
        var validacioncon = validarparticipante();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_participante']").click(function() {
        $("#lbl_form_participante").html("Edita participante");
        $("#lbl_btn_actionparticipante").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionparticipante").attr("data-action", "editar");
        $("#form_participante")[0].reset();
        id = $(this).attr('data-id-participante');
        $("#adjun_funcio").remove();
        $("#adjunto_funcionhv").remove();
        console.log(id);
        carga_participante(id);
    });
    $("[name*='elimina_participante']").click(function(event) {
        id_partici = $(this).attr('data-id-participante');
        console.log(id_partici)
        elimina_participante(id_partici);
    });
    //
    sessionStorage.setItem("id_tab_participante", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    function validarparticipante() {
        var nombre = $("#nombre_participante").val();
        var apellido = $("#apellido_participante").val();
        var tipo = $("#fkID_tipo_documento option:selected").val();
        var documento = $("#documento_participante").val();
        var telefono = $("#telefono_participante").val();
        var direccion = $("#direccion_participante").val();
        var email = $("#email_participante").val();
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
            crea_participante();
        } else if (action === "editar") {
            edita_participante();
        };
    };

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_participante").val('');
            $("#email_participante").focus();
        } else {
            return true;
        }
    }
    $("#email_participante").change(function(event) {
        validarEmail($(this).val())
    });

    function crea_participante() {
            var data = new FormData();
            data.append('nombre', $("#nombre_participante").val());
            data.append('apellido', $("#apellido_participante").val());
            data.append('fk_tipo', $("#fkID_tipo_documento option:selected").val());
            data.append('documento', $("#documento_participante").val());
            data.append('telefono', $("#telefono_participante").val());
            data.append('direccion', $("#direccion_participante").val());
            data.append('email', $("#email_participante").val());
            data.append('proyecto_marco', $("#proyecto_marco").val());
            data.append('tipo', "crear");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxparticipante.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })
    }


    function
    edita_participante() {
    		var data = new FormData();
            data.append('nombre', $("#nombre_participante").val());
            data.append('apellido', $("#apellido_participante").val());
            data.append('fk_tipo', $("#fkID_tipo_documento option:selected").val());
            data.append('documento', $("#documento_participante").val());
            data.append('telefono', $("#telefono_participante").val());
            data.append('direccion', $("#direccion_participante").val());
            data.append('email', $("#email_participante").val());
            data.append('tipo', "editar");
            data.append('pkID', $("#pkID").val());
            $.ajax({
                type: "POST",
                url: "../controller/ajaxparticipante.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })
    }

    function carga_participante(id_partici) {
        console.log("Carga el institucion " + id_partici);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_partici + "&tipo=consultar&nom_tabla=participante",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                if (key == "url_participante" && value != "") {
                    $("#form_participante").append('<div id="adjun_funcio" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Hoja de vida</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_Rmparticipante" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmparticipante" id="btn_actionRmparticipante" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_participante").remove();
                    $("#url_participante").remove();
                    $("[name*='btn_actionRmparticipante']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_participante(id_archivo);
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

    function elimina_participante(id_partici) {
        console.log('Eliminar el participante: ' + id_partici);
        var confirma = confirm("En realidad quiere eliminar este participante?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
            	type: "POST",
                url: '../controller/ajaxparticipante.php',
                data: "pkID=" + id_partici + "&tipo=eliminar",
            }).done(function(data) {
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
        var consEqual = "SELECT COUNT(*) as res_equal FROM `participante` WHERE `documento_participante`= '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("El Número de indetificación ya existe, por favor ingrese un número diferente.");
                $("#documento_participante").val("");
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }
    $("#nombre_participante").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_participante").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#telefono_participante").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de Telefono NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    $("#documento_participante").change(function(event) {
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
    $("#documento_participante").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de DOCUMENTO NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
});