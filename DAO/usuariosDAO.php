<?php

include_once 'genericoDAO.php';


class UsuariosDAO {

    use GenericoDAO;

     public function getcpm(){

            return $this->getCookieProyectoM();
    }   


    public function getUsuarios(){        
       
      $query = "select usuarios.*, tipo_usuario.nombre as nom_tipo

                FROM `usuarios` 

                INNER JOIN tipo_usuario ON tipo_usuario.pkID=usuarios.fkID_tipo

                INNER JOIN usuario_proyectoM ON usuario_proyectoM.fkID_usuario = usuarios.pkID

                WHERE usuario_proyectoM.fkID_proyectoM = ".$this->getcpm()."

                ORDER BY usuarios.pkID desc";

      return $this->EjecutarConsulta($query);
    }

    public function getUsuarioId($pkID){        
       
      $query = "select usuarios.*, tipo_usuario.nombre as nom_tipo

                FROM `usuarios` 

                INNER JOIN tipo_usuario ON tipo_usuario.pkID=usuarios.fkID_tipo

                WHERE usuarios.pkID = ".$pkID;

      return $this->EjecutarConsulta($query);
    }

    public function getUsuariosReporte(){        
       
      $query = "select usuarios.pkID, usuarios.alias, usuarios.nombres, usuarios.apellidos, usuarios.numero_cc, tipo_usuario.nombre as nom_tipo

                FROM `usuarios` 

                INNER JOIN tipo_usuario ON tipo_usuario.pkID=usuarios.fkID_tipo 

                ORDER BY `usuarios`.`pkID` ASC";

      return $this->EjecutarConsulta($query);
    }

    public function getTipoUsuarios(){        
       
      $query = "select * FROM `tipo_usuario`";

      return $this->EjecutarConsulta($query);
    }


    public function getTipoUsuariosDI(){

      $query = "select * 

                FROM `tipo_usuario` 

                WHERE tipo_usuario.pkID = 8 OR tipo_usuario.pkID = 9 OR tipo_usuario.pkID = 11";

      return $this->EjecutarConsulta($query);          
    }


    //SELECT * FROM `tipo_usuario` WHERE nombre != 'Administrador'

    public function getTipoUsuariosNoAdmin(){        
       
      $query = "select * FROM `tipo_usuario` WHERE nombre != 'Administrador'";

      return $this->EjecutarConsulta($query);
    }
	
	 public function getUsuariosLogin($p_usuario,$p_password){           	

      $query = "select usuarios.*, tipo_usuario.nombre as t_usuario

                FROM `usuarios`

                inner join tipo_usuario on tipo_usuario.pkID = usuarios.fkID_tipo

                where usuarios.alias='".$p_usuario."' and usuarios.pass=SHA1('".$p_password."')";   					
		
		return $this->EjecutarConsulta($query);
		
    }

    //--------------------------------------------------------------------------------------------

    public function getTipoDocumento(){        
       
      $query = "select * FROM tipo_documento_id";

      return $this->EjecutarConsulta($query);
    }

    public function getAnio(){        
       
      $query = "select * FROM anio";

      return $this->EjecutarConsulta($query);
    }

    public function getInstitu(){          
       
      $query = "select pkID,nombre_institucion FROM `institucion` WHERE estadoV=1";

      return $this->EjecutarConsulta($query);
    }

    public function getCargo(){        
       
      $query = "select * FROM `cargo`";

      return $this->EjecutarConsulta($query);
    }

    public function getNivelFormacion(){        
       
      $query = "select * FROM `nivel_formacion`";

      return $this->EjecutarConsulta($query);
    }

    public function getGrupoEtnico(){        
       
      $query = "select * FROM `grupo_etnico` where pkID != 6  order by nombre";

      return $this->EjecutarConsulta($query);
    }

    public function getGenero(){        
       
      $query = "select * FROM `genero`";

      return $this->EjecutarConsulta($query);
    }

    //---------------------------------------------------------------------------------------------

    public function getInstitucion(){        
       
      $query = "select sede.* 

          FROM sede 

          INNER JOIN institucion_proyectoM ON sede.fkID_institucion = institucion_proyectoM.fkID_institucion

          WHERE institucion_proyectoM.fkID_proyectoM = ".$this->getcpm();

      return $this->EjecutarConsulta($query);
    }

    public function getMaterias(){        
       
      $query = "select * FROM `materia`";

      return $this->EjecutarConsulta($query);
    }

    public function getProyectosM(){        
       
      $query = "select * FROM `proyecto_marco`";

      return $this->EjecutarConsulta($query);
    }


    public function getGrados(){        
       
      $query = "select * FROM `grado`";

      return $this->EjecutarConsulta($query);
    }
	
}

?>
