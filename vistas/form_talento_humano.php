<!-- Form proyectos marco -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_talento_humano" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_talento_humano">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_talento_humano" method="POST">  
                <br>  
                    <div class="form-group " hidden>  
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_proyecto_marco" name="fkID_proyecto_marco">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fkID_funcionario" class="control-label">Funcionario</label>
                            <select class="form-control" id="fkID_funcionario" name="fkID_funcionario" required = "true">
                              <option></option>
                              <?php
$talento_humanoInst->getSelectFuncionarios();    
?>
                            </select>
                            <button id="btn_nuevofuncionario" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_funcionario"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>

                    <div class="form-group">
                        <label for="fkID_departamento" class="control-label">Cargo</label>
                            <select class="form-control" id="fkID_cargo" name="fkID_cargo" required = "true">
                              <option></option>
                              <?php
$talento_humanoInst->getSelectCargos();
?>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="anio_funcionario_cargo" class="control-label">Fecha de Asignación</label>
                        <input type="date" class="form-control" id="anio_funcionario_cargo" name="anio_funcionario_cargo" placeholder="Fecha de creación del grupo" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Estado</label>
                        <select class="form-control" id="estado_funcionario_cargo" name="estado_funcionario_cargo" required = "true">
                          <option value="" selected>Elija un cargo</option>
                          <option >Activo</option>
                          <option >Inactivo</option>
                        </select>
                    </div>
                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actiontalento_humano" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actiontalento_humano"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->