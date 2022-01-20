<?php session_start();

if (isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

require 'admin/config.php';
require 'funciones/funciones.php';
$conexion = conexion($bd_config);
$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = strtolower(limpiardatos($_POST['usuario']));
	$password = $_POST['password'];

	$statement = $conexion->prepare('
		SELECT * FROM usuarios WHERE usuario = :usuario && pass = :password'
	);
	$statement->execute(array(
		':usuario' => $usuario,
		':password' => $password
	));

	$resultado = $statement->fetch();
	if ($resultado !== false) {
		$_SESSION['usuario'] = $usuario;
		header('Location: index.php');
	} else {
		$errores .= '<li>Datos Incorrectos</li>';
	}
}

require 'views/login.view.php';

?>