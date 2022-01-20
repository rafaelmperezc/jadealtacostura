<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - CONFECCIÓN</title>
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
      <td colspan="2" class="fuente"><!-- InstanceBeginEditable name="Edicion" --><div class="wrap">Módulo de Ingreso de prendas Confeccionadas
         <CENTER>
      <form action="confeccion.php" method="POST">
      	<p><center>
      	  <p>DATOS DE LA PRENDA</p>
      	  <p>&nbsp;</p>
      	  <p class="fuente2">tipo de prenda</p>
      	</center>
      	</p>
     
      	    <select name="tipopren" id="tipopren">
      	      <option value="SELECCIONE...">SELECCIONE...</option>
      	      <?php
      		    	if($pren != false){
						foreach($pren as $pr){
							echo '<option value="' . $pr[1] .'">' . $pr[1] . '</option>';
						}
					}
             ?>
    	      </select>
      	
      	  <p class="fuente2">Cantidad</p>
      	  <p>
      	    <input name="cantidad" type="text" required="required" class="form-control" id="cantidad" placeholder="Valor de la Salida..." >
      	    <br />
             </p>

             <p class="fuente2">Precio</p>
           <p>
             <input name="precio" type="text" required="required" class="form-control" id="cantidad" placeholder="precio..." >
             <br />
            </p>
            <p>Tipo Entrada/Salida</p>
            <p>
               <select name="tipoentradasalida" id="tipoentradasalida" class="form-control" required="">
                  <option value="Entrada" >Entrada</option>
                  <option value="Salida">Salida</option>
               </select>
            </p>
             <p class="fuente2">Descripcion (Opcional)</p>
           <p>
            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion (Opcional)"></textarea>
             <br />
            </p>
      		<?php if(!empty($errores)): ?>
      	  <div class="alert error">
      	    <?php echo $errores ?>
    	    </div>
      		<?php elseif(!empty($enviado)): ?>
      		<div class="alert success">      		
      			<?php echo $enviado ?>
      		</div>
      		<?php endif ?>
      		<input name="actualizar" type="submit" class="btn btn-primary" id="registrar" formmethod="POST" value="GUARDAR DATOS" >
      	
      	
      </form>
      </CENTER>
      <br />
      	  <table width="100%" border="1" align="center" class="gastos" id="historialgastos">
      		<?php
			  if($resultado != false){
				  
			  echo '<tr>
      				<td align="center" style="height:40px;">&nbsp; TIPO PRENDA &nbsp;</td>
      				<td align="center">&nbsp; CANTIDAD PRENDA &nbsp;</td>
                  <td align="center">&nbsp; PRECIO PRENDA &nbsp;</td>
                  
      			</tr>';
			  foreach($resultado as $res){
					echo '<tr><td aling="center" style="height:40px;"><center>' . $res[1] . '</center></td>';
					echo '<td aling="center"><center>' . $res[2] . '</center></td>';
               echo '<td aling="center"><center>' . number_format($res[3],0,',','.') . '</center></td>';
              
					
			}
				  }
			?>
      		</table>
      </div><!-- InstanceEndEditable --></td>
      </tr>
  </tbody>
</table>

</center>
</body>
<!-- InstanceEnd --></html>