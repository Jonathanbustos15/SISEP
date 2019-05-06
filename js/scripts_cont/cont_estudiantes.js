$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 

     //no se le pueden asignar cursos al estudiante 
     //solo el curso del grupo
     $("#select_grado").attr('disabled', 'value');

	 $("#btn_nuevoestudiante").jquery_controllerV2({
	 	nom_modulo:'estudiante',
  		titulo_label:'Nuevo Estudiante',
  		functionBefore:function(){
  			//$("#pass").removeAttr('readonly');
  		},
  		functionAfter:function() {
  			//limpia el form
  			$("#"+rel_grados.formulario_add).html("");

  			rel_grados.arrElementos.length = 0;
			rel_grados.arrElementosRelation.length=0;

            //---------------------------------------
            //selecciona el grado del grupo por defecto
            //grado_grupo
            $("#select_grado").val($("#grado_grupo").val());
            
            //setea los parametros iniciales
            rel_grados.id = $("#grado_grupo").val()
            rel_grados.nombre = $("#select_grado").find("option:selected").data('nombre')
            rel_grados.select_elemento('select','crear');
  		}
	 });
	 
	 $("#btn_actionestudiante").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'estudiante',
	    nom_tabla:'usuarios',
	    recarga: false,
	    tipo_ajax : {
	        crear : "inserta_registro",
	        editar : "actualizar"
	    },
        auditar:true,
	    functionAfter:function(data){

	    	var proyectoM = leerCookie("id_proyectoM")

	    	var accion = $("#btn_actionestudiante").attr("data-action")

	    	if (accion == "crear") {

	    		var id_last_usuario = data[0].last_id;

	    		if (data[0].estado == "ok") {
            		insertUsuarioG(id_last_usuario, $('#grupo').val(), $('#fkID_rol').val())
            		insertUsuarioProyectoM(id_last_usuario, proyectoM)
         	}   

	    		rel_grados.serializa_array(rel_grados.crea_array(rel_grados.arrElementos,id_last_usuario));

	    	}else{
              location.reload()
            }
	    }
	 });


	 //Función para insertar en la tabla auxiliar usuario_grupo, despues de insertar en la tabla usuarios
   function insertUsuarioG(estudiante, grupo, rol){

      var query = " INSERT INTO `usuario_grupo` VALUES (NULL, "+estudiante+", "+grupo+", "+rol+")";

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

    //Función para insertar en la tabla auxiliar usuario_proyectoM, despues de insertar en la tabla usuarios
   function insertUsuarioProyectoM(usuario, proyectoM){

      var query = " INSERT INTO `usuario_proyectoM` VALUES (NULL, "+usuario+", "+proyectoM+")";

      console.log(query);

      $.ajax({
          async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });

   };
	 
	 $("[name*='edita_estudiante']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'estudiante',
  		nom_tabla:'usuarios',
  		titulo_label:'Edita Estudiante',
      tipo_load:1,
      functionBefore:function(ajustes){
          console.log('Ejecutando antes de todo...');
          console.log(ajustes);
       
      },
  		functionAfter:function(data){
        console.log('Ejecutando despues de todo...');
        console.log(data);
  			$("#pass").attr('readonly', 'true');

  			var id_usuario = data.mensaje[0].pkID;

  			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        	/**/
        	var query_grados = "select grado.*, usuarios.alias, usuario_grado.pkID as numReg"+ 

                " FROM grado"+

                " INNER JOIN usuario_grado ON usuario_grado.fkID_grado = grado.pkID"+

                " INNER JOIN usuarios ON usuario_grado.fkID_usuario = usuarios.pkID"+

                " WHERE usuarios.pkID = "+id_usuario;

        	rel_grados.carga_elementos(query_grados);
        	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  		}
	 });
	 
	 $("[name*='elimina_estudiante']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'estudiante',
  		nom_tabla:'usuarios',
      recarga:false,
      auditar:true,
      functionBefore:function(ajustes){
        //-----------------------------------------------------
        console.log(ajustes.id)

        id_usuario = ajustes.id;
      },
      functionAfter:function(data){
        console.log(data)

        if (data.estado == "ok") {
          eliminaUsuarioGrupo(id_usuario)
          eliminaUsuarioProyectoM(id_usuario)
        }           
      }
	 });

