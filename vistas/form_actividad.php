<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_actividad" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_actividad">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_actividad" method="POST" enctype="multipart/form-data">
                <br>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="text" class=" control-label">Nombre de la Actividad</label>
                        <input type="text" class="form-control" id="nombre_actividad" name="nombre_actividad" placeholder="Nombre de la Actividad" required = "true">
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
        <button id="btn_actionactividad" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionactividad"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->