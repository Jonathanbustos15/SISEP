<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_estado_participante" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_estado_participante">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_estado_participante" method="POST" enctype="multipart/form-data">  
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
                        <label for="nombre" class="control-label">Nombre Participante</label>
                        <input type="text" class="form-control" id="nombre_participante" name="nombre_participante" placeholder="Nombre del participante" required = "true" readonly>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Documento del Participante</label>
                        <input type="text" class="form-control" id="documento_participante" name="documento_participante" placeholder="Documento del participante" required="true" readonly>
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">Estado</label>
                        <?php
                        $detalles_grupoInst->getSelectEstadoe();
                        ?>  
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionestado_participante" type="button" class="btn btn-primary botonnewestado_participante" data-action="-">
            <span id="lbl_btn_actionestado_participante"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->