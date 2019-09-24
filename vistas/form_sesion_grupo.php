<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_sesion_grupo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_sesion_grupo">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_sesion_grupo" method="POST" enctype="multipart/form-data">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_grupo" name="fkID_grupo" value=<?php echo $pkID_grupo; ?>>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Fecha de Sesión</label>
                        <input type="date" class="form-control" id="fecha_sesion" name="fecha_sesion" placeholder="Fecha de Sesión" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Tema</label>
                        <input type="text" class="form-control" id="tema" name="tema" required="true">
                    </div>

                    <div class="form-group" id="documentos">
                        <label for="adjunto" id="lbl_url_lista" class=" control-label">Archivo</label>
                        <input type="file" class="form-control" id="url_lista" name="url_lista[]" required = "true" multiple="" >
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionsesion_grupo" type="button" class="btn btn-primary botonnewsesion_grupo" data-action="-">
            <span id="lbl_btn_actionsesion_grupo"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
