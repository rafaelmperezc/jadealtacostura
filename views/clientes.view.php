<!doctype html>
<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - CLIENTES</title>
<script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../js/ajax-3.5.1.js" defer></script>
<script defer type="text/javascript" src="js/javascript.js"></script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<style type="text/css">

.footer {
  padding: 10px;
  text-align: right;
}
.footer a {
  color: #999999;
  text-decoration: none;
}
.footer a:hover {
  text-decoration: underline;
}
.etiqueta {
  width: 120px;
  float: left;
  line-height: 28px;
  font-size: 20px;
}
.input_container {
  height: 30px;
  float: left;
}
.input_container input {
  height: 20px;
  width: 200px;
  padding: 3px;
  border: 1px solid #cccccc;
  border-radius: 0;
}
.input_container ul {
  display: none;
  width: 206px;
  border: 1px solid #eaeaea;
  position: absolute;
  z-index: 9;
  background: #f3f3f3;
  list-style: none;
  margin-left: 0px;
margin-top: -20px;
position: absolute;
}
.input_container ul li{
  position: relative;
    background: white;
  color: black;
  font-size: 20px;
  font-family: normal;
  padding: 2px;
  cursor: pointer;
}
.input_container ul li:hover {
  background: #eaeaea;
}
#country_list_id {
  display: none;
}

.ContainerTallas div{
  width: 150px;
display: inline-flex;
}

.ContainerTallas div input, #telefono, #documento{
  text-align: center;
  font-weight: bold;
  font-size: 15px;
}
</style>
<body class="bg-image">
<center>
	<table width="85%" border="0" align="center" >
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="../js/jquery-ui.min.js"></script>
    <!--<script type="text/javascript" src="../nuevos_js/nuevo_ajax.js"></script>-->
     <script type="text/javascript">
  // Función autocompletar
function autocompletar() {
  var minimo_letras = 1; // minimo letras visibles en el autocompletar
  var palabra = $('#nombre').val();
  //Contamos el valor del input mediante una condicional
  if (palabra.length >= minimo_letras) {
    $.ajax({
      url: 'autocompletar.php',
      type: 'POST',
      data: {
                acao: 'autocomplete',
                palabra:palabra
              },
      success:function(data){
        $('#lista_id').show();
        $('#lista_id').html(data);
        $('#lista_id').css('display','block');
        
      }
    });
  } else {
    //ocultamos la lista
    $('#lista_id').hide();
  }
}
 
// Funcion Mostrar valores
function set_item(opciones) {
  // Cambiar el valor del formulario input
  $('#nombre').val(opciones);
  // ocultar lista de proposiciones
  $('#lista_id').hide();
}

