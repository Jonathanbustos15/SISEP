$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevodocente").click(function() {
        $("#lbl_form_docente").html("Nuevo Docente");
        $("#lbl_btn_actiondocente").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actiondocente").attr("data-action", "crear");
        $("#form_docente")[0].reset();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actiondocente").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='edita_docente']").click(function() {
        $("#lbl_form_docente").html("Edita Docente");
        $("#lbl_btn_actiondocente").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actiondocente").attr("data-action", "editar");
        $("#form_docente")[0].reset();
        id = $(this).attr('data-id-docente');
        console.log(id);
        carga_docente(id);
    });
    $("[name*='elimina_docente']").click(function(event) {
        id_docente = $(this).attr('data-id-docente');
        console.log(id_docente)
        elimina_docente(id_docente);
    });

    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_docente").val('');
            $("#email_docente").focus();  
        } else {
            return true;
        }
    }
    $("#email_docente").change(function(event) {
        /* Act on the event */
        validarEmail($(this).val())
    });
    //---------------------------------------------------------
    //
    sessionStorage.setItem("id_tab_docente", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_docente();
        } else if (action === "editar") {
            edita_docente();
        };
    };

    function crea_docente() {
        objt_f_docente = $("#form_docente").valida();
        e= $("#proyecto_macro").val();
        console.log("aca esta la "+e);
        email = $("#email_docente").val();
        if ((objt_f_docente.estado == true) && (validarEmail(email))) {
            $.ajax({
                type: "GET",
                url: "../controller/ajaxController12.php",
                data: objt_f_docente.srlz + "&tipo=inserta&nom_tabla=docente",
                success: function(r) {
                    console.log(r);
                    location.reload();
                }
            })
        }
    }

    function edita_docente() {
        console.log("aqui toy")
        //crea el objeto formulario serializado
        objt_f_docente = $("#form_docente").valida();
        email = $("#email_docente").val();
        if ((objt_f_docente.estado == true) && (validarEmail(email))) {
            console.log(objt_f_docente.srlz);
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: objt_f_docente.srlz + "&tipo=actualizar&nom_tabla=docente",
                success: function(r) {
                    console.log(r);
                    location.reload();
                }
            })
        }
    }

    function carga_docente(id_docente) {
        console.log("Carga el institucion " + id_docente);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_docente + "&tipo=consultar&nom_tabla=docente",
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

    function elimina_docente(id_docente) {
        var confirma = confirm("En realidad quiere eliminar este Docente?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_docente + "&tipo=eliminar_logico&nom_tabla=docente",
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
    $("#telefono_docente").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de Telefono NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    $("#documento_docente").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de Documento NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });

    $("#documento_docente").change(function(event) {
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
    $("#telefono_docente").change(function(event) {
        /* valida que no tenga menos de 8 caracteres*/
        var valores_idCli = $(this).val().length;
        console.log(valores_idCli);
        if (valores_idCli < 7) {
            alert("El número de Telefono no puede ser menor a 7 valores.");
            $(this).val("");
            $(this).focus();
        }
    });

    $("#nombre_docente").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
    $("#apellido_docente").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });

    function validaEqualIdentifica(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `docente` WHERE estadoV=1 and`documento_docente`= '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("El Número de indetificación ya existe, por favor ingrese un número diferente.");
                $("#documento_docente").val(""); 
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }

});





