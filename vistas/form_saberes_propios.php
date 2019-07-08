<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_saber_propio" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_saber">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_saber" method="POST">
                <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_grupo" name="pkID_grupo">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_salida" class="control-label">Fecha de Salida</label>
                        <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" placeholder="Fecha de salida a sabeberes propios" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Grupo Participante</label>                       
                        <?php $saberesInst->getSelectGrupos(); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="control-label">Comunidad Visitada</label>
                            <input type="text" class="form-control" id="comunidad_visitada" name="comunidad_visitada" placeholder="Nombre de la Comunidad Visitada" required = "true">
                    </div>


                    <div class="form-group">
                        <label for="" class="control-label">Asesor</label>                        
                        <?php $saberesInst->getSelectAsesor(); ?>  
                    </div>

                    <div class="form-group">
                        <label for="url_lista" class="control-label">Lista de Participantes</label>  
                        <input id="fileupload_lista" type="file" name="files[]" data-url="../server/php/" multiple>
                    </div>

                    <div class="form-group">
                            <input type="text" class="form-control" id="url_lista" name="url_lista" disabled="disabled" >
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionsaberes" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionsaberes"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->