function CargarDatos(){
      var busca = $('#nombre').val();
        var palabra_b = $('#nombre').val();
      if(busca != "" && busca.length >= 2){
         console.log(busca);
        $.ajax({
            type:'POST',
            url:'Mostar_datos_clientes.php',
            datatype:'json',
            data: {
                acao: 'llenar_campos',
                abuscar: palabra_b
              },
              success: function(data) {
                 //$('#documento').val(datas.documentocliente);
                 console.log(data);
                 var obj = $.parseJSON(data);
                 var telefonocliente= obj[0].telefonocliente;


                //console.log(obj);
                console.log(telefonocliente);
               $('#telefono').val(obj[0].telefonocliente);
               $('#documento').val(obj[0].documentocliente);
                 //console.log($('#aespalda').val(datas.aespalda));
                 $('#aespalda').val(obj[0].aespalda);
                 $('#ltalla').val(obj[0].ltalla);
                 $('#busto').val(obj[0].busto);
                 $('#escote').val(obj[0].escote);
                 $('#apinza').val(obj[0].apinza);
                 $('#lpinza').val(obj[0].lpinza);
                 $('#cintura1').val(obj[0].cintura1);
                 $('#cadera1').val(obj[0].cadera1);
                 $('#cadera2').val(obj[0].cadera2);
                 $('#lblusa').val(obj[0].lblusa);
                 $('#lvestido').val(obj[0].lvestido);
                 $('#manga').val(obj[0].manga);
                 $('#puno').val(obj[0].puno);
                 $('#corteimperio').val(obj[0].corteimperio);
                 $('#cintura2').val(obj[0].cintura2);
                 $('#rodilla').val(obj[0].rodilla);
                 $('#ltiro').val(obj[0].ltiro);
                 $('#cpierna').val(obj[0].cpierna);
                 $('#lpantalon').val(obj[0].lpantalon);
                 $('#bota').val(obj[0].bota);
                 $('#lfalda').val(obj[0].lfalda);
                 $('#lshort').val(obj[0].lshort);
              }

          });
      }
    }
 function validar_factura(){
       setTimeout(CargarDatos, 200);
    }
    </script>
      <td colspan="2" class="fuente"><!-- InstanceBeginEditable name="Edicion" -->
      <div class="wrap"><center>
        <p>Módulo de clientes</p>
        <p class="fuente2" style="font-weight: bold;word-spacing: 3px;letter-spacing: 4px;">Ingrese el nombre del cliente </p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <!--<form>-->
     		<p>DATOS PERSONALES</p>
          <div class="etiqueta" style="width: 100%;font-size: 14px;word-spacing: 3px;letter-spacing: 4px;">Nombre del cliente: </div>
                <div class="input_container"  style="width: 100%;vertical-align:middle;line-height:normal;">
                    <input name="nombre" value="<?php if(!$enviado and isset($nombre)) echo $nombre ?>" autocomplete="off" type="text" id="nombre"  style="width: 50%;text-align: center;font-weight: bold; letter-spacing: 2px;word-spacing: 3px;height: 36px;" onkeyup="autocompletar()" autofocus="On" onchange="validar_factura()">
                    <ul id="lista_id" style="width: 50%;position: static;"></ul>
                </div>
                <br><br>
          <div style="display: inline-flex;">
          <div style="width: 200px">
          <br><br>
          <label for="documento">DOCUMENTO
            <input name="documento" value="<?php if(!$enviado and isset($documento)) echo $documento ?>" type="text" class="form-control" id="documento" placeholder="Documento..."  maxlength="10" style="text-align: center;word-spacing: 3px;letter-spacing: 2px;">
            </label>
        </div>
        <div style="width: 200px;">
        <br><br>
          <label for="telefono">TELEFONO
      		<input name="telefono" value="<?php if(!$enviado and isset($telefono)) echo $telefono ?>" type="text" class="form-control" id="telefono" placeholder="Teléfono..." style="text-align: center;word-spacing: 3px;letter-spacing: 2px;">
        </label>
        </div>
      </div>
      		<p class="fuente3" style="word-spacing: 5px;letter-spacing: 3px;">MEDIDAS EN CENTÍMETROS</p>
          <p class="fuente2">*Campos obligatorios, si no hay medidas digitar cero (0)</p>
          <br>
          <div class="ContainerTallas">
      		<div>
            <label for="aespalda">A. ESPALDA
              <input name="aespalda" type="text" class="" id="aespalda" placeholder="A. Espalda..." value="<?php if(!$enviado and isset($aespalda)) echo $aespalda ?>">
            </label>
        </div>
        <div>
      		<label for="ltalla">L. TALLA
            <input name="ltalla" type="text" class="form-control" id="ltalla" placeholder="L. Talla..." value="<?php if(!$enviado and isset($ltalla)) echo $ltalla ?>">
          </label>
        </div>
        <div>
      		<label for="busto">BUSTO
            <input name="busto" type="text" class="form-control" id="busto" placeholder="Busto..." value="<?php if(!$enviado and isset($busto)) echo $busto ?>">
          </label>
        </div>
        <div>
      		<label for="escote">ESCOTE
            <input name="escote" type="text" class="form-control" id="escote" placeholder="Escote..." value="<?php if(!$enviado and isset($escote)) echo $escote ?>">
          </label>
        </div>
        <div>
      		<label for="apinza">A.PINZA
            <input name="apinza" type="text" class="form-control" id="apinza" placeholder="A. Pinza..." value="<?php if(!$enviado && isset($apinza)) echo $apinza?>">
          </label>
        </div>
        <div>
          <label for="lpinza">L.PINZA
      		<input name="lpinza" type="text" class="form-control" id="lpinza" placeholder="L. Pinza" title="lpinza" value="<?php if(!$enviado && isset($lpinza)) echo $lpinza ?>">
          </label>
        </div>
        <div>
          <label for="cintura1">CINTURA.1
      		<input name="cintura1" type="text" class="form-control" id="cintura1" placeholder="Cintura..." value="<?php if(!$enviado && isset($cintura1)) echo $cintura1 ?>">
        </label>
      </div>
      <div>
          <label for="cadera1">CADERA.1
      		<input name="cadera1" type="text" class="form-control" id="cadera1" placeholder="Cadera..." value="<?php if(!$enviado && isset($cadera1)) echo $cadera1 ?>">
        </label>
      </div>
      <div>
          <label for="lblusa">L.BLUSA
      		<input name="lblusa" type="text" class="form-control" id="lblusa" placeholder="L. Blusa..." value="<?php if(!$enviado && isset($lblusa)) echo $lblusa ?>">
        </label>
      </div>
      <div>
         <label for="lvestido">L.VESTIDO
      		<input name="lvestido" type="text" class="form-control" id="lvestido" placeholder="L. Vestido" value="<?php if(!$enviado && isset($lvestido)) echo $lvestido ?>">
        </label>
      </div>
      <div>
          <label for="manga">MANGA
      		<input name="manga" type="text" class="form-control" id="manga" placeholder="Manga..." value="<?php if(!$enviado && isset($manga)) echo $manga ?>">
        </label>
      </div>
      <div>
        <label for="puno">PUÑO
      		<input name="puno" type="text" class="form-control" id="puno" placeholder="Puño..." value="<?php if(!$enviado && isset($puno)) echo $puno ?>">
        </label>
      </div>
      <div>
        <label for="corteimperio">CORTE IMPERIO
      		<input name="corteimperio" type="text" class="form-control" id="corteimperio" placeholder="Corte Imperio..." value="<?php if(!$enviado && isset($corteimperio)) echo $corteimperio ?>">
        </label>
      </div>
      <div>
        <label for="cintura2">CINTURA.2
      		<input name="cintura2" type="text" class="form-control" id="cintura2" placeholder="Cintura..." value="<?php if(!$enviado && isset($cintura2)) echo $cintura2 ?>">
        </label>
      </div>
      <div>
        <label for="cadera2">CADERA.2
      		<input name="cadera2" type="text" class="form-control" id="cadera2" placeholder="Cadera..." value="<?php if(!$enviado && isset($cadera2)) echo $cadera2 ?>">
        </label>
      </div>
      <div>
        <label for="rodilla">RODILLA
      		<input name="rodilla" type="text" class="form-control" id="rodilla" placeholder="Rodilla..." value="<?php if(!$enviado && isset($rodilla)) echo $rodilla ?>">
        </label>
      </div>
      <div>
        <label for="ltiro">L.TIRO
      		<input name="ltiro" type="text" class="form-control" id="ltiro" placeholder="L. Tiro..." value="<?php if(!$enviado && isset($ltiro)) echo $ltiro ?>">
        </label>
      </div>
      <div>
        <label for="cpierna">C.PIERNA
      		<input name="cpierna" type="text" class="form-control" id="cpierna" placeholder="C. Pierna..." value="<?php if(!$enviado && isset($cpierna)) echo $cpierna ?>">
        </label>
      </div>
      <div>
        <label for="lpantalon">L.PANTALON
      		<input name="lpantalon" type="text" class="form-control" id="lpantalon" placeholder="L. Pantalón..." value="<?php if(!$enviado && isset($lpantalon)) echo $lpantalon ?>">
        </label>
      </div>
      <div>
        <label for="bota">BOTA
      		<input name="bota" type="text" class="form-control" id="bota" placeholder="Bota..." value="<?php if(!$enviado && isset($bota)) echo $bota ?>">
        </label>
      </div>
      <div>
        <label for="lfalda">L.FALDA
      		<input name="lfalda" type="text" class="form-control" id="lfalda" placeholder="L. Falda..." value="<?php if(!$enviado && isset($lfalda)) echo $lfalda ?>">
        </label>
      </div>
      <div>
        <label for="lshort">LSHORT
      		<input name="lshort" type="text" class="form-control" id="lshort" placeholder="L Short..." value="<?php if(!$enviado && isset($lshort)) echo $lshort ?>">
        </label>
      </div>
        </DIV><br />
      		<?php if(!empty($errores)): ?>
      		<div class="alert error">
      			<?php echo $errores ?>
      		</div>
      		<?php elseif($enviado): ?> 
      		<div class="alert success">      		
          <?php echo $enviado ?>
      		</div>
      		<?php endif ?>
          <input type="submit" value="REGISTRAR" name="registrar" id="registrar" class="btn btn-primary" >
      		<input name="actualizar" type="submit" class="btn btn-primary" id="registrar" value="ACTUALIZAR" >
          <input type="submit" value="ELIMINAR" name="eliminar" id="eliminar" class="btn btn-primary">
          <input name="arreglos" type="submit" class="btn btn-primary" id="arreglos" formmethod="POST" value="ARREGLOS IR" >
      	</form>
      	</center>
      </div><!-- InstanceEndEditable --></td>
      </tr>
  </tbody>
</table>

</center>

<!-- -->

</body>
<!-- InstanceEnd --></html>
