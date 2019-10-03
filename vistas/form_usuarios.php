<!-- Form usuarios -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_usuario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_usuario">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_usuario" method="POST">
                <br>
                    <div class="form-group " hidden>                     
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="alias" class="control-label">Alias</label>
                            <input type="text" class="form-control" id="alias" name="alias" placeholder="Nombre de usuario en el sistema" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="pass" class="control-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña de usuario en el sistema" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="numero_documento" class="control-label">Número de Documento</label>
                            <input type="number" class="form-control" id="numero_documento" name="numero_documento" placeholder="Documento de identificación" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombres" class="control-label">Nombres</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del usuario" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="apellidos" class="control-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos del usuario" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class=" control-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email del Usuario" required = "true">
                    </div>
                                
                    <div class="form-group">
                        <label for="fkID_tipo" class="control-label">Tipo de Usuario</label>
                            <select class="form-control" id="fkID_tipo" name="fkID_tipo" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> >
                              <option></option>
                              <?php 
                                  $usuariosInst->getSelectTipoUsuarios();
                               ?>
                            </select>
                    </div>

                    <hr>

                     <div id="select_usuario_proyectoM" class="form-group" <?php if ($_COOKIE[$NomCookiesApp."_IDtipo"] != 1){echo 'hidden="true"';} ?>>
                        <label for="" class="control-label">Proyectos Marco</label>
                        <?php
                            $usuariosInst->getSelectProyectosMUsuarios();
                         ?>  
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">        
        <button id="btn_actionusuario" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionusuario"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->