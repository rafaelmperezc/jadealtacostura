<?php session_start();

if (isset($_SESSION['usuario'])) {
	//header('Location: index.php');
}else{
	header('Location: index.php');
}

require 'admin/config.php';
require 'funciones/funciones.php'
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">

  function ReportEgresos(){
    var fecha_inicio= $("#fecha_inicio").val();
    var fecha_fin= $("#fecha_fin").val();
    if (fecha_inicio== "" || fecha_fin =="") {
      alert('Fechas vacias');
    }else if (fecha_inicio> fecha_fin ){
      alert('Fecha de inicio no puede ser mayor a la de fin.');
  }else{
    window.location.href = "Report/ReportEgresos.php?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin;
  }
  }

  function ReportIngresos(){
    var fecha_inicio= $("#fecha_inicio").val();
    var fecha_fin= $("#fecha_fin").val();
    if ( fecha_inicio == "" || fecha_fin =="") {
      alert('Fechas vacias');
    }else if (fecha_inicio> fecha_fin ){
      alert('Fecha de inicio no puede ser mayor a la de fin.');
  }else {
    window.location.href = "Report/ReportIngresos.php?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin;
  }

  }
</script>
<body class="bg-image">
<center>
	<table width="85%" border="0" align="center">
  <tbody>
    <tr>
        <td width="21%" align="center"><div class="logo"></div></td>
    </tr>
    <tr>
      <td width="79%"><header>
      	<nav class="navegacion">
      		<ul class="menu">
      			<li><a href="inicio.php">INICIO</a></li>
      			<li><a href="#">INGRESOS</a>
      				<ul class="submenu">
      					<li><a href="confeccion.php">CONFECCIÓN AUTÓNOMA</a></li>
      					<li><a href="arreglos.php">ARREGLOS Y CONFECCIÓN POR PEDIDO</a></li>
      					<li><a href="afacturasc.php">ABONO FACTURA CLIENTE</a></li>
      				</ul>
      			</li>
      			<li><a href="#">GASTOS</a>
      				<ul class="submenu">
   					  	<li><a href="gastos.php">REGISTRO</a></li>
      					<li><a href="consultagastos.php">HISTORIAL DE GASTOS</a></li>
      					
   				  	</ul>
      			</li>
      			<li>
              <a href="clientes.php">CLIENTES</a>
      			</li>
      			<li><a href="empleados.php">EMPLEADOS</a></li>
      			<li><a href="#">TELAS</a>
      				<ul class="submenu">
      					<li><a href="rtelas.php">REGISTRO</a></li>
						<li><a href="atelas.php">REGISTRO ACREEDORES</a></li>
      				</ul>
      			</li>
      			<li><a href="cerrar.php">SALIR</a></li>
      		</ul>
      	</nav>
      </header></td>
    </tr>
    <tr>
      <td colspan="2" class="fuente"><!-- InstanceBeginEditable name="Edicion" --><center><?php
		  $conexion = conexion($bd_config);
		  if($conexion == true){
			  echo "Jade Alta Costura</br></br> Su mejor opción en diseño y confección";
		  }else{
			  echo "Error de conexión";
		  }
		  ?></center><!-- InstanceEndEditable --></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;"><br><br>
          <h2>Descarga el reporte de tus egresos e ingresos </h2><br>
          <label form="fecha_inicio" style="font-weight: bold;">Fecha Inicio</label>
          <input type="date" name="fecha_inicio" id="fecha_inicio">
          <label form="fecha_fin" style="font-weight: bold;">Fecha Fin</label>
          <input type="date" name="fecha_fin" id="fecha_fin" onchange="Validar()">
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;"><br>
          <a href="#"><input type="button" class="btn-primary ReporteIngresos" name="ingresos" id="ReporteIngresos"  value="Reporte de Ingresos " onclick="ReportIngresos();"></a>
          <a ><input type="button" class="btn-primary" name="egresos" id="ReporteEgresos" value="Reporte de Egresos" onclick="ReportEgresos();"></a>
        </td>
      </tr>
  </tbody>
</table>

</center>
</body>
<!-- InstanceEnd --></html>
