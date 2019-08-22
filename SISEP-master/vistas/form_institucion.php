

<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_institucion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_institucion">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_institucion" method="POST">
                    <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre Institución</label>
                            <input type="text" class="form-control" id="nombre_institucion" name="nombre_institucion" placeholder="Nombre de la institución" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Código DANE</label>
                        <input type="text" class="form-control" id="codigo_dane" name="codigo_dane" placeholder="Codigo DANE de la institución" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_institucion" name="direccion_institucion" placeholder="Dirección de la institución" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email_institucion" name="email_institucion" placeholder="Email de la institución" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Persona de Contacto</label>
                        <input type="text" class="form-control" id="persona_contacto" name="persona_contacto" placeholder="Persona de contacto" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Telefono</label>
                        <input type="text" class="form-control" id="telefono_institucion" name="telefono_institucion" placeholder="Telefono de la institución" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="selectEstudioTecnico" class="control-label">Municipio</label>
                            <?php
                                  $institucionInst->getSeleccion_Municipio();
                            ?>
                    </div>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="proyecto_marco" name="proyecto_marco" value="<?php echo $pkID_proyectoM; ?>">
                        </div>
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actioninstitucion" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actioninstitucion"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->