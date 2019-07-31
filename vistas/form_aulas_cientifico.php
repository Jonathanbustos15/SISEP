<!-- Form participantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_aulas_cientifico" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_aulas_cientifico">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_aulas_cientifico" method="POST" enctype="multipart/form-data">

                  <br>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre_cien" class="control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_cien" name="nombre_cien" placeholder="Nombre" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="elemento_cien" class="control-label">Elemento</label>
                        <input type="text" class="form-control" id="elemento_cien" name="elemento_cien" placeholder="Elemento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="cantidad" class="control-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad_cien" name="cantidad_cien" placeholder="Cantidad" required = "true" pattern="[0-9]+">
                    </div>
                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionaulas_cientifico" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionaulas_cientifico"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
