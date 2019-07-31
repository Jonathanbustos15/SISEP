<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_biotecnologia" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_biotecnologia">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_biotecnologia" method="POST" enctype="multipart/form-data">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_proyecto_marco" name="fkID_proyecto_marco">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha de acompañamiento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="institucion" class="control-label">Institución</label>
                        <?php $biotecnologiaInst->getSelectInstituciones();?>
                    </div>

                    <div class="form-group">
                        <label for="grado" class="control-label">Grado</label>
                       <?php $biotecnologiaInst->getSelectGrados();?>
                    </div>

                    <div class="form-group">
                        <label for="curso" class="control-label">Curso</label>
                        <?php $biotecnologiaInst->getSelectCursos();?>
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionbiotecnologia" type="button" class="btn btn-primary botonnewbiotecnologia" data-action="-">
            <span id="lbl_btn_actionbiotecnologia"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
