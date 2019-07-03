$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevoInstitucion").click(function() {
        $("#lbl_form_institucion").html("Nueva Institución");
        $("#lbl_btn_actioninstitucion").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actioninstitucion").attr("data-action", "crear");
        $("#form_institucion")[0].reset();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actioninstitucion").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='edita_institucion']").click(function() {
        $("#lbl_form_institucion").html("Edita Institución");
        $("#lbl_btn_actioninstitucion").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actioninstitucion").attr("data-action", "editar");
        $("#form_institucion")[0].reset();
        id = $(this).attr('data-id-institucion');
        console.log(id);
        carga_institucion(id);
    });
    $("[name*='elimina_institucion']").click(function(event) {
        id_institu = $(this).attr('data-id-institucion');
        console.log(id_institu)
        elimina_institucion(id_institu);
    });
    //---------------------------------------------------
    function validarEmail(email) {
        expr = /([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        if (!expr.test(email)) {
            alert("Error: La dirección de correo " + email + " es incorrecta.");
            $("#email_institucion").val('');
            $("#email_institucion").focus();
        } else {
            return true;
        }
    }
    $("#email_institucion").change(function(event) {
        /* Act on the event */
        validarEmail($(this).val())
    });
    //---------------------------------------------------------
    //
    sessionStorage.setItem("id_tab_institucion", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_institucion();
        } else if (action === "editar") {
            edita_institucion();
        };
    };

    function crea_institucion() {
        objt_f_institu = $("#form_institucion").valida();
        email = $("#email_institucion").val();
        if ((objt_f_institu.estado == true) && (validarEmail(email))) {
            $.ajax({
                type: "GET",
                url: "../controller/ajaxController12.php",
                data: objt_f_institu.srlz + "&tipo=inserta&nom_tabla=institucion",
                success: function(r) {
                    console.log(r);
                    location.reload();
                }
            })
        }
    }

    function edita_institucion() {
        console.log("aqui toy")
        //crea el objeto formulario serializado
        objt_f_institu = $("#form_institucion").valida();
        email = $("#email_institucion").val();
        if ((objt_f_institu.estado == true) && (validarEmail(email))) {
            console.log(objt_f_institu.srlz);
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: objt_f_institu.srlz + "&tipo=actualizar&nom_tabla=institucion",
                success: function(r) {
                    console.log(r);
                    location.reload();
                    $("#form_institucion")[0].reset();
                }
            })
        }
    }

    function carga_institucion(id_institu) {
        console.log("Carga el institucion " + id_institu);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_institu + "&tipo=consultar&nom_tabla=institucion",
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

    function elimina_institucion(id_institucion) {
        console.log('Eliminar el hvida: ' + id_institucion);
        var confirma = confirm("En realidad quiere eliminar esta Institución?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_institucion + "&tipo=eliminar_logico&nom_tabla=institucion",
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
    $("#telefono_institucion").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 48)) || (event.keyCode > 57)) {
            console.log(String.fromCharCode(event.which));
            alert("El número de Telefono NO puede llevar valores alfanuméricos.");
            $(this).val("");
        }
    });
    $("#persona_contacto").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
});