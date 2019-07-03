<!-- Form proyectos marco -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_proyectoM" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_proyectoM">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_proyectoM" method="POST">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre Proyecto Marco</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del proyecto marco" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="fecha_ini" class="control-label">Fecha Inicial</label>
                        <input type="text" class="form-control" id="fecha_ini" name="fecha_ini" placeholder="Fecha de inicio" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin" class="control-label">Fecha Final</label>
                         <input type="text" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Fecha de finalizacion" required = "true">
                    </div>

                     <div class="form-group">
                        <label for="operador" class="control-label">Operador</label>
                            <input type="text" class="form-control" id="operador" name="operador" placeholder="Operador" required = "true">
                    </div>

                    <div class="form-group" hidden="true">
                        <input type="text" class="form-control" id="valor" name="valor" required="true">
                    </div>

                    <div class="form-group">
                        <label for="valor" class="control-label">Valor</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input id="valor_mask" type="text" class="form-control" placeholder="Valor del proyecto marco" required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fuente_recursos" class="control-label">Fuente de Recursos</label>
                        <input type="text" class="form-control" id="fuente_recursos" name="fuente_recursos" placeholder="Fuente de Recursos del proyecto marco" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="financiadores" class="control-label">Financiadores</label>
                        <input type="text" class="form-control" id="financiadores" name="financiadores" placeholder="Financiadores del proyecto marco" >
                    </div>

                    <div class="form-group">
                        <label for="gerente" class="control-label">Gerente</label>
                        <input type="text" class="form-control" id="gerente" name="gerente" placeholder="Gerente del proyecto marco" >
                    </div>

                    <div class="form-group">
                        <label for="interventoria" class="control-label">Interventoria</label>
                        <input type="text" class="form-control" id="interventoria" name="interventoria" placeholder="Interventoria del proyecto marco" >
                    </div>

                    <div class="form-group">
                        <label for="supervisor" class="control-label">Supervisor</label>
                        <input type="text" class="form-control" id="supervisor" name="supervisor" placeholder="Supervisor del proyecto marco" >
                    </div>

                    <hr>

                    <h4>Lugar de Ejecución</h4>

                    <div class="form-group">
                        <label for="fkID_departamento" class="control-label">Departamento</label>
                            <select class="form-control" id="fkID_departamento" name="fkID_departamento" required = "true">
                              <option></option>
                              <?php
$institucionInst->getSelectDepartamentos();
?>
                            </select>
                    </div>

                </form>

                <div id="select_proyectoM_municipio" class="form-group">

                        <label for="" class="control-label">Municipio</label>

                        <select id="select_municipio" class="form-control">
                          <option></option>
                        </select>

                    </div>
                <br>

                <div id='select_municipios'>
                  <label class="control-label">Municipios Asignados</label>
                  <form id="frm_proyectoM_municipios"></form>
                </div>

                <div class="form-group">
                    <label for="archivo" class="control-label">Adjuntar Documentos</label>
                    <input id="fileuploadPM" type="file" name="files[]" data-url="../server/php/" multiple>
                </div>

                    <div id="not_archivo" class="alert alert-info"></div>

                    <div id="res_form"></div>

                <div id="not_documentos" class="alert alert-info"></div>



        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionproyectoM" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionproyectoM"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->