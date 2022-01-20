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

//Llenar Select Tipo Tela
$ttela = $conexion->prepare('SELECT * FROM tipotela ORDER BY nomtela ASC');
$ttela->execute();
$rttela = $ttela->fetchall();
if($rttela != false){
	
}else{
	$rttela = false;
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$stipotela = $_POST['stipotela'];
	$ttipotela = strtoupper(limpiardatos($_POST['ttipotela']));
	$faccod = strtoupper(limpiardatos($_POST['codfact']));
	$ctela = limpiardatos($_POST['cantela']);
	$vcomp = limpiardatos($_POST['valorcompra']);
	$fecha = $_POST['fechacompra'];
	$destipotela = strtoupper(limpiardatos($_POST['destipotela']));
	
	
	//echo '<p class="fuente2">' . $ttipotela . ' - ' . $stipotela . ' - ' . $faccod . ' - ' . $ctela . ' - ' . $vcomp . ' - ' . $fecha . ' - ' . $destipotela . '</p>';
	
	if($stipotela != 'SELECCIONE...' && $ttipotela == ''){
		
		$sentencia = $conexion->prepare('SELECT * FROM abonofac WHERE codfac = :codigo LIMIT 1');
		$sentencia->execute([
			':codigo' => $faccod
		]);
		$res = $sentencia->fetch();
		
		if($res != false){
			
		}else{
			$estadofac = 'ACTIVA';
			$sentencia = $conexion->prepare('INSERT INTO abonofac (codfac, fechafac, valorfac, saldo, estadofac) VALUES (:codigo, :fecha, :valor, :saldo, :estadofac)');
			$sentencia->execute([
				':codigo' => $faccod,
				':fecha' => $fecha,
				':valor' => $vcomp,
				':saldo' => $vcomp,
				':estadofac' => $estadofac
			]);
		}
		
		$sentencia = $conexion->prepare('SELECT * FROM ctelas WHERE tipoctel = :stitel LIMIT 1');
		$sentencia->execute([
			':stitel' => $stipotela
		]);
		$res = $sentencia->fetch();
		
		$ctela = $ctela * 100;
		$ctela = $ctela + $res[2];
		$sentencia = $conexion->prepare('UPDATE ctelas SET cantela = :ctel WHERE tipoctel = :stitel');
		$sentencia->execute([
			':ctel' => $ctela,
			':stitel' => $stipotela
		]);
		
		
		$sentencia = $conexion->prepare('SELECT * FROM acretela WHERE codfacacretela = :codigo LIMIT 1');
		$sentencia->execute([
			':codigo' => $faccod
		]);
		$res = $sentencia->fetch();
		
		if($res != false){
			
		}else{
			$ctela = $ctela / 100;
			$sentencia = $conexion->prepare('INSERT INTO acretela VALUES (null, :codfac, :catela, :valor, :fechae, :destipotela)');
			$sentencia->execute([
				':codfac' => $faccod,
				':destipotela' => $destipotela,
				':catela' => $ctela,
				':valor' => $vcomp,
				':fechae' => $fecha
			]);
		}
		
		$sentencia = $conexion->prepare('SELECT * FROM estadofac WHERE codfacacretela = :codigo LIMIT 1');
		$sentencia->execute([
			':codigo' => $faccod
		]);
		$res = $sentencia->fetch();
		
		if($res != false){
			
		}else{
			$estadofac = 'ACTIVA';
			$sentencia = $conexion->prepare('INSERT INTO estadofac (codfacacretela, fechafac, vtotalfacacretela, saldo, facestado) VALUES (:codigo, :fecha, :valor, :saldo, :estadofac)');
			$sentencia->execute([
				':codigo' => $faccod,
				':fecha' => $fecha,
				':valor' => $vcomp,
				':saldo' => $vcomp,
				':estadofac' => $estadofac
			]);
		}
		
		$enviado .= 'Factura Cargada con Éxito';
	}
	
//SEGUNDA OPCION	
	elseif($stipotela == 'SELECCIONE...' && $ttipotela != ''){
		
		//echo $ttipotela;
		
		//Agregando Factura para Posterior Abono
		$sentencia = $conexion->prepare('SELECT * FROM abonofac WHERE codfac = :codigo LIMIT 1');
		$sentencia->execute([
			':codigo' => $faccod
		]);
		$res = $sentencia->fetch();
		
		if($res != false){
			
		}else{
			$estadoac = 'ACTIVA';
			$sentencia = $conexion->prepare('INSERT INTO abonofac (codfac, fechafac, valorfac, saldo, estadofac) VALUES (:codigo, :fecha, :valor, :saldo, :estado)');
			$sentencia->execute([
				':codigo' => $faccod,
				':fecha' => $fecha,
				':valor' => $vcomp,
				':saldo' => $vcomp,
				':estado' => $estadoac
			]);
		}

		//Agregando el tipo de tela
		$sentencia = $conexion->prepare('SELECT * FROM tipotela WHERE nomtela = :tipo LIMIT 1');
		$sentencia->execute([
			':tipo' => $ttipotela
		]);
		$res = $sentencia->fetch();
		
		if($res != false){
			
		}else{
			$ctela = $ctela * 100;
			$sentencia = $conexion->prepare('INSERT INTO tipotela VALUES (null, :tipo)');
			$sentencia->execute([
				':tipo' => $ttipotela
			]);
		}		
		
		
		//Agregando o Actualizando Cantidad de Tela según el tipo
		$sentencia = $conexion->prepare('SELECT * FROM ctelas WHERE tipoctel = :tipo LIMIT 1');
		$sentencia->execute([
			':tipo' => $ttipotela
		]);
		$res = $sentencia->fetch();
		
		if($res != false){
			$sentencia = $conexion->prepare('SELECT * FROM ctelas WHERE tipoctel = :stitel LIMIT 1');
			$sentencia->execute([
				':stitel' => $ttipotela
			]);
			$res = $sentencia->fetch();
		
			$ctela = $ctela * 100;
			$ctela = $ctela + $res[2];
			$sentencia = $conexion->prepare('UPDATE ctelas SET cantela = :ctel WHERE tipoctel = :stitel');
			$sentencia->execute([
				':ctel' => $ctela,
				':stitel' => $ttipotela
			]);			
		}else{
			$ctela = $ctela * 100;
			$sentencia = $conexion->prepare('INSERT INTO ctelas VALUES (null, :tipo, :cantidad)');
			$sentencia->execute([
				':tipo' => $ttipotela,
				':cantidad' => $ctela
			]);
		}
		
		//Agregando Factura a Acreedores
		$sentencia = $conexion->prepare('SELECT * FROM acretela WHERE codfacacretela = :codigo LIMIT 1');
		$sentencia->execute([
			':codigo' => $faccod
		]);
		$res = $sentencia->fetch();
		
		if($res != false){
			
		}else{
			$ctela = $ctela / 100;
			$sentencia = $conexion->prepare('INSERT INTO acretela VALUES (null, :codfac, :catela, :valor, :fechae, :destipotela)');
			$sentencia->execute([
				':codfac' => $faccod,
				':destipotela' => $destipotela,
				':catela' => $ctela,
				':valor' => $vcomp,
				':fechae' => $fecha
			]);
		}
		
		
		//Agregando Estado de la factura
		$sentenciaestado = $conexion->prepare('SELECT * FROM estadofac WHERE codfacacretela = :codigo LIMIT 1');
		$sentenciaestado->execute([
			':codigo' => $faccod
		]);
		$resulta = $sentencia->fetch();
		
		if($resulta != false){
			$errores .= 'Falla la factura ya existe';
		}else{
			$estadofac = 'ACTIVA';
			$sentencia = $conexion->prepare('INSERT INTO estadofac (codfacacretela, fechafac, vtotalfacacretela, saldo, facestado) VALUES (:codigo, :fecha, :valor, :saldo, :estadofac)');
			$sentencia->execute([
				':codigo' => $faccod,
				':fecha' => $fecha,
				':valor' => $vcomp,
				':saldo' => $vcomp,
				':estadofac' => $estadofac
			]);
		}
		
		$enviado .= 'Factura Cargada con Éxito';
		
		
	}else{
		$errores .= 'Por favor seleccione un tipo de tela de la factura';
	}
}

require 'views/rtelas.view.php';
?>