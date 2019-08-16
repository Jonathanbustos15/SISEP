<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_factura" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_factura">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_factura" method="POST">
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
                        <label for="nombre" class="control-label">Número de factura</label>
                            <input type="text" class="form-control" id="numero_factura" name="numero_factura" placeholder="Número de la factura" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Valor de la factura</label>
                        <div class="input-group text-left">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="valor_factura" name="valor_factura" placeholder="Valor de la factura" required = "true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_factura" class="control-label">Fecha de Creación</label>
                        <input type="date" class="form-control" id="fecha_factura" name="fecha_factura" placeholder="Fecha de creación de la factura" required = "true">
                    </div>

                    <div class="form-group">
                     <label for="nombre" class="control-label">Valor Asignado a la Actividad</label>
                        <div class="input-group text-left">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor Asignado a la actividad" required = "true">
                        </div>
                    </div>

                    <div class="form-group">   
                        <label for="" class="control-label">Objetivo</label>
                        <?php $financieroInst->getSelectObjetivo();?>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Actividad</label>
                        <?php $financieroInst->getSelectActividad();?>
                    </div>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_proyecto_marco" name="fkID_proyecto_marco" value="<?php echo $pkID_proyectoM; ?>">
                        </div>
                    </div>

                </form>

                    <div id='select_actividad'>
                      <label class="control-label">Actividades con Presupuesto Asignado</label>
                      <form id="frm_actividad_factura" name="frm_actividad_factura"></form>
                    </div>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionfactura" type="button" class="btn btn-primary botonnewfactura" data-action="-">
            <span id="lbl_btn_actionfactura"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->