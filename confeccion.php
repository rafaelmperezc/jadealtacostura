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
date_default_timezone_set('America/Bogota');
$prenda = $conexion->prepare('SELECT * FROM tipoprenda');
$prenda->execute();
$pren = $prenda->fetchall();
if($pren != false){
	
}else{
	$pren = false;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['tipopren'])){
	$tipopre = $_POST['tipopren' ];
	$can = $_POST['cantidad'];
	$precio= $_POST['precio'];
	$tipoEntradaSalida= $_POST['tipoentradasalida'];
	$descripcion= $_POST['descripcion'];

if($tipopre != 'SELECCIONE...'){
	$sentencia = $conexion->prepare('SELECT cantidadconfeccion,precio FROM confeccion WHERE tipoconfeccion = :tipop');
	$sentencia->execute([
		':tipop' => $tipopre
	]);
$CountReg = $sentencia -> fetch();
$TRegistros = count($CountReg);
//$suma = $sentencia->fetch();
if ($tipoEntradaSalida=="Entrada") {
	$NuevoPrecio= $precio;
	$NuevoCantidad=$CountReg['cantidadconfeccion'] + $can;
	$actualizar="si";
}

if ($tipoEntradaSalida=="Salida") {

if ($can>$CountReg['cantidadconfeccion']) {
	$errores .= 'No hay sufuciente stock para la cantidad de salida que solicita <br>';
	$actualizar='no';
}

/*if($precio>$CountReg['precio']){
	$errores .= 'No hay sufuciente dinero para el precio de la salida que solicita';
	$actualizar='no';

}*/
if ($CountReg['cantidadconfeccion']> $can){
	$NuevoPrecio=$precio;
	$NuevoCantidad=$CountReg['cantidadconfeccion'] - $can;
	 $actualizar='si';
}
}
if ($actualizar=='si'){

$sentencia = $conexion->prepare("INSERT INTO registroentradasalida (TIPOTELA_RegistroEntradaSalida,CANTIDAD_RegistroEntradaSalida,PRECIO_RegistroEntradaSalida,TIPIENTRADASALIDA_RegistroEntradaSalida,FECHA_RegistroEntradaSalida,DESCRIPCION_RegistroEntradaSalida) VALUES (:tipop,:cantidad, :precio, :tipoentradasalida, :fecha,:descripcion)");
	$sentencia->execute([
		':tipop' => $tipopre,
		':cantidad' => $can,
		':precio' => $precio,
		':tipoentradasalida' => $tipoEntradaSalida,
		':fecha' => date('d-m-Y'),
		':descripcion' => $descripcion
	]);
	
	if ($sentencia) {

if ($tipoEntradaSalida=="Entrada") {
	$sentencia = $conexion->prepare('UPDATE confeccion SET cantidadconfeccion= :nuevacantidad, precio=:nuevoprecio,tipoentradasalida=:tipoentradasalida, fecha=:fecha WHERE tipoconfeccion = :tipop');
	$sentencia->execute([
		':nuevacantidad' => $NuevoCantidad,
		':nuevoprecio' => $NuevoPrecio,
		':tipoentradasalida' => $tipoEntradaSalida,
		':fecha' => date('d-m-Y'),
		':tipop' => $tipopre
	]);
}
if ($tipoEntradaSalida=="Salida") {
	$sentencia1 = $conexion->prepare('INSERT INTO abonofac (codfac,fechafac,valorfac,saldo,abono,saldonuevo,fechaabono,estadofac) VALUES (:venta,:fecha,:nuevoprecio,:cero,:nuevoprecio,:cero,:fecha,:cerrada)');
	$sentencia1->execute([
		':nuevoprecio' => $NuevoPrecio,
		':fecha' => date('Y-m-d'),
		':cero'=>0,
		':venta'=>"VENTA",
		':cerrada'=>"CERRADA"
	]);

	$sentencia2 = $conexion->prepare('UPDATE confeccion SET cantidadconfeccion= :nuevacantidad WHERE tipoconfeccion = :tipop');

	$sentencia2->execute([
		':tipop' => $tipopre,
		':nuevacantidad' => $NuevoCantidad
	]);
}
	$enviado .= 'Cantidad actualizada correctamente ';
}
}else if ($TRegistros=0 and $actualizar=='si'){
	$sentencia = $conexion->prepare("INSERT INTO registroentradasalida (TIPOTELA_RegistroEntradaSalida,CANTIDAD_RegistroEntradaSalida,PRECIO_RegistroEntradaSalida,TIPIENTRADASALIDA_RegistroEntradaSalida,FECHA_RegistroEntradaSalida,DESCRIPCION_RegistroEntradaSalida) VALUES (:tipop,:cantidad, :precio, :tipoentradasalida, :fecha,:descripcion)");
	$sentencia->execute([
		':tipop' => $tipopre,
		':cantidad' => $can,
		':precio' => $precio,
		':tipoentradasalida' => $tipoEntradaSalida,
		':fecha' => date('d-m-Y'),
		':descripcion' => $descripcion
	]);
	if ($tipoEntradaSalida=="Entrada") {
	$sentencia = $conexion->prepare('INSERT INTO confeccion (tipoconfeccion,cantidadconfeccion,precio,tipoentradasalida,fecha) VALUES (:tipop,:nuevacantidad, :nuevoprecio, :tipoentradasalida, :fecha,:descripcion)');
	$sentencia->execute([
		':tipop' => $tipopre,
		':nuevacantidad' => $NuevoCantidad,
		':nuevoprecio' => $NuevoPrecio,
		':tipoentradasalida' => $tipoEntradaSalida,
		':fecha' => date('d-m-Y')
	]);
}
	$enviado .= 'Cantidad insertada correctamente';
}
	
	}else{
		$errores .= 'Por favor seleccione el tipo de prenda';
	}
	
	
}
$sentencia = $conexion->prepare('SELECT * FROM confeccion');
$sentencia->execute();
$resultado = $sentencia->fetchall();

require 'views/confeccion.view.php';
?>