<?php	
			
	class indexController {
		//---------------------------------
		public function setConstantProyectoM($id_proyectoM,$nom_proyectoM){
			//--------------------------------------------------------------
			setcookie("id_proyectoM", $id_proyectoM, time() + 3600*24, "/");
			setcookie("nom_proyectoM", $nom_proyectoM, time() + 3600*24, "/");
			//--------------------------------------------------------------			
		}

		public function unSetConstantProyectoM(){
			//--------------------------------------------------------------
			unset($_COOKIE["id_proyectoM"]);
			unset($_COOKIE["nom_proyectoM"]);

			setcookie("id_proyectoM", null, -1, "/");
			setcookie("nom_proyectoM", null, -1, "/");
			//--------------------------------------------------------------
		}
		//---------------------------------
	}

?>
