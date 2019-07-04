<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_proyecto_grupo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_proyecto_grupo">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_proyecto_grupo" name="form_proyecto_grupo" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_grupos" name="fkID_grupos">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text" class=" control-label">Linea de investigación</label>
                        <textarea class="form-control" id="linea_investigacion" name="linea_investigacion" placeholder="Linea de investigación proyecto" required = "true"> </textarea>
                    </div>

                    <div class="form-group">
                        <label for="text" class="control-label">Pregunta de Investigación</label>
                        <textarea class="form-control" id="pregunta" name="pregunta" placeholder="Pregunta de investigación del proyecto" required = "true"> </textarea>
                    </div>

                    <div class="form-group">
                        <label for="text" class=" control-label">Objetivo General</label>
                        <textarea class="form-control" id="objetivo_general" name="objetivo_general" placeholder="Objetivo general del proyecto" required = "true"> </textarea>
                    </div>


                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionproyecto_grupo" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionproyecto_grupo"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->