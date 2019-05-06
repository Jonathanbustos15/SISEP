$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2

   //set de la validacion de los estados del proyecto
   valEstadoProyecto.selector = "fkID_estado_proyecto";
	 
	 $("#btn_nuevoproyecto").jquery_controllerV2({
	 	nom_modulo:'proyecto',
      	titulo_label:'Nuevo Proyecto',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
            //------------------------------------------
            //validacion estado de proyecto
            valEstadoProyecto.valida(ajustes.tipo)
            //------------------------------------------
            //oculta los campos de fase y estado
            //$("#div-id-fase").attr('attribute', 'value');
            ocultaDivs("hide")
      	},
      	functionAfter:function(ajustes){
        	console.log('Ejecutando despues de todo...');
        //console.log(ajustes);
        //destruye_cambia_pass();
      	}
	 });

     function ocultaDivs(tipo){

        if (tipo == "hide") {
           $("#div-id-fase").attr('hidden','true');
           $("#div-id-estado").attr('hidden','true');
           $("#div-id-asesor").attr('hidden','true');
           $("#div-id-lineaI").attr('hidden','true');
        } else if("show") {
           $("#div-id-fase").removeAttr('hidden');
           $("#div-id-estado").removeAttr('hidden');
           $("#div-id-asesor").removeAttr('hidden');
           $("#div-id-lineaI").removeAttr('hidden');
        }        
     }
	 
	 $("#btn_actionproyecto").jquery_controllerV2({
	 	tipo:'inserta/edita',
      	nom_modulo:'proyecto',
      	nom_tabla:'proyecto',
        auditar:true,    
        //recarga:false,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);        
      	},
      	functionAfter:function(data,ajustes){
        	console.log('Ejecutando despues de todo...');
        	console.log(data); 

          if (ajustes.action == "editar") {

            
          }     
      	}           
	 });
	 
	 $("[name*='edita_proyecto']").jquery_controllerV2({
	 	tipo:'carga_editar',
      	nom_modulo:'proyecto',
      	nom_tabla:'proyecto',
      	titulo_label:'Editar Proyecto',
      	tipo_load:2,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
          // crea_cambia_pass();
          //valEstadoProyecto.valida(ajustes.tipo)
          //------------------------------------
          ocultaDivs("show")

          //var tipo_user = leerCookie("log_sisep_tipo");


          //console.log(tipo_user);
      

      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);

        
        	id_proyecto = data.mensaje[0].pkID

          var estado = $('#fkID_estado_proyecto').val();

          console.log(estado);

          if((estado==1)){
            switchCampos("enable_a")
            $("#form_proyecto #nombre").removeAttr("disabled");
          }else if((estado == 2)||(estado == 3)){
            switchCampos("disable_a")
            $("#form_proyecto #nombre").attr("disabled", "disabled");
          }
          //cambio de estado de proyecto debe ser solo cuando 
          //se ejecute el boton de guardar cambios.
          $('#fkID_estado_proyecto').change(function(){
             
             var id_estado = $(this).val() == 2 ? 1 : 2;

             console.log($(this).val())
             //console.log(id_estado)

            insertCambioEGI($('#fecha').val(),id_estado, $('#grupo').val());

            if (id_estado == 1) {
              updateEstadoG($('#grupo').val());
            }else{
              //location.reload()
            }            

          });
          //-------------------------------------------
          valEstadoProyecto.validaAfter()
          //------------------------------------------------------------------------
          /*valida si la fase se puede cambiar o no
          para poder hacer esta validacion:
          -->debe haber registro tabla asesoria que conicida con fkID_proyecto y 
          fkID_fase

          -->la bitacora debe tener registro de respuesta a todas sus preguntas.
          -->debe permitir al menos poner la fase 1 ya que cuando se crea se debe
          poder asignar la fase 1.

          *si el campo esta vacio es porque puede pasar a fase 1 solamente
          *si el campo es diferente de vacio valida los aspectos anteriores, si los
          cumple carga la lista de fases, de lo contrario deshabilita el control

          */
          //selector_fase, fkID_proyecto, fkID_grupo
          var val_fase = new validaChangeFase("form_proyecto #fkID_fase",data.mensaje[0].pkID,data.mensaje[0].fkID_grupo);
          val_fase.validar();
          //------------------------------------------------------------------------
      	}
	 });

   
   function switchCampos(atributo){

      //console.log($("#form_proyecto"))

      $.each($("#form_proyecto")[0], function(index, val) {           

          var id_campo = val["id"];       

          switch(atributo) {
            case "enable_all":
              $("#"+id_campo).removeAttr('disabled');
                //-----------------------------
              break;
            case "disable_all":
              $("#"+id_campo).attr('disabled', 'true');
                //-----------------------------
              break;
            case "enable_a":
              if ( (id_campo != "fkID_linea_investigacion") && (id_campo != "fkID_asesor") && (id_campo != "fkID_fase") ) {
                  //console.log(" Enable "+id_campo)
                  $("#"+id_campo).removeAttr('disabled');
                }else{
                  //console.log(id_campo)
                  $("#"+id_campo).attr('disabled', 'true');
                };
                //-----------------------------
              break;
            case "disable_a":
              if (((id_campo != "fkID_linea_investigacion") && (id_campo != "fkID_asesor") && (id_campo != "fkID_fase"))) {
                  //console.log(" Disable "+id_campo)
                  if ( (id_campo != "pkID") ) {
                    $("#"+id_campo).attr('disabled', 'true');
                  }                 

                }else{
                  //console.log(id_campo)
                  $("#"+id_campo).removeAttr('disabled');
                };
                //-----------------------------
              break;      
          }

      });
    }

     //Función para insertar en la tabla cambio_estado_grupo_inv, despues de insertar en la tabla proyecto
   function insertCambioEGI(fecha_a, estado, grupo){

      var query = " INSERT INTO `cambio_estado_grupo_inv` VALUES (NULL, '"+fecha_a+"', "+estado+", "+grupo+")";

      console.log(query);

      $.ajax({
          async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          //location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });

   };

     //Función para insertar en la tabla cambio_estado_grupo_inv, despues de insertar en la tabla proyecto
   function updateEstadoG(grupo){

      var query = "UPDATE `grupo` SET `fkID_estado` = 1 WHERE grupo.pkID = "+grupo+"";

      console.log(query);

      $.ajax({
          async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          //location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });

   };



	 $("[name*='elimina_proyecto']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'proyecto',
  		nom_tabla:'proyecto',
      auditar:true,
  		functionBefore:function(ajustes){
  			console.log('Ejecutando antes de todo...');
  			console.log(ajustes);  			
  		},
  		functionAfter:function(data){
  			console.log('Ejecutando despues de todo...');
  			console.log(data);  		
  		}
	 });


	 
	//---------------------------------------------------------

  
  //---------------------------------------------------------
  //validacion de los estados del proyecto
  //fkID_estado_proyecto->selector en donde apareceran los estados.
  //---------------------------------------------------------

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
      window.location.href = $(this).attr('href');
    });

  //
    sessionStorage.setItem("id_tab_proyecto",null);
  //---------------------------------------------------------



});
