<!-- Form actor-->
<div class="modal fade bs-example-modal-lg" id="frm_modal_actor" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_actor">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_actor" method="POST">
                <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fkID_tipo" class="control-label">Tipo de Actor</label>
                            <select class="form-control" id="fkID_tipo" name="fkID_tipo" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> required = "true">
                              <option></option>
                              <?php 
                                  $actorInst->getSelectTipoActor();
                               ?>
                            </select>
                    </div> 

                    <div class="form-group " id="div_actor">                     
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="actor" class="control-label">Nombre del Actor</label>
                            <input type="text" class="form-control" id="actor" name="actor" placeholder="Nombre del Actor" required = "true">
                    </div>                 

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>                        
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción breve del actor"></textarea>
                    </div>

<!--
                    <div class="form-group">
                        <label for="fkID_tipo_vinculacion" class="control-label">Tipo de Vinculación</label>
                            <select class="form-control" id="fkID_tipo_vinculacion" name="fkID_tipo_vinculacion" <?php //if ($crea != 1){echo 'disabled="disabled"';} ?> required = "true">
                              <option></option>
                              <?php 
                                  $actorInst//->getSelectTipoVincu();
                               ?>
                            </select>
                    </div><br>
-->                    
                    <div class="form-group">
                        <label for="fecha_socializacion" class="control-label">Fecha Socialización</label>
                        <input type="text" class="form-control" id="fecha_socializacion" name="fecha_socializacion" placeholder="Fecha de socializacion">
                    </div>

                    <div class="form-group">
                        <label for="fecha_vinculacion" class="control-label">Fecha Vinculación</label>
                        <input type="text" class="form-control" id="fecha_vinculacion" name="fecha_vinculacion" placeholder="Fecha de vinculación">
                    </div><br>

                    <div><p class="bg-info"><strong>Contacto</strong></p></div>

                    <div class="form-group">
                        <label for="nombre_contacto" class="control-label">Nombres</label>
                            <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" placeholder="Nombre del contacto" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="apellido_contacto" class="control-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellido_contacto" name="apellido_contacto" placeholder="Apellidos del contacto" required = "true">
                    </div>

                     <div class="form-group">
                        <label for="cargo_contacto" class="control-label">Cargo</label>
                            <input type="text" class="form-control" id="cargo_contacto" name="cargo_contacto" placeholder="Cargo del contacto" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="telefono_contacto" class=" control-label">Número de Teléfono</label>                
                        <input type="text" class="form-control" id="telefono_contacto" name="telefono_contacto" placeholder="Número de teléfono del contacto" required = "true">                        
                    </div>

                    <div class="form-group">
                        <label for="email_contacto" class=" control-label">Email</label>                        
                        <input type="text" class="form-control" id="email_contacto" name="email_contacto" placeholder="Email del contacto" required = "true">                        
                    </div>

                    <div class="form-group">
                        <label for="direccion_contacto" class=" control-label">Dirección</label>                        
                        <input type="text" class="form-control" id="direccion_contacto" name="direccion_contacto" placeholder="Dirección del contacto" required = "true">                        
                    </div>          

                    <div class="form-group" hidden="true">
                        <label class="control-label"></label>
                        <input type="text" name="fkID_proyectoM" id="fkID_proyectoM" value=<?php 
                        echo $actorInst->getcpm(); ?>>
                    </div>

                    

                </form>

                <div class="form-group">
                    <label for="archivo" class="control-label">Adjuntar Documentos</label>                        
                    <input id="fileuploadA" type="file" name="files[]" data-url="../server/php/" multiple>
                </div>

                <br>
                                
                <div id="res_form"></div>

                <div id="not_documentos" class="alert alert-info"></div>       


        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionactor" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionactor"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->