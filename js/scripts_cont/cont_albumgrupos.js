$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_album_grupo").click(function() {
        $("#lbl_form_album_grupo").html("Nuevo Album");
        $("#lbl_btn_actionalbum_grupo").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionalbum_grupo").attr("data-action", "crear");
        $("#form_album_grupo")[0].reset();
        id_gru = $("#pkID_grup").val();
        $("#fkID_grupo").val(id_gru);
        console.log($("#fkID_grupo").val());
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionalbum_grupo").click(function() {
        var validacioncon = validaralbum();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
        }
    });
    $("[name*='edita_album']").click(function() {
        $("#lbl_form_album_grupo").html("Edita Album");
        $("#lbl_btn_actionalbum_grupo").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionalbum_grupo").attr("data-action", "editar");
        $("#form_album_grupo")[0].reset();
        id = $(this).attr('data-id-album');
        console.log(id);
        carga_album(id);
    });
    $("[name*='elimina_album']").click(function(event) {
        id_album = $(this).attr('data-id-album');
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
            crea_album();
        } else if (action === "editar") {
            edita_album();
        };
    };

    function validaralbum(){
      var nombre = $("#nombre_album").val();
      var fecha = $("#fecha_creacion_album").val();
        var respuesta;
        if (fecha === "" ||  nombre === "" ) {
            respuesta = "no"
            return respuesta
        }else{
            respuesta = "ok"
            return respuesta
        }
    }

    function crea_album() {
        console.log("paso a pasito")
        taller = $("#fkID_taller").val();
        nombre = $("#nombre_album").val();  
        fecha = $("#fecha_creacion_album").val();
        data="nombre_album="+nombre+"&fecha_album="+fecha+"&fkID_taller="+taller+ "&tipo=inserta&nom_tabla=galeria_taller"
        console.log(data)
            $.ajax({
                type: "GET",
                url: "../controller/ajaxController12.php",
                data: data,
                success: function(r) {
                    console.log(r);
                    location.reload();
                }
            })
    }

    function edita_album() {
        console.log("aqui toy")
        //crea el objeto formulario serializado
        nombre = $("#nombre_album").val();  
        fecha = $("#fecha_creacion_album").val();
        observacion = $("#observacion_album").val();
        console.log("ya vamos tres")
            $.ajax({
                type: "GET",
                url: '../controller/ajaxController12.php',
                data: "nombre_album="+nombre+"&fecha_album="+fecha+"&pkID="+id+"&tipo=actualizar&nom_tabla=galeria_taller",
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
            data: "pkID=" + id_album + "&tipo=consultar&nom_tabla=galeria_taller",
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
        var confirma = confirm("En realidad quiere eliminar esta Album?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_album + "&tipo=eliminar_logico&nom_tabla=galeria_taller",
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

    function validaEqualIdentifica(nombre) {
        console.log("busca valor " + encodeURI(nombre));
        var consEqual = "SELECT COUNT(*) as res_equal FROM galeria_taller where estadoV= 1 and nombre_album='" + nombre + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("Este Album ya existe, por favor ingrese un nombre diferente.");
                $("#nombre_album").val(""); 
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }
    
    $("#nombre_album").change(function(event) {
        validaEqualIdentifica($(this).val());
    });


});