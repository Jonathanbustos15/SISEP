$(function() {

    $("#btn_nuevoDocumento").click(function() {
        $("#lbl_form_documentos").html("Nuevos Documentos");
        $("#lbl_btn_actiondocumentos").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actiondocumentos").attr("data-action", "crear");
        $("#form_documentos")[0].reset();
        $("#fkID_categoria").val("");
    });

    $("#btn_nuevoactividad").click(function() {
        $("#lbl_form_actividad").html("Nueva Actividad");
        $("#lbl_btn_actionactividad").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionactividad").attr("data-action", "crear");
        $("#form_actividad")[0].reset();
    });

    $("#btn_nuevosubactividad").click(function() {
        $("#lbl_form_subactividad").html("Nueva Sub Actividad");
        $("#lbl_btn_actionsubactividad").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionsubactividad").attr("data-action", "crear");
        $("#form_subactividad")[0].reset();
    });

    $("#btn_actiondocumentos").click(function() {
        var validacioncon = validardocumento();
        if (validacioncon === "no") {  
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        //valida_actio(action);
        console.log("accion a ejecutar: " + action);
        crea_documentos();
        }
    });

    $("#btn_actionactividad").click(function() {
        var validacioncon = validaractividad();
        if (validacioncon === "no") {  
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        //valida_actio(action);
        console.log("accion a ejecutar: " + action);
        crea_actividad();
        }
    });

    $("#btn_actionsubactividad").click(function() {
        var validacioncon = validarsubactividad();
        if (validacioncon === "no") {  
            window.alert("Faltan Campos por diligenciar.");
        } else {
        action = $(this).attr("data-action");
        //valida_actio(action);
        console.log("accion a ejecutar: " + action);
        crea_subactividad();
        }
    });

    $("[name*='elimina_documento']").click(function(event) {
        id_funciona = $(this).attr('data-id-documento');
        console.log(id_funciona)
        elimina_documento(id_funciona);
    });

    function crea_documentos() {  
         var data = new FormData($("#form_documentos")[0]);
            data.append('tipo', "crear_documento");
            console.log(data)
            $.ajax({
                type: "POST",
                url: "../controller/ajaxrepositorio.php",   
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

    function crea_actividad() {  
         var data = new FormData($("#form_actividad")[0]);
            data.append('tipo', "crear_actividad");
            console.log(data)
            $.ajax({
                type: "POST",
                url: "../controller/ajaxrepositorio.php",   
                data: data, 
                contentType: false,
                processData: false,
                success: function(a) {  
                    console.log(a);
                    location.reload();
                }
            })  
    }

    function crea_subactividad() {  
         var data = new FormData($("#form_subactividad")[0]);
            data.append('tipo', "crear_subactividad");
            console.log(data)
            $.ajax({
                type: "POST",
                url: "../controller/ajaxrepositorio.php",   
                data: data, 
                contentType: false,
                processData: false,
                success: function(a) {  
                    console.log(a);
                    location.reload();
                }
            })  
    }

    function validardocumento(){
        var activi = $("#fkID_categoria option:selected").val();
        var sub = $("#fkID_subcategoria option:selected").val();
     if ((document.getElementById("url_archivo").files.length) && activi != "" && sub != "") {
            respuesta = "ok"
        }else{
            respuesta = "no"
        }
        return respuesta
    }

    function validaractividad(){
        var activi = $("#nombre_actividad").val();
     if (activi != "") {
            respuesta = "ok"
        }else{
            respuesta = "no"
        }
        return respuesta
    }

    function validarsubactividad(){
        var activi = $("#fkID_categoria option:selected").val();
        var sub = $("#nombre_subactividad").val();
     if (activi === "" && sub === "") {
            respuesta = "no"
        }else{
            respuesta = "ok"
        }
        return respuesta
    }

    function elimina_documento(id_anticipo) {
        var confirma = confirm("En realidad quiere eliminar esta documento?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_anticipo + "&tipo=eliminar_logico&nom_tabla=documentos",
            }).done(function(data) {
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("errorfatal");
            }).always(function() {
                console.log("complete");
            });
        }
    };
    
    $(document).ready(function() {
        $("#demo2").navgoco({accordion: true});
    });

    $(document).ready(function () {   
    $('body').on('change','#fkID_categoria', function() {
        var id = $("#fkID_categoria option:selected").val();
        document.getElementById ("fkID_subcategoria") .options.length = 0;
         completasubactividad(id);
    });
    }); 

    function completasubactividad(id){
        console.log(id)
    var ruta = "../controller/ajaxrepositorio.php"; 
          $.ajax({
              url: ruta,
              type: 'POST',  
              data: {tipo: "consultar_subactividad",pkID: id},
              success: function(data){
                  console.log(data)  
                  var tipos = JSON.parse(data);
                  $('#fkID_subcategoria').append('<option value="" selected="selected">Elije la Sub Actividad</option>');
                  for(x=0; x<tipos.length; x++) {
                      $('#fkID_subcategoria').append('<option data-nombre='+tipos[x].nombre+' value='+tipos[x].codigo+'>'+tipos[x].nombre+'</option>');
                  }
              }
          })
      };

    
    sessionStorage.setItem("id_tab_factura", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

});