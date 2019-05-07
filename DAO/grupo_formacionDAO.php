<?php
/**/
	include_once 'genericoDAO.php';
		
	class grupo_formacionDAO {
		
		use GenericoDAO;
		
		public $q_general;
		
		
		//Funciones------------------------------------------
		//Espacio para las funciones en general de esta cla.


    public function getcpm(){

            return $this->getCookieProyectoM();
    }

		public function getGruposF(){        
       
      		$query = "select grupo_formacion.*, curso_formacion.nombre as curso 

                    FROM grupo_formacion

                    INNER JOIN curso_formacion ON curso_formacion.pkID = grupo_formacion.fkID_curso

                    WHERE grupo_formacion.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}

    	public function getGruposFId($pkID_grupo){

    		$query = "select grupo_formacion.*, curso_formacion.nombre as curso 

                    FROM grupo_formacion

                    INNER JOIN curso_formacion ON curso_formacion.pkID = grupo_formacion.fkID_curso
                  
                    WHERE grupo_formacion.pkID = ".$pkID_grupo;


      		return $this->EjecutarConsulta($query);
    	}


      public function getGrupoFUsuarioId($fkID_tipo_usuario, $pkID_grupo){

        $query = "select usuario_grupo_formacion.fkID_usuario, usuarios.*, usuarios.nombre as nombre, usuarios.apellido as apellido, curso_formacion.nombre as curso 

                  FROM `usuario_grupo_formacion`

                  INNER JOIN usuarios ON usuarios.pkID = usuario_grupo_formacion.fkID_usuario

                  INNER JOIN grupo_formacion ON grupo_formacion.pkID = usuario_grupo_formacion.fkID_grupo_formacion

                  INNER JOIN curso_formacion ON curso_formacion.pkID = grupo_formacion.fkID_curso

                  WHERE usuarios.fkID_tipo = ".$fkID_tipo_usuario." AND usuario_grupo_formacion.fkID_grupo_formacion = ".$pkID_grupo;

          return $this->EjecutarConsulta($query);
      }


    	public function getCursos(){

    		$query = "select curso_formacion.* FROM `curso_formacion`

                  INNER JOIN cursosF_proyectoM ON cursosF_proyectoM.fkID_cursosF = curso_formacion.pkID

                  WHERE cursosF_proyectoM.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}

    	public function getCapacitadores(){

    		$query = "select usuarios.*,CONCAT(usuarios.nombre, ' ', usuarios.apellido) as capacitador 
				
					        FROM `usuarios` 
  
                  INNER JOIN tipo_usuario ON tipo_usuario.pkID = usuarios.fkID_tipo 

                  INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_usuario = usuarios.pkID
  
                  WHERE usuarios.fkID_tipo = 12 AND usuario_proyectoM.fkID_proyectoM = ".$this->getcpm();

      		return $this->EjecutarConsulta($query);
    	}


      public function getDocentes(){        
       
        $query = "select usuarios.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) as docente 

                  from usuarios

                  WHERE usuarios.fkID_tipo = 8 ";

        return $this->EjecutarConsulta($query);
      }

      
  /**/public function getDocente($pkID_grupof){        
       
        $query = "select usuarios.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) as docente 

                  from usuarios

                  INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_usuario = usuarios.pkID

                  WHERE usuarios.pkID 

                  NOT IN (SELECT usuario_grupo_formacion.fkID_usuario 

                  FROM usuario_grupo_formacion 

                  INNER JOIN usuarios ON usuarios.pkID = usuario_grupo_formacion.fkID_usuario 

                  WHERE usuario_grupo_formacion.fkID_grupo_formacion =".$pkID_grupof.") and usuarios.fkID_tipo = 8 AND usuario_proyectoM.fkID_proyectoM = ".$this->getcpm();

        return $this->EjecutarConsulta($query);
      }

      
      public function getNumCapacitadoresesGrupoF($fkID_tipo_usuario,$pkID_grupof){        
       
          $query = "select count(usuarios.pkID) as num_capacitadores

                    FROM `usuario_grupo_formacion` 

                    INNER JOIN usuarios ON usuarios.pkID = usuario_grupo_formacion.fkID_usuario  

                    INNER JOIN grupo_formacion ON grupo_formacion.pkID = usuario_grupo_formacion.fkID_grupo_formacion

                    WHERE usuarios.fkID_tipo = ".$fkID_tipo_usuario." AND usuario_grupo_formacion.fkID_grupo_formacion = ".$pkID_grupof;

          return $this->EjecutarConsulta($query);
      }
		
	}
?>
