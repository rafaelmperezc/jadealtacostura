<?php session_start();

if (isset($_SESSION['usuario'])) {
	//header('Location: index.php');
}else{
	header('Location: index.php');
}

require 'admin/config.php';
require 'funciones/funciones.php';

$conexion =conexion($bd_config);
$errores = '';
$enviado = '';

//Llenar Empleados
$sempleado = $conexion->prepare('SELECT * FROM empleados');
$sempleado->execute();
$emplea = $sempleado->fetchall();
if($emplea != false){
	
}else{
	$emplea = false;
}

//Llenar Gastos
$gastot = $conexion->prepare('SELECT * FROM gastos ORDER BY nombregasto ASC');
$gastot->execute();
$gastoti = $gastot->fetchall();
if($gastoti != false){
	
}else{
	$gastoti = false;
}

//Búsqueda General
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bggastos'])){
	$sentencia = $conexion->prepare('SELECT * FROM salidas ORDER BY fechasalida DESC, idsalida DESC');
	$sentencia->execute();
	$resultado =$sentencia->fetchall();
}else{
	$resultado = false;
}

//Búsqueda Avanzada
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bagastos'])){
	$tipo = $_POST['tipogasto'];
	$nempleado = $_POST['nombre_empleado'];
		
	if($tipo == 'DIARIO'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE tiposalida = :tisalida');
		$sentencia->execute([
		':tisalida' => $tipo
	  ]);
		$resultado = $sentencia->fetchall();
    }

	if($tipo == 'NOMINA'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE tiposalida = :tisalida');
		$sentencia->execute([
		':tisalida' => $tipo
	  ]);
		$resultado = $sentencia->fetchall();
    }
	
	if($tipo == 'ARRIENDO'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE tiposalida = :tisalida');
		$sentencia->execute([
		':tisalida' => $tipo
	  ]);
		$resultado = $sentencia->fetchall();
    }
	
	if($tipo == 'SERVICIOS'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE tiposalida = :tisalida');
		$sentencia->execute([
		':tisalida' => $tipo
	  ]);
		$resultado = $sentencia->fetchall();
    }
	
	if($tipo == 'GASTOS DANNY'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE tiposalida = :tisalida');
		$sentencia->execute([
		':tisalida' => $tipo
	  ]);
		$resultado = $sentencia->fetchall();
    }
	
	if($tipo == 'ABONO FACTURA'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE tiposalida = :tisalida');
		$sentencia->execute([
		':tisalida' => $tipo
	  ]);
		$resultado = $sentencia->fetchall();
    }

	if($tipo == 'ABONO CREDITO'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE tiposalida = :tisalida');
		$sentencia->execute([
		':tisalida' => $tipo
	  ]);
		$resultado = $sentencia->fetchall();
    }
	
	if($nempleado != 'SELECCIONE...'){
		$sentencia = $conexion->prepare('SELECT * FROM salidas WHERE nomempleado = :empleado');
		$sentencia->execute([
			':empleado' => $nempleado
		]);
		$resultado = $sentencia->fetchall();
	}
	
	
}

require 'views/consultagastos.view.php';
?>