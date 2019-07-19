$(function() {
    var arrEstudiante = [];
    var arrEstudiantes = [];
    var arrestudiantesasignados=[]
    
    $("#btn_asignarestudiante").click(function() {
        $("#lbl_form_asignarestudiantes").html("Asignar Estudiante");
        $("#lbl_btn_actionasignarestudiantes").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionasignarestudiante").attr("data-action", "asignar");
        $("#form_asignarestudiantes")[0].reset();
        $("#frm_estudiantessaber_grupo").html("");
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionestudiante").click(function() {   
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("#btn_actionasignarestudiantes").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });

    $("[name*='elimina_estudiante_saber_propio']").click(function(event) {
        id_estudian = $(this).attr('data-id-estudiante_saber_propio');
        console.log(id_estudian)
        deleteSaberNumReg(id_estudian);
    });
    
    sessionStorage.setItem("id_tab_estudiante", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            
        } else if (action === "editar") {
           
        } else {
            guardar();
            asigna_estudiante();

        }
    };


    function asigna_estudiante() {
       location.reload();
    }

    function guardar() {
        $.each(arrEstudiante, function(llave, valor) {
            console.log("llave=" + llave + " valor=" + valor);
            id = $("#btn_asignarestudiante").attr('data-saber');
            data = "fkID_saber_propio=" + id + "&fkID_estudiante=" + valor;
            $.ajax({
                url: "../controller/ajaxController12.php",
                data: data + "&tipo=inserta&nom_tabla=saber_estudiante",
            }).done(function(data) {
                console.log(data);
            }).fail(function(data) {
                console.log(data);
            }).always(function() {
                console.log("complete");
            });  
        });
    }

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
    
    $("#fkID_estudiantesaber").change(function(event) {
        grupo = $("#btn_asignarestudiante").attr("data-saber");
        idUsuario = $(this).val();  
        validaEqualEstudiante(grupo,idUsuario);
        nomUsuario = $(this).find("option:selected").data('nombre')
        idGrado = $(this).find("option:selected").data('grado')
        console.log(nomUsuario);
        console.log(idGrado);
        if (verPkIdTutor()) {
            if (document.getElementById("fkID_estudiante_form_" + idUsuario)) {
                console.log(document.getElementById("fkID_estudiante_form_" + idUsuario));
                console.log("Este usuario ya fue seleccionado.");
            } else {
                arrEstudiante.length = 0;
                console.log("este usuario es chavito")
                selectEstudiante(idUsuario, nomUsuario, idGrado, 'select', $(this).data('accion'));
                serializa_array(crea_array(arrEstudiante, $("#pkID").val(), fecha));
            }
        } else {
            selectEstudiante(idUsuario, nomUsuario,'select', $(this).data('accion'));
        };
    });

    function crea_array(array, id_grupo, fecha) {
        console.log("no te vallas chavito")
        console.log(array)
        array.forEach(function(element, index) {
            //statements
            var obtHE = {
                "fkID_saber_propio": id_grupo,
                "fkID_estudiantesaber": element
            };
            arrestudiantesasignados.push(obtHE);
            console.log(obtHE);
        });
        return arrestudiantesasignados;
    }

    function serializa_array(array) {
        console.log("no te vallas chavito")
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
            insertatutgrupo(dataCadena)
        });
        console.log('Se terminó de insertar los usuarios!')
    }

    function insertatutgrupo(data) {
        $.ajax({
            url: "../controller/ajaxController12.php",
            data: data + "&tipo=inserta&nom_tabla=funcionario_grupo",
        }).done(function(data) {
            console.log(data);
        }).fail(function(data) {
            console.log(data);
        }).always(function() {
            console.log("complete");
        });
    }


    function selectEstudiante(id, nombre, type, numReg) {
        console.log(id)
        console.log("ya vamos aca ")
        if (id != "") {
            if (document.getElementById("fkID_estudiante_form_" + id)) {
                console.log("Este usuario ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_estudiantessaber_grupo").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 93%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                    $("#frm_estudiantessaber_grupo").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" data-numReg = "' + numReg + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                }
                $("[name*='btn_actionRmUsuario_" + id + "']").click(function(event) {
                    console.log('click remover usuario ' + $(this).data('id-frm-group'));
                    removeUsuario($(this).data('id-frm-group'));
                    //buscar el indice
                    var idUsuario = $(this).attr("data-id-tutor");
                    console.log('el elemento es:' + idUsuario);
                    var indexArr = arrEstudiante.indexOf(idUsuario);
                    console.log("El indice encontrado es:" + indexArr);
                    //quitar del array
                    if (indexArr >= 0) {
                        arrEstudiante.splice(indexArr, 1);
                        console.log(arrEstudiante);
                    } else {
                        console.log('salio menor a 0');
                        console.log(arrEstudiante);
                    }
                    //deleteSaberNumReg(numReg);
                });
                arrEstudiante.push(id);
                console.log(arrEstudiante);
            }
        } else {
            alert("No se seleccionó ningún usuario.")
        }
    };
    function removeUsuario(id) {
        $("#" + id).remove();
    }

    function verPkIdTutor() {
        var id_proyecto_form = $("#pkID").val();
        if (id_proyecto_form != "") {
            return true;
        } else {
            return false;
        }  
    };

    function deleteSaberNumReg(numReg) {
        var confirma = confirm("En realidad quiere eliminar la asignación del estudiante?");
        console.log(confirma);
        /**/
        if (confirma == true) {
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "pkID=" + numReg + "&tipo=eliminar&nom_tabla=saber_estudiante",
        }).done(function(data) {
            console.log(data);
            location.reload();
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete"); 
        });
    }
    }

    function validaEqualEstudiante(cod,num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `saber_estudiante` WHERE `fkID_saber_propio` ='" + cod + "' and fkID_estudiante= '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
            success: function(data) {
            if (data.mensaje[0].res_equal > 0) {
                alert("El Estudiante ya esta asignado a este saber, por favor ingrese otro estudiante.");
                removeUsuario("frm_group"+num_id);
                $("#fkID_estudiantesaber").val("");
            } else {
            }
        }
        })
    }


});