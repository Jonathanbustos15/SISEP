<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_album_taller" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_album_taller">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_album_taller" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_taller" name="fkID_taller" value="<?php echo $pkID_taller; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text" class=" control-label">Nombre del Album</label>
                        <input type="text" class="form-control" id="nombre_album" name="nombre_album" placeholder="Nombre del album " required = "true">
                    </div>

                    <div class="form-group">
                        <label for="fecha_creacion" class="control-label">Fecha de Creación</label>
                        <input type="date" class="form-control" id="fecha_album" name="fecha_creacion" placeholder="Fecha de creación del grupo" required = "true" value="<?php echo date("Y-m-d");?>">
                    </div>

                    <div class="form-group" hidden>
                        <label for="adjunto" id="lbl_url_foto" class=" control-label"></label>
                        <input type="text" class="form-control" id="url_foto" name="url_foto[]" required = "true" multiple="" >
                    </div>


                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionalbum_taller" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionalbum_taller"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->