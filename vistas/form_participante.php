 <!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_participante" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_participante">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_participante" method="POST">
                <br>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombres" class=" control-label">Nombres</label>
                        <input type="text" class="form-control" id="nombre_participante" name="nombre_participante" placeholder="Nombre del participante" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="apellidos" class=" control-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido_participante" name="apellido_participante" placeholder="Apellidos del participante" required = "true">
                    </div>


                    <div class="form-group">
                        <label for="" class=" control-label">Tipo De Documento</label>
                        <?php
$participanteInst->getSelectTipoDocumento();
?>
                    </div>

                    <div class="form-group">
                        <label for="numero_documento" class=" control-label">Número de Documento</label>
                        <input type="number" min="1" class="form-control" id="documento_participante" name="documento_participante" placeholder="Número de Documento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="numero_documento" class=" control-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_participante" name="telefono_participante" placeholder="Teléfono del participante" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class=" control-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_participante" name="direccion_participante" placeholder="Direccion del participante" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class=" control-label">Email</label>
                        <input type="email" class="form-control" id="email_participante" name="email_participante" placeholder="Email del participante" required = "true">
                    </div>


                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionparticipante" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionparticipante"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->