<?php 
	
	//ini_set('error_reporting', E_ALL|E_STRICT);
	//ini_set('display_errors', 1); 

	include_once '../DAO/reportesDAO.php';

	include_once 'helper_controller/FPDF/fpdf.php';

	class reporteFPDF extends ReportesDAO{

		public $pdf;
		public $prueba;
		public $preguntas;
		public $respuesta;
		public $respuesta_mult;//es multiple o unica

		public $titulosColumnas;

		/**/
		private function limiteString($str,$max){
			return  strlen($str) > $max ? substr($str, 0, $max)."..." : $str;
		}

		private function init($pkID_prueba,$pkID_usuario){

			$this->pdf = new FPDF();
			
			$this->pdf->AddPage();

			$this->getRespuestasPrueba($pkID_prueba,$pkID_usuario);

			$this->Pages();

			//print_r($this->respuesta);				
		}

		private function Header(){
		    // Logo
		    $this->pdf->Image('../img/logo-login.png',10,8,33);
		    // Salto de línea
		    $this->pdf->Ln(15);

		    // Arial bold 15
		    $this->pdf->SetFont('Arial','',13);
		    // Movernos a la derecha
		    //$this->pdf->Cell(35);
		    // Título
		    $this->pdf->Cell(0,10,"Reporte: ".$this->limiteString($this->respuesta[0]["nom_prueba"],50),0,0,'L');
		    // Salto de línea
		    $this->pdf->Ln(10);
		    //Tipo de prueba
		    $this->pdf->SetFont('Arial','',13);
		    $this->pdf->Cell(0,10,"Tipo: ".utf8_decode($this->respuesta[0]["nom_tipo_prueba"]),0,0,'L');
		    // Salto de línea
		    $this->pdf->Ln(15);
		}

		private function Tabla($header){
			
			//configuracion celdas del header
			$arr_conf_th = [
				"ancho"=>45,
				"alto"=>7,
				"borde"=>1
			];

			//-------------------------------------------------------------
			$this->pdf->SetFont('Arial','B',12);

			//Cabecera
			foreach($header as $col){

				//$this->pdf->Cell($arr_conf_th["ancho"],$arr_conf_th["alto"],$col,$arr_conf_th["borde"]);
				//$this->pdf->Ln();
			}

			//$this->pdf->Ln();
			//-------------------------------------------------------------
			

			//$this->grosorCelda();

			//-------------------------------------------------------------
			//contenido de la tabla

			//array de configuracion de las celdas de la tabla
			$arr_conf_t = [
				"ancho"=>0,
				"alto"=>5,
				"borde"=>1
			];
			
			$this->pdf->SetFont('Arial','',10);

			//aumentar alto celdas contenido
			//$arr_conf_t["alto"] = $this->sumAlto($arr_conf_t["alto"]);

			//print_r($this->respuesta);

			//iteracion de las respuestas encontradas
			foreach ($this->respuesta as $ll_rpta => $val_rpta) {

				$this->pdf->MultiCell($arr_conf_t["ancho"],$arr_conf_t["alto"],utf8_decode($val_rpta["nombre"]." ".$val_rpta["apellido"]),$arr_conf_t["borde"]);				

				$rptas = "";

				$rptas = $rptas.$val_rpta["respuesta"]."--";
				//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
				$this->pdf->MultiCell($arr_conf_t["ancho"],$arr_conf_t["alto"],utf8_decode($val_rpta["pregunta"]),$arr_conf_t["borde"]);
				//$this->renderCell($val_rpta["pregunta"]);

				

				//consulta las respuestas multiples
				$this->getRespuestaPreguntaMult($val_rpta["pkID_pregunta"],$val_rpta["pkID_usuario"]);

				//print_r($this->respuesta_mult);
				//valida si tiene respuestas multiples

				if($this->respuesta_mult){

					foreach ($this->respuesta_mult as $llave_mult => $val_mult) {
					
						//echo $val_mult["respuestab"]."<br>";
						
						$rptas = $rptas.$val_mult["respuestab"]." -- ";
						
						//echo $val_mult["correcta"]."<br>";
					}
				}

				$this->pdf->MultiCell($arr_conf_t["ancho"],$arr_conf_t["alto"],utf8_decode($rptas),$arr_conf_t["borde"]);


				if($this->respuesta_mult){

					$this->pdf->MultiCell($arr_conf_t["ancho"],$arr_conf_t["alto"],utf8_decode($this->valida_rpta_mult($this->respuesta_mult)),$arr_conf_t["borde"]);
				}else{
					$this->pdf->MultiCell($arr_conf_t["ancho"],$arr_conf_t["alto"],'--',$arr_conf_t["borde"]);
				}

				
				$this->pdf->Ln();
				
			}
			//-------------------------------------------------------------

			
		}
	

		public function valida_rpta_mult($arr){

			$valor_rpta = "";

			foreach ($arr as $ll_rpta => $val_rpta) {
			
			
				if($val_rpta["correcta"] != "1"){
					$valor_rpta = "Incorrecta.";
					break;
				}

				$valor_rpta = "Correcta.";
			}

			return $valor_rpta;

		}

		private function contenido(){

			$this->pdf->SetFont('Arial','B',11);
			//$this->pdf->Cell(40,10,'Hola, Mundo!');


			$this->titulosColumnas = array('Pregunta', 'Usuario', 'Respuesta(s)', 'Resultado');

			

			$this->Tabla($this->titulosColumnas);
		}

		private function Pages(){

			$this->pdf->AliasNbPages();
		    // Go to 1.5 cm from bottom
		    //$this->pdf->SetY(-15);
		    // Select Arial italic 8
		    $this->pdf->SetFont('Arial','I',8);
		    // Print current and total page numbers
		    $this->pdf->Cell(0,10,utf8_decode('Página(s) '.'{nb}'),0,0,'R');
		}

		private function endPdf(){

			$this->pdf->Output();
		}

		public function ejecutar($pkID_prueba,$pkID_usuario){

			$this->init($pkID_prueba,$pkID_usuario);
			$this->Header();

			$this->contenido();
			
			$this->endPdf();
		}
	}


	$reportar = new reporteFPDF();

	$reportar->ejecutar($_GET["id_prueba"],$_GET["id_usuario"]);

 ?>