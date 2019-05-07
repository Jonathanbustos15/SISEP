<?php 

//-----------------------------------------------------------
//error_reporting(0);
//-----------------------------------------------------------

    include("valida.php");
    include "scripts_cont.php";


    class mostrar extends valida {

        public $script;

        public function __construct(){

            $this->script = new scripts_pag();
        }
        //------------------------------------------------------------
        private function muestra_encabezado($perfil){

            include "../vistas/encabezado.php";
            //include "../vistas/menu_".$perfil.".php";
            //-----------------------------------------
            include "../vistas/menu_encabezado.php";
            //-----------------------------------------
        }

        private function muestra_pie(){

            include "../vistas/footer.php";
        }

        private function scripts_normal(){          

            $this->script->standar();

        }

        private function scripts_special($arr_script){
            $this->script->special($arr_script);
        }

        private function fin_pagina(){

            echo "</body>

                    </html>";
        }
        //---------------------------------------------------------------

        //---------------------------------------------------------------
        public function mostrar_pagina($pagina){

            $valores_login = $this->valida_vals();

            if($valores_login == true){

                //muestra las paginas de administrador
                //-----------------------------------------------------------
                $this->muestra_encabezado($this->valida_perfil());
				//include "menu_lateral.php";
                //-----------------------------------------------------------                
                
                //-----------------------------------------------------------
                //contenido
                include $pagina;                
                //-----------------------------------------------------------
                $this->muestra_pie();

                $this->scripts_normal();             

                $this->fin_pagina();/**/              

            }else{                
                 $this->mensaje_error();                 
            }
            
        }
        //-----------------------------------------
        public function mostrar_pagina_scripts($pagina,$arr_script,$id_modulo){
           
            /**/
            $valores_login = $this->valida_vals();            

            $perfil_actual = $this->valida_perfil();

            $id_perfil_actual = $this->getIDtipo();

            //echo "validando".$perfiles_in." y ".$perfil_actual;

            //--$valida_entrada = $this->valida_entrada_perfil($id_modulo,$id_perfil_actual);

            //si no existen los valores de entrada no puede validar el perfil
            //evitando error sql de consulta.            
            if ($valores_login == true) {
                $valida_entrada = $this->valida_entrada_perfil($id_modulo,$id_perfil_actual);
            } else {
                $valida_entrada = false;
            }
            //---------------------------------------------------------------

            /**/
            if( ($valores_login == true) && ($valida_entrada === true) ){

                //echo "el perfil de usuario es: ".$perfil_actual;

                //echo "aca puede entrar? ".$valida_entrada;

                //muestra las paginas de administrador
                //-----------------------------------------------------------
                $this->muestra_encabezado($this->valida_perfil());
                //include "menu_lateral.php";
                //-----------------------------------------------------------                

                //-----------------------------------------------------------
                //contenido
                include $pagina;
                //-----------------------------------------------------------
                $this->muestra_pie();

                $this->scripts_special($arr_script);             

                $this->fin_pagina();              

            }else{                
                 $this->mensaje_error();                 
            }
            
        }     
    }

 ?>