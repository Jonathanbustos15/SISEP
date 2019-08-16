<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="form_modal_documentos" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_documentos">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_documentos" method="POST" enctype="multipart/form-data">
                <br>

                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>  


                    <div class="form-group">
                        <label for="" class=" control-label">Categoria</label>
                        <?php
                          $repositorioInst->getSelectCategoria();
                        ?>
                        <button id="btn_nuevoactividad" style="width: 6%;display: inline;" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_actividad"><span class="glyphicon glyphicon-plus"></span></button>
                    </div> 

                    <div class="form-group">
                        <label for="" class=" control-label">Sub Categoria</label>
                        <?php
                          $repositorioInst->getSelectSubCategoria(219);
                        ?>
                        <button id="btn_nuevosubactividad" style="width: 6%;display: inline;" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_subactividad"><span class="glyphicon glyphicon-plus"></span></button>
                    </div> 

                    <div class="form-group" id="documentos">
                        <label for="adjunto" id="lbl_url_foto" class=" control-label">Archivo</label>
                        <input type="file" class="form-control" id="url_archivo" name="url_archivo[]" required = "true" multiple="" >
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
        <button id="btn_actiondocumentos" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actiondocumentos"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->