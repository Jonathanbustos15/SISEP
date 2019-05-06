$(function(){
  
	//---------------------------------------------------------
  /*Instancia datatables para la tabla de auditoria*/

  var table_audit = $('#tbl_auditoria').dataTable({
    "ordering": false,
    "language": {
                  "url": "../bower_components/datatables-plugins/i18n/Spanish.lang.json"
                }
  });

  //Set null del sessionstorage------------------------------
  sessionStorage.setItem("id_tab_institucion",null);
  //---------------------------------------------------------

});
