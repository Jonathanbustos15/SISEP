<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_funcionario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_funcionario">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_funcionario" method="POST">
                <br>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombres" class=" control-label">Nombres</label>
                        <input type="text" class="form-control" id="nombre_funcionario" name="nombre_funcionario" placeholder="Nombre del funcionario" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="apellidos" class=" control-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido_funcionario" name="apellido_funcionario" placeholder="Apellidos del funcionario" required = "true">
                    </div>


                    <div class="form-group">
                        <label for="" class=" control-label">Tipo De Documento</label>
                        <?php
$funcionarioInst->getSelectTipoDocumento();
?>
                    </div>

                    <div class="form-group">
                        <label for="numero_documento" class=" control-label">Número de Documento</label>
                        <input type="number" min="1" class="form-control" id="documento_funcionario" name="documento_funcionario" placeholder="Número de Documento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="numero_documento" class=" control-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_funcionario" name="telefono_funcionario" placeholder="Teléfono del Funcionario" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class=" control-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_funcionario" name="direccion_funcionario" placeholder="Direccion del Funcionario" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class=" control-label">Email</label>
                        <input type="email" class="form-control" id="email_funcionario" name="email_funcionario" placeholder="Email del Funcionario" required = "true">
                    </div>


                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionfuncionario" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionfuncionario"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->