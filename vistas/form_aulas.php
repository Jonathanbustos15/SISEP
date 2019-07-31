<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_aulas" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_aulas">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_aulas" method="POST" enctype="multipart/form-data">
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
                        <label for="num_aula" class="control-label">No Aula</label>
                        <input type="text" class="form-control" id="num_aula" name="num_aula" placeholder="Numero de aula" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha de acompañamiento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del aula" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="institucion" class="control-label">Institución</label>
                        <?php $aulasInst->getSelectInstituciones();?>
                    </div>

                    <div id="div_imagen"></div>

                    <div class="form-check">
                        <label class="form-check-label" for="zona_wifi">Zona Wifi</label>
                        <input type="checkbox" class="form-check-input" id="zona_wifi" name="zona_wifi">
                    </div>

                    <div class="form-group">
                        <label for="fecha_ini_wifi" class="control-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="fecha_ini_wifi" name="fecha_ini_wifi" placeholder="Fecha de inicio">
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin_wifi" class="control-label">Fecha fin</label>
                        <input type="date" class="form-control" id="fecha_fin_wifi" name="fecha_fin_wifi" placeholder="Fecha fin">
                    </div>

                    <div class="form-check">
                        <label class="form-check-label" for="internet">Internet</label>
                        <input type="checkbox" class="form-check-input" id="internet" name="internet">
                    </div>

                    <div class="form-group">
                        <label for="fecha_ini_internet" class="control-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="fecha_ini_internet" name="fecha_ini_internet" placeholder="Fecha de inicio">
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin_internet" class="control-label">Fecha fin</label>
                        <input type="date" class="form-control" id="fecha_fin_internet" name="fecha_fin_internet" placeholder="Fecha fin">
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionaulas" type="button" class="btn btn-primary botonnewaulas" data-action="-">
            <span id="lbl_btn_actionaulas"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
