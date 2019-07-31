$(function() {
    var arrParticipante = [];
    var arrGrado = [];
    $("#btn_nuevosesion").click(function() {
        $("#lbl_form_sesion").html("Crear sesion");
        $("#lbl_btn_actionsesion").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionsesion").attr("data-action", "crear");
        $("#btn_actionsesion").removeAttr('disabled', 'disabled');
        $("#form_sesion")[0].reset();
        $("#adjunto_lista2").remove();
        $("#adjunto_lista").remove();
        cargar_input_lista();
    });
    $("#btn_asignarparticipante").click(function() {
        $("#lbl_form_asignarparticipante").html("Asignar Participante");
        $("#lbl_btn_actionasignarparticipante").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionasignarparticipante").attr("data-action", "asignar");
        $("#btn_actionasignarparticipante").removeAttr('disabled', 'disabled');
        $("#form_asignarparticipante")[0].reset();
    });
    $("#btn_actionasignarparticipante").click(function() {
        action = $(this).attr("data-action");
        guardar();
        console.log("accion a ejecutar: " + action);
        asigna_participante();
    });
    $("#btn_actionsesion").click(function() {
        var validacioncon = validarsesion();
        if (validacioncon === "no") {
            window.alert("Falta campos por llenar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_sesion']").click(function(event) {
        $("#lbl_form_sesion").html("Editar Registro sesion");
        $("#lbl_btn_actionsesion").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionsesion").attr("data-action", "editar");
        $("#btn_actionsesion").removeAttr('disabled', 'disabled');
        $("#form_sesion")[0].reset();
        id_sesion = $(this).attr('data-id-sesion');
        $("#adjunto_lista2").remove();
        $("#adjunto_lista").remove();
        console.log(id_sesion)
        cargar_input_lista();
        carga_sesion(id_sesion);
    });
    $("[name*='elimina_asignar_participante']").click(function(event) {
        id_partici = $(this).attr('data-id-asignar_participante');
        console.log(id_partici)
        elimina_asignacionparticipante(id_partici);
    });
    $("[name*='elimina_sesion']").click(function(event) {
        id_sesion = $(this).attr('data-id-sesion');
        elimina_sesion(id_sesion);
    });
    $("#fkID_participante").change(function(event) {
        grupo = $("#btn_asignarparticipante").attr("data-taller");
        idUsuario = $(this).val();
        validaEqualParticipante(grupo, idUsuario);
        nomUsuario = $(this).find("option:selected").data('nombre')
        idGrado = $(this).find("option:selected").data('grado')
        console.log(nomUsuario);
        console.log(idGrado);
        if (verPkIdParticipante()) {
            if (document.getElementById("fkID_participante_form_" + idUsuario)) {
                console.log(document.getElementById("fkID_participante_form_" + idUsuario));
                console.log("Este usuario ya fue seleccionado.");
            } else {
                arrParticipante.length = 0;
                console.log("este usuario es chavito")
                selectParticipante(idUsuario, nomUsuario, idGrado, 'select', $(this).data('accion'));
                serializa_array(crea_array(arrParticipante, $("#pkID").val(), fecha));
            }
        } else {
            selectParticipante(idUsuario, nomUsuario, idGrado, 'select', $(this).data('accion'));
        };
    });

    function asigna_participante() {
        location.reload();
    }

    function selectParticipante(id, nombre, grado, type, numReg) {
        console.log(nombre + "este es")
        console.log(id)
        if (id != "") {
            if (document.getElementById("fkID_usuario_form_" + id)) {
                console.log("Este usuario ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_participante_taller").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 93%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                    $("#frm_participante_taller").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" data-numReg = "' + numReg + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                }
                $("[name*='btn_actionRmUsuario_" + id + "']").click(function(event) {
                    console.log('click remover usuario ' + $(this).data('id-frm-group'));
                    removeUsuario($(this).data('id-frm-group'));
                    //buscar el indice
                    var idUsuario = $(this).attr("data-id-tutor");
                    console.log('el elemento es:' + idUsuario);
                    var indexArr = arrParticipante.indexOf(idUsuario);
                    console.log("El indice encontrado es:" + indexArr);
                    //quitar del array
                    if (indexArr >= 0) {
                        arrParticipante.splice(indexArr, 1);
                        console.log(arrParticipante);
                    } else {
                        console.log('salio menor a 0');
                        console.log(arrParticipante);
                    }
                });
                arrParticipante.push(id);
                console.log(arrParticipante);
            }
        } else {
            alert("No se seleccionó ningún usuario.")
        }
    };

    function validarsesion() {
        var fecha = $("#fecha_sesion").val();
        var descripcion = $("#descripcion_sesion").val();
        var respuesta;
        if (fecha === "" || descripcion === "") {
            respuesta = "no"
            return respuesta
        } else {
            respuesta = "ok"
            return respuesta
        }
    }

    function guardar() {
        $.each(arrParticipante, function(llave, valor) {
            console.log("llave=" + llave + " valor=" + valor);
            id = $("#btn_asignarparticipante").attr('data-taller');
            data = "fkID_taller_formacion=" + id + "&fkID_participante=" + valor;
            $.ajax({
                url: "../controller/ajaxController12.php",
                data: data + "&tipo=inserta&nom_tabla=participante_taller",
            }).done(function(data) {
                console.log(data);
            }).fail(function(data) {
                console.log(data);
            }).always(function() {
                console.log("complete");
            });
        });
    }
    //--------------------------------------------------------
    sessionStorage.setItem("id_tab_sesion", null);

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
        data.append('tipo', "crearsesion");
        console.log('Datos serializados: ' + data);
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

    function cargar_input_lista() {
        $("#form_sesion").append('<div class="form-group" id="adjunto_lista">' + '<label for="adjunto" id="lbl_url_lista" class=" control-label">Adjuntar Lista</label>' + '<input type="file" class="form-control" id="url_lista" name="url_lista" placeholder="Lista de asistencia del sesion de formación" required = "">' + '</div>')
    }

    function carga_sesion(id_sesion) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_sesion + "&tipo=consultar&nom_tabla=sesion_taller",
        }).done(function(data) {
            console.log(data)
            $.each(data.mensaje[0], function(key, valu) {
                if (key == "url_lista" && valu != "") {
                    $("#form_sesion").append('<div id="adjunto_lista2" class="form-group">' + '<label for="lista" id="lbl_pkID_archivo_lista" name="lbl_pkID_archivo_lista" class="custom-control-label">Lista de asistencia</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_sesion name="btn_Rmtaller_documento" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmsesion_lista" id="btn_actionRmsesion_lista" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
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

    function editar_sesion() {
        var data = new FormData();
        data.append('fecha_sesion', $("#fecha_sesion").val());
        data.append('descripcion', $("#descripcion_sesion").val());
        if ($("#url_lista").length) {
            if (document.getElementById("url_lista").files.length) {
                data.append('file2', $("#url_lista").get(0).files[0]);
            }
        }
        data.append('tipo', "editarsesion");
        data.append('fkID_taller_formacion', $("#fkID_taller_formacion").val());
        data.append('pkID', $("#pkID").val());
        console.log('Datos serializados: ' + data);
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
            data.append('pkID', id);
            data.append('tipo', "eliminarlogicos");
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
            data.append('pkID', id_archivo);
            data.append('tipo', "eliminarlista");
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

    function verPkIdParticipante() {
        var id_proyecto_form = $("#pkID").val();
        if (id_proyecto_form != "") {
            return true;
        } else {
            return false;
        }
    };

    function removeUsuario(id) {
        $("#" + id).remove();
    }

    function elimina_asignacionparticipante(id_partici) {
        console.log('Eliminar el participante: ' + id_partici);
        var confirma = confirm("En realidad quiere eliminar esta Asignación?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxparticipante.php',
                data: "pkID=" + id_partici + "&tipo=eliminarasignacion",
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
    $("#fecha_sesion").change(function(event) {
        var descripcion = $("#descripcion_sesion").val();
        var date = $("#fecha_sesion").val();
        validaEqualIdentifica(descripcion, date);
    });
    $("#descripcion_sesion").change(function(event) {
        var descripcion = $("#descripcion_sesion").val();
        var date = $("#fecha_sesion").val();
        validaEqualIdentifica(descripcion, date);
    });

    function validaEqualIdentifica(descripcion, date) {
        console.log("busca valor " + encodeURI(date));
        var consEqual = "SELECT COUNT(*) as res_equal FROM sesion_taller WHERE estadoV=1  and descripcion_sesion='" + descripcion + "' and fecha_sesion='" + date + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("Esta Sesion ya existe, por favor ingrese una Sesion diferente.");
                $("#descripcion_sesion").val("");
                $("#fecha_sesion").val("");
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }

    function validaEqualParticipante(cod, num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM participante_taller where`fkID_taller_formacion` ='" + cod + "' and fkID_participante= '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
            success: function(data) {
                if (data.mensaje[0].res_equal > 0) {
                    alert("El Participante ya esta asignado a este taller, por favor ingrese otro participante.");
                    removeUsuario("frm_group" + num_id);
                    $("#fkID_participante").val("");
                } else {}
            }
        })
    }
});