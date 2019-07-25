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

    $("#btn_nuevafoto").click(function() {
        $("#lbl_form_foto_taller").html("Nuevas Fotos");
        $("#lbl_btn_actionfoto_taller").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionfoto_taller").attr("data-action", "crear");
        $("#form_foto_taller")[0].reset();
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

    $("#btn_actionfoto_taller").click(function() {
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

    function crea_foto() {  
         var data = new FormData($("#form_foto_taller")[0]);
            data.append('tipo', "crear_foto");
            console.log(data)
            $.ajax({
                type: "POST",
                url: "../controller/ajaxtaller.php",
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
        var confirma = confirm("En realidad quiere eliminar este Album?");
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

    function elimina_foto(id_foto) {
        var confirma = confirm("En realidad quiere eliminar esta Foto?");
        console.log(confirma);

        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_foto + "&tipo=eliminar_logico&nom_tabla=fotos_taller",
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

    file_in = document.querySelector("#url_foto")
file_in.onchange = function(e){
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
            $("#form_foto_taller")[0].reset();
        } else{
            console.log("ok")
        }  
    }




    //-------------------------------------------------------------------------------------

    $(document).ready(function(){
        console.log("entre")
    loadGallery(true, 'a.thumbnail');
    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current){
        $('#btn_anterior, #btn_siguiente').show();
        if(counter_max == counter_current){
            $('#btn_siguiente').hide();
        } else if (counter_current == 1){
            $('#btn_anterior').hide();
        }
    }
    /**
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr){
        var current_image,
            selector,
            counter = 0;

        $('#btn_siguiente, #btn_anterior').click(function(){
            if($(this).attr('id') == 'btn_anterior'){
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#imagen_galeria-caption').text($sel.data('caption'));
            $('#imagen_galeria-title').text($sel.data('title'));
            $('#imagen_galeria-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if(setIDs == true){
            $('[data-image-id]').each(function(){
                counter++;
                $(this).attr('data-image-id',counter);
            });
        }
        $(setClickAttr).on('click',function(){
            updateGallery($(this));
        });
    }
});


});