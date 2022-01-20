<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - REGISTRO TELAS</title>
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
      <td colspan="2" class="fuente"><!-- InstanceBeginEditable name="Edicion" --><div class="wrap"><center>
      	<p class="fuente2">MÓDULO DE MOVIMIENTO DE TELAS</p>
      	<p class="fuente3">*Si el tipo de tela ya existe seleccionelo</p>
      	<p class="fuente3">** Ingrese el tipo de tela si no está en el menú desplegable</p>
      	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
      		<table width="100%" align="center">
      			<tr>
      				<td colspan="2" class="fuente3">TIPO TELA</td>
      			</tr>
      			<tr>
      				<td align="center" valign="middle" class="fuente">
						  *
						  <select name="stipotela" id="stipotela">
      				  		<option value="SELECCIONE...">SELECCIONE...</option>
      				  <?php
      		    	if($rttela != false){
						foreach($rttela as $tl){
							echo '<option value="' . $tl[1] .'">' . $tl[1] . '</option>';
						}
					}
             ?>
   				    </select></td>
      				<td align="center" valign="middle" class="fuente">**<input name="ttipotela" type="text" class="form-control" id="ttipotela" placeholder="Tipo Tela..." value="<?php if(!$enviado and isset($ttipotela)) echo $ttipotela ?>"></td>
      			</tr>
      			<tr><!--
      				<td align="center" valign="middle">
						  <p class="fuente3">CODIGO DE FACTURA</p>
						  <input name="codfact" type="text" required class="form-control" id="codfact" placeholder="Código de Factura" value="<?php if(!$enviado and isset($faccod)) echo $faccod ?>">
					</td>-->
      				<td align="center" valign="middle">
						  <p class="fuente3">CANTIDAD DE TELA EN METROS</p>
						  <input name="cantela" type="text" class="form-control" id="cantela" placeholder="Cantidad en metros..." value="<?php if(!$enviado and isset($ctela)) echo $ctela ?>">
					</td>
      			</tr>
      			<tr>
					  <td align="center" valing="middle">
						  <p class="fuente3">TIPO DE MOVIMIENTO ENTRADA/SALIDA</p>
						  <select name="movimiento" id="movimiento">
							  <option value="SELECCIONE...">SELECCIONE...</option>
							  <option value="ENTRADA">ENTRADA</option>
							  <option value="SALIDA">SALIDA</option>
						  </select>
					  </td>
      			<!--	<td align="center" valign="middle">
						<p class="fuente3">VALOR DE FACTURA</p>
						<input name="valorcompra" type="text" required class="form-control" id="valorcompra" placeholder="Valor de la Factura..." value="<?php if(!$enviado and isset($vcomp)) echo $vcomp ?>" onKeyPress="return valida(event)">
					</td>--> 
      			  	<td align="center" valign="middle">
							<p class="fuente3">FECHA DE REGISTRO</p>
							<input name="fechacompra" type="date" id="fechacompra" max="2100-12-31" min="1800-01-01" value="<?php if(!$enviado and isset($fecha)) echo $fecha ?>">
					</td>
    			</tr>
				<tr>
					<td align="center" valign="middle" colspan="2"><p class="fuente2">DESCRIPCIÓN DEL MOVIMIENTO DE TIPO DE TELA</p>
      					<textarea name="destipotela" id="destipotela" placeholder="Descripción del Tipo de Tela(s)..."><?php if(!$enviado and isset($destipotela)) echo $destipotela ?></textarea>
					</td>
				</tr>
    			<tr>
    			  	<td align="center" valign="middle" colspan="2"><br />
      		<?php if(!empty($errores)): ?>
      		<div class="alert error">
      			<?php echo $errores ?>
      		</div>
      		<?php elseif(!empty($enviado)): ?>
      		<div class="alert success">      		
      			<?php echo $enviado ?>
      		</div>
      		<?php endif ?>
			  <input name="registrar" type="submit" class="btn btn-primary" id="registrar" formmethod="POST" value="REGISTRAR" >
			  <input name="consultar" type="submit" class="btn btn-primary" id="consultar" formmethod="POST" value="CONSULTAR CANTIDADES ACTUALES" >
			  <input name="consultar_por_telas" type="submit" class="btn btn-primary" id="consultar_por_telas" formmethod="POST" value="MOVIMIENTOS DE TELAS" >
			</td>
    			  </tr>
      		</table>
      	</form>

		  <br />
      	  <table width="100%" border="1" align="center" class="gastos" id="historialgastos">
      		<?php
			  if($resultado != false){
				  
			  echo '<tr>
      				<td align="center">&nbsp; TIPO DE TELA &nbsp;</td>
      				<td align="center">&nbsp; CANTIDAD EXISTENTE EN METROS &nbsp;</td>
      			</tr>';
			  foreach($resultado as $res){
					echo '<tr><td aling="center"><center>' . $res[1] . '</center></td>';
					echo '<td aling="center"><center>' . $res[2] . '</center></td>';
			}
				  }

				  if($re != false){
				  
					echo '<tr>
							<td align="center">&nbsp; TIPO DE TELA &nbsp;</td>
							<td align="center">&nbsp; CANTIDAD DEL MOVIMIENTO &nbsp;</td>
							<td align="center">&nbsp; TIPO DEL MOVIMIENTO &nbsp;</td>
							<td align="center">&nbsp; FECHA DEL MOVIMIENTO &nbsp;</td>
							<td align="center">&nbsp; DESCRIPCIÓN DEL MOVIMIENTO &nbsp;</td>
						</tr>';
					foreach($re as $res){
						  echo '<tr><td aling="center"><center>' . $res[1] . '</center></td>';
						  echo '<td aling="center"><center>' . $res[2] . '</center></td>';
						  echo '<td aling="center"><center>' . $res[3] . '</center></td>';
						  echo '<td aling="center"><center>' . $res[4] . '</center></td>';
						  echo '<td aling="center"><center>' . $res[5] . '</center></td></tr>';
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