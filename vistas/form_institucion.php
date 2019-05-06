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
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la institución" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Código DANE</label>
                        <input type="text" class="form-control" id="codigo_dane" name="codigo_dane" placeholder="Codigo DANE de la institución" required = "true">
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