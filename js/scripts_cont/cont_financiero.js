$(function() {
    //https://github.com/jsmorales/jquery_controllerV2
    //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 
    var arrActividad = [];
    var valortotal = 0;
    var valorac=0;
    var arrValor = [];
    var arrActividadfacturas = [];
    $("#btn_nuevofactura").click(function() {
        valorac=0;
        $("#lbl_form_factura").html("Nueva factura");
        $("#lbl_btn_actionfactura").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionfactura").attr("data-action", "crear");
        $("#fkID_objetivo").val("");
        $("#fkID_actividad").val("");
        $("#form_factura")[0].reset();
        $("#frm_actividad_factura").html("");
    });

    $("#btn_nuevoanticipo").click(function() {
        $("#lbl_form_anticipo").html("Nueva anticipo");
        $("#lbl_btn_actionanticipo").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionanticipo").attr("data-action", "crear");
        $("#fkID_objetivo").val("");
        $("#fkID_actividad").val("");
        $("#form_anticipo")[0].reset();
        $("#frm_actividad_anticipo").html("");
    });


    $("[name*='edita_factura']").click(function() {
        valorac=0;
        $("#lbl_form_factura").html("Edita factura");
        $("#lbl_btn_actionfactura").html("Guardar Cambios<span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionfactura").attr("data-action", "editar");
        $("#fkID_actividad").val("");
        $("#fkID_objetivo").val("");
        $("#form_factura")[0].reset();
        $("#frm_actividad_factura").html("");
        id_factura = $(this).attr('data-id-factura');
        carga_factura(id_factura);
        carga_factura_actividad(id_factura);
    });

    $("[name*='edita_anticipo']").click(function() {
        $("#lbl_form_anticipo").html("Edita anticipo");
        $("#lbl_btn_actionanticipo").html("Guardar Cambios<span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionanticipo").attr("data-action", "editar");
        $("#fkID_actividad").val("");
        $("#fkID_objetivo").val("");
        $("#form_anticipo")[0].reset();
        $("#frm_actividad_anticipo").html("");
        id_anticipo = $(this).attr('data-id-anticipo');
        carga_anticipo(id_anticipo);
    });

    $("#btn_actionfactura").click(function() {
        var validacioncon = validarfactura();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actio(action);
            console.log("accion a ejecutar: " + action);
        }
    });

    $("[name*='elimina_factura']").click(function(event) {
        id_funciona = $(this).attr('data-id-factura');
        console.log(id_funciona)
        elimina_factura(id_funciona);
    });

    $("#btn_actionanticipo").click(function() {
        var validacioncon = validaranticipo();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {
            action = $(this).attr("data-action");
            valida_actionan(action);
            console.log("accion a ejecutar: " + action);
        }
    });

    $("[name*='elimina_anticipo']").click(function(event) {
        id_funciona = $(this).attr('data-id-anticipo');
        console.log(id_funciona)
        elimina_anticipo(id_funciona);
    });

    function validaranticipo() {
        var valor_anticipo = $("#valor_anticipo").val();
        var legalizado = $("#anticipo_legalizado").val();
        var fecha = $("#fecha_anticipo").val();
        var respuesta;
        if (fecha === "" || valor_anticipo === "" || legalizado === "" ) {
            respuesta = "no"
            return respuesta
        } else {
            respuesta = "ok"
            return respuesta
        }
    }


    $("#fkID_actividad").change(function(event) {
        idUsuario = $(this).val();
        nomUsuario = $(this).find("option:selected").data('nombre');
        objetivo = $("#fkID_objetivo option:selected").text();
        valor = $("#valor").val();
        console.log(nomUsuario);
        if (verPkIdactividad()) {
            if (document.getElementById("fkID_actividad_form_" + idUsuario)) {
                console.log(document.getElementById("fkID_actividad_form_" + idUsuario));
                console.log("Este usuario ya fue seleccionado.");
            } else {
                arrActividad.length = 0;
                arrValor.length = 0;
                console.log("este usuario es chavito")
                selectactividad(idUsuario, valor, objetivo, nomUsuario, 'select', $(this).data('accion'));
                id_factura = $("#pkID").val();
                console.log(id_factura)
                guardar(id_factura);
            }
        } else {
            arrActividad.length = 0;
                arrValor.length = 0;
            selectactividad(idUsuario, valor, objetivo, nomUsuario, 'select', $(this).data('accion'));
        };
    });

    function validarfactura() {
        var numero = $("#numero_factura").val();
        var vafactura = $("#valor_factura").val();
        var fecha = $("#fecha_factura").val();
        var respuesta;
        if (fecha === "" || vafactura === "" || numero === "") {
            respuesta = "no"
            return respuesta
        } else {
            respuesta = "ok"
            return respuesta
        }
    }

    function verPkIdactividad() {
        var id_proyecto_form = $("#pkID").val();
        if (id_proyecto_form != "") {
            return true;
        } else {
            return false;
        }
    };

    function carga_anticipo(id_anticipo) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_anticipo + "&tipo=consultar&nom_tabla=anticipo",
        }).done(function(data) {
            /**/
            $.each(data.mensaje[0], function(key, valu) {
                if (key == "pkID") {
                    $("#pkID_anticipo").val(valu);
                } else if (key == "fecha_anticipo") {
                    $("#fecha_anticipo").val(valu);
                    console.log(valu)
                } else if (key == "fecha_anticipo_legalizado") {
                    $("#fecha_anticipo_legalizado").val(valu);
                    console.log(valu)
                } else {
                $("#" + key).val(valu.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));}
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function crear_anticipo() {
        var data = new FormData($("#form_anticipo")[0]);  
        data.append('tipo', "crear_anticipo");
        console.log("crear anticipo")   
        $.ajax({
            type: "POST",
            url: "../controller/ajaxfinanciero.php", 
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                location.reload();
            }
        })
    }

    function edita_anticipo() {
        var data = new FormData($("#form_anticipo")[0]);  
        data.append('tipo', "editar_anticipo");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxfinanciero.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function elimina_anticipo(id_anticipo) {
        var confirma = confirm("En realidad quiere eliminar esta anticipo?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_anticipo + "&tipo=eliminar_logico&nom_tabla=anticipo",
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

    function selectactividad(id, valor, objetivo, nombre, type, numReg) {
        console.log(id)
        console.log("ya vamos aca ")
        if (id != "") {
            if (document.getElementById("fkID_actividad_form_" + id)) {
                console.log("Este usuario ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_actividad_factura").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 93%;display: inline;" class="form-control" data-valor="'+ valor +'" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="'+ objetivo + ",  Actividad  " + nombre +",  valor asignado $"+  valor+ '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-actividad="' + id + '" data-id-frm-group="frm_group' + id + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                   $("#frm_actividad_factura").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 93%;display: inline;" class="form-control" data-valor="'+ valor +'" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="'+ objetivo + ",  Actividad  " + nombre +",  valor asignado $"+  valor+ '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-actividad="' + id + '" data-id-frm-group="frm_group' + id + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
               }
                $("[name*='btn_actionRmUsuario_" + id + "']").click(function(event) {
                    console.log('click remover usuario ' + $(this).data('id-frm-group'));
                    removeUsuario($(this).data('id-frm-group'));
                    //buscar el indice
                    var idUsuario = $(this).attr("data-id-actividad");
                    console.log('el elemento es:' + idUsuario);
                    var indexArr = arrActividad.indexOf(idUsuario);
                    console.log("El indice encontrado es:" + indexArr);
                    //quitar del array
                    if (indexArr >= 0) {
                        arrActividad.splice(indexArr, 1);
                        console.log(arrActividad);
                    } else {
                        console.log('salio menor a 0');
                        console.log(arrActividad);
                    }
                    deleteactividadNumReg(numReg);
                });
                valorac = $("#valor_factura").val();
                while (valorac.toString().indexOf(".") != -1){
                valorac = valorac.toString().replace(".","")};
                while (valor.toString().indexOf(".") != -1){
                valor = valor.toString().replace(".","")};
                valortotal= parseInt(valortotal) + parseInt(valor);
                console.log(valorac)
                console.log(valortotal)
                if (valor=="") {
                    alert("La actividad no tiene asignado algún valor");
                    removeUsuario("frm_group" + id);
                }else if (valortotal > valorac ) {
                    alert("El valor asignado supera el valor de la factura");
                    removeUsuario("frm_group" + id);
                    $("#valor").val("");
                    $("#fkID_objetivo").val("");
                    $("#fkID_actividad").val("");
                    valortotal=0;
                } else{
                arrActividad.push(id);  
                arrValor.push(valor);
                console.log(arrActividad);}
            }
        } else {
            alert("No se seleccionó ningún usuario.")
        }
    };

    function guardar(pkID) {
        $.each(arrActividad, function(llave, valor) {
            console.log("llave=" + llave + " valor=" + valor);
            val = arrValor[llave];
            data = "fkID_factura=" + pkID + "&fkID_actividad=" + valor + "&valor=" + val;
            $.ajax({
                url: "../controller/ajaxController12.php",
                data: data + "&tipo=inserta&nom_tabla=actividad_factura",
            }).done(function(data) {
                console.log(data);
            }).fail(function(data) {
                console.log(data);
            }).always(function() {
                console.log("complete");
            });
        });
    }

    function crea_array(array, id_factura, valor) {
        console.log("no te vallas chavito")
        console.log(array)
        array.forEach(function(element, index) {
            //statements
            var obtHE = {
                "fkID_factura": id_factura,
                "fkID_actividad": element,
                "valor":valor

            };
            arrActividadfacturas.push(obtHE);
            console.log(obtHE);
        });
        return arrActividadfacturas;
    }

    $('#valor').mask('000.000.000.000.000', {reverse: true});
    $('#valor_factura').mask('000.000.000.000.000', {reverse: true});
    $('#valor_anticipo').mask('000.000.000.000.000', {reverse: true});
    $('#anticipo_legalizado').mask('000.000.000.000.000', {reverse: true});

    function serializa_array(array) {
        console.log(array);
        var cadenaSerializa = "";
        $.each(array, function(index, val) {
            var dataCadena = "";
            $.each(val, function(llave, valor) {
                console.log("llave=" + llave + " valor=" + valor);
                dataCadena = dataCadena + llave + "=" + valor + "&";
            });
            dataCadena = dataCadena.substring(0, dataCadena.length - 1);
            console.log(dataCadena);
            insertaactividadfactura(dataCadena)
        });
        console.log('Se terminó de insertar los usuarios!')
        if ($("#fkID_actividad").attr('data-accion') == 'load') {
            console.log("Se ha agregado el usuario correctamente.")
        }
    }

    function insertaactividadfactura(data) {
        $.ajax({
            url: "../controller/ajaxController12.php",
            data: data + "&tipo=inserta&nom_tabla=actividad_factura",
        }).done(function(data) {
            console.log(data);
        }).fail(function(data) {
            console.log(data);
        }).always(function() {
            console.log("complete");
        });
    }  

    function carga_factura(id_factura) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + id_factura + "&tipo=consultar&nom_tabla=factura",
        }).done(function(data) {
            /**/
            $.each(data.mensaje[0], function(key, valu) {
                if (key == "valor_factura") {
                    $("#" + key).val(valu.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
                    valorac=valu;
                    console.log(valu)
                }
                $("#" + key).val(valu);
            });
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    };

    function carga_factura_actividad(id_factura) {
        var query_proyecto = "select actividad_factura.*,objetivo,numero from actividad_factura INNER JOIN factura on factura.pkID = actividad_factura.fkID_factura INNER JOIN actividad on actividad.pkID = actividad_factura.fkID_actividad INNER JOIN objetivo on objetivo.pkID = actividad.fkID_objetivo WHERE factura.estadoV=1 and actividad_factura.estadoV=1 and factura.pkID=" + id_factura;
        console.log(query_proyecto);
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + query_proyecto + "&tipo=consulta_gen",
            success: function(data) {
                console.log(data);
                var type = 'select';
                for (var x = 0; x < data.mensaje.length; x++) {
                    console.log("mireme aqui")
                    if (data.mensaje[x].pkID === undefined) {} else {
                        valortotal=0;
                        valortotal = parseInt(valortotal) + parseInt(data.mensaje[x].valor);
                        selectactividad(data.mensaje[x].pkID, data.mensaje[x].valor, data.mensaje[x].objetivo, data.mensaje[x].numero, type, data.mensaje[x].pkID);
                        console.log(data.mensaje[x].pkID);
                    }
                }
            }
        })
    };

    function crear_factura() {
        var data = new FormData($("#form_factura")[0]);  
        data.append('tipo', "crear");   
        $.ajax({
            type: "POST",
            url: "../controller/ajaxfinanciero.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a)
                var tipo = JSON.parse(a);
                fkID_factura = tipo[0].last_id;
                guardar(fkID_factura,);
                location.reload();
            }
        })
    }

    function edita_factura() {
        var data = new FormData($("#form_factura")[0]);  
        data.append('tipo', "editar");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxfinanciero.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function elimina_factura(id_factura) {
        var confirma = confirm("En realidad quiere eliminar esta factura?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_factura + "&tipo=eliminar_logico&nom_tabla=factura",
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

    function deleteactividadNumReg(numReg) {
        console.log(numReg)
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + numReg + "&tipo=eliminar_logico&nom_tabla=actividad_factura",
        }).done(function(data) {
            console.log(data);
            alert(data.mensaje.mensaje);
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }

    function removeUsuario(id) {
        $("#" + id).remove();
    }
    sessionStorage.setItem("id_tab_factura", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });

    $(document).ready(function () {   
    $('body').on('change','#fkID_objetivo', function() {
        var id = $("#fkID_objetivo option:selected").val();
        document.getElementById ("fkID_actividad") .options.length = 0;
         completaactividad(id);
    });
    }); 

    function completaactividad(id){
    var ruta = "../controller/ajaxfinanciero.php"; 
          $.ajax({
              url: ruta,
              type: 'POST',  
              data: {tipo: "consultaractividad",pkID: id},
              success: function(data){
                  //convierte la cadena que se recibe json
                  var tipos = JSON.parse(data);
                  $('#fkID_actividad').append('<option value="" selected="selected">Elije la Actividad</option>');
                  for(x=0; x<tipos.length; x++) {
                      $('#fkID_actividad').append('<option data-nombre='+tipos[x].nombre+' value='+tipos[x].codigo+'>'+tipos[x].nombre+'</option>');
                  }
              }
          })
      };

    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crear_factura();
        } else if (action === "editar") {
            edita_factura();
        };
    };

    function valida_actionan(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crear_anticipo();
        } else if (action === "editar") {
            edita_anticipo();
        };
    };
    $("#nombre").change(function(event) {
        var nombre = $("#nombre").val();
        var date = $("#fecha_creacion").val();
        var fecha = date.split("-", 1);
        validaEqualIdentifica(nombre, fecha[0]);
    });
    $("#fecha_creacion").change(function(event) {
        var nombre = $("#nombre").val();
        var date = $("#fecha_creacion").val();
        var fecha = date.split("-", 1);
        validaEqualIdentifica(nombre, fecha[0]);
    });

    function validaEqualIdentifica(anticipo, legalizacion) {
        console.log("estoy validando")
            while (anticipo.toString().indexOf(".") != -1){
                anticipo = anticipo.toString().replace(".","")};
            while (legalizacion.toString().indexOf(".") != -1){
                legalizacion = legalizacion.toString().replace(".","")};
        var calculo = anticipo - legalizacion
        console.log(anticipo)
            if (calculo < 0) {
                alert("El valor legalizado es mayor al anticipo, Ingreso un valor diferente ");
                $("#anticipo_legalizado").val("");
            } else {
                //return false;
            }
    }

    function validaEqualfactura(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `factura` WHERE `numero_factura`= '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("El Número de factura ya existe, por favor ingrese un número diferente.");
                $("#numero_factura").val("");
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }

    $("#valor_anticipo").change(function(event) {
        legalizado = $("#anticipo_legalizado").val();
        validaEqualIdentifica($(this).val(),legalizado);
    });

    $("#anticipo_legalizado").change(function(event) {
        anticipo = $("#valor_anticipo").val();
        validaEqualIdentifica(anticipo, $(this).val());
    });

    $("#numero_factura").change(function(event) {
        validaEqualfactura($(this).val());
    });


});