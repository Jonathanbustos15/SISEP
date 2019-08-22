$(function(){


    $("#btn_nuevoPreguntap").jquery_controllerV2({
        nom_modulo:'preguntap',
        titulo_label:'Nueva Pregunta',        
        functionAfter:function(ajustes){
            //remueve el form que carga las preguntas multiples
            answersP.reset()
            //-------------------------------------------------
            console.log($("#btn_nuevoPreguntap").data("num-pregunta"))

            var num_pre = $("#btn_nuevoPreguntap").data("num-pregunta");

            $("#pregunta").val(num_pre+". ");        
            //console.log($("#pregunta"))            
        }
    });


    $("#btn_actionpreguntap").jquery_controllerV2({
        tipo:'inserta/edita',
        nom_modulo:'preguntap',
        nom_tabla:'pregunta_p',        
        recarga:false,  
        auditar:true,      
        functionAfter:function(data,ajustes){
            //console.log('Ejecutando despues de todo...');
            //console.log(data);
            //console.log(ajustes.action);
            //-------------------------------------------
            //answersP.saveAnsw(data[0].last_id)
            switch (ajustes.action) {
                case "crear":
                    answersP.saveAnsw(data[0].last_id)
                    break;
                case "editar":
                    answersP.saveAnsw($("#pkID").val())
                    break;                
            }
            //-------------------------------------------      
        }           
    });


    $("[name*='edita_preguntap']").jquery_controllerV2({
        tipo:'carga_editar',
        nom_modulo:'preguntap',
        nom_tabla:'pregunta_p',
        titulo_label:'Editar Pregunta',        
        functionAfter:function(data){
            console.log('Ejecutando despues de todo...');
            console.log(data);

            var id_preguntap = data.mensaje[0].pkID,
                type = data.mensaje[0].fkID_tipo_pregunta_p;
            //-------------------------------------------
            answersP.loadAnsw(id_preguntap,type)
            //-------------------------------------------
        }
    }); 

    $("[name*='elimina_preguntap']").jquery_controllerV2({
        tipo:'eliminar',
        nom_modulo:'preguntap',
        nom_tabla:'pregunta_p',
        auditar:true        
    });
    //+++++++++++++++++++++++++++++++++++++++
    
    //--------------------------------------
    answersP.stage = "fkID_tipo_pregunta_p";
    //answersP.append_form = "form_preguntap";
    answersP.init()
    //--------------------------------------

    //-------------------------------------------------------------------------
    
});