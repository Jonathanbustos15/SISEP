$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevoaulas").click(function() {
        $("#lbl_form_aulas").html("Nuevo Aula de Ciencia y Tecnología");
        $("#lbl_btn_actionaulas").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas").attr("data-action", "crear");
        $("#form_aulas")[0].reset();
        id = $("#btn_nuevoaulas").attr('data-proyecto');
        $("#fkID_proyecto_marco").val(id);
        $("#pdf_imagen").remove();
        cargar_input();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionaulas").click(function() {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='edita_aulas']").click(function() {
        $("#lbl_form_aulas").html("Edita Aula de Ciencia y Tecnología");
        $("#lbl_btn_actionaulas").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaulas").attr("data-action", "editar");
        $("#form_aulas")[0].reset();
        id = $(this).attr('data-id-aulas');
        console.log(id);
        carga_aulas(id);
    });
    $("[name*='elimina_aulas']").click(function(event) {
        id_funciona = $(this).attr('data-id-aulas');
        console.log(id_funciona)
        elimina_aulas(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_aulas", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_aulas();
        } else if (action === "editar") {
            edita_aulas();
        };
    };

    function cargar_input() {
        $("#div_imagen").append('<div class="form-group" id="pdf_imagen">' + '<label for="adjunto" id="lbl_url_saber" class=" control-label">Imagen</label>' + '<input type="file" class="form-control" id="url_imagen" name="url_imagen" placeholder="Lista de asistencia de saberes propios">' + '</div>')
    }

    function crea_aulas() {
        ok = $('#form_aulas').valida();
        if (ok.estado === true) {
            var data = new FormData();
            data.append('file', $("#url_imagen").get(0).files[0]);
            data.append('num_aula', $("#num_aula").val());
            data.append('fecha', $("#fecha").val());
            data.append('fkID_institucion', $("#fkID_institucion").val());
            data.append('descripcion', $("#descripcion").val());
            if ($('#zona_wifi').prop('checked')) {
                data.append('zona_wifi', "1");
            } else {
                data.append('zona_wifi', "0");
            }
            data.append('fecha_ini_wifi', $("#fecha_ini_wifi").val());
            data.append('fecha_fin_wifi', $("#fecha_fin_wifi").val());
            if ($('#internet').prop('checked')) {
                data.append('internet', "1");
            } else {
                data.append('internet', "0");
            }
            data.append('fecha_ini_internet', $("#fecha_ini_internet").val());
            data.append('fecha_fin_internet', $("#fecha_fin_internet").val());
            data.append('fkID_proyecto_marco', $("#fkID_proyecto_marco").val());
            data.append('tipo', "crear");
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

    function validaraulas() {
        var fecha = $("#fecha").val();
        var fkID_institucion = $("#fkID_institucion option:selected").val();
        var fkID_grado = $("#fkID_grado option:selected").val();
        var fkID_curso = $("#fkID_curso option:selected").val();
        var respuesta;
        if (fecha === "" || fkID_institucion === "" || fkID_grado === "" || fkID_curso === "") {
            respuesta = "no"
            return respuesta
        } else {
            respuesta = "ok"
            return respuesta
        }
    }

    function edita_aulas() {
        ok = $('#form_aulas').valida();
        if (ok.estado === true) {
            var data = new FormData();
            data.append('pkID', $("#pkID").val());
            if (document.getElementById("url_imagen")) {
                data.append('file', $("#url_imagen").get(0).files[0]);
            }
            data.append('num_aula', $("#num_aula").val());
            data.append('fecha', $("#fecha").val());
            data.append('fkID_institucion', $("#fkID_institucion").val());
            data.append('descripcion', $("#descripcion").val());
            if ($('#zona_wifi').prop('checked')) {
                data.append('zona_wifi', "1");
            } else {
                data.append('zona_wifi', "0");
            }
            data.append('fecha_ini_wifi', $("#fecha_ini_wifi").val());
            data.append('fecha_fin_wifi', $("#fecha_fin_wifi").val());
            if ($('#internet').prop('checked')) {
                data.append('internet', "1");
            } else {
                data.append('internet', "0");
            }
            data.append('fecha_ini_internet', $("#fecha_ini_internet").val());
            data.append('fecha_fin_internet', $("#fecha_fin_internet").val());
            data.append('fkID_proyecto_marco', $("#fkID_proyecto_marco").val());
            data.append('tipo', "editar");
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

    function carga_aulas(id_funciona) {
        console.log("Carga el aulas " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=aulas",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                if (key == "url_imagen" && value != "") {
                    $("#div_imagen").append('<div id="pdf_imagen" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Imagen</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_Rmaibd" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmadocumento" id="btn_actionRmadocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_imagen").remove();
                    $("#url_imagen").remove();
                    $("[name*='btn_actionRmadocumento']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_aulas(id_archivo, 'imagen');
                    });
                } else {
                    if (key == "url_imagen") {
                        cargar_input();
                    } else {
                        $("#" + key).val(value);
                    }
                }
                if (key == "zona_wifi" && value == "1") {
                    $("#zona_wifi").prop('checked', true);
                }
                if (key == "internet" && value == "1") {
                    $("#internet").prop('checked', true);
                }
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function elimina_aulas(id_funciona) {
        console.log('Eliminar el aulas: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este aulas?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=aulas",
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
    $("#fkID_grado").change(function(event) {
        carga_curso($(this).val(), "form_aulas");
        console.log($(this).val());
    });

    function carga_curso(pkID_grado, id_form) {
        var consulta_curso = "SELECT * FROM `curso` WHERE fkID_grado = " + pkID_grado;
        //---------------------------------------------------------------
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consulta_curso + "&tipo=consulta_gen",
        }).done(function(data) {
            console.log(data)
            /**/
            $("#" + id_form + " #fkID_curso").html('');
            if (data.mensaje != "No hay registros.") {
                $("#" + id_form + " #fkID_curso").append('<option></option>')
                $.each(data.mensaje, function(index, val) {
                    console.log(index + "--" + val)
                    console.log(val)
                    $("#" + id_form + " #fkID_curso").append('<option value="' + val.pkID + '">' + val.curso + '</option>')
                });
                $("#fkID_curso").click();
            };
        }).fail(function() {
            console.log("error");
            $("#" + id_form + " #fkID_curso").html('');
        }).always(function() {
            console.log("complete");
        });
        //---------------------------------------------------------------
    }
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevoaulas").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "aulas.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });

    function elimina_archivo_aulas(id_archivo, campo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar este archivo de aula?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            if (campo == 'imagen') {
                data.append('tipo', "eliminararchivoimagen");
            }
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
        } else {
            //no hace nada
        }
    };
});