<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - ABONOS</title>
<script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script defer type="text/javascript" src="js/javascript.js"></script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

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
      		<p class="fuente2">MODULO DE REGISTRO DE ABONOS A FACTURAS</p>
      		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
      			<table width="100%" align="center">
      				<tr>
      					<td align="center" valign="middle" aling="center">
							<p class="fuente3">
							    FACTURAS REGISTRADAS
							</p>
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
						</td>
      					<td align="center" valign="middle">
							<p class="fuente3">
								FACTURA NUEVA
							</p>
							<p>
								<input type="text" name="numFac" id="numFac" placeholder="Número de Factura" value="<?php if(!$enviado and isset($numFac)) echo $numFac ?>" class="form-control">
							</p>
						</td>
      				</tr>
      				<tr>
   					  	<td align="center" valign="middle">
							<p class="fuente3">FECHA DE LA FACTURA</p>
							<input name="fechafactura" type="date" id="fechafactura" max="2100-12-31" min="1800-01-01" value="<?php if(!$enviado and isset($fechafactura)) echo $fechafactura ?>">
						</td>
				  	    <td align="center" valign="middle" class="fuente3">
							<p>VALOR DE LA FACTURA</p>
							<input name="valorfactura" type="text" class="form-control" id="valorfactura" placeholder="Valor de la Factura..." value="<?php if(!$enviado and isset($valorfactura)) echo $valorfactura ?>">
						</td>
      				</tr>
      				<tr>
   					    <td align="center" valign="middle" class="fuente3">
							<p>SALDO ACTUAL</p>
							<input name="saldoactual" type="text" disabled class="form-control" id="saldoactual" placeholder="SALDO ACTUAL..." value="<?php if(!$enviado and isset($saldoactual)) echo $saldoactual ?>">
						</td>
   					    <td align="center" valign="middle" class="fuente3">
							<p>ABONO</p>
							<input name="abonof" type="text" class="form-control" id="abonof" placeholder="Valor del Abono..." value="<?php if(!$enviado and isset($abono)) echo $abono ?>" onKeyPress="return valida(event)">
						</td>
      				</tr>
      				<tr>
				  	  <td align="center" valign="middle">
							<p class="fuente3">FECHA DEL ABONO</p>
							<input name="fechaa" type="date" id="fechaa" max="2100-12-31" min="1800-01-01" value="<?php if(!$enviado and isset($fechaa)) echo $fechaa ?>">
						</td>
				  	  <td align="center" valign="middle" class="fuente3">
							<p>ESTADO DE LA FACTURA</p>
							<input name="facturaestado" type="text" disabled="disabled" class="form-control" id="facturaestado" placeholder="Estado de la Factura..." value="<?php if(!$enviado and isset($facturaestado)) echo $facturaestado ?>">
						</td>
      				</tr>
      				<tr>
      					<td align="center" valign="middle" colspan="2">
      						<?php if(!empty($errores)): ?>
      						<div class="alert error">
      							<?php echo $errores ?>
      						</div>
      							<?php elseif(!empty($enviado)): ?>
   						  <div class="alert success">      		
      							<?php echo $enviado ?>
      						</div>
      							<?php endif ?>
     						<input name="buscar" type="submit" class="btn btn-primary" id="buscar" value="BUSCAR FACTURA" >&nbsp; &nbsp; &nbsp;
     						<input name="registrar" type="submit" class="btn btn-primary" id="registrar" value="REGISTRAR FACTURA" >&nbsp; &nbsp; &nbsp;
							 <input name="eliminar" type="submit" class="btn btn-primary" id="eliminar" value="ELIMINAR FACTURA" >&nbsp; &nbsp; &nbsp;
      					</td>
      				</tr>
      			</table>
      		</form>
      		<br />
      	  <table width="100%" border="1" align="center" class="gastos" id="historialgastos">
      		<?php
			  if($resultado != false){
				  
			  echo '<tr>
						<td align="center">&nbsp; CÓDIGO FACTURA &nbsp;</td>
						<td align="center">&nbsp; VALOR DE LA FACTURA &nbsp;</td>
						<td align="center">&nbsp; FECHA DE LA FACTURA &nbsp;</td>
						<td align="center">&nbsp; SALDO DE LA FACTURA &nbsp;</td>
						<td align="center">&nbsp; ESTADO DE LA FACTURA &nbsp;</td>
      			    </tr>';
			  foreach($resultado as $res){
					echo '<tr><td aling="center"><center>' . $res[1] . '</center></td>';
					echo '<td aling="center"><center> $' . $res[2] . '=</center></td>';
				    echo '<td aling="center"><center>' . $res[3] . '</center></td>';
					echo '<td aling="center"><center> $' . $res[4] . '=</center></td>';
				  	echo '<td aling="center"><center>' . $res[5] . '</center></td>';					
			}
		 }else{
				  $resultado = 1;
			  }

			  if($resul != false){
				  
				echo '<tr>
						  <td align="center">&nbsp; CÓDIGO FACTURA &nbsp;</td>
						  <td align="center">&nbsp; VALOR DE LA FACTURA &nbsp;</td>
						  <td align="center">&nbsp; FECHA DE LA FACTURA &nbsp;</td>
						  <td align="center">&nbsp; ABONO &nbsp;</td>
						  <td align="center">&nbsp; FECHA DEL ABONO &nbsp;</td>
						  <td align="center">&nbsp; SALDO ANTERIOR &nbsp;</td>
						  <td align="center">&nbsp; SALDO ACTUAL &nbsp;</td>
						  <td align="center">&nbsp; ESTADO FACTURA &nbsp;</td>
						</tr>';
				foreach($resul as $res){
					echo '<tr><td aling="center"><center>' . $res[1] . '</center></td>';
					echo '<td aling="center"><center> $' . $res[2] . '=</center></td>';
					echo '<td aling="center"><center>' . $res[3] . '</center></td>';
					echo '<td aling="center"><center> $' . $res[4] . '=</center></td>';
					echo '<td aling="center"><center>' . $res[5] . '</center></td>';
					echo '<td aling="center"><center> $' . $res[6] . '=</center></td>';
					echo '<td aling="center"><center> $' . $res[7] . '=</center></td>';
					echo '<td aling="center"><center>' . $res[8] . '</center></td>';
			  }
		   }else{
					$resul = 1;
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