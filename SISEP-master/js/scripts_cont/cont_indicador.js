$(function(){
   
   //https://github.com/jsmorales/jquery_controllerV2
   
    $("#btn_nuevoindicador").jquery_controllerV2({
        nom_modulo:'indicador',
        titulo_label:'Nuevo Indicador'
    });

    $("#btn_actionindicador").jquery_controllerV2({
        tipo:'inserta/edita',     
        nom_modulo:'indicador',
        nom_tabla:'indicador',
        auditar:true,    
        //recarga : false,
        functionBefore:function(ajustes){
            if($("#script").val() == ""){
              alert("Por favor escriba una consulta sql en el campo script");
              //$("#btn_actionindicador").attr('disabled', 'disabled');
            }else{    
            $("#script").val(crypt.encripta($("#script").val()));
            //$("#btn_actionindicador").removeAttr('disabled', 'disabled');
            }
        }
    });

    $("[name*='edita_indicador']").jquery_controllerV2({
        tipo:'carga_editar',
        nom_modulo:'indicador',
        nom_tabla:'indicador',
        titulo_label:'Edita Indicador',
        functionAfter:function(data,ajustes){
            //console.log(data)
            if($("#script").val() != ""){
              $("#script").val(crypt.desencripta(data.mensaje[0].script));
            }else{
                alert("Por favor escriba una consulta sql en el campo script");
            }
        }      
    });
   
    $("[name*='elimina_indicador']").jquery_controllerV2({
        tipo:'eliminar',
        nom_modulo:'indicador',
        nom_tabla:'indicador',
         auditar:true
    });

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    sessionStorage.setItem("id_tab_indicador",null);
    //---------------------------------------------------------

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
        window.location.href = $(this).attr('href');
    });
 
});