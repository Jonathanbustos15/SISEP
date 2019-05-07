<?php
/**/
	include_once '../DAO/asesoriaDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class asesoriaController extends asesoriaDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
		public $asesoriaId;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 40; //id de la tabla modulos
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

		
		public function getTablaAsesoriasProyecto($pkID){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $asesorias_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"fecha"],
                    ["nombre"=>"logros"],
                    ["nombre"=>"dificultades"],
                    ["nombre"=>"fase"],
                    //["nombre"=>"fkID_asesor"],
                    //["nombre"=>"tipo_p"],
                    //["nombre"=>"estado_p"]
                ];
                //la configuracion de los botones de opciones
                $asesorias_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"asesoria",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"asesoria",
                        "permiso"=>$elimina,
                     ],
                     [
                        "tipo"=>"descarga_multiple",
                        "nombre"=>"asesoria",                        
                     ]
                ];

                $array_opciones = [
		          "modulo"=>"asesoria",//nombre del modulo definido para jquerycontrollerV2
		          "title"=>"Click Ver Detalles",//etiqueta html title
		          "href"=>"detalles_asesoria.php?id_asesoria=",
		          "class"=>"detail"//clase que permite que añadir el evento jquery click
		        ];	
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $asesorias = $this->getAsesoriasProyecto($pkID);


            //Instancia el render
            $this->table_inst = new RenderTable($asesorias,$asesorias_campos,$asesorias_btn,[]);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($asesorias) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($asesorias) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }


        public function getTablaAsesorias(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $asesorias_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"fecha"],
                    ["nombre"=>"logros"],
                    ["nombre"=>"dificultades"],
                    //["nombre"=>"fkID_asesor"],
                    //["nombre"=>"tipo_p"],
                    //["nombre"=>"estado_p"]
                ];
                //la configuracion de los botones de opciones
                $asesorias_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"asesoria",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"asesoria",
                        "permiso"=>$elimina,
                     ]

                ];
                /*
                $array_opciones = [
                  "modulo"=>"asesoria",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_asesoria.php?id_asesoria=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];*/  
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $asesorias = $this->getAsesorias();


            //Instancia el render
            $this->table_inst = new RenderTable($asesorias,$asesorias_campos,$asesorias_btn,[]);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($asesorias) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($asesorias) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }

         public function getSelectFase() {
        
            $tipo = $this->getFase();
        
            for($a=0;$a<sizeof($tipo);$a++){
                echo "<option value='".$tipo[$a]["pkID"]."'>".$tipo[$a]["nombre"]."</option>";
            }
        }




    }
?>
