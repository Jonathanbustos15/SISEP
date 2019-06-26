$(function(){
   //https://github.com/jsmorales/jquery_controllerV2
   //INGRESA A LOS ATRIBUTOS AL FORMULARIO PARA INSERTAR INSTITUCIÓN 

  var arrTutor = [];
  var arrTutoresgrupos = [];
  var arrDocente = [];
  var arrDocentesgrupos = [];

   $("#btn_nuevogrupo").click(function(){
      $("#lbl_form_grupo").html("Nuevo Grupo");
      $("#lbl_btn_actiongrupo").html("Guardar <span class='glyphicon glyphicon-save'></span>");
      $("#btn_actiongrupo").attr("data-action","crear");
      $("#fkID_tutor").val("");
      $("#fkID_docente").val("");
      $("#form_grupo")[0].reset();
      $("#frm_tutor_grupo").html("");
      $("#frm_docente_grupo").html("");
   });

   $("[name*='edita_grupo']").click(function(){
      $("#lbl_form_grupo").html("Edita Grupo");
      $("#lbl_btn_actiongrupo").html("Guardar Cambios<span class='glyphicon glyphicon-save'></span>");
      $("#btn_actiongrupo").attr("data-action","editar");
      $("#fkID_tutor").val("");
      $("#fkID_docente").val("");
      $("#form_grupo")[0].reset();
      $("#frm_tutor_grupo").html("");
      $("#frm_docente_grupo").html("");
   });

   $("#btn_actiongrupo").click(function() {
        /*var validacioncon = validarfuncionario();
        if (validacioncon === "no") {
            window.alert("Faltan Campos por diligenciar.");
        } else {*/
        action = $(this).attr("data-action");
        valida_actio(action);
        console.log("accion a ejecutar: " + action); 
    });

   $("#fkID_tutor").change(function(event) {
    fecha = $("#fecha_creacion").val();
    idUsuario = $(this).val();
    nomUsuario = $(this).find("option:selected").data('nombre')   
    console.log(nomUsuario); 
    if(verPkIdTutor()){
      if(document.getElementById("fkID_tutor_form_"+idUsuario)){
        console.log(document.getElementById("fkID_tutor_form_"+idUsuario));
        console.log("Este usuario ya fue seleccionado.");
      }else{
        arrTutor.length=0;
        console.log("este usuario es chavito")
        selectTutor(idUsuario,nomUsuario,'select',$(this).data('accion'));
        serializa_array(crea_array(arrTutor,$("#pkID").val(),fecha));
      }  
    }else{
      selectTutor(idUsuario,nomUsuario,'select',$(this).data('accion'));};
  });

   $("#fkID_docente").change(function(event) {
    console.log("chavito");
    idDocente = $(this).val();
    nomUsuario = $(this).find("option:selected").data('nombre')   
    console.log(nomUsuario);
    if(verPkIdTutor()){
      if(document.getElementById("fkID_tutor_form_"+idDocente)){
        console.log(document.getElementById("fkID_tutor_form_"+idDocente))
        alert("Este usuario ya fue seleccionado.")
      }else{
        arrDocente.length=0;
        selectDocente(idDocente,nomUsuario,'select',$(this).data('accion'));
        serializa_array(crea_array(arrDocente,$("#pkID").val()));
      }  
    }else{
      selectDocente(idDocente,nomUsuario,'select',$(this).data('accion'));}
  });

   function verPkIdTutor(){

    var id_proyecto_form = $("#pkID").val();
    if(id_proyecto_form != ""){
      return true;
    }else{
      return false;
    }

  };

  function selectDocente(id,nombre,type,numReg){
    console.log(id)
    console.log("ya vamos aca ")
    if(id!=""){

      if(document.getElementById("fkID_docente_form_"+id)){

        console.log("Este usuario ya fue seleccionado.")

      }else{

        if (type=='select') {
          $("#frm_docente_grupo").append(
            '<div class="form-group" id="frm_group'+id+'">'+                    
                      '<input type="text" style="width: 93%;display: inline;" class="form-control" id="fkID_usuario_form_'+id+'" name="fkID_usuario" value="'+nombre+'" readonly="true"> <button name="btn_actionRmDocente_'+id+'" data-id-docente="'+id+'" data-id-frm-grop="frm_group'+id+'" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+                     
                  '</div>'
              );

        } else {
          $("#frm_docente_grupo").append(
            '<div class="form-group" id="frm_group'+id+'">'+                    
                      '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_usuario_form_'+id+'" name="fkID_usuario" value="'+nombre+'" readonly="true"> <button name="btn_actionRmDocente_'+id+'" data-id-docente="'+id+'" data-id-frm-grop="frm_group'+id+'" data-numReg = "'+numReg+'" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+                   
                  '</div>'
              );
        }
        $("[name*='btn_actionRmDocente_"+id+"']").click(function(event) {
          console.log('click remover usuario '+$(this).data('id-frm-grop'));
          removeUsuario($(this).data('id-frm-grop'));
          
          //buscar el indice
          var idDocente = $(this).attr("data-id-docente");
          console.log('el elemento es:'+idDocente);
          var indexArr = arrDocente.indexOf(idDocente);
          console.log("El indice encontrado es:"+indexArr);
          //quitar del array
          if(indexArr >= 0){
            arrDocente.splice(indexArr,1);
            console.log(arrDocente);
          }else{
            console.log('salio menor a 0');
            console.log(arrDocente);
          }

          if (type=='load') {
            // statement
            deleteUsuarioNumReg(numReg);
          }
          
        });
        arrDocente.push(id);
        console.log(arrDocente);
      }     

    }else{
      alert("No se seleccionó ningún usuario.")
    }
  };

  function selectTutor(id,nombre,type,numReg){
    console.log(id)
    console.log("ya vamos aca ")
    if(id!=""){

      if(document.getElementById("fkID_tutor_form_"+id)){
        console.log("Este usuario ya fue seleccionado.")
      }else{
        if (type=='select') {
          console.log("1");
          $("#frm_tutor_grupo").append(
            '<div class="form-group" id="frm_group'+id+'">'+                    
                      '<input type="text" style="width: 93%;display: inline;" class="form-control" id="fkID_usuario_form_'+id+'" name="fkID_usuario" value="'+nombre+'" readonly="true"> <button name="btn_actionRmUsuario_'+id+'" data-id-tutor="'+id+'" data-id-frm-group="frm_group'+id+'" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+                     
                  '</div>'
              );
        } else {
          console.log("2");
          $("#frm_tutor_grupo").append(
            '<div class="form-group" id="frm_group'+id+'">'+                    
                      '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_usuario_form_'+id+'" name="fkID_usuario" value="'+nombre+'" readonly="true"> <button name="btn_actionRmUsuario_'+id+'" data-id-tutor="'+id+'" data-id-frm-group="frm_group'+id+'" data-numReg = "'+numReg+'" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+                   
                  '</div>'
              );
        }

        $("[name*='btn_actionRmUsuario_"+id+"']").click(function(event) { 
          console.log('click remover usuario '+$(this).data('id-frm-group'));
          removeUsuario($(this).data('id-frm-group'));
          //buscar el indice
          var idUsuario = $(this).attr("data-id-tutor");
          console.log('el elemento es:'+idUsuario);
          var indexArr = arrTutor.indexOf(idUsuario);
          console.log("El indice encontrado es:"+indexArr);
          //quitar del array
          if(indexArr >= 0){
            arrTutor.splice(indexArr,1);
            console.log(arrTutor);
          }else{
            console.log('salio menor a 0');
            console.log(arrTutor);
          }
          if (type=='load') {
            deleteUsuarioNumReg(numReg);
          }
        });
        arrTutor.push(id);
        console.log(arrTutor);
      }     

    }else{
      alert("No se seleccionó ningún usuario.")
    }
  };

  function crea_array(array,id_grupo,fecha){
      console.log("no te vallas chavito")
      console.log(array)
      array.forEach(function(element, index){
        //statements
        var obtHE = {"fkID_grupo":id_grupo,"fkID_tutor":element,"fecha_asignacion_tutor":fecha};
        arrTutoresgrupos.push(obtHE);
        console.log(obtHE);
      });
      return arrTutoresgrupos;
    }

    function crea_array2(array,id_grupo,fecha){
      console.log("no te vallas chavito")
      console.log(array)
      array.forEach(function(element, index){
        var obtHE = {"fkID_grupo":id_grupo,"fkID_docente":element,"fecha_asignacion_docente":fecha};
        arrDocentesgrupos.push(obtHE);
        console.log(obtHE);
      });
      return arrDocentesgrupos;
    }

    function serializa_array(array){
      console.log("no te vallas chavito")
      console.log(array);
      var cadenaSerializa = "";

      $.each(array, function(index, val) {

        var dataCadena = "";

        $.each(val, function(llave, valor) {
                   
        console.log("llave="+llave+" valor="+valor);

        dataCadena = dataCadena+llave+"="+valor+"&";                                
        //insertaEstudio(cadenaSerializa);
      });

      dataCadena = dataCadena.substring(0,dataCadena.length - 1);

      console.log(dataCadena);
      
      insertatutgrupo(dataCadena)  

      });
      console.log('Se terminó de insertar los usuarios!')
      if ($("#fkID_tutor").attr('data-accion')=='load') {
        alert("Se ha agregado el usuario correctamente.")
        //location.reload();
      } else {
        //location.reload();  
      }     
    }

    function serializa_array2(array){
      console.log("no te vallas chavito")
      console.log(array);
      var cadenaSerializa = "";

      $.each(array, function(index, val) {

        var dataCadena = "";

        $.each(val, function(llave, valor) {
                   
        console.log("llave="+llave+" valor="+valor);

        dataCadena = dataCadena+llave+"="+valor+"&";                                
        //insertaEstudio(cadenaSerializa);
      });

      dataCadena = dataCadena.substring(0,dataCadena.length - 1);

      console.log(dataCadena);
      
      insertadocegrupo(dataCadena)  

      });
      console.log('Se terminó de insertar los usuarios!')
      if ($("#fkID_docente").attr('data-accion')=='load') {
        alert("Se ha agregado el usuario correctamente.")
        //location.reload();
      } else {
        //location.reload();  
      }     
    }

    function insertatutgrupo(data){    
    $.ajax({
            url: "../controller/ajaxController12.php",
            data: data+"&tipo=inserta&nom_tabla=funcionario_grupo",
          })
          .done(function(data) {            
            //---------------------
            console.log(data);         
          })
          .fail(function(data) {
            console.log(data);         
          })
          .always(function() {
            console.log("complete");
          });
  }

  function insertadocegrupo(data){    
    $.ajax({
            url: "../controller/ajaxController12.php",
            data: data+"&tipo=inserta&nom_tabla=docente_grupo",
          })
          .done(function(data) {            
            //---------------------
            console.log(data);         
          })
          .fail(function(data) {
            console.log(data);         
          })
          .always(function() {
            console.log("complete");
          });
  }

  function crear_grupo(){
      if( document.getElementById("fileupload").files.length){
      var data = new FormData();
      data.append('file', $("#fileupload").get(0).files[0]);
      data.append('nombre', $("#nombre").val());
      data.append('fkID_tipo_grupo',  $("#fkID_tipo_grupo option:selected").val());
      data.append('fkID_grado',  $("#fkID_grado option:selected").val());
      data.append('fkID_institucion',  $("#fkID_institucion option:selected").val());
      data.append('fecha_creacion', $("#fecha_creacion").val());
      data.append('tipo', "crear");
       $.ajax({  
              type: "POST",
              url: "../controller/ajaxgrupo.php",
              data: data,
              contentType: false,
              processData: false,  
              success:function(a){
                      var tipo = JSON.parse(a);
                      fkID_grupo = tipo[0].last_id;
                      fecha = $("#fecha_creacion").val();
                      serializa_array2(crea_array2(arrDocente,fkID_grupo,fecha));
                      serializa_array(crea_array(arrTutor,fkID_grupo,fecha));
                      location.reload();   
              }
            })
     }else{
      var data = new FormData();
      data.append('nombre', $("#nombre").val());
      data.append('fkID_tipo_grupo',  $("#fkID_tipo_grupo option:selected").val());
      data.append('fkID_grado',  $("#fkID_grado option:selected").val());
      data.append('fkID_institucion',  $("#fkID_institucion option:selected").val());
      data.append('fecha_creacion', $("#fecha_creacion").val());
      data.append('tipo', "crearsin");
       $.ajax({  
              type: "POST",
              url: "../controller/ajaxgrupo.php",
              data: data,
              contentType: false,
              processData: false,  
              success:function(a){
                      var tipo = JSON.parse(a);
                      fkID_grupo = tipo[0].last_id;
                      fecha = $("#fecha_creacion").val();
                      serializa_array(crea_array(arrTutor,fkID_grupo,fecha));
                      serializa_array2(crea_array2(arrDocente,fkID_grupo,fecha));
                      location.reload();  
              }
            })
     }
    }

  function removeUsuario(id){
    $("#"+id).remove();
  }

  function valida_actio(action){
      console.log("en la mitad");
        if(action==="crear"){  
            crear_grupo();
        }else if(action==="editar"){
            edita_grupo();
        };
    };

  
   
  });