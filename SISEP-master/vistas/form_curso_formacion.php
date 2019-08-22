<!-- Form lugar apropiación-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_cursof" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_cursof">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_cursof" method="POST">
                <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del curso de formación" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="objetivo" class="control-label">Objetivo</label>                    
                        <textarea  class="form-control" id="objetivo" name="objetivo" placeholder="Objetivo del curso" required="true"></textarea> 
                    </div>

                    <div class="form-group">
                        <label for="intensidad" class="control-label">Intensidad (Horas)</label>  
                         <input type="number" min="1" class="form-control" id="intensidad" name="intensidad" placeholder="Intensidad del curso" required = "true">                     
                    </div>

                     <div class="form-group">
                        <label for="resultados" class="control-label">Resultados Esperados</label>                    
                        <textarea rows="4" class="form-control" id="resultados" name="resultados" placeholder="Resultados del curso" required="true"></textarea> 
                    </div>
                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actioncursof" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actioncursof"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->