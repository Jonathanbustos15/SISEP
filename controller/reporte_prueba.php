<?php

	//ini_set('error_reporting', E_ALL|E_STRICT);
	//ini_set('display_errors', 1);

	include_once '../DAO/reportesDAO.php';
	include_once 'helper_controller/PHPExcel/Classes/PHPExcel.php';

	class reportePrueba extends ReportesDAO {
		
		//variables data----------------------------
		public $objPHPExcel;
		public $prueba;
		public $preguntas;
		public $respuesta;
		public $respuesta_mult;//es multiple o unica
		//------------------------------------------
		//variables excel---------------------------		
		public $tituloReporte;
		public $titulosColumnas;		
		//--------------------------------
		public $numResultadoCellStart;/**/
		public $numCellStart;/**/
		//------------------------------------------

		//----------------------------------------------------------------------------------------
		//Funciones excel
		/**/
		public function initLibro(){

			$this->objPHPExcel = new PHPExcel();

 			// Se asignan las propiedades del libro
			$this->objPHPExcel->getProperties()->setCreator("sisep") // Nombre del autor
			     ->setLastModifiedBy("sisep") //Ultimo usuario que lo modificó
			     ->setTitle("Reporte") // Titulo
			     ->setSubject("Reporte Prueba") //Asunto			    
			     ->setCategory("Reporte Prueba"); //Categorias
			//--------------------------------------------------------------------------			
		}
		//----------------------------------------------------------------------------------------
		public function getResultados($pkID_prueba,$pkID_usuario){
			
			
			$this->getRespuestasPrueba($pkID_prueba,$pkID_usuario);

			//print_r($this->respuesta);
			
			//-------------------------------------------------------------------------
			$this->tituloReporte = "Reporte ".$this->respuesta[0]["nom_prueba"];
			// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
			$this->objPHPExcel->setActiveSheetIndex(0)
				              ->mergeCells('A1:D1');

		  	$this->titulosColumnas = array('Pregunta', 'Usuario', 'Respuesta(s)', 'Resultado');

		  	// Se agregan los titulos del reporte
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A1',$this->tituloReporte) // Titulo del reporte
			    ->setCellValue('A3',$this->titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B3',$this->titulosColumnas[1])
			    ->setCellValue('C3',$this->titulosColumnas[2])
			    ->setCellValue('D3',$this->titulosColumnas[3]);
			//-------------------------------------------------------------------------
			$this->numCellStart = 4;
			//iteracion de las respuestas encontradas
			foreach ($this->respuesta as $ll_rpta => $val_rpta) {
				
				//echo " Pregunta: ".$val_rpta["pregunta"]."<br>";
				//echo " Usuario: ".$val_rpta["nombre"]." ".$val_rpta["apellido"]."<br>";

				$rptas = "";

				$rptas = $rptas.$val_rpta["respuesta"]."--";
				
				$this->objPHPExcel->setActiveSheetIndex(0)
			         ->setCellValue('A'.$this->numCellStart, $val_rpta["pregunta"])
			         ->setCellValue('B'.$this->numCellStart, $val_rpta["nombre"]." ".$val_rpta["apellido"]);
			         //->setCellValue('C'.$this->numCellStart, $val_rpta["respuesta"]);
			   
			    


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
				
				//------------------------------------

				$this->objPHPExcel->setActiveSheetIndex(0)
			         	 ->setCellValue('C'.$this->numCellStart, $rptas);
				//echo $this->valida_rpta_mult($this->respuesta_mult);

			    if($this->respuesta_mult){

					$this->objPHPExcel->setActiveSheetIndex(0)
				         ->setCellValue('D'.$this->numCellStart, $this->valida_rpta_mult($this->respuesta_mult));
				}
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			    //pasa de celda
				$this->numCellStart++;
			}
			
			

			//----------------------------------------------------------------------
			
			//--------------------------------------------------------------------------
			//se ponen las celdas en autosize
			for($celda = 'A'; $celda <= 'D'; $celda++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($celda)->setAutoSize(TRUE);
			}
			//--------------------------------------------------------------------------
			/**/
			//----------------------------------------------------------------------


		}
		

		public function finLibro(){
			//--------------------------------------------------------------------------			
			// Se asigna el nombre a la hoja
			$this->objPHPExcel->getActiveSheet()->setTitle(substr($this->tituloReporte, 0, 30));
			 
			// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
			$this->objPHPExcel->setActiveSheetIndex(0);
			 
			// Inmovilizar paneles
			//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
			//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
			//--------------------------------------------------------------------------
			// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.substr($this->tituloReporte, 0, 30).'.xlsx"');
			header('Cache-Control: max-age=0');
			 
			$this->objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
			$this->objWriter->save('php://output');
			exit;/**/
		//--------------------------------------------------------------------------
		}		

		/**/
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

		public function crear_reporte($pkID_prueba,$pkID_usuario){

			$this->initLibro();
			$this->getResultados($pkID_prueba,$pkID_usuario);
			$this->finLibro();
		}
	};

	$res = new reportePrueba();

	$res->crear_reporte($_GET["id_prueba"],$_GET["id_usuario"]);

 ?>