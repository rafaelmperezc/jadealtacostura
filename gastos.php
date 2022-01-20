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
$res = '';
$saldoNuevo = '';
$res2 = '';
$fac = '';

//Llenar empleados
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

//Llenar Facturas
$fac = 'ACTIVA';
$ttela = $conexion->prepare('SELECT * FROM acretela WHERE estadoFactura = :fac');
$ttela->execute([
	':fac' => $fac
]);
$rttela = $ttela->fetchall();
if($rttela != false){
	
}else{
	$rttela = false;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$tipo = $_POST['tipogasto'];
	$nomem = limpiardatos($_POST['nomemp']);
	$valor = limpiardatos($_POST['valorsalida']);
	$fecha = $_POST['fechasalida'];
	$estado = $_POST['estado'];
	$descripcion = strtoupper(limpiardatos($_POST['descripcionsalida']));
	
		
	if($tipo == 'ARRIENDO'){		
		$sentencia = $conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, descripcionsalida) VALUES (:tipos, :valors, :fechas, :descripcions)');
		$sentencia->execute([
			':tipos' => $tipo,
			':valors' => $valor,
			':fechas' => $fecha,
			':descripcions' => $descripcion
		]);

		$enviado .= 'Gasto '.$tipo.' agregado correctamente';
	}

	if($tipo == 'DIARIO'){		
		$sentencia = $conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, descripcionsalida) VALUES (:tipos, :valors, :fechas, :descripcions)');
		$sentencia->execute([
			':tipos' => $tipo,
			':valors' => $valor,
			':fechas' => $fecha,
			':descripcions' => $descripcion
		]);

		$enviado .= 'Gasto '.$tipo.' agregado correctamente';
	}

	if($tipo == 'GASTOS DANNY'){		
		$sentencia = $conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, descripcionsalida) VALUES (:tipos, :valors, :fechas, :descripcions)');
		$sentencia->execute([
			':tipos' => $tipo,
			':valors' => $valor,
			':fechas' => $fecha,
			':descripcions' => $descripcion
		]);

		$enviado .= 'Gasto '.$tipo.' agregado correctamente';
	}

	if($tipo == 'SERVICIOS'){		
		$sentencia = $conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, descripcionsalida) VALUES (:tipos, :valors, :fechas, :descripcions)');
		$sentencia->execute([
			':tipos' => $tipo,
			':valors' => $valor,
			':fechas' => $fecha,
			':descripcions' => $descripcion
		]);

		$enviado .= 'Gasto '.$tipo.' agregado correctamente';
	}

	if($tipo == 'ABONO CREDITO'){		
		$sentencia = $conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, descripcionsalida) VALUES (:tipos, :valors, :fechas, :descripcions)');
		$sentencia->execute([
			':tipos' => $tipo,
			':valors' => $valor,
			':fechas' => $fecha,
			':descripcions' => $descripcion
		]);

		$enviado .= 'Gasto '.$tipo.' agregado correctamente';
	}

	if($tipo == 'NOMINA'){		
		if ($nomem != 'SELECCIONE...') {
			$sentencia = $conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, nomempleado, descripcionsalida) VALUES (:tipos, :valors, :fechas, :nomempleado, :descripcions)');
			$sentencia->execute([
				':tipos' => $tipo,
				':valors' => $valor,
				':fechas' => $fecha,
				':nomempleado' => $nomem,
				':descripcions' => $descripcion
		]);

		$enviado .= 'Gasto '.$tipo.' agregado correctamente';
		}else {
			$errores .= 'POR FAVOR SELECCIONE EL EMPLEADO PARA REGISTRAR EL GASTO';
		}
	}

	if($tipo == 'ABONO FACTURA'){
		
		if ($estado != 'SELECCIONE...') {
			//echo $estado;
			$sentencia = $conexion->prepare('SELECT * FROM acretela WHERE codfacacretela = :codigo LIMIT 1');
			$sentencia->execute([
				':codigo' => $estado
			]);
			$res = $sentencia->fetch();
	
			if ($res != false) {
				if ($valor > $res[4]) {
					$errores .= 'EL VALOR INGRESADO SUPERA EL SALDO DE LA FACTURA. EL SALDO DE LA FACTURA '.$estado.' ES $'.$res[4].'=';
				}elseif ($res[5] == 'PAGADA') {
					$errores .= 'LA FACTURA DEL ACREEDOR YA SE ENCUENTRA PAGA';
				}else {
					$saldoNuevo = $res[4] - $valor;
					if ($saldoNuevo == 0) {
						$res[5] = 'PAGADA';
					}
	
					$sentenciacre = $conexion->prepare('UPDATE acretela SET saldoFactura = :saldoNuevo, estadoFactura = :estadoFactura WHERE codfacacretela = :codigo');
					$sentenciacre->execute([
						':saldoNuevo' => $saldoNuevo,
						':estadoFactura' => $res[5],
						':codigo' => $estado
					]);
	
					$sentencia2 = $conexion->prepare('INSERT INTO acreabono (codfacacre, valfacacre, fechafacacre, abofacacre, acrefechabono, saldoanti, saldonuev, estadofacacre) VALUES (:codfacacre, :valfacacre, :fechafacacre, :abofacacre, :acrefechabono, :saldoanti, :saldonuev, :estadofacacre)');
					$sentencia2->execute([
						':codfacacre' => $estado,
						':valfacacre' => $res[2],
						':fechafacacre' => $res[3],
						':abofacacre' => $valor,
						':acrefechabono' => $fecha,
						':saldoanti' => $res[4],
						':saldonuev' => $saldoNuevo,
						':estadofacacre' => $res[5]
					]);
	
					$sentencia = $conexion->prepare('INSERT INTO salidas (tiposalida, valorsalida, fechasalida, facacreecod, descripcionsalida) VALUES (:tipos, :valors, :fechas,:codigo, :descripcions)');
					$sentencia->execute([
						':tipos' => $tipo,
						':valors' => $valor,
						':fechas' => $fecha,
						':codigo' => $estado,
						':descripcions' => $descripcion
					]);
	
					//Llenar Facturas
					$fac = 'ACTIVA';
					$ttela = $conexion->prepare('SELECT * FROM acretela WHERE estadoFactura = :fac');
					$ttela->execute([
						':fac' => $fac
					]);
					$rttela = $ttela->fetchall();
					if($rttela != false){
						
					}else{
						$rttela = false;
					}
	
					$enviado .= 'Gasto '.$tipo.' registrado con éxito';
	
				}
				
			}else {
				$errores .= 'NO HAY RESULTADOS DE LA BÚSQUEDA';
			}
		}else{
			$errores .= 'EL CÓDIGO DE LA FACTURA NO FUÉ SELECCIONADO';
		}

	}

		
	if ($tipo == 'SELECCIONE...') {
		$errores .= 'Por favor escoja el tipo de gasto.';
	}

}

require 'views/gastos.view.php'
?>