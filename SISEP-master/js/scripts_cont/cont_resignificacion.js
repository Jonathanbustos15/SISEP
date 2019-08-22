$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevoResignificacion").click(function() {
        $("#lbl_form_resignificacion").html("Nueva resignificación")
        $("#lbl_btn_actionresignificacion").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionresignificacion").attr("data-action", "crear");
        $("#form_resignificacion")[0].reset();
        id = $("#btn_nuevoResignificacion").attr('data-proyecto');
        $("#fkID_proyecto_marco").val(id);
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionresignificacion").click(function() {
        var validacioncon = validarresignificacion();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_resignificacion']").click(function() {
        $("#lbl_form_resignificacion").html("Edita resignificación");
        $("#lbl_btn_actionresignificacion").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionresignificacion").attr("data-action", "editar");
        $("#form_resignificacion")[0].reset();
        id = $(this).attr('data-id-resignificacion');
        console.log(id);
        carga_resignificacion(id);
    });
    $("[name*='elimina_resignificacion']").click(function(event) {
        id_funciona = $(this).attr('data-id-resignificacion');
        console.log(id_funciona)
        elimina_resignificacion(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_resignificacion", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    function validarresignificacion() {
        var fecha = $("#fecha").val();
        var fkID_institucion = $("#fkID_institucion option:selected").val();
        var asesor = $("#fkID_asesor option:selected").val();
        var respuesta;
        if (fecha === "" || fkID_institucion === "" || asesor === "" ) {
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
            crea_resignificacion();
        } else if (action === "editar") {
            edita_resignificacion();
        };
    };

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_resignificacion").val('');
            $("#email_resignificacion").focus();
        } else {
            return true;
        }
    }
    $("#email_resignificacion").change(function(event) {
        validarEmail($(this).val())
    });

    function crea_resignificacion() {
        data = new FormData();
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('descripcion', $("#descripcion").val());
        data.append('fkID_proyecto_marco', $("#fkID_proyecto_marco").val());
        data.append('fkID_institucion', $("#fkID_institucion").val());
        data.append('fkID_asesor', $("#fkID_asesor").val());
        data.append('tipo', "crear");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxresignificacion.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                //location.reload();
            }
        })
    }

    function edita_resignificacion() {
        data = new FormData();
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('descripcion', $("#descripcion").val());
        data.append('fkID_proyecto_marco', $("#fkID_proyecto_marco").val());
        data.append('fkID_institucion', $("#fkID_institucion").val());
        data.append('fkID_asesor', $("#fkID_asesor").val());
        data.append('tipo', "editar");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxresignificacion.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function carga_resignificacion(id_funciona) {
        console.log("Carga la resignificacion " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=resignificacion",
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

    function elimina_resignificacion(id_funciona) {
        console.log('Eliminar la resignificacion: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar esta resignificación?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=resignificacion",
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
    //valida si existe el documento
    function validaEqualIdentifica(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `documento_resignificacion` = '" + num_id + "'";
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
    $("#nombre_resignificacion").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_resignificacion").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#telefono_resignificacion").keyup(function(event) {
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
    $("#documento_resignificacion").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de DOCUMENTO NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevoResignificacion").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "resignificacion.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });
});