<?php 

	trait Conexion {

		private $dbconection;
	    private $userconection;
	    private $passconection;
	    private $stringconection;
	    private $hostconection;

	    public function connect(){

	        //----------------------------------
	        include "datos.php";
	    
	        $this->dbconection=$dbconection;
	        $this->userconection=$userconection;
	        $this->passconection=$passconection;
	        $this->hostconection=$hostconection;

	        //----------------------------------

	        $this->stringconection= new mysqli($this->hostconection, $this->userconection,  $this->passconection,$this->dbconection);
			
	        $conn = $this->stringconection;

	        /*Excepcion*/
	        if($conn->connect_errno > 0){
	            die('Error en la conexion con la base de datos [' . $conn->connect_error . ']');
	        }
	        /*-------*/
	        $conn->set_charset("utf8");
			return $conn;            
	    }
    
	}

 ?>