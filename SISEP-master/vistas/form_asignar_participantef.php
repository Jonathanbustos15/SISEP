 <!-- Form participantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_asignacion_participantef" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_asignarparticipante">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_asignarparticipante" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">Participantes</label>
                        <?php
                          $feriaInst->getSelectParticipante();
                          ?>
                    <button id="btn_nuevoparticipante" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_participante"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
</form>
                    <div id='select_participante'>
                      <label class="control-label">Participantes Asignados</label>
                      <form id="frm_participante_taller" name="frm_participante_taller"></form>
                    </div>



        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionasignarparticipante" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionasignarparticipante"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->