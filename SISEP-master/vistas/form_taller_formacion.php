<!-- Form actor-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_taller" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_taller">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_taller" method="POST">
                <br> 
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_taller" class="control-label">Fecha del Taller</label>
                        <input type="date" class="form-control" id="fecha_taller" name="fecha_taller" placeholder="Fecha del taller de Formación" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="fkID_tipo_taller" class="control-label">Tipo de Taller</label>
                            <select class="form-control" id="fkID_tipo_taller" name="fkID_tipo_taller" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> required = "true">
                              <option value="" selected>Elija el Tipo de Taller</option>
                              <?php 
                                  $TallerInst->getSelectTipoTaller();
                               ?>
                            </select>
                    </div>                 

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción del Taller</label>                        
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción breve del Taller"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fkID_tutor" class="control-label">Tutor</label>
                            <select class="form-control" id="fkID_tutor" name="fkID_tutor" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> required = "true">
                              <option value="" selected>Elija el Tutor</option>
                              <?php 
                                  $TallerInst->getSelectTutor();
                               ?>
                            </select>
                    </div>         

                    <div class="form-group" hidden="true">
                        <label class="control-label"></label>
                        <input type="text" name="fkID_proyectoM" id="fkID_proyectoM" value="<?php echo $pkID_proyectoM; ?>">
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actiontaller" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actiontaller"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->