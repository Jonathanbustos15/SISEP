$(function() {
    var arrParticipante = [];
    var arrParticipantes = [];
    var arrParticipantesasignados = []
    var arrEstado = [];

    $("#btn_asignarparticipante").click(function() {
        $("#lbl_form_asignarparticipante").html("Asignar participante");
        $("#lbl_btn_actionasignarparticipante").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionasignarparticipante").attr("data-action", "asignar");
        $("#form_asignarparticipante")[0].reset();
        $("#frm_participante_acompanante").html("");
    });

    $("#btn_asignarasistencia").click(function() {
        $("#lbl_form_asistencia").html("Crear asistencia");
        $("#lbl_btn_actionasistencia").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionasistencia").attr("data-action", "asistencia");
        $("#form_asistencia")[0].reset();
        $("#frm_participante_acompanante").html("");
        $("#pdf_asistencia").remove();
        cargar_input_asistencia();
    });
    $("[name*='edita_compaasistencia']").click(function() {
        $("#lbl_form_asistencia").html("editar asistencia");
        $("#lbl_btn_actionasistencia").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionasistencia").attr("data-action", "editar");
        $("#form_asistencia")[0].reset();
        $("#pdf_asistencia").remove();
        id = $(this).attr('data-id-asistencia');
        cargar_input_asistencia();
        carga_asistencia(id);
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionparticipante").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("#btn_actionasistencia").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("#btn_actionasignarparticipante").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='elimina_participantes_acompaniamiento']").click(function(event) {
        id_estudian = $(this).attr('data-id-participantes_acompaniamiento');
        console.log(id_estudian)
        deleteParticiNumReg(id_estudian);
    });
    sessionStorage.setItem("id_tab_participante", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "asistencia") {
            crea_asistencia();
        } else if (action === "asignar") {
            guardar();
            console.log("");
            console.log("");
            console.log("");
            asigna_participante();
        } else if (action === "editar") {
            edita_asistencia();
        }
    };

    function asigna_participante() {
        location.reload();
    }

    function edita_asistencia() {
        var data = new FormData();
        if ($("#url_asistencia").length) {
            if (document.getElementById("url_asistencia").files.length) {
            data.append('file', $("#url_asistencia").get(0).files[0]);
        }
        }
            data.append('fecha_acompanamiento_asistencia', $("#fecha_acompanamiento_asistencia").val());
            data.append('tipo', "editarasistencia");
            data.append('pkID', $("#pkID").val());
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

    function guardar() {
        $.each(arrParticipante, function(llave, valor) {
            console.log("llave=" + llave + " valor=" + valor);
            id = $("#btn_asignarparticipante").attr('data-acompanamiento');
            estado = arrEstado[llave];
            data = "fkID_acompanamiento=" + id + "&fkID_docente=" + valor + "&fkID_estado=" + estado;
            $.ajax({
                url: "../controller/ajaxController12.php",
                data: data + "&tipo=inserta&nom_tabla=acompanamiento_docente",
            }).done(function(data) {
                console.log(data);
            }).fail(function(data) {
                console.log(data);
            }).always(function() {
                console.log("complete");
            });
        });
    }

    function crea_asistencia() {
        var data = new FormData();
        if (document.getElementById("url_asistencia").files.length) {
            data.append('file', $("#url_asistencia").get(0).files[0]);
        }
            data.append('fecha_acompanamiento_asistencia', $("#fecha_acompanamiento_asistencia").val());
            data.append('fkID_acompanamiento', $("#fkID_acompanamiento").val());
            data.append('tipo', "crearasistencia");
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
    $("#fkID_docente").change(function(event) {
        estado = valida_estado();
        if (estado == false) {
            alert('Seleccione un estado');  
            $("#fkID_docente").val('');
            $("#fkID_estado").focus();
        } else {
            idDocente = $(this).val();
            nomDocente = $(this).find("option:selected").data('nombre')
            idEstado = $("#fkID_estado").val();
            nomEstado = $("#fkID_estado").find("option:selected").data('nombre')
            console.log(idEstado);
            console.log(nomEstado);
            if (verPkIdTutor()) {
                if (document.getElementById("fkID_paricipante_form_" + idDocente)) {
                    console.log(document.getElementById("fkID_participante_form_" + idDocente));
                    console.log("Este participante ya fue seleccionado.");
                } else {
                    arrParticipante.length = 0;
                    selectParticipante(idEstado, nomEstado, idDocente, nomDocente, 'select', $(this).data('accion'));
                    serializa_array(crea_array(arrParticipante, $("#pkID").val(), fecha));
                }
            } else {
                selectParticipante(idEstado, nomEstado, idDocente, nomDocente, 'select', $(this).data('accion'));
            };
        }
    });

    function valida_estado() {
        if ($("#fkID_estado").val() == '') {
            return false;
        } else {
            return true;
        }
    }

    function crea_array(array, id_grupo, fecha) {
        console.log("no te vallas chavito")
        console.log(array)
        array.forEach(function(element, index) {
            //statements
            var obtHE = {
                "fkID_saber_propio": id_grupo,
                "fkID_estudiante": element
            };
            arrParticipantesasignados.push(obtHE);
            console.log(obtHE);
        });
        return arrParticipantesasignados;
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

    function selectParticipante(idEstado, nomEstado, idDocente, nomDocente, type, numReg) {
        console.log(idEstado)
        if (idEstado != "") {
            if (document.getElementById("fkID_participante_form_" + idDocente)) {
                alert("Este participante ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_participante_acompanamiento").append('<div class="form-group" id="frm_group' + idDocente + '">' + '<input type="text" style="width: 45%;display: inline;" class="form-control" id="fkID_estado_form_' + idEstado + '" name="fkID_estado" value="' + nomEstado + '" readonly="true">' + '<input type="text" style="width: 45%;display: inline;" class="form-control" id="fkID_participante_form_' + idDocente + '" name="fkID_docente" value="' + nomDocente + '" readonly="true"><button name="btn_actionRmUsuario_' + idDocente + '"  data-id-frm-group="frm_group' + idDocente + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                    $("#frm_participante_acompanamiento").append('<div class="form-group" id="frm_group' + idDocente + '">' + '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_participante_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" data-numReg = "' + numReg + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                }
                $("[name*='btn_actionRmUsuario_" + idDocente + "']").click(function(event) {
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
                    //deleteParticiNumReg(numReg);
                });
                arrParticipante.push(idDocente);
                console.log(arrParticipante);
                arrEstado.push(idEstado);
                console.log(arrEstado);
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

    function carga_asistencia(id_asistencia) {
        console.log("Carga la asistencia " + id_asistencia);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_asistencia + "&tipo=consultar&nom_tabla=acompanamiento_asistencia",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                if (key == "url_asistencia" && value != "") {
                    $("#pdf_asistencia").append('<div id="pdf_asiste" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Asistencia</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmAsistencia" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmAsistencia" id="btn_actionRmAsistencia" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_asistencia").remove();
                    $("#url_asistencia").remove();
                    $("[name*='btn_actionRmAsistencia']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_asistencias(id_archivo);
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

    function deleteParticiNumReg(numReg) {
        console.log("vamos por aqui")
        var confirma = confirm("En realidad quiere eliminar la asignación del docente?");
        console.log(confirma);
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + numReg + "&tipo=eliminar&nom_tabla=acompanamiento_docente",
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
    //Función para cargar varios archivos

    function cargar_input_asistencia() {
        $("#form_asistencia").append('<div class="form-group" id="pdf_asistencia">' + '<label for="adjunto" id="lbl_url_asistencia" class=" control-label">Asistencia</label>' + '<input type="file" class="form-control" id="url_asistencia" name="asistencia" required = "true">' + '</div>')
    }

    function elimina_archivo_asistencias(id_archivo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar este archivo de Asistencia?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            data.append('tipo', "eliminarasistencia");
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
});