$(function(){
   
   //https://github.com/jsmorales/jquery_controllerV2
   //console.log(date)
   
   $("#btn_nuevogrupo").jquery_controllerV2({
    nom_modulo:'grupo',
      titulo_label:'Nuevo Grupo',
      functionBefore:function(ajustes){
        //funciones de novedades          
        novedades.hideParent(true)
        //---------------------------
      }
   });
   
   $("#btn_actiongrupo").jquery_controllerV2({
    tipo:'inserta/edita',     
      nom_modulo:'grupo',
      nom_tabla:'grupo',    
      recarga : false,
      auditar:true,
      functionBefore:function(ajustes){
        novedades.newOwner(ajustes.action)
      },
      functionAfter:function(data,ajustes){
      console.log('Ejecutando despues de todo...');
          console.log(data);
            console.log(ajustes);
            var tipo_user = leerCookie("log_sisep_IDtipo");
            console.log(tipo_user);
            var pkID_user = leerCookie("log_sisep_id");
            //dbGen.db_general
            if (ajustes.action == "crear") {

              
              var id_last_usuario = data[0].last_id;
              
              if(tipo_user == 8){
                insertDocenteGrupo(pkID_user, id_last_usuario, 6);
              }
          
                //(tabla_aux,nom_id_ini,id_ini,reload)
                
                var grupos_proyectoM = new ins_proyectoM("grupos_proyectoM","fkID_grupo",data[0].last_id,true);

                grupos_proyectoM.insProyM();
                
            }

            var accion = $("#btn_actiongrupo").attr("data-action")        

        fileAfter()                

      }
   });

   //Función para insertar en la tabla auxiliar usuario_grupo, despues de insertar en la tabla grupo
   function insertDocenteGrupo(docente, grupo, rol){

      var query = " INSERT INTO `usuario_grupo` VALUES (NULL, "+docente+", "+grupo+", "+rol+")";

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



   self.fileAfter = function (){

    /**/
    if (filesList.name) {
      //console.log("No está vacío")

      $("#not_logo").html('<img src="../bower_components/blueimp-file-upload/img/loading.gif" height="20" width="20"> Subiendo logo ...')             
    
          $('#fileupload').fileupload('send', {files: filesList})
          .success(function (result, textStatus, jqXHR) {
            
            $("#not_logo").html("El logo se ha subido con éxito.")

            setTimeout(function() {
               location.reload();
            }, 2000);

          })
        .error(function (jqXHR, textStatus, errorThrown) {              
            //console.log(jqXHR)
            //$("#not_logo").html("El logo no se subió.")             
        })
        .complete(function (result, textStatus, jqXHR) {
          console.log(result)               
        });

    }else{

      $("#not_logo").html('<img src="../bower_components/blueimp-file-upload/img/loading.gif" height="20" width="20"> Por favor espere ...')              

      setTimeout(function() {
             location.reload();
          }, 2000);
    }

   }

   $("[name*='edita_grupo']").jquery_controllerV2({
    tipo:'carga_editar',
      nom_modulo:'grupo',
      nom_tabla:'grupo',
      titulo_label:'Edita grupo',
      tipo_load:1,
      functionBefore:function(ajustes){
        //-----------------------------------------------------
        novedades.hideParent(false)
      },
      functionAfter:function(data){
        console.log('Ejecutando despues de todo...');
        console.log(data);

          id_grupo = data.mensaje[0].pkID

                        
      }
   });


  
   
  // var id_grupo = 0;

   $("[name*='elimina_grupo']").jquery_controllerV2({
    tipo:'eliminar',
      nom_modulo:'grupo',
      nom_tabla:'grupo',
      recarga:false,
      auditar:true,
      functionBefore:function(ajustes){
        //-----------------------------------------------------
        console.log(ajustes.id)

        id_grupo = ajustes.id;
      },
      functionAfter:function(data){
        console.log(data)

        if (data.estado == "ok") {
          //eliminaGrupoUsuarioReg(id_grupo)
          eliminaGrupoProyectoM(id_grupo)
        }           
      }
   });

  

     //----Función que elimina los registros de la tabla auxiliar grupos_proyectoM
    function eliminaGrupoProyectoM(fkID_grupo){

      var query = " DELETE FROM `grupos_proyectoM` WHERE fkID_grupo = "+fkID_grupo;

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
  $( "#fecha_creacion" ).datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "1930:2040",
    changeYear: true,
    showButtonPanel: true,      
  });
    

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
  /**/

  var filesList = {};

  $('#fileupload').fileupload({
    autoUpload : false,
    change: function (e, data) {
      $("#url_logo").val(data.files[0].name)
      $("#not_logo").html("Archivo: "+data.files[0].name)
      filesList = data.files[0];
      console.log(filesList)
      }
  });

  //---------------------------------------------------------
  var novedades = new follow("novedades","btn_nuevonovedad","frm_modal_grupo","frm_novedad","grupo","btn_actionnovedad");
  
  /**/
  $("#btn_nuevonovedad").jquery_controllerV2({
      nom_modulo:'novedad',
      titulo_label:'Nueva Novedad',
      functionAfter:function(){
        novedades.newFollow()
        novedades.updateFollow()  
      }
    });

    //$("#btn_actionnovedad").
  //---------------------------------------------------------

  //
  sessionStorage.setItem("id_tab_grupo",null);
  //---------------------------------------------------------

  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //click al detalle en cada fila----------------------------
  $('.table').on( 'click', '.detail', function () {
        window.location.href = $(this).attr('href');
  });
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//-------------------------------------------------------------
//experimento overlooker
$("#form_grupo").overlooker({
    validations:[
        {
            id : "nombre",
            expresion : "no_vacio",
            evento : "change"
        },        
        {
            id : "descripcion",
            expresion : "no_vacio",
            evento : "change"
        }
    ],    
});

//-------------------------------------------------------------
});
