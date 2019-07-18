$(function() {
    $("#btn_nuevoProyectoM").jquery_controllerV2({
        nom_modulo: 'proyectoM',
        titulo_label: 'Nuevo Proyecto Marco',
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
            upload.functionReset()
            //$("#btn_actionusuario").html("Esto es antes...")
        },
        functionAfter: function(ajustes) {
            console.log('Ejecutando despues de todo...');
            //console.log(ajustes);
            //destruye_cambia_pass();
            //------------------------------------------
            //matrix Relation
            //limpia el form
            $("#" + rel_municipios.formulario_add).html("");
            //setea el valor de los arrays
            rel_municipios.arrElementos.length = 0;
            rel_municipios.arrElementosRelation.length = 0;
            //------------------------------------------      
        }
    });
    $("#btn_nuevoProyectoM").click(function(){
    $("select_municipio").val($("#select_municipio").data("default-value"));
   });
    $("#btn_actionproyectoM").jquery_controllerV2({
        tipo: 'inserta/edita',
        nom_modulo: 'proyectoM',
        nom_tabla: 'proyecto_marco',
        recarga: false,
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
            //$("#btn_actionusuario").html("Esto es antes...")
        },
        functionAfter: function(data, ajustes) {
            console.log('Ejecutando despues de todo...');
            console.log(data)
            console.log(ajustes)
            //--------------------------------------------------------        
            if (ajustes.action == "crear") {
                var id_last_proyectoM = data[0].last_id; //last_id solo aparece si acaba de insertar
                rel_municipios.serializa_array(rel_municipios.crea_array(rel_municipios.arrElementos, id_last_proyectoM));
                if (upload.arregloDeArchivos.length > 0) {
                    $('#fileuploadPM').fileupload('send', {
                        files: upload.arregloDeArchivos
                    }).success(function(result, textStatus, jqXHR) {
                        upload.functionSend(id_last_proyectoM, result);
                    });
                } else {
                    location.reload()
                }
            } else {
                if (upload.arregloDeArchivos.length > 0) {
                    $('#fileuploadPM').fileupload('send', {
                        files: upload.arregloDeArchivos
                    }).success(function(result, textStatus, jqXHR) {
                        upload.functionSend($("#pkID").val(), result);
                    });
                } else {
                    location.reload()
                }
            }
            //--------------------------------------------------------         
        }
    });
    $("[name*='edita_proyectoM']").jquery_controllerV2({
        tipo: 'carga_editar',
        nom_modulo: 'proyectoM',
        nom_tabla: 'proyecto_marco',
        titulo_label: 'Editar Proyecto Marco',
        tipo_load: 1,
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
            // crea_cambia_pass();
        },
        functionAfter: function(data) {
            console.log('Ejecutando despues de todo...');
            console.log(data);
            id_proyectoM = data.mensaje[0].pkID;
            var query_docs = "SELECT * FROM `documentos_proyectoM` WHERE fkID_proyectoM = " + id_proyectoM;
            upload.functionLoad(query_docs);
            //----------------------------------------------------------------
            var query = "SELECT municipio.*, proyectoM_municipio.pkID as numReg " + " FROM `municipio` " + " INNER JOIN proyectoM_municipio ON proyectoM_municipio.fkID_municipio = municipio.pkID " + " INNER JOIN proyecto_marco ON proyectoM_municipio.fkID_proyectoM = proyecto_marco.pkID " + " WHERE proyectoM_municipio.fkID_proyectoM = " + id_proyectoM;
            rel_municipios.carga_elementos(query);
            //----------------------------------------------------------------
            //cargar los municipios con el departamento
            depart.load_mun($("#fkID_departamento").val())
            //----------------------------------------------------------------
        }
    });
  
    $("[name*='elimina_proyectoM']").click(function(event) {
        id_proyecto = $(this).attr('data-id-proyectom');
        elimina_proyecto(id_proyecto);
    });
    //
    $("[name*='ver_archivos_proyectoM']").click(function(event) {
        console.log($(this).data("id-registro"))
        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");
        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_proyectoM` WHERE fkID_proyectoM = " + $(this).data("id-registro"));
        carga_archivos.load()
    });

    function elimina_proyecto(id) {
        var confirma = confirm("En realidad quiere eliminar este Proyecto?");
        console.log(confirma);
        if (confirma == true) {  
            $.ajax({ 
                url: '../controller/ajaxController12.php',  
                data: "pkID=" + id + "&tipo=eliminar_logico&nom_tabla=proyecto_marco",
            }).done(function(data) {
                //---------------------
                console.log(data);
                //location.reload();
            }).fail(function() {
                console.log("errorfatal");
            }).always(function() {
                console.log("complete");
            });
        }
    };
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
    //Función para cargar varios archivos
    self.upload = new funcionesUpload("btn_actionproyectoM", "res_form", "not_documentos", "documentos_proyectoM", "fkID_proyectoM")
    //console.log(upload)
    $('#fileuploadPM').fileupload({
        dataType: 'json',
        add: function(e, data) {
            upload.functionAdd(data)
        },
        done: function(e, data) {
            console.log('Load finished.');
        }
    });
    //---
    //---------------------------------------------------------------
    //carga la funcionalidad de cargar municipios con el departamento
    var depart = new locationDepMun();
    //se setea un nuevo selector de munucipios porque no es el que 
    //esta por defecto.
    depart.set_mun("select_municipio")
    //inicializa la funcionalidad
    depart.init();
    //---------------------------------------------------------------
    //---------------------------------------------------------------
    //Instancia del complemento matrixRelation
    //(seleccionador,btn_accion,nombre_modulo,nombre_modulo2,formulario_add,nombre_tabla,obtHE)
    var obtHE = {
        "fkID_proyectoM": 0,
        "fkID_municipio": 0
    }
    var rel_municipios = new matrixRelation("select_municipio", "btn_actionproyectoM", "municipio", "proyectoM", "frm_proyectoM_municipios", "proyectoM_municipio", obtHE);
    //------------------
    //setea el msg de error cuando cargue la relacion
    rel_municipios.setMsgError("Todo el Departamento.")
    rel_municipios.setMsgErrorClase("success")
    //------------------
    rel_municipios.setup();
    //---------------------------------------------------------------
    //---------------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //
    sessionStorage.setItem("id_tab_proyectoM", null);
    //------------------------------------------------------
$("#operador").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 47) && (event.keyCode < 58))) {
            console.log(String.fromCharCode(event.which));
            alert("El Operador NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
$("#fuente_recursos").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 47) && (event.keyCode < 58))) {
            console.log(String.fromCharCode(event.which));
            alert("La Fuente de Recursos NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
$("#financiadores").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 47) && (event.keyCode < 58))) {
            console.log(String.fromCharCode(event.which));
            alert("El Financiador NO puede llevar valores numericos.");
            $(this).val("");
        }
    });
$("#interventoria").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 47) && (event.keyCode < 58))) {
            console.log(String.fromCharCode(event.which));
            alert("La Interventoria NO puede llevar valores numericos.");
            $(this).val("");
        }
    });

$("#supervisor").keyup(function(event) {
        /* Act on the event */
        if (((event.keyCode > 47) && (event.keyCode < 58))) {
            console.log(String.fromCharCode(event.which));
            alert("El Supervisor NO puede llevar valores numericos.");
            $(this).val("");
        }
    });

});
