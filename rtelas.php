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
$re = '';
$val = 0;

//Llenar Select Tipo Tela
$ttela = $conexion->prepare('SELECT * FROM tipotela ORDER BY nomtela ASC');
$ttela->execute();
$rttela = $ttela->fetchall();
if($rttela != false){
	
}else{
	$rttela = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['consultar'])) {
	$sentencia = $conexion->prepare('SELECT * FROM ctelas');
	$sentencia->execute();
	$resultado = $sentencia->fetchAll();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])){
	$stipotela = $_POST['stipotela'];
	$ttipotela = strtoupper(limpiardatos($_POST['ttipotela']));
	//$faccod = strtoupper(limpiardatos($_POST['codfact']));
	$ctela = limpiardatos($_POST['cantela']);
	$val = $ctela;
	//$vcomp = limpiardatos($_POST['valorcompra']);
	$fecha = $_POST['fechacompra'];
	$destipotela = strtoupper(limpiardatos($_POST['destipotela']));
	$movimiento = strtoupper(limpiardatos($_POST['movimiento']));
	
	
	//echo '<p class="fuente2">' . $ttipotela . ' - ' . $stipotela . ' - ' . $faccod . ' - ' . $ctela . ' - ' . $vcomp . ' - ' . $fecha . ' - ' . $destipotela . '</p>';
	
	if($stipotela != 'SELECCIONE...' && $ttipotela == ''){
		if ($ctela == '') {
			$errores .= 'La Cantidad no puede estar vacia';
		}else{
			if ($movimiento == 'ENTRADA') {
				
				$sentencia = $conexion->prepare('SELECT * FROM ctelas WHERE tipoctel = :tipo LIMIT 1');
				$sentencia->execute([
					':tipo' => $stipotela
				]);
				$res = $sentencia->fetch();
	
				$ctela += $res[2];
				$sentencia = $conexion->prepare('UPDATE ctelas SET cantela = :ctel WHERE tipoctel = :tipo');
				$sentencia->execute([
					':ctel' => $ctela,
					':tipo' => $stipotela
				]);

				$sentencia = $conexion->prepare('INSERT INTO entradasalidatelas (tipoTela, cantidadTela, tipoMovimiento, fehaMovimiento, descripcionMovimiento) VALUES (:tipo, :can, :mov, :fech, :descr)');
				$sentencia->execute([
					':tipo' => $stipotela,
					':can' => $val,
					':mov' => $movimiento,
					':fech' => $fecha,
					':descr' => $destipotela
				]);
					
				$enviado .= 'CANTIDAD DE TELA AGREGADA CON ÉXITO';
	
				$sentencia = $conexion->prepare('SELECT * FROM ctelas');
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
	
			}elseif ($movimiento == 'SALIDA') {

				$val = -1 * $val;
				$sentencia = $conexion->prepare('INSERT INTO entradasalidatelas (tipoTela, cantidadTela, tipoMovimiento, fehaMovimiento, descripcionMovimiento) VALUES (:tipo, :can, :mov, :fech, :descr)');
				$sentencia->execute([
					':tipo' => $stipotela,
					':can' => $val,
					':mov' => $movimiento,
					':fech' => $fecha,
					':descr' => $destipotela
				]);

				$sentencia = $conexion->prepare('SELECT * FROM ctelas WHERE tipoctel = :tipo LIMIT 1');
				$sentencia->execute([
					':tipo' => $stipotela
				]);
				$res = $sentencia->fetch();
	
				if ($ctela > $res[2]) {
					$errores .= 'La cantidad no se puede restar ya que no cuenta con el stock suficiente por favor valide';
				}else{
					echo $res[2];
				$ctela = $res[2] - $ctela;
				$sentencia = $conexion->prepare('UPDATE ctelas SET cantela = :ctel WHERE tipoctel = :tipo');
				$sentencia->execute([
					':ctel' => $ctela,
					':tipo' => $stipotela
				]);
	
				$enviado .= 'CANTIDAD DE TELA RESTADA CORRECTAMENTE';
			}
				$sentencia = $conexion->prepare('SELECT * FROM ctelas');
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
			}else {
				$errores .= 'POR FAVOR SELECCIONE EL TIPO DE MOVIMIENTO';
			}
		}

	}
	
//SEGUNDA OPCION	
	elseif($stipotela == 'SELECCIONE...' && $ttipotela != ''){
		
		if ($ctela == '') {
			$errores .= 'CANTIDAD NO PUEDE ESTAR VACIO';
		}else {
			if ($movimiento == 'ENTRADA') {

				$sentencia = $conexion->prepare('INSERT INTO entradasalidatelas (tipoTela, cantidadTela, tipoMovimiento, fehaMovimiento, descripcionMovimiento) VALUES (:tipo, :can, :mov, :fech, :descr)');
				$sentencia->execute([
					':tipo' => $ttipotela,
					':can' => $val,
					':mov' => $movimiento,
					':fech' => $fecha,
					':descr' => $destipotela
				]);
			
				//AGREGANDO EL TIPO DE TELA
				$sentencia = $conexion->prepare('SELECT * FROM tipotela WHERE nomtela = :tipo');
				$sentencia->execute([
					':tipo' => $ttipotela
				]);
				$res = $sentencia->fetch();
	
				if ($res != false) {
					
				}else {
					$sentencia = $conexion->prepare('INSERT INTO tipotela (nomtela) VALUES (:tipo)');
					$sentencia->execute([
						':tipo' => $ttipotela
					]);
				}
	
				//AGREGNDO O ACTUALIZANDO LA CANTIDAD DE TELA
				$sentencia = $conexion->prepare('SELECT * FROM ctelas WHERE tipoctel = :tipo LIMIT 1');
				$sentencia->execute([
					':tipo' => $ttipotela
				]);
				$res = $sentencia->fetch();
	
				if ($res != false) {
	
					$errores .= 'EL TIPO DE TELA YA EXISTE, POR FAVOR SELECCIONELO DEL MENÚ';
	
					$sentencia = $conexion->prepare('SELECT * FROM ctelas');
					$sentencia->execute();
					$resultado = $sentencia->fetchAll();
	
				}else {
					//Insertando una tela nueva
					$sentencia = $conexion->prepare('INSERT INTO ctelas (tipoctel, cantela) VALUES (:tipo, :ctel)');
					$sentencia->execute([
						':tipo' => $ttipotela,
						':ctel' => $ctela
					]);
					
					//Llenar Select Tipo Tela
					$ttela = $conexion->prepare('SELECT * FROM tipotela ORDER BY nomtela ASC');
					$ttela->execute();
					$rttela = $ttela->fetchall();
					if($rttela != false){
						
					}else{
						$rttela = false;
					}

					$enviado .= 'INFORMACIÓN AGREGADA CORRECTAMENTE';
	
					$sentencia = $conexion->prepare('SELECT * FROM ctelas');
					$sentencia->execute();
					$resultado = $sentencia->fetchAll();
	
				}
	
			}elseif ($movimiento == 'SALIDA') {
				$errores .= 'NO SE PUEDEN CREAR SALIDAS SI ESTÁ AÑADIENDO UN TIPO DE TELA NUEVO';
	
				$sentencia = $conexion->prepare('SELECT * FROM ctelas');
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
	
			}else {
				$errores .= 'SIN MOVIMIENTO SELECCIONADO';
	
				$sentencia = $conexion->prepare('SELECT * FROM ctelas');
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
	
			}
		}

	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['consultar_por_telas'])) {
	$tipo = $_POST['stipotela'];
	
	if ($tipo == 'SELECCIONE...') {
		
		$sentencia = $conexion->prepare('SELECT * FROM entradasalidatelas ORDER BY tipoTela ASC, ID DESC');
		$sentencia->execute();
		$re = $sentencia->fetchAll();

	}else {
		
		$sentencia = $conexion->prepare('SELECT * FROM entradasalidatelas WHERE tipoTela = :tipo ORDER BY fehaMovimiento DESC, ID DESC');
		$sentencia->execute([
			':tipo' => $tipo
		]);
		$re = $sentencia->fetchAll();
		
	}
}

require 'views/rtelas.view.php';
?>