<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_anticipo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_anticipo">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_anticipo" method="POST">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_anticipo" name="pkID_anticipo">
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_proyecto_marco" name="fkID_proyecto_marco">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Valor del anticipo</label>
                        <div class="input-group text-left">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="valor_anticipo" name="valor_anticipo" placeholder="Valor de la anticipo" required = "true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_anticipo" class="control-label">Fecha de Anticipo</label>
                        <input type="date" class="form-control" id="fecha_anticipo" name="fecha_anticipo" placeholder="Fecha de creación de la anticipo" required = "true">
                    </div>

                    <div class="form-group">
                     <label for="nombre" class="control-label">Valor Legalizado del Anticipo</label>
                        <div class="input-group text-left">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="anticipo_legalizado" name="anticipo_legalizado" placeholder="Valor Asignado a la actividad" required = "true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_anticipo" class="control-label">Fecha de Anticipo Legalizado</label>
                        <input type="date" class="form-control" id="fecha_anticipo_legalizado" name="fecha_anticipo_legalizado" placeholder="Fecha de creación de la anticipo" required = "true">
                    </div>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_proyecto_marco" name="fkID_proyecto_marco" value="<?php echo $pkID_proyectoM; ?>">
                        </div>
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionanticipo" type="button" class="btn btn-primary botonnewanticipo" data-action="-">
            <span id="lbl_btn_actionanticipo"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->