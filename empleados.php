<?php session_start();

if (isset($_SESSION['usuario'])) {
	//header('Location: index.php');
}else{
	header('Location: index.php');
}

require 'admin/config.php';
require 'funciones/funciones.php';
$conexion = conexion($bd_config);
$errores='';
$enviado='';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])){
	$documentoe = limpiardatos($_POST['documento_empleado']);
	$nombre = strtoupper(limpiardatos($_POST['nombre_empleado']));
	$telefono1 = limpiardatos($_POST['telefono_1_empleado']);
	$telefono2 = limpiardatos($_POST['telefono_2_empleado']);
	$fechaingreso = $_POST['fecha_ingreso'];
	$fechasalida = $_POST['fecha_salida'];
	
	
	$sentencia = $conexion->prepare('SELECT * FROM empleados WHERE documento_empleado = :documento LIMIT 1');
	$sentencia->execute([
		':documento' => $documentoe
	]);
	$resultado = $sentencia->fetch();
	if($resultado != false){
		$nombre = $resultado['nombre_empleado'];
		$telefono1 = $resultado['telefono_1_empleado'];
		$telefono2 = $resultado['telefono_2_empleado'];		
		$fechaingreso = $resultado['fecha_ingreso'];
		$fechasalida = $resultado['fecha_salida'];
		$errores .= 'El empleado ya existe <br />';
	}
	
	if($errores == ''){
		$sentencia = $conexion->prepare('INSERT INTO empleados (id_empleado, documento_empleado, nombre_empleado, telefono_1_empleado, telefono_2_empleado, fecha_ingreso, fecha_salida) VALUES(null, :documento, :nombree, :telefono1e, :telefono2e, :fechaingresoe, :fechasalidae)');
		$sentencia->execute([
			':documento' => $documentoe,
			':nombree' => $nombre,
			':telefono1e' => $telefono1,
			':telefono2e' => $telefono2,
			':fechaingresoe' => $fechaingreso,
			':fechasalidae' => $fechasalida
		]);
		$enviado .= 'Empleado creado correctamente';		
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])){
	$documentoe = limpiardatos($_POST['documento_empleado']);
	$nombre = strtoupper(limpiardatos($_POST['nombre_empleado']));
	$telefono1 = limpiardatos($_POST['telefono_1_empleado']);
	$telefono2 = limpiardatos($_POST['telefono_2_empleado']);
	$fechaingreso = $_POST['fecha_ingreso'];
	$fechasalida = $_POST['fecha_salida'];
	
	
	$sentencia = $conexion->prepare('UPDATE empleados SET nombre_empleado = :nombree, telefono_1_empleado = :telefono1e, telefono_2_empleado = :telefono2e, fecha_ingreso = :fechaingresoe, fecha_salida = :fechasalidae WHERE documento_empleado = :documento');
	$sentencia->execute([
			':documento' => $documentoe,
			':nombree' => $nombre,
			':telefono1e' => $telefono1,
			':telefono2e' => $telefono2,
			':fechaingresoe' => $fechaingreso,
			':fechasalidae' => $fechasalida
		]);
	$enviado .= 'Empleado actualizado correctamente';
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])){
	$documentoe = limpiardatos($_POST['documento_empleado']);
	$nombre = strtoupper(limpiardatos($_POST['nombre_empleado']));
	$telefono1 = limpiardatos($_POST['telefono_1_empleado']);
	$telefono2 = limpiardatos($_POST['telefono_2_empleado']);
	$fechaingreso = $_POST['fecha_ingreso'];
	$fechasalida = $_POST['fecha_salida'];

	$sentencia = $conexion->prepare('DELETE FROM empleados WHERE documento_empleado = :documento');
	$sentencia->execute([
		':documento' => $documentoe
	]);
	$enviado.= 'Empleado eliminado correctamente';
}

require 'views/empleados.view.php';
?>