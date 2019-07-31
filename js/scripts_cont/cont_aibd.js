$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevoaibd").click(function() {
        console.log('Entro a crear');
        $("#lbl_form_aibd").html("Nuevo AIBD(Aula de Investigación Basica Departamental)")
        $("#lbl_btn_actionaibd").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaibd").attr("data-action", "crear");
        $("#form_aibd")[0].reset();
        limpia_inputs();
        cargar_input_imagen();
    });

    $("#btn_nuevafoto").click(function() {
        $("#lbl_form_foto_aibd").html("Nuevas Fotos");
        $("#lbl_btn_actionfoto_aibd").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionfoto_aibd").attr("data-action", "crear");
        $("#form_foto_aibd")[0].reset();
    });

    $("#btn_actionfoto_aibd").click(function() {
        var validacioncon = validarfoto();
        if (validacioncon === "no") {  
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        //valida_actio(action);
        console.log("accion a ejecutar: " + action);
        crea_foto();
        }
    });

    $("[name*='elimina_foto']").click(function(event) {
        id_foto = $(this).attr('data-id-foto');
        console.log(id_foto)
        elimina_foto(id_foto);
    });

    function limpia_inputs() {
        $("#pdf_imagen").remove();
        $("#pdf_documento").remove();
        $("#pdf_informe").remove();
    }
    //Definir la acción del boton del formulario 
    $("#btn_actionaibd").click(function() {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='edita_aibd']").click(function() {
        $("#lbl_form_aibd").html("Edita AIBD(Aula de Investigación Basica Departamental)");
        $("#lbl_btn_actionaibd").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionaibd").attr("data-action", "editar");
        $("#form_aibd")[0].reset();
        id = $(this).attr('data-aibd');
        console.log(id);
        limpia_inputs();
        carga_aibd(id);
    });
    $("[name*='elimina_aibd']").click(function(event) {
        id_funciona = $(this).attr('data-id-aibd');
        console.log(id_funciona)
        elimina_aibd(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_aibd", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_aibd();
        } else if (action === "editar") {
            edita_aibd();
        };
    };

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_aibd").val('');
            $("#email_aibd").focus();
        } else {
            return true;
        }
    }
    $("#email_aibd").change(function(event) {
        validarEmail($(this).val())
    });

    function validarfoto(){
        if (document.getElementById("url_foto").files.length) {
            respuesta = "ok"
        }else{
            respuesta = "no"
        }
        return respuesta
    }

    function crea_foto() {  
         var data = new FormData($("#form_foto_aibd")[0]);
            data.append('tipo', "crear_foto");
            console.log(data)
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaibd.php", 
                data: data, 
                contentType: false,
                processData: false,
                success: function(a) {  
                    console.log(a);
                    var tipos = JSON.parse(a);
                    console.log(tipos);
                    for(x=0; x<tipos.length; x++) {
                console.log("nombre"+tipos[x]);
                }
                location.reload();
                }
            })  
    }

    function elimina_foto(id_foto) {
        var confirma = confirm("En realidad quiere eliminar esta Foto?");
        console.log(confirma);

        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_foto + "&tipo=eliminar_logico&nom_tabla=fotos_aibd",
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

    function validarextension(ext){
        if(ext != ".jpg" && ext != ".png" && ext != ".gif" && ext != ".jpeg") {
            window.alert("Solo se permiten formatos de imagen.");
            $("#form_foto_aibd")[0].reset();
        } else{
            console.log("ok")
        }  
    }

    function crea_aibd() {
        ok = $('#form_aibd').valida();
        if (ok.estado === true) {
            var data = new FormData();
            id_proyecto = $("#btn_nuevoaibd").attr('data-proyecto');
            data.append('file', $("#url_imagen").get(0).files[0]);
            data.append('fecha', $("#fecha").val());
            data.append('descripcion', $("#descripcion").val());
            data.append('fkID_proyecto_marco', id_proyecto);
            data.append('tipo', "crear");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaibd.php",
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

    function cargar_input_imagen() {
        $("#form_aibd").append('<div class="form-group" id="pdf_imagen">' + '<label for="adjunto" id="lbl_//imagen" class=" control-label">Imagen</label>' + '<input type="file" class="form-control" id="url_imagen" name="imagen" placeholder="Email del aibd" >' + '</div>')
    }

    function edita_aibd() {
        ok = $('#form_aibd').valida();
        if (ok.estado === true) {
            var data = new FormData();
            if (document.getElementById("url_imagen")) {
                data.append('file', $("#url_imagen").get(0).files[0]);
            }
            data.append('pkID', $("#pkID").val());
            data.append('fecha', $("#fecha").val());
            data.append('descripcion', $("#descripcion").val());
            data.append('fkID_proyecto_marco', $("#fkID_proyecto_marco").val());
            data.append('tipo', "editar");
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaibd.php",
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

    function carga_aibd(id_funciona) {
        console.log("Carga el aibd " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=aibd",
        }).done(function(data) {
            $.each(data.mensaje[0], function(key, value) {
                console.log(key + "--" + value);
                if (key == "url_imagen" && value != "") {
                    $("#form_aibd").append('<div id="pdf_imagen" class="form-group">' + '<label for="adjunto" id="lbl_pkID_archivo_" name="lbl_pkID_archivo_" class="custom-control-label">Imagen</label>' + '<br>' + '<input type="text" style="width: 89%;display: inline;" class="form-control" id="pkID_archivo" name="btn_Rmaibd" value="' + value + '" readonly="true"> <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" class="btn btn-success" href = "../vistas/subidas/' + value + '" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a><button name="btn_actionRmadocumento" id="btn_actionRmadocumento" data-id-contratos="1" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                    $("#lbl_url_imagen").remove();
                    $("#url_imagen").remove();
                    $("[name*='btn_actionRmadocumento']").click(function(event) {
                        var id_archivo = $("#pkID").val();
                        console.log("este es el numero" + id_archivo);
                        elimina_archivo_aibd(id_archivo, 'imagen');
                    });
                } else {
                    if (key == "url_imagen") {
                        cargar_input_imagen();
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

    function elimina_aibd(id_funciona) {
        console.log('Eliminar el acompañamiento: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este acompañamiento?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=aibd",
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

    function elimina_archivo_aibd(id_archivo, campo) {
        console.log('Eliminar el archivito: ' + id_archivo);
        var confirma = confirm("En realidad quiere eliminar este archivo de aibd?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            var data = new FormData();
            data.append('pkID', id_archivo);
            if (campo == 'imagen') {
                data.append('tipo', "eliminararchivoimagen");
            }
            if (campo == 'documento') {
                data.append('tipo', "eliminararchivodocumento");
            }
            if (campo == 'informe') {
                data.append('tipo', "eliminararchivoinforme");
            }
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxaibd.php',
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
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `documento_aibd` = '" + num_id + "'";
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
    $("#nombre_aibd").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_aibd").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#telefono_aibd").keyup(function(event) {
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
    $("#documento_aibd").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de DOCUMENTO NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevoaibd").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "aibd.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });
});