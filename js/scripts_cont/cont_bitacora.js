$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 
	 $("#btn_nuevobitacora").jquery_controllerV2({
	 	nom_modulo:'bitacora',
      	titulo_label:'Nuevo Diario de Investigación',
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);

        $("#chk_evento").click(function(event) {
          console.log($(this)[0]["checked"]);
          chk_rec($(this)[0]["checked"]);         
        });
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(ajustes){
        	console.log('Ejecutando despues de todo...');
          $("#fkID_fase").removeAttr('disabled'); 
        //console.log(ajustes);
        //destruye_cambia_pass();
      	}
	 });

   //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        $("#chk_evento").click(function(event) {

            if(document.getElementById("chk_evento").checked) {
                document.getElementById('chk_evento_hidden').disabled = true;
            }else{
              document.getElementById('chk_evento_hidden').disabled = false;
            }

        });  

        function chk_rec(tipo){

            if (tipo == true) {
                $("#chk_evento").val('1');
            } else{
                $("#chk_evento").val('0');
            };
        }   
	 
	 $("#btn_actionbitacora").jquery_controllerV2({
	 	tipo:'inserta/edita',
      	nom_modulo:'bitacora',
      	nom_tabla:'bitacora',
      //cambiando el tipo de ajax para poder crear el usuario
      //con la contraseña encriptada.
      /*tipo_ajax : {
        crear : "inserta_registro",
        editar : "actualizar"
      },*/
      //recarga:false,
      auditar:true,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
        //$("#btn_actionusuario").html("Esto es antes...")
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data); 

      	}           
	 });
	 
	 $("[name*='edita_bitacora']").jquery_controllerV2({
	 	tipo:'carga_editar',
      	nom_modulo:'bitacora',
      	nom_tabla:'bitacora',
      	titulo_label:'Editar Diario de Investigación',
      	tipo_load:2,
      	functionBefore:function(ajustes){
        	console.log('Ejecutando antes de todo...');
        	console.log(ajustes);
          
       // crea_cambia_pass();
      	},
      	functionAfter:function(data){
        	console.log('Ejecutando despues de todo...');
        	console.log(data);
          $("#fkID_fase").attr('disabled', 'disabled');
        
        	id_bitacora = data.mensaje[0].pkID;

          //--------------------------------------------------
        if(data.mensaje[0].evento == "1") {
          $("#chk_evento")[0]["checked"] = true;
          chk_rec(true)
        }else{
          $("#chk_evento")[0]["checked"] = false;
          chk_rec(false)
        };

        $("#chk_evento").click(function(event) {
          //console.log($(this)[0]["checked"]);
          chk_rec($(this)[0]["checked"]);         
        });

      	}
	 });

	 $("[name*='elimina_bitacora']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'bitacora',
  		nom_tabla:'bitacora',
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
	$( "#fecha_creacion" ).datepicker({
		dateFormat: "yy-mm-dd",
		yearRange: "1930:2040",
		changeYear: true,
		showButtonPanel: true,			
	});
	

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //click al detalle en cada fila----------------------------
    $('.table').on( 'click', '.detail', function () {
      window.location.href = $(this).attr('href');
    });

    var valFases = new valBitacora("fkID_fase","frm_modal_bitacora");

    valFases.setFuncSelect()

  //
    sessionStorage.setItem("id_tab_bitacora",null);
  //---------------------------------------------------------

});
