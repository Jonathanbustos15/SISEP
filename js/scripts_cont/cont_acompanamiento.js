$(function() {
    $("#btn_nuevoAcompanamiento").jquery_controllerV2({
        nom_modulo: 'acompanamiento',
        titulo_label: 'Nuevo Acompañamiento',
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
            upload.functionReset();
        },
        functionAfter: function(ajustes) {
            console.log('Ejecutando despues de todo...');
            id = $("#btn_nuevoAcompanamiento").attr('data-proyecto');
            $("#fkID_proyecto_marco").val(id);
            console.log(id);
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
    $("#btn_actionacompanamiento").jquery_controllerV2({
        tipo: 'inserta/edita',
        nom_modulo: 'acompanamiento',
        nom_tabla: 'acompanamiento',
        subida: true,
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
    $("[name*='edita_proyectoM']").jquery_controllerV2({
        tipo: 'carga_editar',
        nom_modulo: 'proyectoM',
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
    $("[name*='elimina_proyectoM']").jquery_controllerV2({
        tipo: 'eliminar_logico',
        nom_modulo: 'proyectoM',
        nom_tabla: 'funcionario_cargo',
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
        },
        functionAfter: function(data) {
            console.log('Ejecutando despues de todo...');
            console.log(data);
        }
    });
    //
    $("[name*='ver_archivos_proyectoM']").click(function(event) {
        console.log($(this).data("id-registro"))
        //var query_docs = "SELECT * FROM `documentos_apropiacionS` WHERE fkID_apropiacionS = "+$(this).data("id-registro");
        var carga_archivos = new loadArchivosMult("SELECT * FROM `documentos_proyectoM` WHERE fkID_proyectoM = " + $(this).data("id-registro"));
        carga_archivos.load()
    });
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
});