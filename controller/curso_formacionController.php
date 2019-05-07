<?php
/**/
	include_once '../DAO/curso_formacionDAO.php';
	 include_once 'helper_controller/render_table.php';
		
	class curso_formacionController extends curso_formacionDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 45; //id de la tabla modulos
			$this->NameCookieApp = $NomCookiesApp;
			
		}
		
		
		public function getTablaCursos(){       

        //permisos-------------------------------------------------------------------------
        $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
        $edita = $arrPermisos[0]["editar"];
        $elimina = $arrPermisos[0]["eliminar"];
        $consulta = $arrPermisos[0]["consultar"];
        //---------------------------------------------------------------------------------

        //Define las variables de la tabla a renderizar

            //Los campos que se van a ver
            $cursof_campos = [
               // ["nombre"=>"pkID"],
                ["nombre"=>"nombre"],
                ["nombre"=>"objetivo"]                    
            ];
            //la configuracion de los botones de opciones
            $cursof_btn =[

                 [
                    "tipo"=>"editar",
                    "nombre"=>"cursof",
                    "permiso"=>$edita,
                 ],
                 [
                    "tipo"=>"eliminar",
                    "nombre"=>"cursof",
                    "permiso"=>$elimina,
                 ]

            ];

            $array_opciones = [
              "modulo"=>"curso",//nombre del modulo definido para jquerycontrollerV2
              "title"=>"Click Ver Detalles",//etiqueta html title
              "href"=>"detalles_cursof.php?id_curso=",
              "class"=>"detail"//clase que permite que añadir el evento jquery click
            ];
        //---------------------------------------------------------------------------------
        //carga el array desde el DAO
        $cursof = $this->getCursos();


        //Instancia el render
        $this->table_inst = new RenderTable($cursof,$cursof_campos,$cursof_btn,$array_opciones);
        //---------------------------------------------------------------------------------     

        //valida si hay usuarios y permiso de consulta
        if( ($cursof) && ($consulta==1) ){

            //ejecuta el render de la tabla
            $this->table_inst->render();                

        }elseif(($cursof) && ($consulta==0)){

         $this->table_inst->render_blank();

         echo "<h3>En este momento no tiene permiso de consulta.</h3>";

        }else{

         $this->table_inst->render_blank();

         echo "<h3>En este momento no hay registros.</h3>";
        };
        //---------------------------------------------------------------------------------

    }
		
	}
?>
