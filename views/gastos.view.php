<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - GASTOS</title>
<script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script defer type="text/javascript" src="../js/javascript.js"></script>
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
      <td colspan="2" class="fuente"><!-- InstanceBeginEditable name="Edicion" --><center>
		  <div class="wrap">
			DATOS DE LA SALIDA
			<p class="fuente2">
			  * Si el tipo de salida es nómina es obligatorio el nombre del empleado
			</p>
			<p class="fuente2">
			  ** Si el tipo de salida es abono factura es obligatorio el código de la factura
			</p>
      	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="formulario" name="formulario">
      		<p class="fuente2">Tipo de Salida:</p>
      		<p>
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
      		</p>
				<div id="empleado" style="display: none;">
					<p id="dempleado" class="fuente2">
						Nombre del Empleado:
					</p>
      				<p>
						  *
						<select name="nomemp" id="nomemp">
							<option value="SELECCIONE...">SELECCIONE...</option>
      		    			<?php
      		    				if($emplea != false){
									foreach($emplea as $em){
									echo '<option value="' . $em[2] .'">' . $em[2] . '</option>';
									}
								}
             				?>
        				</select>
					</p>
			  </div>
      		<p>
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
			</p>
      		<p class="fuente2">Valor de la Salida:</p>
      		<p>
      		  <input name="valorsalida" type="text" required="required" class="form-control" id="valorsalida" placeholder="Valor de la Salida..." value="<?php if(!$enviado and isset($valor)) echo $valor ?>" onKeyPress="return valida(event)">
    		  </p>
      		<p class="fuente2">Fecha de la Salida:</p>
      		<p>
              <input name="fechasalida" type="date" required="required" id="fechasalida" max="2100-12-31" min="1800-01-01" value="<?php if(!$enviado and isset($fecha)) echo $fecha ?>">
      		</p>
      		<p class="fuente2">Descripción de la salida:</p>
      		<textarea name="descripcionsalida" required id="descripcionsalida" placeholder="Descripción del Gasto..."><?php if(!$enviado and isset($descripcion)) echo $descripcion ?></textarea>
      		<br />
      		<?php if(!empty($errores)): ?>
      		<div class="alert error">
      			<?php echo $errores ?>
      		</div>
      		<?php elseif(!empty($enviado)): ?>
      		<div class="alert success">      		
      			<?php echo $enviado ?>
      		</div>
      		<?php endif ?>
      		<input name="registrar" type="submit" class="btn btn-primary" id="registrar" formmethod="POST" value="REGISTRAR GASTO" >
      	</form>
      </div>
      </center><!-- InstanceEndEditable --></td>
      </tr>
  </tbody>
</table>

</center>
</body>
<!-- InstanceEnd --></html>