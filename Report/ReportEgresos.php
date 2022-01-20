<?php
	session_start();

if (isset($_SESSION['usuario'])) {
	//header('Location: index.php');
}else{
	header('Location: index.php');
}


require 'Classes/PHPExcel.php';
	
    //require '../admin/config.php';
	//require '../funciones/funciones.php';
	//$mysqli = conexion($bd_config);
    $con=new mysqli("localhost","jadealta_jade","kCpIq6+%}P7P","jadealta_jade"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
	
	$fecha_inicio=$_GET['fecha_inicio'];
	$fecha_fin=$_GET['fecha_fin'];
	date_default_timezone_set('America/Bogota');
 
	$sql = "SELECT * FROM salidas WHERE fechasalida >= '$fecha_inicio' AND fechasalida <= '$fecha_fin' " ;
	$resultado = mysqli_query($con, $sql) or die(mysqli_error($con));
 
	$row_cnt = mysqli_num_rows($resultado);
	/*	 if (!empty($resultado)) {
	 	echo 'bien mysqli';
	 }else {
	 	echo 'mal mysqli';
	 }*/
	 
	if ($row_cnt > 0) { 
	    
	$fila = 7; //Establecemos en que fila inciara a imprimir los datos
	
	$gdImage = imagecreatefrompng('../img/logo.png');//Logotipo
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("SOLUCIONES EMPRESARIALES MAURICIO.NET")->setDescription("Reporte Egresos");
	
	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("EGRESOS");
	
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(100);
	$objDrawing->setCoordinates('C1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	$estiloCreador = array(
    'font' => array(
	'name'      => 'Arial',
	'bold'      => true,
	'italic'    => false,
	'strike'    => false,
	'size' =>13
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_NONE
	)
    ),
    'alignment' => array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);

	 $estiloTituloReporte = array(
    'font' => array(
	'name'      => 'Arial',
	'bold'      => true,
	'italic'    => false,
	'strike'    => false,
	'size' =>13
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_NONE
	)
    ),
    'alignment' => array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);
	
	$estiloTituloColumnas = array(
    'font' => array(
	'name'  => 'Arial',
	'bold'  => true,
	'size' =>10,
	'color' => array(
	'rgb' => 'FFFFFF'
	)
    ),
    'fill' => array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID,
	'color' => array('rgb' => '538DD5')
    ),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
    'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);
	
	$estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
    'font' => array(
	'name'  => 'Arial',
	'size' =>12,
	'color' => array(
	'rgb' => '000000'
	)
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
	'alignment' =>  array(
	'wrap' => true
    )

	));

	$objPHPExcel->getActiveSheet()->getStyle('A1:F5')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F6')->applyFromArray($estiloTituloColumnas);


	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REPORTE DE EGRESOS');
	$objPHPExcel->getActiveSheet()->mergeCells('A1:F5');
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Tipo Salida');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('B6', 'Valor');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'Fecha');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('D6', 'Empleado');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
	$objPHPExcel->getActiveSheet()->setCellValue('E6', 'Código de Factura');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
	$objPHPExcel->getActiveSheet()->setCellValue('F6', 'Código de Factura');
	
	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = $resultado->fetch_assoc()){
$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['tiposalida']);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['valorsalida']);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['fechasalida']);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['nomempleado']);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['facacreecod']);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['descripcionsalida']);
		
		$fila++; //Sumamos 1 para pasar a la siguiente fila
	}
	
	$fila = $fila-1;
	
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:E".$fila);


$fila= $fila+4;
$objPHPExcel->getActiveSheet()->mergeCells('B'.$fila.':C'.$fila);
$objPHPExcel->getActiveSheet()->mergeCells('B'.($fila+1).':C'.($fila+1));
$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->applyFromArray($estiloCreador);
$objPHPExcel->getActiveSheet()->getStyle('A'.($fila+1).':B'.($fila+1))->applyFromArray($estiloCreador);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'HECHO POR');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'SOLUCIONES EMPRESARIALES MAURICIO.NET');
$objPHPExcel->getActiveSheet()->setCellValue('A'.($fila+1),'Expedido');
$objPHPExcel->getActiveSheet()->setCellValue('B'.($fila+1),  date('d-m-Y h:i:s a'));
	

/*Segunda Hoja donde se exportara el estado de las telas*/
// Create a new worksheet, after the default sheet
$sqlConfeccion = "SELECT * FROM confeccion" ;
$resultadoconfeccion = mysqli_query($con, $sqlConfeccion);

$filahoja2 = 7;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle("ESTADOS DE LAS TELAS");
	
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Logotipo');
$objDrawing->setDescription('Logotipo');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(100);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objPHPExcel->getActiveSheet()->getStyle('A1:C5')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A6:C6')->applyFromArray($estiloTituloColumnas);


$objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DE ESTADO DE TELAS');
$objPHPExcel->getActiveSheet()->mergeCells('B3:C3');
	
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Tipo Confección');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('B6', 'Cantidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('C6', 'Precio');
	
	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = $resultadoconfeccion->fetch_assoc()){
$objPHPExcel->getActiveSheet()->setCellValue('A'.$filahoja2, $rows['tipoconfeccion']);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$filahoja2, $rows['cantidadconfeccion']);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$filahoja2, $rows['precio']);

	$filahoja2++; //Sumamos 1 para pasar a la siguiente fila
	}
	
	$filahoja2 = $filahoja2-1;
	
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:C".$filahoja2);


$filahoja2= $filahoja2+4;
$objPHPExcel->getActiveSheet()->mergeCells('B'.$filahoja2.':C'.$filahoja2);
$objPHPExcel->getActiveSheet()->mergeCells('B'.($filahoja2+1).':C'.($filahoja2+1));
$objPHPExcel->getActiveSheet()->getStyle('A'.$filahoja2.':B'.$filahoja2)->applyFromArray($estiloCreador);
$objPHPExcel->getActiveSheet()->getStyle('A'.($filahoja2+1).':B'.($filahoja2+1))->applyFromArray($estiloCreador);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$filahoja2, 'POWER BY');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$filahoja2, 'SOLUCIONESWEB');
$objPHPExcel->getActiveSheet()->setCellValue('A'.($filahoja2+1),'Expedido');
$objPHPExcel->getActiveSheet()->setCellValue('B'.($filahoja2+1),  date('d-m-Y h:i:s a'));


/*Tercera Hoja donde se exportara el registro de entrada/Salida de las telas*/
$sqltela = "SELECT * FROM registroentradasalida" ;
$resultadotela = mysqli_query($con, $sqltela);

$filahoja3= 7;
// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setTitle("ENTRADAS-SALIDAS DE TELAS");
	
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Logotipo');
$objDrawing->setDescription('Logotipo');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(100);
$objDrawing->setCoordinates('C1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objPHPExcel->getActiveSheet()->getStyle('A1:F5')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A6:F6')->applyFromArray($estiloTituloColumnas);


$objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DEL REGISTRO DE TELAS');
$objPHPExcel->getActiveSheet()->mergeCells('B3:F3');
	
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Tipo Tela');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('B6', 'Cantidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('C6', 'Precio');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('D6', 'Entrada/Salida');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('E6', 'Fecha');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
$objPHPExcel->getActiveSheet()->setCellValue('F6', 'Descripción');
	
	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = $resultadotela->fetch_assoc()){
$objPHPExcel->getActiveSheet()->setCellValue('A'.$filahoja3, $rows['TIPOTELA_RegistroEntradaSalida']);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$filahoja3, $rows['CANTIDAD_RegistroEntradaSalida']);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$filahoja3, $rows['PRECIO_RegistroEntradaSalida']);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$filahoja3, $rows['TIPIENTRADASALIDA_RegistroEntradaSalida']);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$filahoja3, $rows['FECHA_RegistroEntradaSalida']);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$filahoja3, $rows['DESCRIPCION_RegistroEntradaSalida']);
		
		$filahoja3++; //Sumamos 1 para pasar a la siguiente fila
	}
	
	$filahoja3 = $filahoja3-1;
	
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:F".$filahoja3);


$filahoja3= $filahoja3+4;
$objPHPExcel->getActiveSheet()->mergeCells('B'.$filahoja3.':C'.$filahoja3);
$objPHPExcel->getActiveSheet()->mergeCells('B'.($filahoja3+1).':C'.($filahoja3+1));
$objPHPExcel->getActiveSheet()->getStyle('A'.$filahoja3.':B'.$filahoja3)->applyFromArray($estiloCreador);
$objPHPExcel->getActiveSheet()->getStyle('A'.($filahoja3+1).':B'.($filahoja3+1))->applyFromArray($estiloCreador);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$filahoja3, 'POWER BY');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$filahoja3, 'SOLUCIONESWEB');
$objPHPExcel->getActiveSheet()->setCellValue('A'.($filahoja3+1),'Expedido');
$objPHPExcel->getActiveSheet()->setCellValue('B'.($filahoja3+1),  date('d-m-Y h:i:s a'));


	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	
	
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="EgresosDanny.xlsx"');
	header('Cache-Control: max-age=0');
	
	$writer->save('php://output');
	}else {
	 	echo '<script>alert("Ho hay registros que coincidan con la fecha.");location.href ="../inicio.php";</script>';
	 }
	
?>