$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_nuevomicrobiologia").click(function() {
        $("#lbl_form_microbiologia").html("Nuevo Taller de microbiología básica");
        $("#lbl_btn_actionmicrobiologia").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionmicrobiologia").attr("data-action", "crear");
        $("#form_microbiologia")[0].reset();
        id = $("#btn_nuevomicrobiologia").attr('data-proyecto');
        $("#fkID_proyecto_marco").val(id);
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionmicrobiologia").click(function() {
        var validacioncon = validarmicrobiologia();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_microbiologia']").click(function() {
        $("#lbl_form_microbiologia").html("Edita Taller de microbiología básica");
        $("#lbl_btn_actionmicrobiologia").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionmicrobiologia").attr("data-action", "editar");
        $("#form_microbiologia")[0].reset();
        id = $(this).attr('data-id-microbiologia');
        console.log(id);
        carga_microbiologia(id);
    });
    $("[name*='elimina_microbiologia']").click(function(event) {
        id_funciona = $(this).attr('data-id-microbiologia');
        console.log(id_funciona)
        elimina_microbiologia(id_funciona);
    });
    //
    sessionStorage.setItem("id_tab_microbiologia", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_microbiologia();
        } else if (action === "editar") {
            edita_microbiologia();
        };
    };

    function crea_microbiologia() {
        var data = new FormData();
        data.append('fecha', $("#fecha").val());
        data.append('fkID_institucion', $("#fkID_institucion").val());
        data.append('fkID_grado', $("#fkID_grado").val());
        data.append('fkID_curso', $("#fkID_curso").val());
        data.append('fkID_proyecto_marco', $("#fkID_proyecto_marco").val());
        data.append('tipo', "crear");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxmicrobiologia.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function validarmicrobiologia() {
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

    function edita_microbiologia() {
        var data = new FormData();
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('fkID_institucion', $("#fkID_institucion").val());
        data.append('fkID_grado', $("#fkID_grado").val());
        data.append('fkID_curso', $("#fkID_curso").val());
        data.append('fkID_proyecto_marco', $("#fkID_proyecto_marco").val());
        data.append('tipo', "editar");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxmicrobiologia.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function carga_microbiologia(id_funciona) {
        console.log("Carga el microbiologia " + id_funciona);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=microbiologia",
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

    function elimina_microbiologia(id_funciona) {
        console.log('Eliminar el microbiologia: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este Taller?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=microbiologia",
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
        carga_curso($(this).val(), "form_microbiologia");
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
        proyecto = $("#btn_nuevomicrobiologia").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "microbiologia.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });
});