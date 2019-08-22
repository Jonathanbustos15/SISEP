<!-- Form participantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_evidencia" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_evidencia">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_evidencia" method="POST" enctype="multipart/form-data">

                  <br>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_acompanamiento_evidencia" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required = "true">
                    </div>
                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionevidencia" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionevidencia"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
