(function($) {
    $.fn.jquery_controllerV2 = function(opciones) {
        var ajustes = $.extend({
            // These are the defaults.
            tipo: 'nuevo', //tipo de instancia
            action: 'insertar', //accion a realizar el botón
            tipo_load: 1,
            objt_f: '', //objeto del formulario
            id: '', //id del registro de BD
            subida: false, //si sube o no archivos
            recarga: true, //si recarga o no la pagina despues de cada accion
            //tipos de ajax por defecto
            tipo_ajax: {
                crear: "inserta",
                editar: "actualizar",
                carga: "consultar",
                eliminar: "eliminar",
                eliminar_logico: "eliminar_logico"
            },
            //------------------------
            //ajustes del form/modulo
            nom_modulo: '', //el nombre del modulo usado
            titulo_label: '', //titulo de la ventana del modal
            nom_tabla: '', //nombre de la tabla en la BD
            //-----------------------------------------------------------------
            //CallBacks            
            functionAfter: function(data, ajustes) {
                console.log('Ejecutando luego de Cualquier cosa!!!');
            },
            functionBefore: function(ajustes) {
                console.log('Ejecutando antes de cualquier cosa!!!');
            },
            //-----------------------------------------------------------------            
            //validacion de campo individual-----------------------------------
            validarCampo: false,
            nom_campo: '',
            //-----------------------------------------------------------------
            confirm_action: false,
            msg_confirm: "Esta seguro que desea ejecutar esta acción?",
            confirma_accion: function(ajustes) {
                if (ajustes.confirm_action == true) {
                    var conf = confirm(ajustes.msg_confirm);
                    if (conf === true) {
                        ajustes.valida_action(ajustes.action);
                    }
                } else {
                    ajustes.valida_action(ajustes.action);
                }
            },
            //-----------------------------------------------------------------
            valida_action: function(action) {
                if (ajustes.action === "crear") {
                    //crea_usuario();
                    //console.log('crear desde la funcion del plugin');
                    if (ajustes.validarCampo == true) {
                        //crear();
                        validaCampo();
                    } else {
                        if (ajustes.subida == true) {
                            subida_archivo('crear')
                        } else {
                            crear();
                        };
                    };
                } else if (ajustes.action === "editar") {
                    //edita_usuario();
                    if (ajustes.subida == true) {
                        subida_archivo('editar')
                    } else {
                        editar();
                    };
                };
            },
            //-----------------------------------------------------------------
            //funciones de auditoria
            auditar: false,
            //-----------------------------------------------------------------
            elemento: {}
        }, opciones);
        var options_format = {
            symbol: "$",
            decimal: ",",
            thousand: ".",
            precision: 0,
            format: "%s%v"
        };
        //------------------------------------------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------
        function crear() {
            //callback before      
            ajustes.functionBefore(ajustes);
            //--------------------------------------
            //crea el objeto formulario serializado
            ajustes.objt_f = $("#form_" + ajustes.nom_modulo).valida();
            //email = $("#email").val(); && (validarEmail(email))
            console.log(ajustes.objt_f);
            //console.log(objt_f_adminPublicidad.srlz);
            //--------------------------------------
            /**/
            if (ajustes.objt_f.estado == true) {
                $.ajax({
                    url: "../controller/ajaxController12.php",
                    data: ajustes.objt_f.srlz + "&tipo=" + ajustes.tipo_ajax.crear + "&nom_tabla=" + ajustes.nom_tabla,
                }).done(function(data) {
                    //---------------------
                    console.log(data);
                    alert(data[0].mensaje);
                    //Ejecuta callback-----------------------------------------------------------                  
                    ajustes.functionAfter(data, ajustes);
                    //---------------------------------------------------------------------------
                    //verifica si debe auditar
                    if (ajustes.auditar) {
                        console.log("Debe auditar!")
                        var audita = new audit(ajustes.action, data.query, ajustes.nom_modulo);
                        audita.auditar()
                    };
                    //---------------------------------------------------------------------------
                    if (ajustes.recarga == true) {
                        location.reload();
                    };
                    //---------------------------------------------------------------------------
                }).fail(function(data) {
                    console.log(data);
                    alert(data[0].mensaje);
                }).always(function() {
                    console.log("complete");
                });
            } else {
                alert("El formulario no está totalmente diligenciado, revíselo e inténtelo de nuevo.");
            };
        };
        //cierra crea
        function validaCampo() {
            var val_campo = $("#form_" + ajustes.nom_modulo)[0][ajustes.nom_campo]["value"];
            var cons_validaCampo = 'select ' + ajustes.nom_campo + ' from ' + ajustes.nom_tabla + ' where ' + ajustes.nom_campo + ' LIKE "' + val_campo + '" ';
            console.log(cons_validaCampo)
            /**/
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "query=" + cons_validaCampo + "&tipo=consulta_gen",
            }).done(function(data) {
                console.log(data)
                //console.log(valResConsulta)
                if (data.estado == "Error") {
                    crear();
                } else {
                    alert("El campo " + ajustes.nom_campo + " que ha ingresado ya existe y no se puede duplicar. Por favor ingrese un valor diferente.");
                };
            }).fail(function() {
                console.log("error");
            }).always(function() {
                console.log("complete");
            });
            //---------------------------------------------------------------          
        }

        function editar() {
            //callback before-----------------------------------------
            ajustes.functionBefore(ajustes);
            //--------------------------------------
            //crea el objeto formulario serializado
            ajustes.objt_f = $("#form_" + ajustes.nom_modulo).valida();
            //email = $("#email").val(); ) && (validarEmail(email)) 
            //--------------------------------------
            if (ajustes.objt_f.estado == true) {
                console.log(ajustes.objt_f.srlz);
                $.ajax({
                    url: '../controller/ajaxController12.php',
                    data: ajustes.objt_f.srlz + "&tipo=" + ajustes.tipo_ajax.editar + "&nom_tabla=" + ajustes.nom_tabla,
                }).done(function(data) {
                    //---------------------
                    //console.log(data.query)
                    console.log(data.mensaje.mensaje);
                    alert(data.mensaje.mensaje);
                    //----------------------------------
                    //callback after                    
                    ajustes.functionAfter(data, ajustes);
                    //---------------------------------------------------------------------------
                    //verifica si debe auditar
                    if (ajustes.auditar) {
                        console.log("Debe auditar!")
                        var audita = new audit(ajustes.action, data.query, ajustes.nom_modulo);
                        audita.auditar()
                    };
                    //---------------------------------------------------------------------------
                    //---------------------------------------------------------------------------
                    if (ajustes.recarga == true) {
                        location.reload();
                    };
                    //----------------------------------
                }).fail(function() {
                    console.log("error");
                }).always(function() {
                    console.log("complete");
                });
            } else {
                alert("Faltan " + Object.keys(ajustes.objt_f.objt).length + " campos por llenar.");
            }
            //------------------------------------------------------
        };
        //cierra editar
        function carga(id) {
            //callback before --------------------
            ajustes.functionBefore(ajustes);
            //------------------------------------                    
            console.log("Carga el id " + id);
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id + "&tipo=" + ajustes.tipo_ajax.carga + "&nom_tabla=" + ajustes.nom_tabla,
            }).done(function(data) {
                /**/
                var ciclo_carga = $.each(data.mensaje[0], function(key, value) {
                    console.log(key + "--" + value);
                    //-----------------------------------------------------
                    //Tipo de Carga con el Plugin
                    //1. Carga con solo ids
                    //$("#"+key).val(value);
                    //para cuando los campos del formulario no son iguales
                    //a los de la tabla en la BD.
                    //2. carga dentro del formulario que corresponde el modulo
                    //solo funciona si los campos de la BD son exactamente
                    //iguales a los del formulario.
                    //$("#form_"+nom_modulo)[0][key].value = value;
                    if (ajustes.tipo_load == 1) {
                        $("#" + key).val(value);
                    } else if (ajustes.tipo_load == 2) {
                        //$("#form_"+ajustes.nom_modulo)[0][key]["value"] = value;
                        //console.log($("#form_"+ajustes.nom_modulo)[0][key])
                        if ($("#form_" + ajustes.nom_modulo)[0][key]) {
                            console.log("Existe")
                            $("#form_" + ajustes.nom_modulo)[0][key]["value"] = value;
                        } else {
                            console.log("No Existe")
                        }
                    };
                    //condicional por si tiene mascaras de dinero añadidas
                    if (key == "valor") {
                        $("#valor_mask").val(accounting.formatNumber(value, options_format));
                    };
                    //-----------------------------------------------------
                });
                $.when(ciclo_carga).then(ciclo_carga_ok, ciclo_carga_fail);

                function ciclo_carga_ok() {
                    //callback after--------------------------------                  
                    ajustes.functionAfter(data, ajustes);
                    //---------------------------------------------------------------------------   
                }

                function ciclo_carga_fail() {
                    //callback after--------------------------------                  
                    console.log('Algo salió mal cargando la data.');
                    console.log(data);
                    //---------------------------------------------------------------------------   
                }
                //--------------------------------------------------------------------------                        
            }).fail(function() {
                console.log("error");
            }).always(function() {
                console.log("complete");
            });
        };
        //cierra carga
        function eliminar(id) {
            ajustes.id = id;
            ajustes.action = "eliminar";
            //callback before------------------
            ajustes.functionBefore(ajustes);
            //---------------------------------
            console.log('Eliminar el registro: ' + id);
            var confirma = confirm("En realidad quiere eliminar este registro?");
            //console.log(confirma);
            /**/
            if (confirma == true) {
                //si confirma es true ejecuta ajax
                $.ajax({
                    url: '../controller/ajaxController12.php',
                    data: "pkID=" + id + "&tipo=" + ajustes.tipo_ajax.eliminar + "&nom_tabla=" + ajustes.nom_tabla,
                }).done(function(data) {
                    //---------------------
                    console.log(data);
                    //console.log(data.query)
                    //---------------------------------------------------------------------------
                    //verifica si debe auditar
                    if (ajustes.auditar) {
                        console.log("Debe auditar!")
                        var audita = new audit(ajustes.action, data.query, ajustes.nom_modulo);
                        audita.auditar()
                    };
                    //---------------------------------------------------------------------------
                    alert(data.mensaje.mensaje);
                    //valida si hay que recargar la pagina
                    if (ajustes.recarga == true) {
                        location.reload();
                    };
                    //------------------------------------                                          
                    ajustes.functionAfter(data, ajustes);
                    //------------------------------------
                }).fail(function() {
                    console.log("error");
                }).always(function() {
                    console.log("complete");
                });
            };
        };
        //cierra eliminar
        function eliminar_logico(id) {
            ajustes.id = id;
            ajustes.action = "eliminar_logico";
            //callback before------------------
            ajustes.functionBefore(ajustes);
            //---------------------------------
            console.log('Eliminar el registro: ' + id);
            var confirma = confirm("En realidad quiere eliminar este registro?");
            //console.log(confirma);
            /**/
            if (confirma == true) {
                //si confirma es true ejecuta ajax
                $.ajax({
                    url: '../controller/ajaxController12.php',
                    data: "pkID=" + id + "&tipo=" + ajustes.tipo_ajax.eliminar_logico + "&nom_tabla=" + ajustes.nom_tabla,
                }).done(function(data) {
                    //---------------------
                    console.log(data);
                    //console.log(data.query)
                    //---------------------------------------------------------------------------
                    //verifica si debe auditar
                    if (ajustes.auditar) {
                        console.log("Debe auditar!")
                        var audita = new audit(ajustes.action, data.query, ajustes.nom_modulo);
                        audita.auditar()
                    };
                    //---------------------------------------------------------------------------
                    alert(data.mensaje.mensaje);
                    //valida si hay que recargar la pagina
                    if (ajustes.recarga == true) {
                        location.reload();
                    };
                    //------------------------------------                                          
                    ajustes.functionAfter(data, ajustes);
                    //------------------------------------
                }).fail(function() {
                    console.log("error");
                }).always(function() {
                    console.log("complete");
                });
            };
        };
        //Eliminar logico
        function subida_archivo(tipo) {
            //---------------------------------------------------------------------------------------
            //CREA UNA VARIABLE  DE TIPO FormData que toma el formulario
            var formData = new FormData($("#form_" + ajustes.nom_modulo)[0]);
            //la ruta del php que ejecuta ajax
            var ruta = "../subida_archivo/ctrl_sub_objt.php";
            //hacemos la petición ajax
            $.ajax({
                url: ruta,
                type: 'POST',
                // Form data
                //datos del formulario
                data: formData,
                //necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
                //mientras enviamos el archivo
                beforeSend: function() {
                    console.log("Subiendo archivo, por favor espere...");
                    if ($("#archivo")[0]["files"].length > 0) {
                        $(".alert").html("Subiendo archivo, por favor espere...");
                    } else {
                        $(".alert").html("No hay archivo para subir.");
                    };
                },
                //una vez finalizado correctamente
                success: function(data) {
                    console.log(data);
                    if ($("#archivo")[0]["files"].length > 0) {
                        $(".alert").html(data.estado);
                    } else {
                        $(".alert").html("No hay archivo para subir.");
                    };
                    if (tipo == 'crear') {
                        crear();
                    } else if ('editar') {
                        editar();
                    };
                },
                //si ha ocurrido un error
                error: function() {
                    console.log("Ha ocurrido un error.");
                }
            });
            //---------------------------------------------------------------------------------------
        }; //cierra función subida*/
        //------------------------------------------------------------------------------------------------------------------------
        switch (ajustes.tipo) {
            case 'nuevo':
                // statements_1
                //ajustes.elemento = this;
                this.click(function(event) {
                    //se ejecuta luego por el reset del form----------------------------                    
                    ajustes.functionBefore(ajustes);
                    //------------------------------------------------------------------
                    /* Act on the event */
                    if (ajustes.titulo_label == '') {
                        $("#lbl_form_" + ajustes.nom_modulo).html("Nuevo Registro " + ajustes.nom_modulo);
                    } else {
                        $("#lbl_form_" + ajustes.nom_modulo).html(ajustes.titulo_label);
                    };
                    $("#lbl_btn_action" + ajustes.nom_modulo).html("Guardar<span class='glyphicon glyphicon-chevron-right'></span>");
                    $("#btn_action" + ajustes.nom_modulo).attr("data-action", "crear");
                    $("#form_" + ajustes.nom_modulo)[0].reset();
                    //------------------------------------------------------------------
                    ajustes.functionAfter(ajustes);
                    //------------------------------------------------------------------
                });
                break;
                //---------------------------------------------------------------------------
            case 'inserta/edita':
                this.click(function(event) {
                    /* Act on the event */
                    ajustes.action = $(this).attr("data-action");
                    console.log(ajustes.action)
                    ajustes.confirma_accion(ajustes);
                });
                break;
                //---------------------------------------------------------------------------
                //---------------------------------------------------------------------------
            case 'carga_editar':
                this.click(function(event) {
                    /* Act on the event */
                    //console.log('ha dado click por carga_editar, con parametro:'+nom_modulo);
                    if (ajustes.titulo_label == '') {
                        $("#lbl_form_" + ajustes.nom_modulo).html("Edita Registro " + ajustes.nom_modulo);
                    } else {
                        $("#lbl_form_" + ajustes.nom_modulo).html(ajustes.titulo_label);
                    };
                    $("#lbl_btn_action" + ajustes.nom_modulo).html("Guardar Cambios<span class='glyphicon glyphicon-chevron-right'></span>");
                    $("#btn_action" + ajustes.nom_modulo).attr("data-action", "editar");
                    $("#form_" + ajustes.nom_modulo)[0].reset();
                    id = $(this).attr('data-id-' + ajustes.nom_modulo);
                    console.log('El id del registro es:' + id);
                    carga(id);
                });
                break;
                //---------------------------------------------------------------------------
                //---------------------------------------------------------------------------
            case 'eliminar':
                this.click(function(event) {
                    /* Act on the event */
                    id = $(this).attr('data-id-' + ajustes.nom_modulo);
                    eliminar(id);
                });
                break;
            case 'eliminar_logico':
                this.click(function(event) {
                    /* Act on the event */
                    id = $(this).attr('data-id-' + ajustes.nom_modulo);
                    eliminar_logico(id);
                });
                break;
                //--------------------------------------------------------------------------- 
        }
        console.log('Ejecutando jquery_controllerV2 en ' + this.selector)
    };
}(jQuery));