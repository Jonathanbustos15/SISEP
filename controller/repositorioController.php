<?php
/**/

include_once '../DAO/repositorioDAO.php';
include_once 'helper_controller/render_table.php';

class repositorioController extends repositorioDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $id_modulo_estudiantes;
    public $id_modulo_docentes;
    public $table_inst;
    public $repositoriosId;

    public function __construct() 
    {

        include '../conexion/datos.php';

        $this->id_modulo             = 25; //id de la tabla modulos
        $this->id_modulo_estudiantes = 30; //id de la tabla modulos
        $this->id_modulo_docentes    = 26; //id de la tabla modulos
        $this->NameCookieApp         = $NomCookiesApp;

    }

    public function getTablaDocumentos(){


            include("../Conexion/datos.php");
            

                $this->documentos = $this->getDocumentos();

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------             

            //valida si hay proyecto
            if($this->documentos){

                for($a=0;$a<sizeof($this->documentos);$a++){

                 $id = $this->documentos[$a]["pkID"];
                 $nombre = $this->documentos[$a]["nom_doc"];
                 $ruta = $this->documentos[$a]["ruta"];                
                 $tipo = $this->documentos[$a]["nom_tipoDocumento"];
                 $nombre_tsubtipo = $this->documentos[$a]["nombre_tsubtipo"];

                 //<td>'.$id.'</td>                               

                 echo '
                             <tr>
                                 
                                 <td>'.$tipo.'</td>
                                 <td>'.$nombre_tsubtipo.'</td>                               
                                 <td>'.$nombre.'</td>                                                                                                  
                                 <td>
                                     <a id="btn_doc" title="Descargar Archivo" name="download_documento" type="button" data-id-documento="'.$id.'" class="btn btn-success" href = "../server/php/files/'.$ruta.'" target="_blank" ><span class="glyphicon glyphicon-download-alt"></span></a>
                                     <a class="btn btn-info" title="Visualizar Archivo con Google Docs" href="https://docs.google.com/viewer?url='.$this->ruta_visor_multiple.''.$ruta.'" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a>
                                     
                                     <button id="btn_eliminar" title="Eliminar" name="elimina_documento" type="button" class="btn btn-danger" data-id-documento = "'.$id.'" '; if ($elimina != 1){echo 'disabled="disabled"';} echo '><span class="glyphicon glyphicon-remove"></span></button>
                                 </td> 
                             </tr>';
                };


            }elseif(($this->documentos) && ($consultaDocumentos==0)){

             echo "<tr>
                      
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>                                                                                                             
                   </tr>
                   <div class='alert alert-danger' role='alert'>                        
                        En este momento no tiene permiso de <strong>Consulta</strong> para <strong>Proyectos/Documentos.</strong>                       
                   </div>";
            }else{

             echo "<tr>                                        
                       
                       <td></td>
                       <td></td>
                       <td></td>                                                                                                          
                       <td></td>
                   </tr>
                   <div class='alert alert-danger' role='alert'>
                        En este momento no hay <strong>Registros</strong> para este <strong>Proyecto</strong> o el filtro no coincide.                      
                   </div>";
            };

        }

    public function getTablarepositorioFactura($pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $repositorio_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "numero_factura"],
            ["nombre" => "valor_facturas"],
            ["nombre" => "fecha_factura"],
        ];
        //la configuracion de los botones de opciones
        $repositorio_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "factura",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "factura",
                "permiso" => $elimina,
            ],

        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $repositorio = $this->getFactura($pkID_proyectoM);
        //print_r($repositorio);

        //Instancia el render
        $this->table_inst = new RenderTable($repositorio, $repositorio_campos, $repositorio_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($repositorio) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($repositorio) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablarepositorioAnticipo($pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $repositorio_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "fecha_anticipo"],
            ["nombre" => "anticipo"],
            ["nombre" => "anticipo_legalizado"],
            ["nombre" => "valor_pendiente"],
        ];
        //la configuracion de los botones de opciones
        $repositorio_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "anticipo",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "anticipo",
                "permiso" => $elimina,
            ],

        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $repositorio = $this->getAnticipo($pkID_proyectoM);
        //print_r($repositorio);

        //Instancia el render
        $this->table_inst = new RenderTable($repositorio, $repositorio_campos, $repositorio_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($repositorio) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($repositorio) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getDetallerepositorio(){

        $objetivo = $this->getObjetivos();

        for ($a = 0; $a < sizeof($objetivo); $a++) {
            echo '<h2>'.$objetivo[$a]['objetivo'].'</h2>';
            echo '<table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                          <th colspan="1" class="text-center">Actividad</th>
                          <th colspan="1" class="text-center">Descripción</th>
                          <th colspan="1" class="text-center">Valor Actividad</th>
                          <th colspan="1" class="text-center">Valor Ejecutado</th>
                      </tr>  
                  </thead>
                  <tbody>';
            $actividad = $this->getActividad($objetivo[$a]['pkID']);
            for ($b = 0; $b < sizeof($actividad); $b++) {
               $totalac = $this->getActividadTotal($actividad[$b]['pkID']); 
            echo '<tr>
                          <td colspan="1" class="text-center" style="background-color: #F4ECF7"><h4>'.$actividad[$b]['numero'].'</h4></td>
                          <td colspan="1" class="text-left" style="background-color: #F4ECF7"><h4>'.$actividad[$b]['actividad'].'</h4></td>
                          <td colspan="1" class="text-center" style="background-color: #A3C7EE"><h4>$'. number_format($actividad[$b]['valor_actividad'],0,'.', '.').'</h4></td>
                          <td colspan="1" class="text-center" style="background-color: #95F388"><h4>$'. number_format($totalac[0]['total'],0,'.', '.').'</h4>
                          </td>
                      </tr>';

            }
            echo '</tbody>
              </table>';

        }
    }

    public function getSelectCategoria()
    {

        $tipo = $this->getCategoria();

        echo '<select name="fkID_categoria" id="fkID_categoria" class="form-control" required = "true" style="width: 93%;display: inline;">
                        <option value="" selected>Elija la Categoria</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre_tdoc"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectCategoria2()
    {

        $tipo = $this->getCategoria();

        echo '<select name="fkID_categoria" id="fkID_categoria" class="form-control" required = "true">
                        <option value="" selected>Elija la Categoria</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre_tdoc"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectSubCategoria($pkID)
    {

        $tipo = $this->getSubcategoria($pkID);

        echo '<select name="fkID_subcategoria" id="fkID_subcategoria" class="form-control" required = "true" style="width: 93%;display: inline;">
                        <option value="" selected>Elija la SubCategoria</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre_tdoc"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectActividad()
    {

        $tipo = $this->getActividad();

        echo '<select name="fkID_actividad" id="fkID_actividad" class="form-control" required = "true">
                        <option value="" selected>Elija la Actividad</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option id='fkID_actividad_form_' data-nombre='" . $tipo[$a]["actividad"] . "' value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["actividades"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectArchivos($pkID)
    {

        $tipo = $this->getTipoProyecto($pkID);
        if ($tipo[0]["pkID"] != ""){
            for ($a = 0; $a < sizeof($tipo); $a++) {
                echo '<li class="list-group-item"><a href="#"><img src="../img/carpeta.png">&nbsp;'.$tipo[$a]["nom_tipoDocumento"].'</a>';
                $subtipo = $this->getSubtipo($tipo[$a]["fkID_tipo"]);
                if ($subtipo[0]["pkID"] != "") {
                    echo '<ul>';
                  for ($b = 0; $b < sizeof($subtipo); $b++) {
                    echo '<li class="list-group-item"><a href="#"><img src="../img/carpeta.png">&nbsp;'.$subtipo[$b]["nombre_tsubtipo"].'</a>';
                    $documentos = $this->getDocumen($subtipo[$b]["fkID_subtipo"]);
                    if ($documentos[0]["pkID"] != "") {
                        echo '<ul>';
                        for ($c = 0; $c < sizeof($documentos); $c++) {
                          echo '<li class="list-group-item"><p><a href="../server/php/files/'.$documentos[$c]["ruta"].'" style="color:#1b75de; font-weight: bold;"><span class="glyphicon glyphicon-save-file"></span>&nbsp;'.$documentos[$c]["ruta"].'</a></p></li>';  
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                  } 
                  echo '</ul>';
                }
                echo '</li>';
            }
        }
    }

      

}