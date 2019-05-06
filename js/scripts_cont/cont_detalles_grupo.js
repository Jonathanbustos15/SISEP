$(function(){
	 
	 //https://github.com/jsmorales/jquery_controllerV2
	 //console.log("https://github.com/jsmorales/jquery_controllerV2")
	 
	 
	 $("#btn_nuevoestudianteg").jquery_controllerV2({
	 	nom_modulo:'grupo_estudiante',
  		titulo_label:'Asignar Estudiante',
  		functionBefore : function(){
  			$("#fkID_usuario").removeAttr('disabled');
  		}
	 });
	 
	 $("#btn_actiongrupo_estudiante").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'grupo_estudiante',
	    nom_tabla:'usuario_grupo'
	 });
	 
	 $("[name*='edita_grupo_estudiante']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'grupo_estudiante',
  		nom_tabla:'usuario_grupo',
  		titulo_label:'Edita Estudiante',
  		tipo_load:2,
  		functionBefore : function(){
  			$("#fkID_usuario").attr('disabled', 'true');
  		}
	 });
	 
	 $("[name*='elimina_grupo_estudiante']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'grupo_estudiante',
  		nom_tabla:'usuario_grupo'
	 });

	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	/*$("#btn_nuevodocente").jquery_controllerV2({
	 	nom_modulo:'grupo_docente',
  		titulo_label:'Asignar Docente',  		
	 });
	*/
	 $("#btn_actiongrupo_docente").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'grupo_docente',
	    nom_tabla:'usuario_grupo'
	 });

	 $("[name*='edita_grupo_docente']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'grupo_docente',
  		nom_tabla:'usuario_grupo',
  		tipo_load:2,
  		titulo_label:'Edita Docente',
	 });
	 
	 $("[name*='elimina_grupo_docente']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'grupo_docente',
  		nom_tabla:'usuario_grupo'
	 });
	//---------------------------------------------------------
	// Seteo de tabs de los detalles 

	tabs.nom_tab_default = "li_general";
	tabs.nombre_storage = "id_tab_grupo";
	tabs.arr_no_permit = ["",null,"null"];
	tabs.setTabs()
	//---------------------------------------------------------

	//---------------------------------------------------------
	/*
	validacion de estudiantes en grupos

	El estudiante no puede estar en mas de 1 grupo.
	No puede estar en un grupo mas de 1 vez.

	solo el hecho de estar en la tabla usuario_grupo
	no debe aparecer en la lista de estudiantes en grneral.

	--toDo list
	++ cons1 = select de todo lo que esta en la tabla usuarios_grupo
	++ cons2 = select de los usuarios de tipo estudiante que sean del
	grado correspondiente al grupo actual.

	-- si coincide algun dato de cons2 con cons1 no cargarlo al
	select.

	*/
	var valEstudiantes = new valGrupo("fkID_usuario","form_grupo_estudiante");

	valEstudiantes.setFuncSelect()

	var valDocentes = new valGrupo("fkID_usuario","form_grupo_docente","fkID_rol");
	valDocentes.tipo_cons = 2;
	
	valDocentes.setFuncSelect()

	//console.log(valEstudiantes.sel_institucion_grupo)
	//---------------------------------------------------------

	//---------------------------------------------------------
	//validacion de creacion de proyecto
	//grupo_id

	valCreaProyecto.selector = "btn_nuevoproyecto";
	valCreaProyecto.validaNuevo($("#grupo_id").val())	
	//---------------------------------------------------------

	//---------------------------------------------------------
});
