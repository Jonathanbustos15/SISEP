<!-- Form participantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_documento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_documento">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_documento" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_salida" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha_doc" name="fecha_doc" placeholder="Fecha de documento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de documento" required = "true">
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actiondocumento" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actiondocumento"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
