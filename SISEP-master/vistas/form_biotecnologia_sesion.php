<!-- Form actor-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_biotecnologia_sesion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_biotecnologia_sesion">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_biotecnologia_sesion" method="POST">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_sesion" class="control-label">Fecha de la sesión</label>
                        <input type="date" class="form-control" id="fecha_sesion" name="fecha_sesion" placeholder="Fecha del taller de Formación" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="descripcion_sesion" class="control-label">Descripción de la Sesión</label>
                        <textarea class="form-control" id="descripcion_sesion" name="descripcion_sesion" placeholder="Descripción breve del Taller"></textarea>
                    </div>


                    <div class="form-group" hidden="true">
                        <label class="control-label"></label>
                        <input type="text" name="fkID_biotecnologia" id="fkID_biotecnologia" value=<?php echo $pkID_biotecnologia; ?>>
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionsesion" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionsesion"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->