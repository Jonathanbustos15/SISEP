<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_acompanamiento_marco" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_acompanamiento_marco">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_acompanamiento_marco" method="POST" enctype="multipart/form-data">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_proyecto_marco" name="fkID_proyecto_marco" value="<?php echo $pkID_proyectoM ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion_acompañamiento" name="descripcion_acompañamiento" required="true">
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionacompanamiento_marco" type="button" class="btn btn-primary botonnewacompanamiento_marco" data-action="-">
            <span id="lbl_btn_actionacompanamiento_marco"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
