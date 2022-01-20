<?php
require 'admin/config.php';
require 'funciones/funciones.php';

$acao=$_POST['acao'];
 if ($acao=="autocomplete") {
	
$pdo = conexion($bd_config);
$keyword = '%'.$_POST['palabra'].'%';
$sql = "SELECT * FROM clientes WHERE nombrecliente LIKE (:keyword) ORDER BY idcliente ASC LIMIT 0, 7";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$lista = $query->fetchAll();
foreach ($lista as $milista) {
	// Colocaremos negrita a los textos
	$pais_nombre = str_replace($_POST['palabra'], '<b style="color:red;">'.$_POST['palabra'].'</b>', $milista['nombrecliente']);
	$telefono=$milista['telefonocliente'];
	// Aquì, agregaremos opciones
    $lista= '<li id="mivalor" onclick="set_item(\''.str_replace("'", "\'", $milista['nombrecliente']).'\')">'.$pais_nombre.'</li><hr style="height:0.01px;position:relative;">';
    echo $lista;
} 
}

?>