<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_grupo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_grupo">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_grupo" method="POST">
                <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del grupo" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Tipo de Grupo</label>                        
                        <?php $grupoInst->getSelectTipoGrupos(); ?>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Grado</label>                        
                        <?php $grupoInst->getSelectGrados(); ?>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Institución</label>                        
                        <?php $grupoInst->getSelectInstituciones(); ?>  
                    </div>

                    <div class="form-group">
                        <label for="fecha_creacion" class="control-label">Fecha de Creación</label>
                        <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" placeholder="Fecha de creación del grupo" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Tutor</label>                        
                        <?php $grupoInst->getSelectTutor(); ?>  
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Docente</label>                        
                        <?php $grupoInst->getSelectDocente(); ?>   
                    </div>

                    <div class="form-group">
                        <label for="url_imagen" class="control-label">Adjuntar Logo</label>  
                        <input id="fileupload" type="file" name="files[]" data-url="../server/php/" multiple>
                    </div>

                    <div class="form-group">
                            <input type="text" class="form-control" id="url_logo" name="url_logo" disabled="disabled" >
                    </div>

                </form>

                    <div id='select_tutor'>
                      <label class="control-label">Tutores Asignados</label> 
                      <form id="frm_tutor_grupo" name="frm_tutor_grupo"></form>
                    </div> 

                    <div id='select_tutor'>
                      <label class="control-label">Docentes Asignados</label> 
                      <form id="frm_docente_grupo" name="frm_docente_grupo"></form>
                    </div> 

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actiongrupo" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actiongrupo"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->