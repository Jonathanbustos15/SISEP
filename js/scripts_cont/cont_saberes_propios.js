 $(function() {
    //https://github.com/jsmorales/jquery_controllerV2
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    var arrTutor = [];
    var arrTutoresgrupos = [];
    var arrDocente = [];
    var arrDocentesgrupos = [];
    $("#btn_nuevosaber").click(function() {
        $("#lbl_form_saber").html("Nuevo Saber Propio");
        $("#lbl_btn_actionsaberes").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionsaberes").attr("data-action", "crear");
        $("#fileupload_lista").val("");
        $("#form_saber")[0].reset();
        $("#adjunto_saber").remove();
     	$("#adjunto_saber2").remove();
     	cargar_input();
    });
    $("[name*='edita_saber_propio']").click(function() {
        $("#lbl_form_saber").html("Edita Saber Propio");
        $("#lbl_btn_actionsaberes").html("Guardar Cambios<span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionsaberes").attr("data-action", "editar");
        $("#fileupload_lista").val("");
        $("#form_saber")[0].reset();
        $("#adjunto_saber").remove();
     	$("#adjunto_saber2").remove();
        id_saber = $(this).attr('data-id-saber_propio');
        cargar_input();
        console.log(id_saber);
        carga_saber(id_saber);
    });

    $("#btn_actionsaberes").click(function() {
        var validacioncon = validarsaber();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    	}
    });
    
    $("[name*='elimina_saber_propio']").click(function(event) {
        id_saberes = $(this).attr('data-id-saber_propio');
        console.log(id_saberes)
        elimina_saberes(id_saberes);
    });
    $("#fkID_tutor").change(function(event) {
        fecha = $("#fecha_creacion").val();
        idUsuario = $(this).val();
        nomUsuario = $(this).find("option:selected").data('nombre')
        console.log(nomUsuario);
        if (verPkIdTutor()) {
            if (document.getElementById("fkID_tutor_form_" + idUsuario)) {
                console.log(document.getElementById("fkID_tutor_form_" + idUsuario));
                console.log("Este usuario ya fue seleccionado.");
            } else {
                arrTutor.length = 0;
                console.log("este usuario es chavito")
                selectTutor(idUsuario, nomUsuario, 'select', $(this).data('accion'));
                serializa_array(crea_array(arrTutor, $("#pkID").val(), fecha));
            }
        } else {
            selectTutor(idUsuario, nomUsuario, 'select', $(this).data('accion'));
        };
    });

    function verPkIdTutor() {
        var id_proyecto_form = $("#pkID").val();
        if (id_proyecto_form != "") {
            return true;
        } else {
            return false;
        }
    };

    function selectTutor(id, nombre, type, numReg) {
        console.log(id)
        console.log("ya vamos aca ")
        if (id != "") {
            if (document.getElementById("fkID_tutor_form_" + id)) {
                console.log("Este usuario ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_tutor_grupo").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 93%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                    $("#frm_tutor_grupo").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" data-numReg = "' + numReg + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                }
                $("[name*='btn_actionRmUsuario_" + id + "']").click(function(event) {
                    console.log('click remover usuario ' + $(this).data('id-frm-group'));
                    removeUsuario($(this).data('id-frm-group'));
                    //buscar el indice
                    var idUsuario = $(this).attr("data-id-tutor");
                    console.log('el elemento es:' + idUsuario);
                    var indexArr = arrTutor.indexOf(idUsuario);
                    console.log("El indice encontrado es:" + indexArr);
                    //quitar del array
                    if (indexArr >= 0) {
                        arrTutor.splice(indexArr, 1);
                        console.log(arrTutor);
                    } else {
                        console.log('salio menor a 0');
                        console.log(arrTutor);
                    }
                    deleteTutorNumReg(numReg);
                });
                arrTutor.push(id);
                console.log(arrTutor);
            }
        } else {
            alert("No se seleccionó ningún usuario.")
        }
    };

    function crea_array(array, id_saber, fecha) {
        console.log("no te vallas chavito")
        console.log(array)
        array.forEach(function(element, index) {
            //statements
            var obtHE = {
                "fkid_saber": id_saber,
                "fkID_tutor": element
            };
            arrTutoresgrupos.push(obtHE);
            console.log(obtHE);
        });
        return arrTutoresgrupos;
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
        if ($("#fkID_tutor").attr('data-accion') == 'load') {
            console.log("Se ha agregado el usuario correctamente.")
        }
    }

    function cargar_input(){
      $("#form_saber").append('<div class="form-group" id="adjunto_saber">'+
                        '<label for="adjunto" id="lbl_url_saber" class=" control-label">Lista de asistencia</label>'+ 
                        '<input type="file" class="form-control" id="fileupload_lista" name="fileupload_lista" placeholder="Lista de asistencia de saberes propios" required = "">'+
                    '</div>')
    }

    function carga_saber(id_saber) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_saber + "&tipo=consultar&nom_tabla=saber_propio",
        }).done(function(data) {
            /**/
            $.each(data.mensaje[0], function(key, valu) {
                if (key=="url_lista" && valu != "") { 
                  $("#form_saber").append('<div id="adjunto_saber2" class="form-group">'+'<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Lista de asistencia</label>'+'<br>'+'<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_RmFuncionario" value="' + valu + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../server/php/files/' + valu + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmSaber" id="btn_actionRmSaber" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                  $("#lbl_url_saber").remove();
                  $("#fileupload_lista").remove(); 
                  $("[name*='btn_actionRmSaber']").click(function(event) {
                    var id_archivo = $("#pkID").val();
                    console.log("este es el numero"+id_archivo);
                    elimina_archivo_saber(id_archivo); 
                });         
                 }else{
                $("#" + key).val(valu);
              }
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function crear_saber_propio() {
        if (document.getElementById("fileupload_lista").files.length) {
            var data = new FormData();
            data.append('file', $("#fileupload_lista").get(0).files[0]);
            data.append('fecha_salida', $("#fecha_salida").val());
            data.append('fkID_grupo', $("#fkID_grupo option:selected").val());
            data.append('comunidad_visitada', $("#comunidad_visitada").val());
            data.append('fkID_asesor', $("#fkID_asesor option:selected").val());
            data.append('tipo', "crear");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxsaberes.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                	console.log(a);
                    var tipo = JSON.parse(a);
                    location.reload();
                }
            })
        } else {
            var data = new FormData();
            data.append('fecha_salida', $("#fecha_salida").val());
            data.append('fkID_grupo', $("#fkID_grupo option:selected").val());
            data.append('comunidad_visitada', $("#comunidad_visitada").val());
            data.append('fkID_asesor', $("#fkID_asesor option:selected").val());
            data.append('tipo', "crearsin");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxsaberes.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                	console.log(a)
                    var tipo = JSON.parse(a);
                    location.reload();
                }
            })
        }
    }

    function edita_saberes() {
        if ($("#fileupload_lista").length) {
        	if (document.getElementById("fileupload_lista").files.length) {
        		var data = new FormData();
            data.append('file', $("#fileupload_lista").get(0).files[0]);
            data.append('fecha_salida', $("#fecha_salida").val());
            data.append('fkID_grupo', $("#fkID_grupo option:selected").val());
            data.append('comunidad_visitada', $("#comunidad_visitada").val());
            data.append('fkID_asesor', $("#fkID_asesor option:selected").val());
            data.append('tipo', "editar");
            data.append('pkID', $("#pkID").val());
            $.ajax({
                type: "POST",
                url: "../controller/ajaxsaberes.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })
        	} else {
        		var data = new FormData();
            data.append('fecha_salida', $("#fecha_salida").val());
            data.append('fkID_grupo', $("#fkID_grupo option:selected").val());
            data.append('comunidad_visitada', $("#comunidad_visitada").val());
            data.append('fkID_asesor', $("#fkID_asesor option:selected").val());
            data.append('tipo', "editarsin");
            data.append('pkID', $("#pkID").val());
            $.ajax({
                type: "POST",  
                url: "../controller/ajaxsaberes.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })
        	}
            
        } else {
            var data = new FormData();
            data.append('fecha_salida', $("#fecha_salida").val());
            data.append('fkID_grupo', $("#fkID_grupo option:selected").val());
            data.append('comunidad_visitada', $("#comunidad_visitada").val());
            data.append('fkID_asesor', $("#fkID_asesor option:selected").val());
            data.append('tipo', "editarsin");
            data.append('pkID', $("#pkID").val());
            $.ajax({
                type: "POST",  
                url: "../controller/ajaxsaberes.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    location.reload();
                }
            })
        }
    }

    function elimina_saberes(id_saber) {
        var confirma = confirm("En realidad quiere eliminar este Saber Propio?");
        console.log(confirma);
        if (confirma == true) {
        	var data = new FormData();
        	data.append('fecha_salida', $("#fecha_salida").val());
            data.append('fkID_grupo', $("#fkID_grupo option:selected").val());
            data.append('comunidad_visitada', $("#comunidad_visitada").val());
            data.append('fkID_asesor', $("#fkID_asesor option:selected").val());
        	data.append('tipo', "eliminarlogico");
            data.append('pkID', $("#pkID").val());
            $.ajax({
            	type: "POST",
                url: '../controller/ajaxsaberes.php',  
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

    function validarsaber(){
      var fecha = $("#fecha_salida").val();
      var grupo = $("#fkID_grupo option:selected").val();
      var comunidad = $("#comunidad_visitada").val();
      var asesor = $("#fkID_asesor option:selected").val();
        var respuesta;
        if (fecha === "" || grupo === "" || comunidad === "" || asesor === "") {
            respuesta = "no"
            return respuesta
        }else{
            respuesta = "ok"
            return respuesta
        }
    }

    function deleteDocenteNumReg(numReg) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + numReg + "&tipo=eliminarlogico&nom_tabla=docente_grupo",
        }).done(function(data) {
            console.log(data);
            alert(data.mensaje.mensaje);
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }

    function deleteTutorNumReg(numReg) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + numReg + "&tipo=eliminarlogico&nom_tabla=funcionario_grupo",
        }).done(function(data) {
            console.log(data);
            alert(data.mensaje.mensaje);
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete"); 
        });
    }

    function removeUsuario(id) {
        $("#" + id).remove();
    }
    sessionStorage.setItem("id_tab_grupo", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crear_saber_propio();
        } else if (action === "editar") {
            edita_saberes();
        };
    };

    function elimina_archivo_saber(id_archivo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar la lista de asistencia?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID',id_archivo);
            data.append('tipo',"eliminararchivo");
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxsaberes.php',
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