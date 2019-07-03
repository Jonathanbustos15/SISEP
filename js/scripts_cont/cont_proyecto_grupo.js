$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_crearproyectogrupo").click(function() {
        $("#lbl_form_proyecto_grupo").html("Nuevo Album");
        $("#lbl_btn_actionproyecto_grupo").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionproyecto_grupo").attr("data-action", "crear");
        $("#form_proyecto_grupo")[0].reset();
        id_gru = $("#pkID_grup").val();
        $("#fkID_grupos").val(id_gru);
        console.log($("#fkID_grupo").val());
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionproyecto_grupo").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='edita_proyecto']").click(function() {
        $("#lbl_form_proyecto_grupo").html("Edita Album");
        $("#lbl_btn_actionproyecto_grupo").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionproyecto_grupo").attr("data-action", "editar");
        $("#form_proyecto_grupo")[0].reset();
        id = $(this).attr('data-id-album_grupo');
        console.log(id);
        carga_album(id);
    });
    $("[name*='elimina_album']").click(function(event) {
        id_album = $(this).attr('data-id-album_grupo');
        console.log(id_album)
        elimina_album(id_album);
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
            crea_proyecto();
        } else if (action === "editar") {
            edita_proyecto();
        };
    };

    function crea_proyecto() {
        linea = $("#linea_investigacion").val();
        pregunta = $("#pregunta").val();
        console.log(pregunta);
        objetivo = $("#objetivo_general").val();
            $.ajax({
                type: "GET",
                url: "../controller/ajaxgrupo_proyecto.php",
                data: "linea_investigacion="+linea+"&pregunta_investigacion="+pregunta+"&objetivo_general="+objetivo+"&fkID_grupo="+id_gru+ "&tipo=insertar&nom_tabla=grupo_proyecto",
                success: function(r) {
                    console.log(r);
                    location.reload();
                }
            })
    }

    function edita_proyecto() {
        console.log("aqui toy")
        //crea el objeto formulario serializado
        nombre = $("#nombre_album").val();
        fecha = $("#fecha_creacion_album").val();
        observacion = $("#observacion_album").val();
        console.log("ya vamos tres")
            $.ajax({
                type: "GET",
                url: '../controller/ajaxController12.php',
                data: "nombre_album="+nombre+"&fecha_creacion="+fecha+"&observacion_album="+observacion+"&pkID="+id+"&tipo=actualizar2&nom_tabla=grupo_album",
                success: function(r) {
                    console.log(r);
                    location.reload();
                }
            })
    }

    function carga_album(id_album) {
        console.log("Carga el album " + id_album);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_album + "&tipo=consultar&nom_tabla=grupo_album",
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

    function elimina_album(id_album) {
        console.log('Eliminar el hvida: ' + id_album);
        var confirma = confirm("En realidad quiere eliminar esta Album?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_album + "&tipo=eliminar_logico&nom_tabla=grupo_album",
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
});