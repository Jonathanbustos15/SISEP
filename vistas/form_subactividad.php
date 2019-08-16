<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_subactividad" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_subactividad">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_subactividad" method="POST" enctype="multipart/form-data">
                <br>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="" class=" control-label">Categoria</label>
                        <?php
                          $repositorioInst->getSelectCategoria2();
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="text" class=" control-label">Nombre de la Sub Actividad</label>
                        <input type="text" class="form-control" id="nombre_subactividad" name="nombre_subactividad" placeholder="Nombre de la Actividad" required = "true">
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
        <button id="btn_actionsubactividad" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionsubactividad"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->