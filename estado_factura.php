<?php 

require 'admin/config.php';
require 'funciones/funciones.php';
$con= conexion($bd_config);
$acao2=$_POST['datos'];
$parametro=$_POST['abuscar_factura'];
if($acao2 == 'abuscar_factura'):
    $sql = "SELECT * FROM estadofac ";
    $sql .= "WHERE codfacacretela like  ?  ";

    $stm = $con->prepare($sql);
    $stm->bindValue(1,$parametro);
    $stm->execute();
    $datos = $stm->fetchAll(PDO::FETCH_OBJ);

    $json = json_encode($datos);
    echo $json;
endif;

?>