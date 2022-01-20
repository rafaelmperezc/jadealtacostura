<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - EMPLEADOS</title>
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
      <td colspan="2" class="fuente"><!-- InstanceBeginEditable name="Edicion" --><center>
        <div class="wrap">Módulo de empleados
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <p class="fuente2">DATOS PERSONALES</p>
            <p>
              *<input name="documento_empleado" type="text" required class="form-control" id="documento_empleado" placeholder="Documento..." value="<?php if(!$enviado and isset($documentoe)) echo $documentoe ?>" maxlength="10" onKeyPress="return valida(event)">
              *<input name="nombre_empleado" type="text" class="form-control" id="nombre_empleado" placeholder="Nombre Completo" value="<?php if(!$enviado and isset($nombre)) echo $nombre ?>"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
              *<input name="telefono_1_empleado" type="text" class="form-control" id="telefono_1_empleado" placeholder="Teléfono..." value="<?php if(!$enviado and isset($telefono1)) echo $telefono1 ?>" maxlength="10" onKeyPress="return valida(event)">
              &nbsp; <input name="telefono_2_empleado" type="text" class="form-control" id="telefono_2_empleado" placeholder="Teléfono 2..." value="<?php if(!$enviado and isset($telefono2)) echo $telefono2 ?>" maxlength="10" onKeyPress="return valida(event)">
            </p>
            <p class="fuente2">FECHA DE INGRESO &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; FECHA SALIDA</p>
            <p>
  				*<input name="fecha_ingreso" type="date" class="form-control" id="fecha_ingreso" max="2100-12-31" min="1800-01-01" value="<?php if(!$enviado and isset($fechaingreso)) echo $fechaingreso ?>">
            	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input name="fecha_salida" type="date" class="form-control" id="fecha_salida" max="2100-12-31" min="1800-01-01" value="<?php if(!$enviado and isset($fechasalida)) echo $fechasalida ?>">
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
      		<input name="registrar" type="submit" class="btn btn-primary" id="registrar" formmethod="POST" value="BUSCAR / REGISTRAR" >
         	<input name="actualizar" type="submit" class="btn btn-primary" id="actualizar" formmethod="POST" value="ACTUALIZAR" >
			<input name="eliminar" type="submit" value="ELIMINAR" class="btn btn-primary" id="eliminar" formmethod="POST">
          </form>
        </div>
	</center>
      <!-- InstanceEndEditable --></td>
      </tr>
  </tbody>
</table>

</center>
</body>
<!-- InstanceEnd --></html>