<!-- Form docentes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_docente" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_docente">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_docente" method="POST">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text" class=" control-label">Nombre del Docente</label>
                        <input type="text" class="form-control" id="nombre_docente" name="nombre_docente" placeholder="Nombre de docente " required = "true">
                    </div>

                    <div class="form-group">
                        <label for="text" class=" control-label">Apellido del Docente</label>
                        <input type="text" class="form-control" id="apellido_docente" name="apellido_docente" placeholder="Apellido de docente" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">Tipo de Documento</label>
                        <?php
$docentesInst->getSelectTipoDocumento();
?>
                    </div>

                    <div class="form-group">
                        <label for="documentos" class=" control-label">Numero de Documento</label>
                        <input type="text" class="form-control" id="documento_docente" name="documento_docente" placeholder="Apellidos del docente" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="selectEstudioTecnico" class="control-label">Institución</label>
                            <?php
$docentesInst->getSelectInstitu();
?>
                    </div>


                    <div class="form-group">
                        <label for="numero_documento" class=" control-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_docente" name="telefono_docente" placeholder="Teléfono del Docente" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class=" control-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_docente" name="direccion_docente" placeholder="Direccion del Docente" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class=" control-label">Email</label>
                        <input type="email" class="form-control" id="email_docente" name="email_docente" placeholder="Email del Docente" required = "true">
                    </div>

                <br>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actiondocente" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actiondocente"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->