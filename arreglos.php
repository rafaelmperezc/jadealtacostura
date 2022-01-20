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
$estado ='';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
	$codigofac = strtoupper(limpiardatos($_POST['codigo']));

	$misentencia = $conexion->prepare("DELETE FROM acreclientes WHERE acreclientes.faccod = :codigo");
	$misentencia->execute([
		':codigo'=> $codigofac
	]);
	
	$misentencia = $conexion->prepare("DELETE FROM abonofac WHERE abonofac.codfac = :codigo");
	$misentencia->execute([
		':codigo'=> $codigofac
	]);

	$misentencia = $conexion->prepare("DELETE FROM estadofac WHERE estadofac.codfacacretela = :codigo");
	$misentencia->execute([
		':codigo'=> $codigofac
	]);

	$enviado .= 'Factura eliminada correctamente';
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscarcli'])){
	
	$documento1 = limpiardatos($_POST['documento']);
	$nombre = strtoupper(limpiardatos($_POST['nombre']));
	$telefono = limpiardatos($_POST['telefono']);
	
	if($documento1 != ''){
		$sentencia1 = $conexion->prepare('SELECT * FROM clientes WHERE documentocliente = :doc');
		$sentencia1->execute([
			':doc' => $documento1
		]);
		
		$res1 = $sentencia1->fetch();
		
		if($res1 != false){
			$nombrec = $res1[2];
			$telefonoc = $res1[3];
		}else{
			$errores .= 'No existe el cliente, por favor valide el número de documento';
		}
		
	}else{
		$errores .= 'Campo de documento vacio, por favor valide';
	}
}



if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])){
	
	$documento = limpiardatos($_POST['documento']);
	$nombre = strtoupper(limpiardatos($_POST['nombre']));
	$telefono = limpiardatos($_POST['telefono']);
	$codigo = strtoupper(limpiardatos($_POST['codigo']));
	$valor = limpiardatos($_POST['valor']);
	$fecha = $_POST['fecha'];
	$descripcion = strtoupper(limpiardatos($_POST['descripcion']));
	$abono = limpiardatos($_POST['abono']);	
	
	if($documento and $nombre and $telefono and $codigo and $valor and $fecha and $descripcion != ''){
		
		$sentencia2 = $conexion->prepare('SELECT * FROM acreclientes WHERE faccod = :codigo LIMIT 1');
		$sentencia2->execute([
			':codigo' => $codigo
		]);
	
		$res2 = $sentencia2->fetch();
	
		if($res2 != false){
			$errores .= 'La factura ya existe y no puede ser alterada';
		}else{
			$sentencia3 = $conexion->prepare('INSERT INTO acreclientes (faccod, doccli, nomcli, telcli, valor, fecha, detallefac) VALUES (:codigo, :documento, :nombre, :telefono, :valor, :fecha, :detalle)');
			$sentencia3->execute([
				':codigo' => $codigo,
				':documento' => $documento,
				':nombre' => $nombre,
				':telefono' => $telefono,
				':valor' => $valor,
				':fecha' => $fecha,
				':detalle' => $descripcion
			]);
			
			
		}
		
		$sentencia4 = $conexion->prepare('SELECT codfac FROM abonofac WHERE codfac = :codigo LIMIT 1');
		$sentencia4->execute([
			':codigo' => $codigo
		]);
		
		$res3 = $sentencia4->fetch();
		
		if($res3 != false){
			
		}else{
			$estado = 'ACTIVA';
			if($abono != ''){
				$saldo = $valor - $abono;	
			}else{
				$saldo = $valor;
			}
                        if($saldo == 0){
                            $estado = 'CERRADA';
                        }
			$sentencia5 = $conexion->prepare('INSERT INTO abonofac (codfac, fechafac, valorfac, saldo, abono, estadofac) VALUES (:codigo, :fecha, :valor, :saldo, :abono, :estado)');
			$sentencia5->execute([
				':codigo' => $codigo,
				':fecha' => $fecha,
				':valor' => $valor,
				':saldo' => $saldo,
				':abono' => $abono,
				'estado' => $estado
			]);
		}
		
		$sentencia6 = $conexion->prepare('SELECT * FROM estadofac WHERE codfacacretela = :codigo LIMIT 1');
		$sentencia6->execute([
			':codigo' => $codigo
		]);
		
		$res4 = $sentencia6->fetch();
		
		if($res4 != false){
			
		}else{
			//$estado = 'ACTIVA';
			$sentencia7 = $conexion->prepare('INSERT INTO estadofac VALUES (null, :codigo, :fecha, :valor, :saldo, :estado)');
			$sentencia7->execute([
				':codigo' => $codigo,
				':fecha' => $fecha,
				':valor' => $valor,
				':saldo' => $saldo,
				':estado' => $estado
			]);
		}
				
		$enviado .= 'Factura Agregada con éxito';
	}else{
		echo $errores .= 'No pueden existir campos vacios';
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$documento = limpiardatos($_POST['documento']);
	$nombre = strtoupper(limpiardatos($_POST['nombre']));
	$telefono = limpiardatos($_POST['telefono']);
	$codigo = strtoupper(limpiardatos($_POST['codigo']));
	$valor = limpiardatos($_POST['valor']);
	$fecha = $_POST['fecha'];
	$descripcion = strtoupper(limpiardatos($_POST['descripcion']));
	
	if(isset($_POST['buscar'])){
		if($codigo != ''){
			$sentencia8 = $conexion->prepare('SELECT * FROM acreclientes WHERE faccod = :codigo LIMIT 1');
			$sentencia8->execute([
				':codigo' => $codigo
			]);
			
			$res5 = $sentencia8->fetch();
			
			if($res5 != ''){
				$documento = $res5['doccli'];
				$nombrec = $res5['nomcli'];
				$telefonoc = $res5['telcli'];
				$valor = $res5['valor'];
				$fecha = $res5['fecha'];
				$descripcion = $res5['detallefac'];
			}else{
				$errores .= 'La factura no existe, por favor verifique.';
			}
			
		}else{
			$errores .= 'Por favor ingrese un código de factura.';
		}
	}elseif(isset($_POST['anular'])){
		if($codigo != ''){
			$sen2 = $conexion->prepare('SELECT * FROM estadofac WHERE codfacacretela = :codigo LIMIT 1');
			$sen2->execute([
				':codigo' => $codigo
			]);
			$v2 = $sen2->fetch();
			
			if($v2['facestado'] != 'CERRADA' && $v2['facestado'] != 'ANULADA'){
				$estado = 'ANULADA';
				$sentencia9 = $conexion->prepare('UPDATE abonofac SET estadofac = :estado WHERE codfac = :codigo');
				$sentencia9->execute([
					':estado' => $estado,
					':codigo' => $codigo
				]);
			
				$sentencia10 = $conexion->prepare('UPDATE estadofac SET facestado = :estado WHERE codfacacretela = :codigo');
				$sentencia10->execute([
					':estado' => $estado,
					':codigo' => $codigo
				]);
			
				$enviado .= 'Factura Anulada Exitosamente';

			}else{
				$errores .= 'Error al Anular, La factura se encuetra cerrada o ya a sido anulada previamente';
			}
			
			}else{
			$errores .= 'El campo de código de factura no puede estar vacio';
		}
	}
}

require 'views/arreglos.view.php';

?>