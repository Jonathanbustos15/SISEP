<!-- Form actor-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_aulas_actas" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_aulas_actas">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_aulas_actas" method="POST">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_acta" class="control-label">Fecha del acta</label>
                        <input type="date" class="form-control" id="fecha_acta" name="fecha_acta" placeholder="Fecha del taller de Formación" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="descripcion_acta" class="control-label">Descripción del acta</label>
                        <textarea class="form-control" id="descripcion_acta" name="descripcion_acta" placeholder="Descripción breve del Taller"></textarea>
                    </div>


                    <div class="form-group" hidden="true">
                        <label class="control-label"></label>
                        <input type="text" name="fkID_tiex" id="fkID_tiex" value=<?php echo $pkID_tiex; ?>>
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionactas" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionactas"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->