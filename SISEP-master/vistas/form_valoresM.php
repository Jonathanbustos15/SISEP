<!-- Form valores_metas-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_valoresM" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_valoresM">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

              <form id="form_valoresM" method="POST">
                <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del valor" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="valor" class="control-label">Valor</label>
                            <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor de la meta" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="fecha_ini" class="control-label">Fecha Inicio</label>            
                        <input type="text" class="form-control" id="fecha_iniM" name="fecha_ini" placeholder="Fecha de inicio" required = "true">                        
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin" class="control-label">Fecha Fin</label>  
                         <input type="text" class="form-control" id="fecha_finM" name="fecha_fin" placeholder="Fecha de finalización" required = "true">                      
                    </div>

                    <div class="form-group">
                        <label for="script" class="control-label">Script</label>                    
                        <textarea  class="form-control" id="script" name="script" placeholder="Script de la meta" required = "true"></textarea> 
                    </div>   

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionvaloresM" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionvaloresM"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->