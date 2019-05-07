<?php
/**/
	include_once '../DAO/respuestas_bDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class respuestas_bController extends respuestas_bDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 44; //id de la tabla modulos
			$this->NameCookieApp = $NomCookiesApp;
			
		}
		
		
		//Funciones-------------------------------------------
		//Espacio para las funciones de esta clase.
		
		//permisos---------------------------------------------------------------------
		//$arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
		//$edita = $arrPermisos[0]["editar"];
		//$elimina = $arrPermisos[0]["eliminar"];
		//$consulta = $arrPermisos[0]["consultar"];
		//-----------------------------------------------------------------------------
		public function getTablaRespuestabPregunta($pkID){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $respuesta_b_campos = [                   
                    ["nombre"=>"respuesta"],
                    ["nombre"=>"pregunta"],
                    ["nombre"=>"fkID_usuario"],
                    ["nombre"=>"fkID_grupo"]
                ];
                //la configuracion de los botones de opciones
                $respuesta_b_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"respuesta_b",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"respuesta_b",
                        "permiso"=>$elimina,
                     ]

                ];

                $array_opciones = [
		          "modulo"=>"respuesta_b",//nombre del modulo definido para jquerycontrollerV2
		          "title"=>"Click Ver Detalles",//etiqueta html title
		          "href"=>"detalles_respuesta_b.php?id_respuesta_b=",
		          "class"=>"detail"//clase que permite que añadir el evento jquery click
		        ];	
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $respuesta_b = $this->getRespuestasB($pkID);


            //Instancia el render
            $this->table_inst = new RenderTable($respuesta_b,$respuesta_b_campos,$respuesta_b_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($respuesta_b) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($respuesta_b) && ($consulta==0)){

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
