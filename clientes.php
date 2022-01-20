<?php session_start();

if (isset($_SESSION['usuario'])) {
	//header('Location: index.php');
}else{
	header('Location: index.php');
}

require 'admin/config.php';
require 'funciones/funciones.php';

//$conexion = conexion($bd_config);
$errores = '';
$enviado = '';

/*if($_SERVER['REQUEST_METHOD']== 'POST'){
	$nombre = limpiardatos($_POST['nombre']);
		
		$setencia = $conexion->prepare('SELECT * FROM clientes WHERE nombrecliente = :nombre LIMIT 1');
		$setencia->execute([
			':nombre' => $nombre
		]);
		$resultado = $setencia->fetch();
		$nombre = $resultado['nombrecliente'];
		$telefono = $resultado['telefonocliente'];
		$aespalda = $resultado['aespalda'];
		$ltalla = $resultado['ltalla'];
		$busto = $resultado['busto'];
		$escote = $resultado['escote'];
		$apinza = $resultado['apinza'];
		$lpinza = $resultado['lpinza'];
		$cintura1 = $resultado['cintura1'];
		$cadera1 = $resultado['cadera1'];
		$lblusa = $resultado['lblusa'];
		$lvestido = $resultado['lvestido'];
		$manga = $resultado['manga'];
		$puno = $resultado['puno'];
		$corteimperio = $resultado['corteimperio'];
		$cintura2 = $resultado['cintura2'];
		$cadera2 = $resultado['cadera2'];
		$rodilla = $resultado['rodilla'];
		$ltiro = $resultado['ltiro'];
		$cpierna = $resultado['cpierna'];
		$lpantalon = $resultado['lpantalon'];
		$bota = $resultado['bota'];
		$lfalda = $resultado['lfalda'];
		$lshort = $resultado['lshort'];
		
		if($resultado != true){
			$errores .= 'Éste cliente no existe <br />';
		}	
}*/

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])){
	$documento = limpiardatos($_POST['documento']);
	$nombre = strtoupper(limpiardatos($_POST['nombre']));
	$telefono = limpiardatos($_POST['telefono']);
	$aespalda = limpiardatos($_POST['aespalda']);
	$ltalla = limpiardatos($_POST['ltalla']);
	$busto = limpiardatos($_POST['busto']);
	$escote = limpiardatos($_POST['escote']);
	$apinza = limpiardatos($_POST['apinza']);
	$lpinza = limpiardatos($_POST['lpinza']);
	$cintura1 = limpiardatos($_POST['cintura1']);
	$cadera1 = limpiardatos($_POST['cadera1']);
	$lblusa = limpiardatos($_POST['lblusa']);
	$lvestido = limpiardatos($_POST['lvestido']);
	$manga = limpiardatos($_POST['manga']);
	$puno = limpiardatos($_POST['puno']);
	$corteimperio = limpiardatos($_POST['corteimperio']);
	$cintura2 = limpiardatos($_POST['cintura2']);
	$cadera2 = limpiardatos($_POST['cadera2']);
	$rodilla = limpiardatos($_POST['rodilla']);
	$ltiro = limpiardatos($_POST['ltiro']);
	$cpierna = limpiardatos($_POST['cpierna']);
	$lpantalon = limpiardatos($_POST['lpantalon']);
	$bota = limpiardatos($_POST['bota']);
	$lfalda = limpiardatos($_POST['lfalda']);
	$lshort = limpiardatos($_POST['lshort']);

	
		$conexion = conexion($bd_config);
		$setencia = $conexion->prepare('SELECT * FROM clientes WHERE documentocliente = :documento LIMIT 1');
		$setencia->execute([
			':documento' => $documento
		]);
		$resultado = $setencia->fetch();
		if($resultado != true){
			$errores .= 'El cliente no existe, por favor crearlo';
		}else{
		$setencia = $conexion->prepare('UPDATE clientes SET nombrecliente = :nombre, telefonocliente = :telefono, aespalda = :aespalda, ltalla = :ltalla, busto = :busto, escote = :escote, apinza = :apinza, lpinza = :lpinza, cintura1 = :cintura1, cadera1 = :cadera1, lblusa = :lblusa, lvestido = :lvestido, manga = :manga, puno = :puno, corteimperio = :corteimperio, cintura2 = :cintura2, cadera2 = :cadera2, rodilla = :rodilla, ltiro = :ltiro, cpierna = :cpierna, lpantalon = :lpantalon, bota = :bota, lfalda = :lfalda, lshort = :lshort WHERE documentocliente = :documento');
		$setencia->execute([
			':documento' => $documento,
			':nombre' => $nombre,
			':telefono' => $telefono,
			':aespalda' => $aespalda,
			':ltalla' => $ltalla,
			':busto' => $busto,
			':escote' => $escote,
			':apinza' => $apinza,
			':lpinza' => $lpinza,
			':cintura1' => $cintura1,
			':cadera1' => $cadera1,
			':lblusa' => $lblusa,
			':lvestido' => $lvestido,
			':manga' => $manga,
			':puno' => $puno,
			':corteimperio' => $corteimperio,
			':cintura2' => $cintura2,
			':cadera2' => $cadera2,
			':rodilla' => $rodilla,
			':ltiro' => $ltiro,
			':cpierna' => $cpierna,
			':lpantalon' => $lpantalon,
			':bota' => $bota,
			':lfalda' => $lfalda,
			':lshort' => $lshort
		]);
		$enviado .='Los datos se Actualizaron';
			
		}
	
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['arreglos'])){
	header('Location: arreglos.php');
}

