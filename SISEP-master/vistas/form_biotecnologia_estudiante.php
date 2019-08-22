<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_biotecnologia_estudiante" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_biotecnologia_estudiante">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_biotecnologia_estudiante" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">Estudiantes</label>
                        <?php $detalles_biotecnologiaInst->getSelectEstudiantes();?>
                    <button id="btn_nuevoestudiante" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_estudiante"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
</form>
                    <div id='select_tutor'>
                      <label class="control-label">Estudiantes Asignados</label>
                      <form id="frm_estudiante_grupo" name="frm_estudiante_grupo"></form>
                    </div>



        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionbiotecnologia_estudiante" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionbiotecnologia_estudiante"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->