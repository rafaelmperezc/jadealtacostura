<?php session_start();

if (isset($_SESSION['usuario'])) {
	//header('Location: index.php');
}else{
	header('Location: index.php');
}

require 'admin/config.php';
require 'funciones/funciones.php';

$conexion = conexion($bd_config);
$errores = '';
$enviado = '';
$resultado = '';
$resul = '';
$estado = '';
$saldo = '';
$con = '';
$saldoanti = 0;
$saldonuev = 0;
$tipoSalida = 'ABONO FACTURA';
$descr = '';

//Llenar Facturas Activas
$ttela = $conexion->prepare('SELECT * FROM acretela');
$ttela->execute();
$rttela = $ttela->fetchall();
if($rttela != false){
	
}else{
	$rttela = false;
}


//BUSCAR FACTURA
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])){
	
		$estadof = $_POST['estado'];
		$numFac = $_POST['numFac'];
		
		
		if($estadof != 'SELECCIONE...' && $numFac == ''){
			$sentencia1 = $conexion->prepare('SELECT * FROM acretela WHERE codfacacretela = :estadof LIMIT 1');
			$sentencia1->execute([
				':estadof' => $estadof
			]);
			$res1 = $sentencia1->fetch();
			$fechafactura = $res1['fecacretela'];
			$valorfactura = $res1['valacretela'];
			$saldoactual = $res1['saldoFactura'];
			$facturaestado = $res1['estadoFactura'];

			$sentencia = $conexion->prepare('SELECT * FROM acreabono WHERE codfacacre = :codigo');
			$sentencia->execute([
				':codigo' => $estadof
			]);

			$resul = $sentencia->fetchAll();

			if ($resul != false) {
				
			}else {
				$resul = false;
			}
			
			
		}else{
			$errores .= 'SELECCIONE LA FACTURA A BUSCAR DEL MENÚ DESPLEGABLE';
			$resultado = false;
		}
}


//Registrar Facturas
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])){
	
	$numFac = $_POST['numFac'];
	$fechafactura = $_POST['fechafactura'];
	$valorfactura = $_POST['valorfactura'];
	$abonof = $_POST['abonof'];
	$fechaa = $_POST['fechaa'];
	$estado = $_POST['estado'];
	$fechaa = $_POST['fechaa'];

	if ($numFac != '' && $fechafactura != '' && $valorfactura != '' && $abonof != '' && $estado == 'SELECCIONE...') {
		
		$sentencia = $conexion->prepare('SELECT * FROM acretela WHERE codfacacretela = :codigo');
		$sentencia->execute([
			':codigo' => $numFac
		]);
		
		$con = $sentencia->fetchAll();

		if ($con != false) {
			$errores .= 'LA FACTURA YA EXISTE, POR FAVOR SELECCIONELA PARA REALIZAR UN ABONO. GRACIAS';
			$sentencia = $conexion->prepare('SELECT * FROM acretela WHERE codfacacretela = :numFac');
				$sentencia->execute([
					'numFac' => $numFac
				]);
	
				$resultado = $sentencia->fetchAll();
	
				if ($resultado != false) {
					
				}else {
					$resultado = false;
				}
		}else {
			if ($abonof > $valorfactura) {
				$errores .= 'EL VALOR DEL ABONO NO PUEDE SER MAYOR AL VALOR DE LA FACTURA';
			}else {
				
				$saldo = $valorfactura - $abonof;
				$estado = 'ACTIVA';
				
				if ($saldo == 0) {
					$estado = 'PAGADA';
				}
	
				$sentencia = $conexion->prepare('INSERT INTO acretela (codfacacretela, valacretela, fecacretela, saldoFactura, estadoFactura) VALUES (:numFac, :valorfactura, :fechafactura, :saldo, :estado)');
				$sentencia->execute([
					':numFac' => $numFac,
					':valorfactura' => $valorfactura,
					':fechafactura' => $fechafactura,
					':saldo' => $saldo,
					':estado' => $estado
				]);

				if ($abonof == 0) {
					$saldoanti = $valorfactura;
					$saldonuev = $valorfactura;
				}else {
					$saldonuev = $saldo;
					$saldoanti = $valorfactura;
				}

				$sentencia = $conexion->prepare('INSERT INTO acreabono (codfacacre, valfacacre, fechafacacre, abofacacre, acrefechabono, saldoanti, saldonuev, estadofacacre) VALUES (:codfacacre, :valfacacre, :fechafacacre, :abofacacre, :acrefechabono, :saldoanti, :saldonuev, :estadofacacre)');
				$sentencia->execute([
					':codfacacre' => $numFac,
					':valfacacre' => $valorfactura,
					':fechafacacre' => $fechafactura,
					':abofacacre' => $abonof,
					':acrefechabono' => $fechaa,
					':saldoanti' => $saldoanti,
					':saldonuev' => $saldonuev,
					':estadofacacre' => $estado
				]);

				$descr = 'ABONO DE FACTURA '.$numFac;

				if ($abonof > 0) {
					$sentencia =$conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, facacreecod, descripcionsalida) VALUES (:tiposalida, :valorsalida, :fechasalida, :facacreecod, :descripcionsalida)');
					$sentencia->execute([
						':tiposalida' => $tipoSalida,
						':valorsalida' => $abonof,
						':fechasalida' => $fechaa,
						':facacreecod' => $numFac,
						':descripcionsalida' => $descr
					]);
				}
	
				//Llenar Facturas Activas
				$ttela = $conexion->prepare('SELECT * FROM acretela');
				$ttela->execute();
				$rttela = $ttela->fetchall();
				if($rttela != false){
					
				}else{
					$rttela = false;
				}
	
				$sentencia = $conexion->prepare('SELECT * FROM acretela WHERE codfacacretela = :numFac');
				$sentencia->execute([
					'numFac' => $numFac
				]);
	
				$resultado = $sentencia->fetchAll();
	
				if ($resultado != false) {
					
				}else {
					$resultado = false;
				}
	
				$enviado .= 'FACTURA REGISTRADA CON ÉXITO';
	
			}
		}
	}else {
		$errores .= 'PARA REGISTRAR LA FACTURA NO PUEDEN EXISTIR CAMPOS VACIOS O TENER SELECCIONADA UNA FACTURA DEL MENÚ';
	}

}

//Eliminar Facturas Acreedores
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
	$estado = $_POST['estado'];
	$numFac = $_POST['numFac'];

	if ($estado != 'SELECCIONE...' && $numFac == '') {
		
		$sentencia = $conexion->prepare('DELETE FROM acreabono WHERE codfacacre = :codigo');
		$sentencia->execute([
			':codigo' => $estado
		]);

		$sentencia = $conexion->prepare('DELETE FROM acretela WHERE codfacacretela = :codigo');
		$sentencia->execute([
			':codigo' => $estado
		]);

		//Llenar Facturas Activas
		$ttela = $conexion->prepare('SELECT * FROM acretela');
		$ttela->execute();
		$rttela = $ttela->fetchall();
		if($rttela != false){
			
		}else{
			$rttela = false;
		}

		$enviado .= 'FACTURA ELIMINADA CON ÉXITO';
	}else {
		$errores .= 'NO SE PUEDE ELIMIAR LA FACTURA PORQUE NO ESTÁ SELECCIONADA EN EL MENÚ DESPLEGABLE';
	}
}

require 'views/atelas.view.php';

?>