//----Función que elimina los registros de la tabla auxiliar usuario_grupo
  function eliminaUsuarioGrupo(fkID_usuario){

    var query = " DELETE FROM `usuario_grupo` WHERE fkID_usuario = "+fkID_usuario;

    $.ajax({
      async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });
  }



   //----Función que elimina los registros de la tabla auxiliar usuario_proyectoM
  function eliminaUsuarioProyectoM(fkID_usuario){

    var query = " DELETE FROM `usuario_proyectoM` WHERE fkID_usuario = "+fkID_usuario;

    $.ajax({
      async: false,
          url: '../controller/ajaxController12.php',
          data: "query="+query+"&tipo=consulta_gen",
      })
      .done(function(data) {      
        console.log(data)
        
        setTimeout(function(){
          location.reload()
        },1000)
      })
      .fail(function() {
          console.log("error");
      })
      .always(function() {
          console.log("complete");
      });
  }
   
   
	 
	 //---------------------------------------------------------

   function getAnioActual() {

    var anio = new Date();

    return anio.getFullYear();

   }

   function getMesActual() {

    var mes = new Date();

    return mes.getMonth() + 1;

   }

   console.log(getAnioActual() - 5)

   var anio_actual = getAnioActual();
   var anio_min = getAnioActual() - 5;

	 $( "#fecha_nacimiento" ).datepicker({
		dateFormat: "yy-mm-dd",
		yearRange: "1930:"+anio_min,
		changeYear: true,
		showButtonPanel: true,			
	});

   $( "#fecha_nacimiento" ).change(function(e) {
     console.log("Cambio la fecha nacimiento")
     
     var anio_select = new Date($(this).val());
           
     anio_select.setDate(anio_select.getDate() + 1);
     //console.log(date_actual.getFullYear())
     //console.log(date_actual.getMonth() + 1)

     console.log(anio_select)

     var edad = anio_actual - anio_select.getFullYear();

     //console.log(getMesActual())

     edad = getMesActual() >= anio_select.getMonth() + 1 ? edad : edad - 1;

     console.log(edad)

     $("#edad").val(edad)
   });
//------------------------------------------------------------------------------------------------------------------
//validaciones con plugin overlooker
/**/
$("#form_estudiante").overlooker({
    validations:[
        {
            id : "email",
            expresion : "email",
            evento : "change"
        },        
        {
            id : "numero_documento",
            expresion : "doc_identidad",
            evento : "change"
        },        
        {
            id : "numero_telefono",
            expresion : "telefono",
            evento : "change"
        }
    ],
})
//------------------------------------------------------------------------------------------------------------------

	//click al detalle en cada fila----------------------------
	$('.table').on( 'click', '.detail', function () {
	  window.location.href = $(this).attr('href');
	});
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	var obtHE_grados = {
    	"fkID_grado" : 0,
    	"fkID_usuario" : 0
    }

	self.rel_grados = new matrixRelation("select_grado", "btn_actionestudiante", "grado", "usuario", "frm_usuarios_grados", "usuario_grado", obtHE_grados);

	rel_grados.setup();
	 
	 //console.log(navigator)
	 //alert(navigator.platform)
	//---------------------------------------------------------

  //-------------------------------------------------------------------------
  //complemento usuarios
  var estudiantes_f = new usersGen("form_estudiante");
  estudiantes_f.init()
  
  //-------------------------------------------------------------------------

    //-------------------------------------------------------------------------
    //complemento validacion numero de documento
    var validacion_estudiante = new validaCampoLike('numero_documento','usuarios','numero_documento','form_estudiante','btn_actionestudiante');

    $("#numero_documento").keyup(function(e) {
      validacion_estudiante.validar()
    });
    
    //-------------------------------------------------------------------------
});
