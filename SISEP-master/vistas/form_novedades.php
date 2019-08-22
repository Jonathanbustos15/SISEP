<div class="modal fade" id="frm_novedad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_novedad">-</h3>
      </div>
      <div class="modal-body">
        
        <form id="form_novedad" name="form_novedad" method="POST">                
            <br>
                <div class="form-group" hidden="true">                     
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pkIDNovedadOwner" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha_novedad" class="control-label">Fecha de Creación - Novedad</label>                 
                    <input type="text" class="form-control" id="fecha_novedad" required = "true" readonly>           
                </div>
                                                       
                <div class="form-group">
                    <label for="novedadNuevo" class="control-label">novedades (caracteres no permitidos: #%&!()/)</label>                    
                    <textarea id="novedadNuevo" class="form-control" required = "true"></textarea>                    
                </div> 
        </form>
                
      </div>

      <div class="modal-footer">    
        <button id="btn_actionnovedad" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionnovedad">-</span>
        </button>
      </div>

    </div>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
  </div>
  
</div>
  
<!-- /form modal 2-->

<!--<script src="../js/scripts_cont/cont_novedad.js"></script>-->