$(function() {
    $("#btn_aulas_tecnologia").click(function() {
        $("#lbl_form_aulas_tecnologia").html("Crear Inventario Tecnología");
        $("#lbl_btn_actionaulas_tecnologia").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas_tecnologia").attr("data-action", "crear_tecnologia");
        $("#form_aulas_tecnologia")[0].reset();
    });
    $("#btn_aulas_cientifico").click(function() {
        $("#lbl_form_aulas_cientifico").html("Crear Inventario Cientifico");
        $("#lbl_btn_actionaulas_cientifico").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas_cientifico").attr("data-action", "crear_cientifico");
        $("#form_aulas_cientifico")[0].reset();
    });
    $("#btn_aulas_wifi").click(function() {
        $("#lbl_form_aulas_wifi").html("Crear Inventario WIFI");
        $("#lbl_btn_actionaulas_wifi").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas_wifi").attr("data-action", "crear_wifi");
        $("#form_aulas_wifi")[0].reset();
    });
    $("#btn_aulas_actas").click(function() {
        $("#lbl_form_aulas_actas").html("Crear Actas");
        $("#lbl_btn_actionactas").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionactas").attr("data-action", "crear_acta");
        $("#form_aulas_actas")[0].reset();
        $("#adjunto_lista").remove();
        cargar_input_lista();
    });
    $("[name*='edita_aulas_tecnologia']").click(function() {
        $("#lbl_form_aulas_tecnologia").html("Edita Inventario Tecnología");
        $("#lbl_btn_actionaulas_tecnologia").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas_tecnologia").attr("data-action", "editar_tecnologia");
        $("#form_aulas_tecnologia")[0].reset();
        id = $(this).attr('data-id-aulas_tecnologia');
        console.log(id);
        carga_aulas_tecnologia(id);
    });
    $("[name*='edita_aulas_cientifico']").click(function() {
        $("#lbl_form_aulas_cientifico").html("Edita Inventario Cientifico");
        $("#lbl_btn_actionaulas_cientifico").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas_cientifico").attr("data-action", "editar_cientifico");
        $("#form_aulas_cientifico")[0].reset();
        id = $(this).attr('data-id-aulas_cientifico');
        console.log(id);
        carga_aulas_cientifico(id);
    });
    $("[name*='edita_aulas_wifi']").click(function() {
        $("#lbl_form_aulas_wifi").html("Edita Inventario Cientifico");
        $("#lbl_btn_actionaulas_wifi").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas_wifi").attr("data-action", "editar_wifi");
        $("#form_aulas_wifi")[0].reset();
        id = $(this).attr('data-id-aulas_wifi');
        console.log(id);
        carga_aulas_wifi(id);
    });
    $("[name*='edita_acta']").click(function() {
        $("#lbl_form_aulas_actas").html("Editar Acta");
        $("#lbl_btn_actionactas").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionactas").attr("data-action", "editar_acta");
        $("#form_aulas_actas")[0].reset();
        id = $(this).attr('data-id-acta');
        console.log(id);
        carga_acta(id);
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionaulas_tecnologia").click(function() {
        action = $(this).attr("data-action");
        valida_action(action);
        console.log("accion a ejecutar: " + action);
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionaulas_cientifico").click(function() {
        action = $(this).attr("data-action");
        valida_action(action);
        console.log("accion a ejecutar: " + action);
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionactas").click(function() {
        action = $(this).attr("data-action");
        valida_action(action);
        console.log("accion a ejecutar: " + action);
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionaulas_wifi").click(function() {
        action = $(this).attr("data-action");
        valida_action(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='elimina_aulas_tecnologia']").click(function(event) {
        id_funciona = $(this).attr('data-id-aulas_tecnologia');
        console.log(id_funciona)
        elimina_aulas_tecnologia(id_funciona);
    });
    $("[name*='elimina_aulas_cientifico']").click(function(event) {
        id_funciona = $(this).attr('data-id-aulas_cientifico');
        console.log(id_funciona)
        elimina_aulas_cientifico(id_funciona);
    });
    $("[name*='elimina_aulas_wifi']").click(function(event) {
        id_funciona = $(this).attr('data-id-aulas_wifi');
        console.log(id_funciona)
        elimina_aulas_wifi(id_funciona);
    });
    $("[name*='elimina_acta']").click(function(event) {
        id_funciona = $(this).attr('data-id-acta');
        console.log(id_funciona)
        elimina_aulas_acta(id_funciona);
    });
    //valida accion a realizar
    function valida_action(action) {
        console.log("en la mitad");
        if (action === "crear_tecnologia") {
            crea_aula_tecnologia();
        }
        if (action === "editar_tecnologia") {
            edita_aula_tecnologia();
        };
        if (action === "crear_cientifico") {
            crea_aula_cientifico();
        }
        if (action === "editar_cientifico") {
            edita_aula_cientifico();
        };
        if (action === "crear_wifi") {
            crea_aula_wifi();
        }
        if (action === "editar_wifi") {
            edita_aula_wifi();
        };
        if (action === "crear_acta") {
            crea_acta();
        };
        if (action === "editar_acta") {
            edita_acta();
        };
    };

    function crea_aula_tecnologia() {
        ok = $('#form_aulas_tecnologia').valida();
        if (ok.estado === true) {
            var data = new FormData();
            id_aula = $("#btn_aulas_tecnologia").attr('data-aulas');
            data.append('nombre_tec', $("#nombre_tec").val());
            data.append('elemento_tec', $("#elemento_tec").val());
            data.append('cantidad_tec', $("#cantidad_tec").val());
            data.append('fkID_aula', id_aula);
            data.append('tipo', "crear_tecnologia");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
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

    function edita_aula_tecnologia() {
        ok = $('#form_aulas_tecnologia').valida();
        if (ok.estado === true) {
            var data = new FormData();
            data.append('pkID', $("#pkID").val());
            id_aula = $("#btn_aulas_tecnologia").attr('data-aulas');
            data.append('nombre_tec', $("#nombre_tec").val());
            data.append('elemento_tec', $("#elemento_tec").val());
            data.append('cantidad_tec', $("#cantidad_tec").val());
            data.append('fkID_aula', id_aula);
            data.append('tipo', "editar_tecnologia");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
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

    function carga_aulas_tecnologia(id_funciona) {
        console.log("Carga el aulas " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=aulas_tecnologia",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                $("#" + key).val(value);
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function elimina_aulas_tecnologia(id_funciona) {
        console.log('Eliminar el aula tecnología: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar esta inventario de tecnología?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=aulas_tecnologia",
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

    function crea_aula_cientifico() {
        ok = $('#form_aulas_cientifico').valida();
        if (ok.estado === true) {
            var data = new FormData();
            id_aula = $("#btn_aulas_cientifico").attr('data-aulas');
            data.append('nombre_cien', $("#nombre_cien").val());
            data.append('elemento_cien', $("#elemento_cien").val());
            data.append('cantidad_cien', $("#cantidad_cien").val());
            data.append('fkID_aula', id_aula);
            data.append('tipo', "crear_cientifico");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
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

    function edita_aula_cientifico() {
        ok = $('#form_aulas_cientifico').valida();
        if (ok.estado === true) {
            var data = new FormData();
            data.append('pkID', $("#pkID").val());
            id_aula = $("#btn_aulas_cientifico").attr('data-aulas');
            data.append('nombre_cien', $("#nombre_cien").val());
            data.append('elemento_cien', $("#elemento_cien").val());
            data.append('cantidad_cien', $("#cantidad_cien").val());
            data.append('fkID_aula', id_aula);
            data.append('tipo', "editar_cientifico");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
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

    function carga_aulas_cientifico(id_funciona) {
        console.log("Carga el aulas " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=aulas_cientifico",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                $("#" + key).val(value);
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function elimina_aulas_cientifico(id_funciona) {
        console.log('Eliminar el aula Cientifico: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar esta inventario Cientifico?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=aulas_cientifico",
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

    function crea_aula_wifi() {
        ok = $('#form_aulas_wifi').valida();
        if (ok.estado === true) {
            var data = new FormData();
            id_aula = $("#btn_aulas_wifi").attr('data-aulas');
            data.append('nombre_wifi', $("#nombre_wifi").val());
            data.append('elemento_wifi', $("#elemento_wifi").val());
            data.append('cantidad_wifi', $("#cantidad_wifi").val());
            data.append('fkID_aula', id_aula);
            data.append('tipo', "crear_wifi");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
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

    function edita_aula_wifi() {
        ok = $('#form_aulas_wifi').valida();
        if (ok.estado === true) {
            var data = new FormData();
            data.append('pkID', $("#pkID").val());
            id_aula = $("#btn_aulas_wifi").attr('data-aulas');
            data.append('nombre_wifi', $("#nombre_wifi").val());
            data.append('elemento_wifi', $("#elemento_wifi").val());
            data.append('cantidad_wifi', $("#cantidad_wifi").val());
            data.append('fkID_aula', id_aula);
            data.append('tipo', "editar_wifi");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
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

    function carga_aulas_wifi(id_funciona) {
        console.log("Carga el aulas " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=aulas_wifi",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                $("#" + key).val(value);
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function elimina_aulas_wifi(id_funciona) {
        console.log('Eliminar el aula Cientifico: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar esta inventario WIFI?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=aulas_wifi",
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

    function cargar_input_lista() {
        $("#form_aulas_actas").append('<div class="form-group" id="adjunto_lista">' + '<label for="adjunto" id="lbl_url_lista" class=" control-label">Adjuntar Acta</label>' + '<input type="file" class="form-control" id="url_lista" name="url_lista" placeholder="Lista de asistencia del sesion de formación">' + '</div>')
    }

    function crea_acta() {
        ok = $('#form_aulas_actas').valida();
        if (ok.estado === true) {
            var data = new FormData();
            id_aula = $("#btn_aulas_actas").attr('data-aula');
            data.append('fecha_acta', $("#fecha_acta").val());
            data.append('descripcion_acta', $("#descripcion_acta").val());
            if (document.getElementById("url_lista").files.length) {
                data.append('file', $("#url_lista").get(0).files[0]);
            }
            data.append('fkID_aula', id_aula);
            data.append('tipo', "crear_acta");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });
        } else {
            alert('Faltan campos por llenar :(');
        }
    }

    function carga_acta(id_acta) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_acta + "&tipo=consultar&nom_tabla=aulas_acta",
        }).done(function(data) {
            console.log(data)
            $.each(data.mensaje[0], function(key, valu) {
                if (key == "url_lista" && valu != "") {
                    $("#form_aulas_actas").append('<div id="adjunto_lista" class="form-group">' + '<label for="lista" id="lbl_pkID_archivo_lista" name="lbl_pkID_archivo_lista" class="custom-control-label">Lista de asistencia</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkid_acta" name="btn_Rmtaller_documento" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmsesion_lista" id="btn_actionRmsesion_lista" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_lista").remove();
                    $("#url_lista").remove();
                    $("[name*='btn_actionRmsesion_lista']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_lista(id_archivo);
                    });
                } else {
                    if (key == "url_lista") {
                        cargar_input_lista();
                    } else {
                        $("#" + key).val(valu);
                    }
                }
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function edita_acta() {
        ok = $('#form_aulas_actas').valida();
        if (ok.estado === true) {
            var data = new FormData();
            data.append('pkID', $("#pkID").val());
            data.append('fkID_acta', $("#fkID_acta").val());
            data.append('fecha_acta', $("#fecha_acta").val());
            data.append('descripcion_acta', $("#descripcion_acta").val());
            if (document.getElementById("url_lista")) {
                data.append('file', $("#url_lista").get(0).files[0]);
            }
            data.append('tipo', "editar_acta");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });
        } else {
            alert('Faltan campos por llenar :(');
        }
    }

    function elimina_archivo_lista(id_archivo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar el archivo?");
        console.log(confirma);
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            data.append('tipo', "eliminarlista");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxaulas.php',
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

    function elimina_aulas_acta(id_funciona) {
        console.log('Eliminar el aula acta ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar esta acta?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=aulas_acta",
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