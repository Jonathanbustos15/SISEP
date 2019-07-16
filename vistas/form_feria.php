<!-- Form actor-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_feria" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_feria">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_feria" method="POST">
                <br> 
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_feria" class="control-label">Fecha de la Feria</label>
                        <input type="date" class="form-control" id="fecha_feria" name="fecha_feria" placeholder="Fecha de la Feria" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="fkID_tipo_feria" class="control-label">Tipo de Taller</label>
                            <select class="form-control" id="fkID_tipo_feria" name="fkID_tipo_feria" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> required = "true">
                              <option value="" selected>Elija el Tipo de Feria</option>
                              <?php 
                                  $FeriaInst->getSelectTipoFeria();
                               ?>
                            </select>
                    </div>                

                    <div class="form-group">
                        <label for="descripcion_feria" class="control-label">Lugar de la Feria</label>                        
                        <input type="text" class="form-control" id="lugar_feria" name="lugar_feria" placeholder="Lugar de la Feria" required = "true">
                    </div>       

                    <div class="form-group" hidden="true">
                        <label class="control-label"></label>
                        <input type="text" name="fkID_proyectoM" id="fkID_proyectoM" value=<?php 
                        echo $FeriaInst->getcpm(); ?>>
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionferia" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionferia"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->