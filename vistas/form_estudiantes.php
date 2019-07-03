<!-- Form estudiantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_estudiante" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_estudiante">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_estudiante" method="POST">  
                <br>

                	<div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombres" class=" control-label">Nombres</label>                        
                        <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" placeholder="Nombre del estudiante" required = "true">                        
                    </div>

                    <div class="form-group">
                        <label for="apellidos" class=" control-label">Apellidos</label>                        
                        <input type="text" class="form-control" id="apellido_estudiante" name="apellido_estudiante" placeholder="Apellidos del estudiante" required = "true">                        
                    </div>


                    <div class="form-group">
                        <label for="" class=" control-label">Tipo De Documento</label>
                        <?php 
                            $estudiantesInst->getSelectTipoDocumento();
                         ?>
                    </div> 

                    <div class="form-group">
                        <label for="numero_documento" class=" control-label">Número de Documento</label>                    
                        <input type="number" min="1" class="form-control" id="documento_estudiante" name="documento_estudiante" placeholder="Número de Documento" required = "true">                        
                    </div>                                

                    <div  class="form-group">
                        <label for="" class="control-label">Grado que Cursa</label>                       <?php
                            $estudiantesInst->getSelectGrados();
                         ?>
                    </div>                                       

                </form>                      

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionestudiante" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionestudiante"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->