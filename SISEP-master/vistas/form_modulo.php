<!-- Modal -->
<div class="modal fade" id="form_modal_modulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_modulo">-</h3>
      </div>
      <div class="modal-body">
        
        <form id="form_modulo" method="POST">                
            <br>
                <div class="form-group" hidden>                     
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pkID" name="pkID">
                    </div>
                </div>
                                                       
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>                        
                    <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del Modulo" required = "true">                        
                </div> 
        </form>
                
      </div>

      <div class="modal-footer">    
        <button id="btn_actionmodulo" type="button" class="btn btn-primary botonnewgrupo" data-action="-" disabled="disabled">
            <span id="lbl_btn_actionmodulo">-</span>
        </button>
      </div>

    </div>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
  </div>
  
</div>
  
<!-- /form modal 2-->

<!--<script src="../js/scripts_cont/cont_modulo.js"></script>-->
