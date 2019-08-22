<!-- Form respuesta_b-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_respuesta_p" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_respuesta_p">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_respuesta_p" method="POST">

                    <br>
        
                    <div class="form-group " hidden>                                          
                        <input type="text" class="form-control" id="pkID" name="pkID">                        
                    </div>


                    <div class="form-group">
                        <label id="pregunta_p_text" class="control-label"></label>
                        <hr>                                                              
                    </div>                                      

                    <div class="form-group" hidden="true">
                        <label id="" class="control-label">fkID_pregunta</label>
                        <input type="text" class="form-control" id="fkID_pregunta_p" name="fkID_pregunta_p">                 
                    </div>

                    <div class="form-group" hidden="true">
                        <label id="" class="control-label">fkID_usuario</label>                                             
                        <input type="text" class="form-control" id="fkID_usuario" name="fkID_usuario">                   
                    </div>

                </form>

                <div id="div-rptas" class="form-group"></div>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionrespuesta_p" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionrespuesta_p"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->