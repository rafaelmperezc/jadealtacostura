<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - CONSULTA GASTOS</title>
<script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script defer type="text/javascript" src="js/javascript.js"></script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<script>
	function mostrar(){
  		getSelectValue = document.getElementById("tipogasto").value;
		if(getSelectValue=="NOMINA"){
			document.getElementById("empleado").style.display = "inline-block";
			document.getElementById("facturaacre").style.display = "none";
		}else if(getSelectValue=="ABONO FACTURA"){
			document.getElementById("empleado").style.display = "none";
			document.getElementById("facturaacre").style.display = "inline-block";
		}else if (getSelectValue=="ARRIENDO") {
			document.getElementById("empleado").style.display = "none";
			document.getElementById("facturaacre").style.display = "none";
		}else if (getSelectValue == "GASTOS DANNY") {
			document.getElementById("empleado").style.display = "none";
			document.getElementById("facturaacre").style.display = "none";
		}else if(getSelectValue=="SERVICIOS"){
			document.getElementById("empleado").style.display = "none";
			document.getElementById("facturaacre").style.display = "none";
		}else if (getSelectValue=="ABONO CREDITO") {
			document.getElementById("empleado").style.display = "none";
			document.getElementById("facturaacre").style.display = "none";
		}else if (getSelectValue=="SELECCIONE...") {
			document.getElementById("empleado").style.display = "none";
			document.getElementById("facturaacre").style.display = "none";
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
						<li><a href="atelas.php">RESGISTRO ACREEDORES</a></li>
      				</ul>
      			</li>
      			<li><a href="cerrar.php">SALIR</a></li>
      		</ul>
      	</nav>
      </header></td>
    </tr>
    <tr>
      <td colspan="2" class="fuente"><!-- InstanceBeginEditable name="Edicion" --><div class="wrap">
      	<center>     	  
      	  <p>CRITERIOS DE BÚSQUEDA</p>
      	  <p><form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
      	  <center>
      	  <table width="100%" border="0" align="center">
      	  	<tr>
      	  	  <center>
      	  	    <td width="50%" align="center">
					<label for="nombre_empleado" class="fuente2">TIPO GASTO:</label><p></p>
					  <select name="tipogasto" id="tipogasto" onchange="mostrar()">
      		    <option value="SELECCIONE...">SELECCIONE...</option>
      		    <?php
      		    	if($gastoti != false){
						foreach($gastoti as $gs){
							echo '<option value="' . $gs[1] .'">' . $gs[1] . '</option>';
						}
					}
             ?>
              </select>
      	  	    </td>
      	  	    </center>
      	  	  <center>
      	  	    <td width="50%" align="center">
						<div id="empleado" style="display: none;">
							<label class="fuente2">NOMBRE EMPLEADO:</label><p></p>
							<select name="nombre_empleado" id="nombre_empleado">
      	  	        			<option value="SELECCIONE...">SELECCIONE...</option>
      	  	        			<?php
      		    					if($emplea != false){
										foreach($emplea as $em){
											echo '<option value="' . $em[2] .'">' . $em[2] . '</option>';
										}	
									}
             					?>
      	  	        		</select>&nbsp;&nbsp;     	  		
						</div>

						<div style="display: none;" id="facturaacre">
					<p class="fuente3">
						FACTURAS ACREEDORES
					</p>
					<p>
						**
					<select name="estado" id="estado">
      					<option value="SELECCIONE...">SELECCIONE...</option>
      					<?php
							if($rttela != false){
								foreach($rttela as $tl){
									echo '<option value="' . $tl[1] .'">' . $tl[1] . '</option>';
									}
								}
						?>
   				    </select>
					</p>
				</div>
      	  	    </td>
      	  	    </center>
    	  	  </tr>
      	  	<tr>
      	  	  <center>
      	  	    <td colspan="2" align="center">
      	  	      <input name="bagastos" type="submit" class="btn btn-primary" id="bagastos" formmethod="POST" value="BUSQUEDA AVANZADA" >      	  			
      	  	      </td>
      	  	    </center>
    	  	  </tr>
      	  	<tr>
      	  		<center>
      	  			<td colspan="2" align="center"><input name="bggastos" type="submit" class="btn btn-primary" id="bfgastos" formmethod="POST" value="BUSQUEDA GENERAL" >
      	  			</td>
      	  		</center>
      	  	</tr>
      	  </table></center></form></p>
      	  <br />
      	  <table width="100%" border="1" align="center" class="gastos" id="historialgastos">
      		<?php
			  if($resultado != false){
				  
			  echo '<tr>
      				<td align="center">&nbsp; tipo de salida &nbsp;</td>
      				<td align="center">&nbsp; valor de la salida &nbsp;</td>
      				<td align="center">&nbsp; fecha salida &nbsp;</td>
      				<td aling="center"><center>&nbsp; nombre empleado &nbsp;</center></td>
					  <td aling="center"><center>&nbsp; Código de la Factura &nbsp;</center></td>
      				<td align="center">&nbsp; descripción de la salida &nbsp;</td>
      			</tr>';
			  foreach($resultado as $res){
					echo '<tr><td aling="center"><center>' . $res[1] . '</center></td>';
					echo '<td aling="center"><center>$' . $res[2] . '</center></td>';
					echo '<td aling="center"><center>' . $res[3] . '</center></td>';
					echo '<td aling="center"><center>' . $res[4] . '</center></td>';
					echo '<td aling="center"><center>' . $res[5] . '</center></td>';
				  	echo '<td aling="center"><center>' . $res[6] . '</center></td></tr>';
			}
				  }
			?>
      		</table>
      	</center>
      </div><!-- InstanceEndEditable --></td>
      </tr>
  </tbody>
</table>

</center>
</body>
<!-- InstanceEnd --></html>