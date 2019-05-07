<?php 
	
	include_once '../DAO/reportesDAO.php';
	include_once 'helper_controller/PHPExcel/Classes/PHPExcel.php';

	class excelReport extends ReportesDAO {

		//$tipo = $this->getTipoUsuarios();

		public function crearReporte($query){
			//--------------------------------------------------------------------------
			$registros = $this->getQuery($query);
			
			//print_r($registros);
			//--------------------------------------------------------------------------
			// Se crea el objeto PHPExcel
 			$objPHPExcel = new PHPExcel();

 			// Se asignan las propiedades del libro
			$objPHPExcel->getProperties()->setCreator("sisep") // Nombre del autor
			    ->setLastModifiedBy("sisep") //Ultimo usuario que lo modificó
			    ->setTitle("Reporte Tipos de usuario") // Titulo
			    ->setSubject("Reporte Tipos de usuario") //Asunto
			    ->setDescription("Reporte Tipos de usuario") //Descripción
			    ->setKeywords("reporte usuarios tipos") //Etiquetas
			    ->setCategory("Reporte excel"); //Categorias
			//--------------------------------------------------------------------------
			//se asignan dos titulos para el reporte y para las columnas
			//deben se pasados por el usuario.
			$tituloReporte = "Listado de Tipos de Usuario";
			$titulosColumnas = array('Id', 'Nombre');
			//--------------------------------------------------------------------------
			// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
			$objPHPExcel->setActiveSheetIndex(0)
			    ->mergeCells('A1:D1');
			 
			// Se agregan los titulos del reporte
			$objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A1',$tituloReporte) // Titulo del reporte
			    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B3',  $titulosColumnas[1]);
			//--------------------------------------------------------------------------
		    /*
		    //Se agregan los datos de los alumnos
 
			 $i = 4; //Numero de fila donde se va a comenzar a rellenar
			 while ($fila = $resultado->fetch_array()) {
			     $objPHPExcel->setActiveSheetIndex(0)
			         ->setCellValue('A'.$i, $fila['alumno'])
			         ->setCellValue('B'.$i, $fila['fechanac'])
			         ->setCellValue('C'.$i, $fila['sexo'])
			         ->setCellValue('D'.$i, $fila['carrera']);
			     $i++;
			 }
		    */
			 /**/
			 $i = 4;
			 foreach ($registros as $key => $value) {
			 	/*echo $key;
			 	echo $value;
			 	echo $i;*/	
			 	
			 	$objPHPExcel->setActiveSheetIndex(0)
			         ->setCellValue('A'.$i, $value['pkID'])
			         ->setCellValue('B'.$i, $value['nombre']);
			    $i++;		         
			 }
			//--------------------------------------------------------------------------
			//se ponen las celdas en autosize
			for($celda = 'A'; $celda <= 'D'; $celda++){
			    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($celda)->setAutoSize(TRUE);
			}
			//--------------------------------------------------------------------------
			/**/
			// Se asigna el nombre a la hoja
			$objPHPExcel->getActiveSheet()->setTitle('Tipos de Usuario');
			 
			// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
			$objPHPExcel->setActiveSheetIndex(0);
			 
			// Inmovilizar paneles
			//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
			//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
			//--------------------------------------------------------------------------
			// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$tituloReporte.'.xlsx"');
			header('Cache-Control: max-age=0');
			 
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
			//--------------------------------------------------------------------------
		}
	}

	$report = new excelReport();

	$report->crearReporte("select * FROM `tipo_usuario`");
 ?>