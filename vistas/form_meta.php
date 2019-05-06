<!-- Form meta-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_meta" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_meta">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_meta" method="POST">
                <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la meta" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="total" class="control-label">Total</label>
                            <input type="text" class="form-control" id="total" name="total" placeholder="Total" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="fecha_ini" class="control-label">Fecha Inicio</label>            
                        <input type="text" class="form-control" id="fecha_ini" name="fecha_ini" placeholder="Fecha de inicio" required = "true">                        
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin" class="control-label">Fecha Fin</label>  
                         <input type="text" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Fecha final" required = "true">                      
                    </div>      

                </form>


        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionmeta" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionmeta"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->