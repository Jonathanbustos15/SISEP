$(function(){
	
	console.log("Js de Grupo de formación.")
		//--------------------------------------
	$("#btn_nuevocapacitador").jquery_controllerV2({
	 	nom_modulo:'grupof_capacitador',
  		titulo_label:'Asignar Capacitador',
  		functionBefore : function(){
  			$("#fkID_usuario").removeAttr('disabled');
  		}
	 });
	 
	 $("#btn_actiongrupof_capacitador").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'grupof_capacitador',
	    nom_tabla:'usuario_grupo_formacion'
	 });
	 
	 $("[name*='edita_grupof_capacitador']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'grupof_capacitador',
  		nom_tabla:'usuario_grupo_formacion',
  		titulo_label:'Edita Capacitador',
  		tipo_load:2,
  		functionBefore : function(){
  			$("#fkID_usuario").attr('disabled', 'true');
  		}
	 });
	 
	 $("[name*='elimina_grupof_capacitador']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'grupof_capacitador',
  		nom_tabla:'usuario_grupo_formacion'
	 });

	
	//--------------------------------------

	$("#btn_nuevodocentegf").jquery_controllerV2({
	 	nom_modulo:'grupof_docente',
  		titulo_label:'Asignar Docente', 
  		functionBefore : function(){
  			$("#fkID_usuario").removeAttr('disabled');
  		} 		
	 });

	 $("#btn_actiongrupof_docente").jquery_controllerV2({
	 	tipo:'inserta/edita',	    
	    nom_modulo:'grupof_docente',
	    nom_tabla:'usuario_grupo_formacion'
	 });

	 $("[name*='edita_grupof_docente']").jquery_controllerV2({
	 	tipo:'carga_editar',
  		nom_modulo:'grupof_docente',
  		nom_tabla:'usuario_grupo_formacion',
  		tipo_load:2,
  		titulo_label:'Edita Docente',
  		functionBefore : function(){
  			$("#fkID_usuario").attr('disabled', 'true');
  		}
	 });
	 
	 $("[name*='elimina_grupof_docente']").jquery_controllerV2({
	 	tipo:'eliminar',
  		nom_modulo:'grupof_docente',
  		nom_tabla:'usuario_grupo_formacion'
	 });


	 //-------------------------------------
	tabs.nom_tab_default = "li_general";

	tabs.nombre_storage = "id_tab_grupof";

	tabs.arr_no_permit = ["",null,"null"];

	tabs.setTabs()


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
	var valCapacitadores = new valGrupo("fkID_usuario","form_grupof_capacitador");

	valCapacitadores.setFuncSelect()

	/*var valDocentes = new valGrupo("fkID_usuario","form_grupof_docente");
	valDocentes.tipo_cons = 2;
	
	valDocentes.setFuncSelect()
*/


	
});