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

if(isset($_POST['abonar'])){
		$abono = limpiardatos($_POST['abono']);
		$fecha = $_POST['fecha'];

			//Validando que los datos de abono estén diligenciados
			if($abono and $fecha != ''){

				
				$sen7 = $conexion->prepare('SELECT * FROM estadofac WHERE codfacacretela = :codigo  LIMIT 1');
				$sen7->execute([
					':codigo' => $factiva
				]);
				$res4 = $sen7->fetch();
				$saldo = $res4[4];
				$saldonuevo = $saldo - $abono;
				
				if($abono <= $saldo){
					$sen8 = $conexion->prepare('INSERT INTO abonofac VALUES (null, :codigo, :fechafac, :valorfac, :saldo, :abono, :saldonuevo, :fechaabono, :estadofac)');
					$sen8->execute([
						':codigo' => $res4[1],
						':fechafac' => $res4[2],
						':valorfac' => $res4[3],
						':saldo' => $res4[4],
						':abono' => $abono,
						':saldonuevo' => $saldonuevo,
						':fechaabono' => $fecha,
						':estadofac' => $res4[5]
					]);
					
					$sen9 = $conexion->prepare('UPDATE estadofac SET saldo = :saldonuevo WHERE codfacacretela = :codfac');
					$sen9->execute([
						':saldonuevo' => $saldonuevo,
						':codfac' => $factiva
					]);
					
					if($saldonuevo == 0){
						$estadofinal = 'CERRADA';
						$sen10 = $conexion->prepare('UPDATE abonofac SET estadofac = :estadofinal WHERE saldonuevo = :snuevo && codfac = :codigo');
						$sen10->execute([
							':estadofinal' => $estadofinal,
							':snuevo' => $saldonuevo,
							':codigo' => $factiva
						]);
						
						$sen11 = $conexion->prepare('UPDATE estadofac SET facestado = :estadofinal WHERE codfacacretela = :codfac');
						$sen11->execute([
							':estadofinal' => $estadofinal,
							':codfac' => $factiva
						]);
					}
					
				}else{
					$errores .= 'El abono no puede ser mayor al saldo';
				}
				
			}else{

				$sen12 = $conexion->prepare('SELECT * FROM estadofac WHERE codfacacretela = :estadof LIMIT 1');
				$sen12->execute([
					':estadof' => $factiva
				]);
				$res5 = $sen12->fetch();
				$fechafactura = $res5['fechafac'];
				$valorfactura = $res5['vtotalfacacretela'];
				$saldoactual = $res5['saldo'];
				$facturaestado = $res5['facestado'];
				$errores .= 'Los Campos de abono y fecha no pueden estar vacios';
			}
	}



require 'views/afacturasc.view.php';
?>