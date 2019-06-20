$(function(){
   //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
   $("#btn_nuevoestudiante").click(function(){
      $("#lbl_form_estudiante").html("Nuevo Estudiante");
      $("#lbl_btn_actionestudiante").html("Guardar <span class='glyphicon glyphicon-save'></span>");
      $("#btn_actionestudiante").attr("data-action","crear");
      $("#form_estudiante")[0].reset();
   });     
   //Definir la acción del boton del formulario 
   $("#btn_actionestudiante").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);  
    });

   
   
   $("[name*='edita_estudiante']").click(function(){
       $("#lbl_form_estudiante").html("Edita Estudiante");
      $("#lbl_btn_actionestudiante").html("Guardar Cambios <span class='glyphicon glyphicon-save'></span>");
      $("#btn_actionestudiante").attr("data-action","editar");
      $("#form_estudiante")[0].reset();
      id = $(this).attr('data-id-estudiante');
      console.log(id);
      carga_institucion(id);
   });

   $("[name*='elimina_estudiante']").click(function(event) {
        id_estudian = $(this).attr('data-id-estudiante');
        console.log(id_estudian)
        elimina_institucion(id_estudian);
    });
   
  //---------------------------------------------------------

  //
  sessionStorage.setItem("id_tab_estudiante",null);
  //---------------------------------------------------------


    //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action){
      console.log("en la mitad");
        if(action==="crear"){  
            crea_estudiante();
        }else if(action==="editar"){
            edita_estudiante();
        };
    };

    function crea_estudiante(){
        objt_f_estudi = $("#form_estudiante").valida();
         $.ajax({  
              type: "GET",
              url: "../controller/ajaxController12.php",
              data: objt_f_estudi.srlz+"&tipo=inserta&nom_tabla=estudiante",
              success:function(r){
                    console.log(r);
                    location.reload();
              }
            })
    }

     function edita_estudiante(){
        //crea el objeto formulario serializado
        objt_f_estudi = $("#form_estudiante").valida();
            console.log(objt_f_estudi.srlz);
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: objt_f_estudi.srlz+"&tipo=actualizar&nom_tabla=estudiante",
                success:function(r){
                    console.log(r);
                    location.reload();
              }
            })
    }

    function carga_institucion(id_estudian) {
        console.log("Carga el institucion " + id_estudian);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_estudian + "&tipo=consultar&nom_tabla=estudiante",
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

    function elimina_institucion(id_estudian) {
        console.log('Eliminar el hvida: ' + id_estudian);
        var confirma = confirm("En realidad quiere eliminar esta Institución?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_estudian + "&tipo=eliminarlogico&nom_tabla=estudiante",
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
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `documento_estudiante` = '" + num_id + "'";
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

    $("#nombre_estuadiante").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Nombre NO puede llevar valores numericos.");
            $(this).val("");
        }
    });

    $("#apellido_estudiante").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 32) && (event.keyCode < 65)) || (event.keyCode > 200)) {
            console.log(String.fromCharCode(event.which));
            alert("El Apellido NO puede llevar valores numericos.");
            $(this).val("");
        }
    });

    $("#documento_estudiante").change(function(event) {
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

});
