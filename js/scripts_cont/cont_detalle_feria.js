$(function(){
	 
	 var arrParticipante = [];
    var arrGrado = [];
	 

 $("#btn_asignarparticipante").click(function(){
    $("#lbl_form_asignarparticipante").html("Asignar Participante");
        $("#lbl_btn_actionasignarparticipante").html("Guardar Cambios <span class='glyphicon glyphicon-pencil'></span>");
        $("#btn_actionasignarparticipante").attr("data-action","asignar");
        $("#btn_actionasignarparticipante").removeAttr('disabled', 'disabled');
        $("#form_asignarparticipante")[0].reset();
        
     });
	 
	 $("#btn_actionasignarparticipante").click(function() {
        action = $(this).attr("data-action");
        guardar();
        console.log("accion a ejecutar: " + action);
        console.log("" );
        console.log(" " );
        asigna_participante();
        console.log("accion a ejecutar: " + action);
    });


   $("[name*='elimina_asignar_participante']").click(function(event) {
        id_partici = $(this).attr('data-id-asignar_participante');
        console.log(id_partici)
        elimina_asignacionparticipante(id_partici);
    });

     $("#fkID_participante").change(function(event) {
        grupo = $("#btn_asignarparticipante").attr("data-feria");
        idUsuario = $(this).val();
        validaEqualParticipante(grupo,idUsuario);
        nomUsuario = $(this).find("option:selected").data('nombre')
        idGrado = $(this).find("option:selected").data('grado')
        console.log(nomUsuario);
        console.log(idGrado);
        if (verPkIdParticipante()) {
            if (document.getElementById("fkID_participante_form_" + idUsuario)) {
                console.log(document.getElementById("fkID_participante_form_" + idUsuario));
                console.log("Este usuario ya fue seleccionado.");
            } else {
                arrParticipante.length = 0;
                console.log("este usuario es chavito")
                selectParticipante(idUsuario, nomUsuario, idGrado, 'select', $(this).data('accion'));
                serializa_array(crea_array(arrParticipante, $("#pkID").val(), fecha));
            }
        } else {
            selectParticipante(idUsuario, nomUsuario, idGrado, 'select', $(this).data('accion'));
        };
    });

     function asigna_participante() {
       location.reload();
    }

    function selectParticipante(id, nombre, grado, type, numReg) {
        console.log(nombre+"este es")
        console.log(id)
        if (id != "") {
            if (document.getElementById("fkID_usuario_form_" + id)) {
                console.log("Este usuario ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_participante_taller").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 93%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                    $("#frm_participante_taller").append('<div class="form-group" id="frm_group' + id + '">' + '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_usuario_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" data-numReg = "' + numReg + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                }
                $("[name*='btn_actionRmUsuario_" + id + "']").click(function(event) {
                    console.log('click remover usuario ' + $(this).data('id-frm-group'));
                    removeUsuario($(this).data('id-frm-group'));
                    //buscar el indice
                    var idUsuario = $(this).attr("data-id-tutor");
                    console.log('el elemento es:' + idUsuario);
                    var indexArr = arrParticipante.indexOf(idUsuario);
                    console.log("El indice encontrado es:" + indexArr);
                    //quitar del array
                    if (indexArr >= 0) {
                        arrParticipante.splice(indexArr, 1);
                        console.log(arrParticipante);
                    } else {
                        console.log('salio menor a 0');
                        console.log(arrParticipante);
                    }
                });
                arrParticipante.push(id);
                console.log(arrParticipante);
            }
        } else {
            alert("No se seleccionó ningún usuario.")
        }
    };

    function guardar() {
        $.each(arrParticipante, function(llave, valor) {
            console.log("llave=" + llave + " valor=" + valor);
            id = $("#btn_asignarparticipante").attr('data-feria');
            data = "fkID_feria=" + id + "&fkID_participante=" + valor;
            $.ajax({
                url: "../controller/ajaxController12.php",
                data: data + "&tipo=inserta&nom_tabla=feria_participantes",
            }).done(function(data) {
                console.log(data);
            }).fail(function(data) {
                console.log(data);
            }).always(function() {
                console.log("complete");
            });  
        });
    }


  //--------------------------------------------------------

    

  sessionStorage.setItem("id_tab_sesion",null);

    function verPkIdParticipante() {
        var id_proyecto_form = $("#pkID").val();
        if (id_proyecto_form != "") {
            return true;
        } else {
            return false;
        }
    };

    function removeUsuario(id) {
      $("#" + id).remove();
    }

     function elimina_asignacionparticipante(id_partici) {
        console.log('Eliminar el participante: ' + id_partici);
        var confirma = confirm("En realidad quiere eliminar esta Asignación?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                type: "POST",
                url: '../controller/ajaxparticipante.php',
                data: "pkID=" + id_partici + "&tipo=eliminarasignacionf",
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

    function validaEqualParticipante(cod,num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM feria_participantes where`fkID_feria` ='" + cod + "' and fkID_participante= '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
            success: function(data) {
            if (data.mensaje[0].res_equal > 0) {
                alert("El Participante ya esta asignado a esta Feria, por favor ingrese otro participante.");
                removeUsuario("frm_group"+num_id);
                $("#fkID_participante").val("");
            } else {
            }
        }
        })
    }

});