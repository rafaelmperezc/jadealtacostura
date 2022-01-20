<?php session_start();

if (isset($_SESSION['usuario'])) {
	//header('Location: index.php');
}else{
	header('Location: index.php');
}

require 'admin/config.php';
require 'funciones/funciones.php';

$tipoprenda = $_POST['tipopren'];
$cantidad = $_POST['cantidad'];

if (isset($tipoprenda) and isset($cantidad)) {
	$sentencia = $conexion->prepare('SELECT cantidadconfeccion FROM confeccion WHERE tipoconfeccion = :tipop');
	$sentencia->execute([
		':tipop' => $tipopre
	]);

$CountReg = $sentencia -> fetchAll();
$TRegistros = count($CountReg);
	if ($TRegistros>0) {

	$suma = $sentencia->fetch();
	$total =$suma['cantidadconfeccion'] + $can;
	$sentencia = $conexion->prepare('UPDATE confeccion SET cantidadconfeccion= :nuevacantidad WHERE tipoconfeccion = :tipop');
	$sentencia->execute([
		':nuevacantidad' => $total,
		':tipop' => $tipopre
	]);
}
}

?>