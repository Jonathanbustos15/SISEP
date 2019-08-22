<?php
/**/
include_once '../DAO/docentesDAO.php';
include_once 'helper_controller/render_table.php';

class docentesController extends docentesDAO
{

    public $NameCookieApp;
    public $id_modulo;
    public $id_modulo_materias;
    public $id_modulo_grados;
    public $docentesId;

    public function __construct()
    {

        include '../conexion/datos.php';

        $this->id_modulo     = 26; //id de la tabla modulos
        $this->NameCookieApp = $NomCookiesApp;

    }

    public function getSelectRoles($tipo_user)
    {

        $tipo = $this->getRoles($tipo_user);

        echo "<select name='fkID_rol' id='fkID_rol' class='form-control' required='true'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectDepartamentos()
    {

        $tipo = $this->getDepartamentos();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    public function getSelectMunicipios()
    {

        $tipo = $this->getMunicipios();

        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
    }

    //---------------------------------------------------------------------------------
    public function getTablaDocentes($pkID_proyectoM)
    {

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo, $_COOKIE[$this->NameCookieApp . "_IDtipo"]);
        $edita       = $arrPermisos[0]["editar"];
        $elimina     = $arrPermisos[0]["eliminar"];
        $consulta    = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $array_campos = [
            //["nombre"=>"pkID"],
            ["nombre" => "nombres"],
            ["nombre" => "documento_docente"],
            ["nombre" => "institucion"],
            ["nombre" => "email_docente"],
        ];
        //la configuracion de los botones de opciones
        $array_btn = [

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

        ];
        //---------------------------------------------------------------------------------
        //get de los datos
        $docentes = $this->getDocente($pkID_proyectoM);

        //Instancia el render
        $this->table_inst = new RenderTable($docentes, $array_campos, $array_btn, $array_opciones);
        //---------------------------------------------------------------------------------
        /**/
        //valida si hay resultados
        if (($docentes) && ($consulta == 1)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } elseif (($docentes) && ($consulta == 0)) {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no tiene permiso de Consulta.</h3>";

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros creados.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    //---------------------------------------------------------------------------------
    public function getTablaDocentesNoLogin($proyectoM_docente)
    {

        //Los campos que se van a ver
        $array_campos = [
            //["nombre"=>"pkID"],
            ["nombre" => "alias"],
            ["nombre" => "nombre"],
            ["nombre" => "apellido"],
            ["nombre" => "nom_cargo"],
            ["nombre" => "nom_rol"],
        ];

        //---------------------------------------------------------------------------------
        //get de los datos
        $docentes = $this->getDocentesNoLogin($proyectoM_docente);

        //print_r($docentes);
        //Instancia el render
        $this->table_inst = new RenderTable($docentes, $array_campos, [], []);
        //---------------------------------------------------------------------------------
        /**/
        //valida si hay resultados
        if (($docentes)) {

            //ejecuta el render de la tabla
            $this->table_inst->render();

        } else {

            $this->table_inst->render_blank();

            echo "<h3>En este momento no hay registros creados.</h3>";
        };
        //---------------------------------------------------------------------------------

    }

    public function getTablaDocentesMaterias($pkID)
    {

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $array_campos = [
            //["nombre"=>"pkID"],
            ["nombre" => "nombre"],
        ];
        //la configuracion de los botones de opciones
        $array_btn = [

        ];
        //---------------------------------------------------------------------------------
        //get de los datos
        $materias = $this->getDocentesMaterias($pkID);

        //Instancia el render
        $this->table_inst = new RenderTable($materias, $array_campos, $array_btn, []);

        $this->table_inst->render();
    }

    public function getTablaGradosMaterias($pkID)
    {

        //Define las variables de la tabla a renderizar

        //Los campos que se van a ver
        $array_campos = [
            //["nombre"=>"pkID"],
            ["nombre" => "nombre"],
        ];
        //la configuracion de los botones de opciones
        $array_btn = [

        ];
        //---------------------------------------------------------------------------------
        //get de los datos
        $grados = $this->getDocentesGrados($pkID);

        //Instancia el render
        $this->table_inst = new RenderTable($grados, $array_campos, $array_btn, []);

        $this->table_inst->render();
    }

    public function getSelectTipoDocumento()
    {

        $tipo = $this->getTipoDocumento();

        echo '<select name="fkID_tipo_documento" id="fkID_tipo_documento" class="form-control" required = "true">
                        <option value="" selected>Elija el tipo de documento</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectInstitu()
    {

        $tipo = $this->getInstitu();

        echo '<select name="fkID_institucion" id="fkID_institucion" class="form-control" required = "true">
                        <option value="" selected>Elija la institucion</option>';
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre_institucion"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectCargo()
    {

        $tipo = $this->getCargo();

        echo "<select name='fkID_cargo' id='fkID_cargo' class='form-control'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectNivelFormacion()
    {

        $tipo = $this->getNivelFormacion();

        echo "<select name='fkID_nivel_formacion' id='fkID_nivel_formacion' class='form-control' required = 'true'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectGrupoEtnico()
    {

        $tipo = $this->getGrupoEtnico();

        echo "<select name='fkID_grupo_etnico' id='fkID_grupo_etnico' class='form-control'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectGenero()
    {

        $tipo = $this->getGenero();

        echo "<select name='fkID_genero' id='fkID_genero' class='form-control' required = 'true'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectInstitucion()
    {

        $tipo = $this->getInstitucion();
        //print_r($tipo);

        echo "<select name='fkID_institucion' id='fkID_institucion' class='form-control' required = 'true'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectInstitucionNoLogin($proyectoM_docente)
    {

        $tipo = $this->getInstitucionNoLogin($proyectoM_docente);

        echo "<select name='fkID_institucion' id='fkID_institucion' class='form-control' required = 'true'>";
        echo "<option></option>";
        for ($a = 0; $a < sizeof($tipo); $a++) {
            echo "<option value='" . $tipo[$a]["pkID"] . "'>" . $tipo[$a]["nombre"] . "</option>";
        }
        echo "</select>";
    }

    public function getSelectMateriasUsuarios()
    {

        $m_u_Select = $this->getMaterias();

        echo '<select id="select_materia" class="form-control" data-accion="select">
                      <option></option>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '" data-nombre = "' . $m_u_Select[$i]["nombre"] . '" >' . $m_u_Select[$i]["nombre"] . '</option>';
        };
        echo '</select>';
    }

    public function getSelectGradosUsuarios()
    {

        $m_u_Select = $this->getGrados();

        echo '<select id="select_grado" class="form-control" data-accion="select">
                      <option></option>';
        for ($i = 0; $i < sizeof($m_u_Select); $i++) {
            echo '<option value="' . $m_u_Select[$i]["pkID"] . '" data-nombre = "' . $m_u_Select[$i]["nombre"] . '" >' . $m_u_Select[$i]["nombre"] . '</option>';
        };
        echo '</select>';
    }
    //-----------------------------------------------------------------------------

    public function getDataDocenteGen($pkID)
    {

        $this->docentesId = $this->getDocentesId($pkID);

        /**/
        echo '
				  <div class="col-sm-12">

					<div class="col-sm-6">

						<strong>Nombre: </strong> ' . $this->docentesId[0]["nombre"] . ' ' . $this->docentesId[0]["apellido"] . ' <br> <br>
						<strong>Email: </strong> ' . $this->docentesId[0]["email"] . ' <br> <br>
						<strong>Tipo de Documento: </strong> ' . $this->docentesId[0]["nom_tdoc"] . ' <br> <br>
						<strong>Número de Documento: </strong> ' . $this->docentesId[0]["numero_documento"] . ' <br> <br>
						<strong>Fecha de Nacimiento: </strong> ' . $this->docentesId[0]["fecha_nacimiento"] . ' <br> <br>
						<strong>Dirección: </strong> ' . $this->docentesId[0]["direccion"] . ' <br> <br>
						<strong>Número de Teléfono: </strong> ' . $this->docentesId[0]["numero_telefono"] . ' <br> <br>
						<strong>Cargo: </strong> ' . $this->docentesId[0]["nom_cargo"] . ' <br> <br>

						';

        echo '</div>

					<div class="col-sm-6">

						<strong>Fecha Vinculación: </strong> ' . $this->docentesId[0]["fecha_vinculacion"] . ' <br> <br>
						<strong>Nivel de Formación: </strong> ' . $this->docentesId[0]["nom_nformacion"] . ' <br> <br>
						<strong>Título: </strong> ' . $this->docentesId[0]["nombre_titulo"] . ' <br> <br>
						<strong>Último Título: </strong> ' . $this->docentesId[0]["ultimo_titulo"] . ' <br> <br>
						<strong>Grupo Etnico: </strong> ' . $this->docentesId[0]["nom_getnico"] . ' <br> <br>
						<strong>Institución: </strong> ' . $this->docentesId[0]["nom_institucion"] . ' <br> <br>
						<strong>Género: </strong> ' . $this->docentesId[0]["nom_genero"] . ' <br> <br>
					</div>
			';

        echo '</div>';

    }
    //-----------------------------------------------------------------------------

}
