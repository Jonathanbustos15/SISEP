<?php
/**/

include_once '../DAO/grupoDAO.php';
include_once 'helper_controller/render_table.php';

class grupoController extends grupoDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $id_modulo_estudiantes;
    public $id_modulo_docentes;
    public $table_inst;
    public $gruposId;

    public function __construct()
    {

        include '../conexion/datos.php';

        $this->id_modulo             = 25; //id de la tabla modulos
        $this->id_modulo_estudiantes = 30; //id de la tabla modulos
        $this->id_modulo_docentes    = 26; //id de la tabla modulos
        $this->NameCookieApp         = $NomCookiesApp;

    }

    //Funciones-------------------------------------------
    //Espacio para las funciones de esta clase.

    //permisos---------------------------------------------------------------------
    //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
    //$edita = $arrPermisos[0]["editar"];
    //$elimina = $arrPermisos[0]["eliminar"];
    //$consulta = $arrPermisos[0]["consultar"];
    //-----------------------------------------------------------------------------

    public function getTablaGrupo()
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "nom_tipo"],
            ["nombre" => "anio"],
            ["nombre" => "nom_institucion"],
            ["nombre" => "nom_grado"],
        ];
        //la configuracion de los botones de opciones
        $grupo_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "grupo",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "grupo",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [
                  "modulo"=>"institucion",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"   => "detalles_grupo.php?id_grupo=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getGrupos();
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablaGruposUsuario($pkID_user)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "nom_tipo"],
            ["nombre" => "lema"],
            ["nombre" => "fecha_creacion"],
            ["nombre" => "nom_institucion"],
            ["nombre" => "nom_grado"],
        ];
        //la configuracion de los botones de opciones
        $grupo_btn = [

            [
                "tipo"    => "editar",
                "nombre"  => "grupo",
                "permiso" => $edita,
            ],
            [
                "tipo"    => "eliminar",
                "nombre"  => "grupo",
                "permiso" => $elimina,
            ],

        ];

        $array_opciones = [
            "modulo" => "grupo", //nombre del modulo definido para jquerycontrollerV2
            "title"  => "Click Ver Detalles", //etiqueta html title
            "href"   => "detalles_grupo.php?id_grupo=",
            "class"  => "detail", //clase que permite que añadir el evento jquery click
        ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getGruposUsuario($pkID_user);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, $array_opciones);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getSelectGrados()
    {

        $m_u_Select = $this->getGrados();

        echo '<select id="fkID_grado" name="fkID_grado" class="form-control" required="true">
                  <option value="" selected>Elija el Grado</option>'
                  ;
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '">' . $m_u_Select[$i]["nombre"] . '</option>';
        };
        echo '</select>';
    }

    public function getSelectInstituciones()
    {

        $tipo = $this->getInstitu();
            
          echo '<select name="fkID_institucion" id="fkID_institucion" class="form-control" required = "true">
                        <option value="" selected>Elija la institucion</option>';
                for($a=0;$a<sizeof($tipo);$a++){
                    echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre_institucion"]."</option>";
                }
            echo "</select>";
    }

    public function getSelectTipoGrupos()
    {

        $tipo = $this->getTipoGrupo();
            
          echo '<select name="fkID_tipo_grupo" id="fkID_tipo_grupo" class="form-control" required = "true">
                        <option value="" selected>Elija el Tipo de Grupo</option>';
                for($a=0;$a<sizeof($tipo);$a++){
                    echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
                }
            echo "</select>";
    }

    public function getSelectTutor()
    {

        $tipo = $this->getTutor();
            
          echo '<select name="fkID_tutor" id="fkID_tutor" class="form-control" required = "true">
                        <option value="" selected>Elija el Tutor del Grupo</option>';
                for($a=0;$a<sizeof($tipo);$a++){
                    echo "<option id='fkID_tutor_form_' data-nombre='".$tipo[$a]["nombres"]."' value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombres"]."</option>";
                }
            echo "</select>";
    }

    public function getSelectDocente()
    {

        $tipo = $this->getDocente();
            
          echo '<select name="fkID_docente" id="fkID_docente" class="form-control" required = "true">
                        <option value="" selected>Elija el Docente del Grupo</option>';
                for($a=0;$a<sizeof($tipo);$a++){
                    echo "<option id='fkID_docente_form_' data-nombre='".$tipo[$a]["nombres"]."' value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombres"]."</option>";
                }
            echo "</select>";
    }

    public function getSelectRoles($pkID_tipo)
    {

        $tipo = $this->getRoles($pkID_tipo);

        echo "<select name='fkID_rol' id='fkID_rol' class='form-control' required='true'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectDocentesGrado($pkID_grado)
    {

        $tipo = $this->getDocentesGrado($pkID_grado);

        echo "<select name='fkID_usuario' id='fkID_usuario' class='form-control'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . " " . $tipo[$a]["apellido"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectGradoUsuarios($pkID_grado, $pkID_institucion)
    {

        $m_u_Select = $this->getGradoUsuarios($pkID_grado, $pkID_institucion);

        echo '<select id="fkID_usuario" name="fkID_usuario" class="form-control" required="true">
                  <option></option>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '">' . $m_u_Select[$i]["nombre"] . " " . $m_u_Select[$i]["apellido"] . '</option>';
        };
        echo '</select>';
    }

    public function getDataGrupoGen($pkID)
    {

        $this->gruposId = $this->getGruposId($pkID);

        //print_r($this->gruposId);

        echo '<div class="col-sm-6">

                <div class="text-center">
                  <img src="../server/php/files/' . $this->gruposId[0]["url_logo"] . '" alt="..." height="250" width="250" class="img-thumbnail">
                </div>

              </div>

            <div class="col-sm-6">

              <strong>Nombre: </strong> ' . $this->gruposId[0]["nombre"] . ' <br> <br>
              <strong>Descripción: </strong> ' . $this->gruposId[0]["descripcion"] . ' <br> <br>
              <strong>Institución: </strong> ' . $this->gruposId[0]["nom_institucion"] . ' <br> <br>
              <strong>Grado: </strong> ' . $this->gruposId[0]["nom_grado"] . ' <br> <br>
              <strong>Lema: </strong> ' . $this->gruposId[0]["lema"] . ' <br> <br>
              <strong>Fecha de creación: </strong> ' . $this->gruposId[0]["fecha_creacion"] . ' <br> <br>
              ';

        echo '</div>';

    }

    public function getTablaGrupoUsuarios($fkID_tipo_usuario, $pkID_grupo)
    {

        //permisos-------------------------------------------------------------------------
        if ($fkID_tipo_usuario == 9) {

            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_estudiantes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

            //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita    = $arrPermisos[0]["editar"];
            $elimina  = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];

            //la configuracion de los botones de opciones
            $grupo_btn = [

                [
                    "tipo"    => "editar",
                    "nombre"  => "estudiante",
                    "permiso" => $edita,
                ],
                [
                    "tipo"    => "eliminar",
                    "nombre"  => "estudiante",
                    "permiso" => $elimina,
                ],

            ];

        } else if ($fkID_tipo_usuario == 8) {

            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo_docentes, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);

            //$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita    = $arrPermisos[0]["editar"];
            $elimina  = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];

            //la configuracion de los botones de opciones
            $grupo_btn = [

                [
                    "tipo"    => "editar",
                    "nombre"  => "docente",
                    "permiso" => $edita,
                ],
                [
                    "tipo"    => "eliminar",
                    "nombre"  => "docente",
                    "permiso" => $elimina,
                ],
                [
                    "tipo"   => "descarga_multiple",
                    "nombre" => "docente",
                ],

            ];
        }

        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $grupo_campos = [
            // ["nombre"=>"pkID"],
            ["nombre" => "nombre"],
            ["nombre" => "apellido"],
            ["nombre" => "nom_rol"],
            //["nombre"=>"nom_tUsuario"],
        ];

        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $grupo = $this->getGrupoUsuarios($fkID_tipo_usuario, $pkID_grupo);
        //print_r($grupo);

        //Instancia el render
        $this->table_inst = new RenderTable($grupo, $grupo_campos, $grupo_btn, []);
        //---------------------------------------------------------------------------------

        //valida si hay usuarios y permiso de consulta
        if (($grupo) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($grupo) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros.</h3>";
        }; /**/
        //---------------------------------------------------------------------------------

    }

}
