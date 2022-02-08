<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
	<meta charset="utf-8">
	<link rel="icon" href="favicon.ico" type="image / x-icon">
	<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
	<link href="css/estilo.css" rel="stylesheet" type="text/css">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>DANNYCON - ARREGLOS Y CONFECCIÓN</title>
	<script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script defer src="../js/ajax-3.5.1.js"></script>
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
					<td width="21%" align="center">
						<div class="logo"></div>
					</td>
				</tr>
				<tr>
					<td width="79%">
						<header>
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
						</header>
					</td>
				</tr>
				<tr>
					<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
					<link rel="stylesheet" href="../css/jquery-ui.css">
					<script src="//code.jquery.com/jquery-1.10.2.js"></script>
					<script src="../js/jquery-3.6.0.min.js"></script>
					<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
					<script src="../js/jquery-ui.min.js"></script>
					<script type="text/javascript">
						function autocompletar() {
							var minimo_letras = 1;
							var palabra = $('#nombre').val();
							if (palabra.length >= minimo_letras) {
								$.ajax({
									url: 'autocompletar.php',
									type: 'POST',
									data: {
										acao: 'autocomplete',
										palabra: palabra
									},
									success: function(data) {
										$('#lista_id').show();
										$('#lista_id').html(data);
										$('#lista_id').css('display', 'block');
									}
								});
							} else {
								$('#lista_id').hide();
							}
						}

						function set_item(opciones) {
							$('#nombre').val(opciones);
							$('#lista_id').hide();
						}

						function CargarDatos() {
							var busca = $('#nombre').val();
							var palabra_b = $('#nombre').val();
							if (busca != "" && busca.length >= 2) {
								console.log(busca);
								$.ajax({
									type: 'POST',
									url: 'Mostar_datos_clientes.php',
									datatype: 'json',
									data: {
										acao: 'llenar_campos',
										abuscar: palabra_b
									},
									success: function(data) {
										console.log(data);
										var obj = $.parseJSON(data);
										var telefonocliente = obj[0].telefonocliente;
										console.log(telefonocliente);
										$('#telefono').val(obj[0].telefonocliente);
										$('#documento').val(obj[0].documentocliente);
									}
								});
							}
						}

						function validar_factura() {
							setTimeout(CargarDatos, 200);
						}
					</script>
					<td colspan="2" class="fuente">
						<!-- InstanceBeginEditable name="Edicion" -->
						<div clas="wrap">
							<center>
								<p class="fuente2">
									Arreglo y confección por pedido
								</p>
								<p class="fuente3">
									* En ubicación de factura digitar una de las siguientes opciones:
								</p>
								<p class="fuente3">
									- EN BODEGA
								</p>
								<p class="fuente3">
									-ENTREGADA
								</p>
								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
									<table width="100%" border="0" align="center">
										<tbody>
											<tr>
												<td align="center" valign="middle"><label for="valor" class="fuente3">Documento Cliente<br>
														<input name="documento" type="text" class="form-control" id="documento" placeholder="Documento..." value="<?php if (!$enviado and isset($documento)) echo $documento ?>" maxlength="10" onKeyPress="return valida(event)">
													</label></td>
												<td align="center" valign="middle">
													<label for="nombre" class="fuente3">Nombre del Cliente<br>
														<div class="input_container" style="width: 100%;vertical-align:middle;line-height:normal;">
															<input name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre..." value="<?php if (!$enviado and isset($nombrec)) echo $nombrec ?>" size="34" style="width: 50%;text-align: center;font-weight: bold; letter-spacing: 2px;word-spacing: 3px;height: 36px;" onkeyup="autocompletar()" autofocus="On" onchange="validar_factura()">
															<ul id="lista_id" style="width: 50%;position: static;"></ul>
														</div>
													</label>
												</td>
												<td align="center" valign="middle">
													<label for="telefono" class="fuente3">Teléfono Cliente<br>
														<input name="telefono" type="text" class="form-control" id="telefono" placeholder="Teléfono..." onKeyPress="return valida(event)" value="<?php if (!$enviado and isset($telefonoc)) echo $telefonoc ?>" maxlength="10">
													</label>
												</td>
											</tr>
											<tr>
												<td colspan="3" align="center" valign="middle">
													<!--<input name="buscarcli" type="submit" class="btn btn-primary" id="buscarcli" formmethod="POST" value="BUSCAR CLIENTE" >--><br>
													<hr>
												</td>
											</tr>

											<tr>
												<td align="center" valign="middle"><label for="valor" class="fuente3">Código de Factura<br>
														<input name="codigo" type="text" class="form-control" id="codigo" placeholder="Codigo Factura..." value="<?php if (!$enviado and isset($codigo)) echo $codigo ?>">
													</label></td>
												<td align="center" valign="middle">
													<label for="valorfactura" class="fuente3">
														Valor de la Factura
														<br>
														<input name="valor" type="text" class="form-control" id="valor" placeholder="Valor..." value="<?php if (!$enviado and isset($valor)) echo $valor ?>" onKeyPress="return valida(event)">
													</label>
													<br>
													<label for="valor" class="fuente3">Fecha de Factura<br>
														<input name="fecha" type="date" id="fecha" max="2100-12-31" min="1800-01-01" value="<?php if (!$enviado and isset($fecha)) echo $fecha ?>">
													</label>
													<br>
													<label for="abono" class="fuente3">Abono<br>
														<input name="abono" type="text" class="form-control" id="abono" placeholder="Abono..." value="<?php if (!$enviado and isset($abono)) echo $abono ?>" onKeyPress="return valida(event)">
													</label>
												</td>
												<td align="center" valign="middle">
													<label for="valor" class="fuente3">
														Detalle de la Factura
														<br>
														<textarea name="descripcion" id="descripcion" placeholder="Descripción de la factura...">
															<?php if (!$enviado and isset($descripcion)) echo $descripcion ?>
														</textarea>
													</label>

													<label class="fuente3" for="ubicacion_factura">
														Ubicación de la Factura
														<br>														
														<input name="ubicacion_factura" type="text" class="form-control" id="ubicacion_factura" placeholder="Ubicación de la Factura" value="<?php if (!$enviado and isset($valor)) echo $valor ?>" onKeyPress="return valida(event)">
														<br>
													</label>
												</td>
											</tr>
											<tr>
												<td colspan="3" align="center" valign="middle">
													<?php if (!empty($errores)) : ?>
														<div class="alert error">
															<?php echo $errores ?>
														</div>
													<?php elseif (!empty($enviado)) : ?>
														<div class="alert success">
															<?php echo $enviado ?>
														</div>
													<?php endif ?>
													<input name="buscar" type="submit" class="btn btn-primary" id="buscar" formmethod="POST" value="BUSCAR FACTURA">
													&nbsp; &nbsp; &nbsp;
													<input name="registrar" type="submit" class="btn btn-primary" id="registrar" formmethod="POST" value="REGISTRAR FACTURA">
													&nbsp; &nbsp; &nbsp;
													<input name="eliminar" type="submit" class="btn btn-primary" id="eliminar" formmethod="POST" value="ELIMINAR FACTURA">
												</td>
											</tr>
										</tbody>
									</table>
								</form>
								<table>

								</table>
							</center>
						</div><!-- InstanceEndEditable -->
					</td>
				</tr>
			</tbody>
		</table>

	</center>
</body>
<!-- InstanceEnd -->

</html>