if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['registrar'])){
	$documento = limpiardatos($_POST['documento']);
	$nombre = strtoupper(limpiardatos($_POST['nombre']));
	$telefono = limpiardatos($_POST['telefono']);
	$aespalda = limpiardatos($_POST['aespalda']);
	$ltalla = limpiardatos($_POST['ltalla']);
	$busto = limpiardatos($_POST['busto']);
	$escote = limpiardatos($_POST['escote']);
	$apinza = limpiardatos($_POST['apinza']);
	$lpinza = limpiardatos($_POST['lpinza']);
	$cintura1 = limpiardatos($_POST['cintura1']);
	$cadera1 = limpiardatos($_POST['cadera1']);
	$lblusa = limpiardatos($_POST['lblusa']);
	$lvestido = limpiardatos($_POST['lvestido']);
	$manga = limpiardatos($_POST['manga']);
	$puno = limpiardatos($_POST['puno']);
	$corteimperio = limpiardatos($_POST['corteimperio']);
	$cintura2 = limpiardatos($_POST['cintura2']);
	$cadera2 = limpiardatos($_POST['cadera2']);
	$rodilla = limpiardatos($_POST['rodilla']);
	$ltiro = limpiardatos($_POST['ltiro']);
	$cpierna = limpiardatos($_POST['cpierna']);
	$lpantalon = limpiardatos($_POST['lpantalon']);
	$bota = limpiardatos($_POST['bota']);
	$lfalda = limpiardatos($_POST['lfalda']);
	$lshort = limpiardatos($_POST['lshort']);
	
		$conexion = conexion($bd_config);
		$setencia = $conexion->prepare('SELECT * FROM clientes WHERE documentocliente = :documento LIMIT 1');
		$setencia->execute([
			':documento' => $documento
		]);
		$resultado = $setencia->fetch();
		
		if($resultado != false){
			$errores .= 'Éste cliente ya existe <br />';
		}
	
	
	if($errores == ''){
		$conexion = conexion($bd_config);
		$setencia = $conexion->prepare('INSERT INTO clientes (documentocliente, nombrecliente, telefonocliente, aespalda, ltalla, busto, escote, apinza, lpinza, cintura1, cadera1, lblusa, lvestido, manga, puno, corteimperio, cintura2, cadera2, rodilla, ltiro, cpierna, lpantalon, bota, lfalda, lshort) VALUES(:documento, :nombre, :telefono, :aespalda, :ltalla, :busto, :escote, :apinza, :lpinza, :cintura1, :cadera1, :lblusa, :lvestido, :manga, :puno, :corteimperio, :cintura2, :cadera2, :rodilla, :ltiro, :cpierna, :lpantalon, :bota, :lfalda, :lshort)');
		$setencia->execute([
			':documento' => $documento,
			':nombre' => $nombre,
			':telefono' => $telefono,
			':aespalda' => $aespalda,
			':ltalla' => $ltalla,
			':busto' => $busto,
			':escote' => $escote,
			':apinza' => $apinza,
			':lpinza' => $lpinza,
			':cintura1' => $cintura1,
			':cadera1' => $cadera1,
			':lblusa' => $lblusa,
			':lvestido' => $lvestido,
			':manga' => $manga,
			':puno' => $puno,
			':corteimperio' => $corteimperio,
			':cintura2' => $cintura2,
			':cadera2' => $cadera2,
			':rodilla' => $rodilla,
			':ltiro' => $ltiro,
			':cpierna' => $cpierna,
			':lpantalon' => $lpantalon,
			':bota' => $bota,
			':lfalda' => $lfalda,
			':lshort' => $lshort
		]);
		$enviado .='Cliente registrado exitosamente';
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
	$nombre = strtoupper(limpiardatos($_POST['nombre']));
	$conexion = conexion($bd_config);
	$sentencia = $conexion->prepare('DELETE FROM clientes WHERE nombrecliente = :cliente');
	$sentencia->execute([
		':cliente' => $nombre
	]);
	$enviado .= 'Cliente Eliminado Satisfactoriamente';
}

require 'views/clientes.view.php';
?>