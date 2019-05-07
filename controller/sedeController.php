<?php
/**/
	include_once '../DAO/sedeDAO.php';
	include_once 'helper_controller/render_table.php';
		
	class sedeController extends sedeDAO{
		
		public $NameCookieApp;
		public $id_modulo;
		public $table_inst;
		
		
		public function __construct() {
			
			include('../conexion/datos.php');
			
			$this->id_modulo = 50; //id de la tabla modulos
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

		public function getTablaSede(){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $sede_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"direccion"],
                    ["nombre"=>"telefono"],
                    ["nombre"=>"email"],
                   /* ["nombre"=>"codigo_dane"],
                    ["nombre"=>"nom_departamento"],
                    ["nombre"=>"nom_municipio"],
                    ["nombre"=>"nom_zona"],
                    ["nombre"=>"nom_tipo_escuela"],
                    ["nombre"=>"nom_tipo_sede"]*/
                ];
                //la configuracion de los botones de opciones
                $sede_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"sede",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"sede",
                        "permiso"=>$elimina,
                     ]

                ];

                $array_opciones = [
                  "modulo"=>"sede",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_sede.php?id_sede=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $sede = $this->getSedes();


            //Instancia el render
            $this->table_inst = new RenderTable($sede,$sede_campos,$sede_btn,$array_opciones);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($sede) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($sede) && ($consulta==0)){

             $this->table_inst->render_blank();

             echo "<h3>En este momento no tiene permiso de consulta.</h3>";

            }else{

             $this->table_inst->render_blank();

             echo "<h3>En este momento no hay registros.</h3>";
            };
            //---------------------------------------------------------------------------------

        }


        public function getTablaSedesInstitucion($pkID_institucion){       

            //permisos-------------------------------------------------------------------------
            $arrPermisos = $this->getPermisosModulo_Tipo($this->id_modulo,$_COOKIE[$this->NameCookieApp."_IDtipo"]);
            $edita = $arrPermisos[0]["editar"];
            $elimina = $arrPermisos[0]["eliminar"];
            $consulta = $arrPermisos[0]["consultar"];
            //---------------------------------------------------------------------------------

            //Define las variables de la tabla a renderizar

                //Los campos que se van a ver
                $sede_campos = [
                   // ["nombre"=>"pkID"],
                    ["nombre"=>"nombre"],
                    ["nombre"=>"direccion"],
                    ["nombre"=>"telefono"],
                    ["nombre"=>"email"],
                   /* ["nombre"=>"codigo_dane"],
                    ["nombre"=>"nom_departamento"],
                    ["nombre"=>"nom_municipio"],
                    ["nombre"=>"nom_zona"],
                    ["nombre"=>"nom_tipo_escuela"],
                    ["nombre"=>"nom_tipo_sede"]*/
                ];
                //la configuracion de los botones de opciones
                $sede_btn =[

                     [
                        "tipo"=>"editar",
                        "nombre"=>"sede",
                        "permiso"=>$edita,
                     ],
                     [
                        "tipo"=>"eliminar",
                        "nombre"=>"sede",
                        "permiso"=>$elimina,
                     ]

                ];

                /*$array_opciones = [
                  "modulo"=>"sede",//nombre del modulo definido para jquerycontrollerV2
                  "title"=>"Click Ver Detalles",//etiqueta html title
                  "href"=>"detalles_sede.php?id_sede=",
                  "class"=>"detail"//clase que permite que añadir el evento jquery click
                ];*/
            //---------------------------------------------------------------------------------
            //carga el array desde el DAO
            $sede = $this->getSedeInstitucionId($pkID_institucion);


            //Instancia el render
            $this->table_inst = new RenderTable($sede,$sede_campos,$sede_btn,[]);
            //---------------------------------------------------------------------------------     

            //valida si hay usuarios y permiso de consulta
            if( ($sede) && ($consulta==1) ){

                //ejecuta el render de la tabla
                $this->table_inst->render();                

            }elseif(($sede) && ($consulta==0)){

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
