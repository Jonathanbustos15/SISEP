$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevoAcompanamiento").click(function() {
        $("#lbl_form_acompanamiento").html("Nuevo acompañamiento")
        $("#lbl_btn_actionacompanamiento").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionacompanamiento").attr("data-action", "crear");
        $("#form_acompanamiento")[0].reset();
        id = $("#btn_nuevoAcompanamiento").attr('data-proyecto');
        $("#fkID_proyecto_marco").val(id);
        $("#pdf_lista").remove();
        $("#pdf_informe").remove();
        cargar_input_lista();
        //cargar_input_informe();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionacompanamiento").click(function() {
        var validacioncon = validaracompanamiento();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_acompanamiento']").click(function() {
        $("#lbl_form_acompanamiento").html("Edita acompañamiento");
        $("#lbl_btn_actionacompanamiento").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionacompanamiento").attr("data-action", "editar");
        $("#form_acompanamiento")[0].reset();
        id = $(this).attr('data-id-acompanamiento');
        console.log(id);
        $("#pdf_lista").remove();
        $("#pdf_informe").remove();
        carga_acompanamiento(id);
    });
    $("[name*='elimina_acompanamiento']").click(function(event) {
        id_funciona = $(this).attr('data-id-acompanamiento');
        console.log(id_funciona)
        elimina_acompanamiento(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_acompanamiento", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    function validaracompanamiento() {
        var fecha = $("#fecha_acompanamiento").val();
        var descripcion = $("#descripcion").val();
        var respuesta;
        if (fecha === "" || descripcion === "" ) {
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
            crea_acompanamiento();
        } else if (action === "editar") {
            edita_acompanamiento();
        };
    };

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_acompanamiento").val('');
            $("#email_acompanamiento").focus();
        } else {
            return true;
        }
    }
    $("#email_acompanamiento").change(function(event) {
        validarEmail($(this).val())
    });

    function crea_acompanamiento() {
        var data = new FormData();
        data.append('file', $("#url_lista").get(0).files[0]);
        data.append('fecha_acompanamiento', $("#fecha_acompanamiento").val());
        data.append('descripcion', $("#descripcion").val());
        data.append('fkID_proyecto_marco', $("#fkID_acompanamiento").val());
        data.append('tipo', "crear");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxacompanamiento.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function cargar_input_lista() {
        $("#form_acompanamiento").append('<div class="form-group" id="pdf_lista">' + '<label for="adjunto" id="lbl_url_acompanamiento" class=" control-label">Lista de Asistencia</label>' + '<input type="file" class="form-control" id="url_lista" name="lista" placeholder="Email del acompanamiento" required = "true">' + '</div>')
    }

    function cargar_input_informe() {
        $("#form_acompanamiento").append('<div class="form-group" id="pdf_informe">' + '<label for="adjunto" id="lbl_url_acompanamiento" class=" control-label">Informe</label>' + '<input type="file" class="form-control" id="url_informe" name="informe" placeholder="Email del acompanamiento" required = "true">' + '</div>')
    }

    function edita_acompanamiento() {
        //no existe
        var data = new FormData();
        if (document.getElementById("url_lista")) {
            data.append('file', $("#url_lista").get(0).files[0]);
        }
        data.append('pkID', $("#pkID").val());
        data.append('fecha_acompanamiento', $("#fecha_acompanamiento").val());
        data.append('descripcion', $("#descripcion").val());
        data.append('tipo', "editar");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxacompanamiento.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function carga_acompanamiento(id_funciona) {
        console.log("Carga el acompanamiento " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=acompanamiento",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                if (key == "url_lista" && value != "") {
                    $("#form_acompanamiento").append('<div id="pdf_lista" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Lista de Asistencia</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_Rmacompanamiento" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_lista" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmalista" id="btn_actionRmalista" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_acompanamiento").remove();
                    $("#url_acompanamiento").remove();
                    $("[name*='btn_actionRmalista']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_acompanamiento(id_archivo, 'lista');
                    });
                } else {
                    if (key == "url_lista") {
                        cargar_input_lista();
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

    function elimina_acompanamiento(id_funciona) {
        console.log('Eliminar el acompañamiento: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este acompañamiento?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=acompanamiento",
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

    function elimina_archivo_acompanamiento(id_archivo, campo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar esta Lista de Asistencia?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            if (campo == 'lista') {
                data.append('tipo', "eliminararchivolista");
            }
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxacompanamiento.php',
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
    //valida si existe el lista
    function validaEqualIdentifica(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `lista_acompanamiento` = '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("El Número de indetificación ya existe, por favor ingrese un número diferente.");
                $("#lista_estudiante").val("");
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {  
            console.log("complete");
        });
    }
    $("#nombre_acompanamiento").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_acompanamiento").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#telefono_acompanamiento").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de Telefono NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    $("#lista_funcinario").change(function(event) {
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
    $("#lista_acompanamiento").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de lista NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevoAcompanamiento").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "acompanamiento.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });
});