$(function() {
    $("#btn_nuevotalento_humano").jquery_controllerV2({
        nom_modulo: 'talento_humano',
        titulo_label: 'Nuevo talento humano',
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
        },
        functionAfter: function(ajustes) {
            console.log('Ejecutando despues de todo...');
            id = $("#btn_nuevotalento_humano").attr('data-proyecto');
            $("#fkID_proyecto_marco").val(id);
            console.log(id);
            //console.log(ajustes);
            //destruye_cambia_pass();
            //------------------------------------------
            //matrix Relation
            //limpia el form
            //------------------------------------------      
        }
    });
    $("#btn_actiontalento_humano").jquery_controllerV2({
        tipo: 'inserta/edita',
        nom_modulo: 'talento_humano',
        nom_tabla: 'funcionario_cargo',
        recarga: false,
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
        },
        functionAfter: function(data, ajustes) {
            console.log('Ejecutando despues de todo...');
            console.log(data)
            console.log(ajustes)
            location.reload()
        }
    });
    $("[name*='edita_talento_humano']").jquery_controllerV2({
        tipo: 'carga_editar',
        nom_modulo: 'talento_humano',
        nom_tabla: 'funcionario_cargo',
        titulo_label: 'Editar Asignacion laboral',
        tipo_load: 1,
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
        },
        functionAfter: function(data) {
            console.log('Ejecutando despues de todo...');
            console.log(data);
            //----------------------------------------------------------------
        }
    });
    $("[name*='elimina_talento_humano']").click(function(event) {
        id_funciona = $(this).attr('data-id-talento_humano');
        console.log(id_funciona)
        elimina_talento_humano(id_funciona);
    });

    function elimina_talento_humano(id_funciona) {
        console.log('Eliminar el talento humano: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar esta Asignación?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminar_logico&nom_tabla=funcionario_cargo",
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
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //------------------------------------------------------
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevotalento_humano").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        estado = $('select[name="estado_filtro"] option:selected').text();
        location.href = "talento_humano.php?id_proyectoM=" + proyecto + "&anio=" + nombre +  "&estado=" + estado + "";
    });

    $("#estado_funcionario_cargo").change(function(event) {
        var cargo = $("#fkID_cargo option:selected").val();
        var funcionario = $("#fkID_funcionario option:selected").val();
        var date = $("#anio_funcionario_cargo").val();
        var fecha = date.split("-", 1);
        var estado = $("#estado_funcionario_cargo option:selected").text();            
        validaEqualIdentifica(estado,fecha[0],funcionario,cargo);
    });
    $("#fkID_cargo").change(function(event) {
        var cargo = $("#fkID_cargo option:selected").val();
        var funcionario = $("#fkID_funcionario option:selected").val();
        var date = $("#anio_funcionario_cargo").val();
        var fecha = date.split("-", 1);
        var estado = $("#estado_funcionario_cargo option:selected").text();            
        validaEqualIdentifica(estado,fecha[0],funcionario,cargo);
    });
    $("#fkID_funcionario").change(function(event) {
        var cargo = $("#fkID_cargo option:selected").val();
        var funcionario = $("#fkID_funcionario option:selected").val();
        var date = $("#anio_funcionario_cargo").val();
        var fecha = date.split("-", 1);
        var estado = $("#estado_funcionario_cargo option:selected").text();            
        validaEqualIdentifica(estado,fecha[0],funcionario,cargo);
    });
    $("#anio_funcionario_cargo").change(function(event) {
        var cargo = $("#fkID_cargo option:selected").val();
        var funcionario = $("#fkID_funcionario option:selected").val();
        var date = $("#anio_funcionario_cargo").val();
        var fecha = date.split("-", 1);
        var estado = $("#estado_funcionario_cargo option:selected").text();            
        validaEqualIdentifica(estado,fecha[0],funcionario,cargo);
    });

    function validaEqualIdentifica(num_id,fecha,funcionario,cargo) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `funcionario_cargo` WHERE estadoV=1 and fkID_funcionario='" + funcionario + "' and fkID_cargo='" + cargo + "' and YEAR(anio_funcionario_cargo)='" + fecha + "' and estado_funcionario_cargo='" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("La Asignación de ese funcionario ya existe, por favor ingrese una asignacion diferente.");
                $("#anio_funcionario_cargo").val("");; 
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