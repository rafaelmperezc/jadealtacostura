<?php
require 'admin/config.php';
require 'funciones/funciones.php';
$con= conexion($bd_config);
$acao=$_POST['acao'];
$parametro=$_POST['abuscar'];
if($acao == 'llenar_campos'):
    $sql = "SELECT * FROM abonofac ";
    $sql .= "WHERE codfac like  ? ";

    $stm = $con->prepare($sql);
    $stm->bindValue(1,$parametro);
    $stm->execute();
    $datos = $stm->fetchAll(PDO::FETCH_OBJ);

    $json = json_encode($datos);
    echo $json;
endif;
?>