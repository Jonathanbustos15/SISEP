$(function() {
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    $("#btn_album_aula").click(function() { 
        $("#lbl_form_album_aula").html("Nuevo Album");
        $("#lbl_btn_actionalbum_aula").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionalbum_aula").attr("data-action", "crear");
        $("#form_album_aula")[0].reset();   
    });  

    $("#btn_nuevafoto").click(function() {
        $("#lbl_form_foto_aula").html("Nuevas Fotos");
        $("#lbl_btn_actionfoto_aula").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionfoto_aula").attr("data-action", "crear");
        $("#form_foto_aula")[0].reset();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionalbum_aula").click(function() {
        var validacioncon = validaralbum();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
        }
    });

    $("#btn_actionfoto_aula").click(function() {
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

    $("[name*='edita_album']").click(function() {
        $("#lbl_form_album_aula").html("Edita Album");
        $("#lbl_btn_actionalbum_aula").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionalbum_aula").attr("data-action", "editar");
        $("#form_album_aula")[0].reset();
        id = $(this).attr('data-id-album');
        console.log(id);
        carga_album(id);
    });
    $("[name*='elimina_album']").click(function(event) {
        id_album = $(this).attr('data-id-album');
        console.log(id_album)
        elimina_album(id_album);
    });

    $("[name*='elimina_foto']").click(function(event) {
        id_foto = $(this).attr('data-id-foto');
        console.log(id_foto)
        elimina_foto(id_foto);
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
      var fecha = $("#fecha_album").val();
        var respuesta;
        if (fecha === "" ||  nombre === "" ) {
            respuesta = "no"
            return respuesta
        }else{
            respuesta = "ok"
            return respuesta
        }
    }   

    function validarfoto(){
        if (document.getElementById("url_foto").files.length) {
            respuesta = "ok"
        }else{
            respuesta = "no"
        }
        return respuesta
    }

    function crea_album() {
        console.log("paso a pasito")
        aula = $("#fkID_aula").val(); 
        nombre = $("#nombre_album").val();  
        fecha = $("#fecha_album").val();
        data="nombre_album="+nombre+"&fecha_album="+fecha+"&fkID_aula="+aula+ "&tipo=inserta&nom_tabla=galeria_aula"
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

    function crea_foto() {  
         var data = new FormData($("#form_foto_aula")[0]);
            data.append('tipo', "crear_foto");
            console.log(data)
            $.ajax({
                type: "POST",
                url: "../controller/ajaxaulas.php",   
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

    function edita_album() {
        console.log("aqui toy")
        //crea el objeto formulario serializado
        nombre = $("#nombre_album").val();  
        fecha = $("#fecha_album").val();
        observacion = $("#observacion_album").val();
        console.log("ya vamos tres")
            $.ajax({
                type: "GET",
                url: '../controller/ajaxController12.php',
                data: "nombre_album="+nombre+"&fecha_album="+fecha+"&pkID="+id+"&tipo=actualizar&nom_tabla=galeria_aula",
                success: function(r) {
                    console.log(r);
                    location.reload();
                }
            })
    }

    function carga_album(id_album) {
        $("#fecha_album").val('');
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_album + "&tipo=consultar&nom_tabla=galeria_aula",
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
        var confirma = confirm("En realidad quiere eliminar este Album?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_album + "&tipo=eliminar_logico&nom_tabla=galeria_aula",
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

    function elimina_foto(id_foto) {
        var confirma = confirm("En realidad quiere eliminar esta Foto?");
        console.log(confirma);

        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_foto + "&tipo=eliminar_logico&nom_tabla=fotos_aula",
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

    function validaEqualIdentifica(nombre) {
        console.log("busca valor " + encodeURI(nombre));
        var consEqual = "SELECT COUNT(*) as res_equal FROM galeria_aula where estadoV= 1 and nombre_album='" + nombre + "'";
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

    
        var file_i=document.querySelector("#url_foto")
        file_i.onchange = function(e){
            var files = e.target.files;
            for(var i=0,f;f= files[i];++i){
                extension = (f.name.substring(f.name.lastIndexOf("."))).toLowerCase();
                validarextension(extension);
                console.log(f.name);
                console.log(extension);
            }
        }   


    function validarextension(ext){
        if(ext != ".jpg" && ext != ".png" && ext != ".gif" && ext != ".jpeg") {
            window.alert("Solo se permiten formatos de imagen.");
            $("#form_foto_aula")[0].reset();
        } else{
            console.log("ok")
        }  
    }

    



});