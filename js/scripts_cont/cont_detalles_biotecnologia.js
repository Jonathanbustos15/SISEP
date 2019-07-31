$(function() {
    var arrEstudiante = [];
    var arrestudiantesasignados = []
    $("#btn_biotecnologia_estudiante").click(function() {
        $("#lbl_form_biotecnologia_estudiante").html("Asignar Estudiante");
        $("#lbl_btn_actionbiotecnologia_estudiante").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionbiotecnologia_estudiante").attr("data-action", "crear_estudiante");
        $("#form_biotecnologia_estudiante")[0].reset();
        $("#frm_estudiante_grupo").html("");
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionestudiante").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("#btn_actionbiotecnologia_estudiante").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='elimina_biotecnologia_estudiante']").click(function(event) {
        id_estudian = $(this).attr('data-id-biotecnologia_estudiante');
        console.log(id_estudian)
        deleteSaberNumReg(id_estudian);
    });
    sessionStorage.setItem("id_tab_estudiante", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear_estudiante") {
            crea_estudiante();
            recargar();
        } else if (action === "crear_sesion") {
            crea_sesion();
        } else if (action === "editar_sesion") {
            edita_sesion();
        }
    };

    function crea_estudiante() {
        $.each(arrEstudiante, function(llave, valor) {
            console.log("llave=" + llave + " valor=" + valor);
            id = $("#btn_biotecnologia_estudiante").attr('data-biotecnologia');
            data = "fkID_biotecnologia=" + id + "&fkID_estudiante=" + valor;
            $.ajax({
                url: "../controller/ajaxController12.php",
                data: data + "&tipo=inserta&nom_tabla=biotecnologia_estudiante",
            }).done(function(data) {
                console.log(data);
            }).fail(function(data) {
                console.log(data);
            }).always(function() {
                console.log("complete");
            });
        });
    }

    function crea_sesion() {
        ok = $('#form_biotecnologia_sesion').valida();
        if (ok.estado === true) {
            var data = new FormData();
            id_biotecnologia = $("#btn_nuevosesion").attr('data-biotecnologia');
            data.append('fecha_sesion', $("#fecha_sesion").val());
            data.append('descripcion_sesion', $("#descripcion_sesion").val());
            if (document.getElementById("url_lista").files.length) {
                data.append('file', $("#url_lista").get(0).files[0]);
            }
            data.append('fkID_biotecnologia', id_biotecnologia);
            data.append('tipo', "crear_sesion");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxbiotecnologia.php",
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

    function recargar() {
        location.reload();
    }
    //valida si existe el documento
    function validaEqualIdentifica(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `documento_estudiante` = '" + num_id + "'";
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
    $("#fkID_estudiante").change(function(event) {
        idUsuario = $(this).val();
        nomUsuario = $(this).find("option:selected").data('nombre')
        idGrado = $(this).find("option:selected").data('grado')
        console.log(nomUsuario);
        console.log(idGrado);
        if (verPkIdTutor()) {
            if (document.getElementById("fkID_estudiante_form_" + idUsuario)) {
                console.log(document.getElementById("fkID_estudiante_form_" + idUsuario));
                console.log("Este usuario ya fue seleccionado.");
            } else {
                arrEstudiante.length = 0;
                console.log("este usuario es chavito")
                selectEstudiante(idUsuario, nomUsuario, idGrado, 'select', $(this).data('accion'));
                serializa_array(crea_array(arrEstudiante, $("#pkID").val(), fecha));
            }
        } else {
            selectEstudiante(idUsuario, nomUsuario, 'select', $(this).data('accion'));
        };
    });

    function crea_array(array, id_grupo, fecha) {
        console.log("no te vallas chavito")
        console.log(array)
        array.forEach(function(element, index) {
            //statements
            var obtHE = {
                "fkID_saber_propio": id_grupo,
                "fkID_estudiante": element
            };
            arrestudiantesasignados.push(obtHE);
            console.log(obtHE);
        });
        return arrestudiantesasignados;
    }

    function serializa_array(array) {
        console.log("no te vallas chavito")
        console.log(array);
        var cadenaSerializa = "";
        $.each(array, function(index, val) {
            var dataCadena = "";
            $.each(val, function(llave, valor) {
                console.log("llave=" + llave + " valor=" + valor);
                dataCadena = dataCadena + llave + "=" + valor + "&";
            });
            dataCadena = dataCadena.substring(0, dataCadena.length - 1);
            console.log(dataCadena);
            insertatutgrupo(dataCadena)
        });
        console.log('Se terminó de insertar los usuarios!')
    }

    function insertatutgrupo(data) {
        $.ajax({
            url: "../controller/ajaxController12.php",
            data: data + "&tipo=inserta&nom_tabla=funcionario_grupo",
        }).done(function(data) {
            console.log(data);
        }).fail(function(data) {
            console.log(data);
        }).always(function() {
            console.log("complete");
        });
    }

    function selectEstudiante(id, nombre, type, numReg) {
        console.log(id)
        console.log("ya vamos aca ")
        if (id != "") {
            if (document.getElementById("fkID_estudiante_form_" + id)) {
                console.log("Este usuario ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_estudiante_grupo").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 93%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                    $("#frm_estudiante_grupo").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" data-numReg = "' + numReg + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                }
                $("[name*='btn_actionRmUsuario_" + id + "']").click(function(event) {
                    console.log('click remover usuario ' + $(this).data('id-frm-group'));
                    removeUsuario($(this).data('id-frm-group'));
                    //buscar el indice
                    var idUsuario = $(this).attr("data-id-tutor");
                    console.log('el elemento es:' + idUsuario);
                    var indexArr = arrEstudiante.indexOf(idUsuario);
                    console.log("El indice encontrado es:" + indexArr);
                    //quitar del array
                    if (indexArr >= 0) {
                        arrEstudiante.splice(indexArr, 1);
                        console.log(arrEstudiante);
                    } else {
                        console.log('salio menor a 0');
                        console.log(arrEstudiante);
                    }
                    //deleteSaberNumReg(numReg);
                });
                arrEstudiante.push(id);
                console.log(arrEstudiante);
            }
        } else {
            alert("No se seleccionó ningún usuario.")
        }
    };

    function removeUsuario(id) {
        $("#" + id).remove();
    }

    function verPkIdTutor() {
        var id_proyecto_form = $("#pkID").val();
        if (id_proyecto_form != "") {
            return true;
        } else {
            return false;
        }
    };

    function deleteSaberNumReg(numReg) {
        var confirma = confirm("En realidad quiere eliminar la asignación del estudiante?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + numReg + "&tipo=eliminar_logico&nom_tabla=biotecnologia_estudiante",
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

    function deleteSesionNumReg(numReg) {
        var confirma = confirm("En realidad quiere eliminar la sesión?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + numReg + "&tipo=eliminar_logico&nom_tabla=biotecnologia_sesion",
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
    $("#btn_nuevosesion").click(function() {
        $("#lbl_form_biotecnologia_sesion").html("Crear sesion");
        $("#lbl_btn_actionsesion").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionsesion").attr("data-action", "crear_sesion");
        $("#btn_actionsesion").removeAttr('disabled', 'disabled');
        $("#form_biotecnologia_sesion")[0].reset();
        $("#adjunto_lista").remove();
        cargar_input_lista();
    });

    function cargar_input_lista() {
        $("#form_biotecnologia_sesion").append('<div class="form-group" id="adjunto_lista">' + '<label for="adjunto" id="lbl_url_lista" class=" control-label">Adjuntar Lista</label>' + '<input type="file" class="form-control" id="url_lista" name="url_lista" placeholder="Lista de asistencia del sesion de formación">' + '</div>')
    }
    $("#btn_actionsesion").click(function() {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='edita_sesion']").click(function(event) {
        $("#lbl_form_biotecnologia_sesion").html("Editar Registro sesion");
        $("#lbl_btn_actionsesion").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionsesion").attr("data-action", "editar_sesion");
        $("#btn_actionsesion").removeAttr('disabled', 'disabled');
        $("#form_biotecnologia_sesion")[0].reset();
        id_sesion = $(this).attr('data-id-sesion');
        $("#adjunto_lista").remove();
        console.log(id_sesion)
        cargar_input_lista();
        carga_sesion(id_sesion);
    });

    function carga_sesion(id_sesion) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_sesion + "&tipo=consultar&nom_tabla=biotecnologia_sesion",
        }).done(function(data) {
            console.log(data)
            $.each(data.mensaje[0], function(key, valu) {
                if (key == "url_lista" && valu != "") {
                    $("#form_biotecnologia_sesion").append('<div id="adjunto_lista" class="form-group">' + '<label for="lista" id="lbl_pkID_archivo_lista" name="lbl_pkID_archivo_lista" class="custom-control-label">Lista de asistencia</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_sesion" name="btn_Rmtaller_documento" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmsesion_lista" id="btn_actionRmsesion_lista" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_lista").remove();
                    $("#url_lista").remove();
                    $("[name*='btn_actionRmsesion_lista']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
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

    function edita_sesion() {
        ok = $('#form_biotecnologia_sesion').valida();
        if (ok.estado === true) {
            var data = new FormData();
            data.append('pkID', $("#pkID").val());
            data.append('fkID_biotecnologia', $("#fkID_biotecnologia").val());
            data.append('fecha_sesion', $("#fecha_sesion").val());
            data.append('descripcion_sesion', $("#descripcion_sesion").val());
            if (document.getElementById("url_lista")) {
                data.append('file', $("#url_lista").get(0).files[0]);
            }
            data.append('tipo', "editar_sesion");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxbiotecnologia.php",
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
        var confirma = confirm("En realidad quiere eliminar la sesión?");
        console.log(confirma);
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            data.append('tipo', "eliminarlista");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxbiotecnologia.php',
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
    $("[name*='elimina_sesion']").click(function(event) {
        id_sesion = $(this).attr('data-id-sesion');
        console.log(id_sesion)
        deleteSesionNumReg(id_sesion);
    });
});