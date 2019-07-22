$(function() {
    var arrParticipante = [];
    var arrParticipantes = [];
    var arrParticipantesasignados = []
    var arrEstado = [];
    $("#btn_inventario").click(function() {
        $("#lbl_form_inventario").html("Crear Inventario");
        $("#lbl_btn_actioninventario").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actioninventario").attr("data-action", "crear");
        $("#form_inventario")[0].reset();
    });
    $("#btn_actioninventario").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='elimina_inventario']").click(function(event) {
        id_inventario = $(this).attr('data-id-inventario_aibd');
        console.log(id_inventario)
        deleteSaberNumReg(id_inventario);
    });
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_inventario();
        } else {
            edita_asistencia();
        }
    };

    function crea_inventario() {
        data = new FormData();
        id_aibd = $("#btn_inventario").attr('data-id-aibd');
        data.append('pkID', $("#pkID").val());
        data.append('fecha', $("#fecha").val());
        data.append('nombre', $("#nombre").val());
        data.append('cantidad', $("#cantidad").val());
        data.append('fkID_aibd', id_aibd);
        data.append('tipo', "crear_inventario");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxaibd.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function deleteSaberNumReg(numReg) {
        var confirma = confirm("En realidad quiere eliminar el Inventario?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + numReg + "&tipo=eliminarlogico&nom_tabla=inventario_aibd",
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
});