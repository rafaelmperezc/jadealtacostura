<!doctype html>

<html><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<link  rel = "icon"  href = "favicon.ico"  type = "image / x-icon" >
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>DANNYCON - ABONOS CLIENTES</title>
<script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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

#tabla_datos_factura{
  display: none;
}
</style>
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
      			<table width="100%" border="0" align="center">
      				<tbody>
      					<tr>
      						<td align="center" valign="middle" colspan="3">
                    <br>
      							<p class="fuente2">ESTADO DE FACTURAS</p>
      						</td>
      					</tr>
      				
                 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--<script type="text/javascript" src="../nuevos_js/nuevo_ajax.js"></script>-->
     <script type="text/javascript">
  // Función autocompletar
function autocompletar() {
  var minimo_letras = 1; // minimo letras visibles en el autocompletar
  var palabra = $('#factura').val();
  //Contamos el valor del input mediante una condicional
  if (palabra.length >= minimo_letras) {
    $.ajax({
      url: 'abonofac.php',
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
  $('#factura').val(opciones);
  // ocultar lista de proposiciones
  $('#lista_id').hide();
}

function CargarDatos(){
      var busca = $('#factura').val();
        var palabra_b = $('#factura').val();
       // alert(busca);
      if(busca != "" && busca.length >= 2){
         console.log(busca);
        $.ajax({
            type:'POST',
            url:'abonofac_datos_json.php',
            datatype:'json',
            data: {
                acao: 'llenar_campos',
                abuscar: palabra_b
              },
              success: function(data) {
                 //$('#documento').val(datas.documentocliente);
                 console.log(data);
                 var obj = $.parseJSON(data);

                //console.log(obj);
                //console.log(telefonocliente);
               /*$('#fechafactura').val(obj[0].fechafac);
               $('#valorfactura').val(obj[0].valorfac);
                 //console.log($('#aespalda').val(datas.aespalda));
                 $('#saldoactual').val(obj[0].saldo);
                 // $('#abonof').val(obj[0].abono);
                 $('#fechaa').val(obj[0].fechaabono);
                 $('#facturaestado').val(obj[0].estadofac);
                 if(obj[0].estadofac=="CERRADA" || obj[0].estadofac=="ANULADA"){
                  $('#abonar').css('display','none'); 
                 }else{
                   $('#abonar').css('display','block'); 
                 }*/
                             var fila="";
$('#tabla_datos_factura').css('display','block'); 
$.each(obj, function(index) {
  console.log(obj);
  var codfac = obj[index].codfac;
  var fechafac = obj[index].fechafac;
  var valorfac = obj[index].valorfac;
  var saldo = obj[index].saldo;
  var saldonuevo = obj[index].saldonuevo;
  var fechaabono = obj[index].fechaabono;
  var abono=obj[index].abono;
  var estadofac = obj[index].estadofac;
  fila += '<tr><td>'+codfac+'</td><td>'+fechafac+'</td><td>'+valorfac+'</td><td>'+saldo+'</td><td>'+abono+'</td><td>'+saldonuevo+'</td><td>'+fechaabono+'</td><td>'+estadofac+'</td></tr>';
    $('#Mostrar').html(fila); 
});

   
              }

          });
      }
    }

    function validar_factura(){
      setTimeout(CargarDatos_de_input, 200);
       setTimeout(CargarDatos, 200);
    }


    function CargarDatos_de_input(){
      var busca = $('#factura').val();
        var palabra_b = $('#factura').val();
       // alert(busca);
      if(busca != "" && busca.length >= 2){
         console.log('datos '+busca);
        $.ajax({
            type:'POST',
            url:'estado_factura.php',
            datatype:'json',
            data: {
                datos: 'abuscar_factura',
                abuscar_factura: palabra_b
              },
              success: function(datas) {
                 console.log('valorae '+datas);
                 var obj_datos = $.parseJSON(datas);
               $('#fechafactura').val(obj_datos[0].fechafac);
               $('#valorfactura').val(obj_datos[0].vtotalfacacretela);
                 $('#saldoactual').val(obj_datos[0].saldo);
                 $('#abonof').val('');
                 $('#fechaa').val('');
                 $('#facturaestado').val(obj_datos[0].facestado);
                 if(obj_datos[0].facestado=="CERRADA" || obj_datos[0].facestado=="ANULADA"){
                  $('#abonar').css('display','none'); 
                 }else{
                   $('#abonar').css('display','block'); 
                 }
              }

          });
      }
    }


     function AgregarAbono(){
      var fecha = $('#fechaa').val();
        var abono = $('#abonof').val();
        var factura = $('#factura').val();
        //alert(factura);
        if (factura=="") {
          alert('Por favor busca una factura...');
          return false;
        }

        if (abono=="") {
          alert('El valor del abono no puede estar vacio...');
          return false;
        }

        if (fecha=="") {
          alert('Establesca la fecha del abono por favor...');
          return false;
        }

      if(factura && fecha  && abono != "" && abono.length >= 2){
         console.log('AgregarAbono '+ abono +'  '+ fecha);
         $('.btnabono').attr('disabled','disabled');
        $.ajax({
            type:'POST',
            url:'AgregarAbono.php',
            datatype:'json',
            data: {
                factura:factura,
                abono: abono,
                fecha:fecha,
                abonar:'abonar'
              },
              success: function(abono) {
                  $('.btnabono').removeAttr('disabled');
                 //$('#documento').val(datas.documentocliente);
                 console.log('Mensaje '+abono);
                 //var obj_datos = $.parseJSON(abono);
               if (abono == ''){
                alert('El abono fue agregado exitosamente...');
               }
                validar_factura();
              }
          });
      }
    }
    </script>
    <div class="etiqueta" style="width: 100%;font-size: 14px;word-spacing: 3px;letter-spacing: 4px;">Numero de la Factura: </div>
                <div class="input_container"  style="width: 100%;vertical-align:middle;line-height:normal;">
                    <input name="nombre" autocomplete="off" type="text" id="factura"  style="width: 50%;text-align: center;font-weight: bold; letter-spacing: 2px;word-spacing: 3px;height: 36px;" onkeyup="autocompletar()" onchange="validar_factura()"autofocus="On">
                    <ul id="lista_id" style="width: 50%;position: static;"></ul>
                </div>
      					<tr>
      						<td align="center" valign="middle" class="fuente3">
      							<p class="fuente3">FECHA DE LA FACTURA</p><input name="fechafactura" type="date" disabled="disabled" id="fechafactura" max="2100-12-31" min="1800-01-01" >
      						</td>
      						<td colspan="2" align="center" valign="middle" class="fuente3">
      							<p>VALOR DE LA FACTURA</p>
      							<input name="valorfactura" type="text" disabled="disabled" class="form-control" id="valorfactura" placeholder="Valor de la Factura..." >
      						</td>
      					</tr>
      					<tr>
   					  <td align="center" valign="middle" class="fuente3"><p>SALDO ACTUAL</p><input name="saldoactual" type="text" disabled="disabled" class="form-control" id="saldoactual" placeholder="SALDO ACTUAL..." ></td>
   					  <td align="center" valign="middle" class="fuente3" colspan="2"><p>ABONO</p><input name="abonof" type="text" class="form-control" id="abonof" placeholder="Valor del Abono..."  onKeyPress="return valida(event)"></td>
      				</tr>
      				<tr>
				  	  <td align="center" valign="middle"><p class="fuente3">FECHA DEL ABONO</p><input name="fechaa" type="date" id="fechaa" max="2100-12-31" min="1800-01-01" ></td>
				  	  <td align="center" valign="middle" class="fuente3" colspan="2"><p>ESTADO DE LA FACTURA</p><input name="facturaestado" type="text" disabled="disabled" class="form-control" id="facturaestado" placeholder="Estado de la Factura..." ></td>
      				</tr>
      				<tr>
      					<td align="center" valign="middle" colspan="3">
     						<!--<input name="buscar" type="submit" class="btn btn-primary" id="buscar" value="BUSCAR" >&nbsp; &nbsp; &nbsp;-->
     						<input name="abonar" type="button" class="btn btn-primary btnabono" id="abonar" value="ABONAR" onclick="AgregarAbono()">
      					</td>
      				</tr>

      				</tbody>
      			</table>
      		</form>
      		<br />
      		<table id="tabla_datos_factura" width="100%" border="1" align="center" class="gastos" id="historial_abonos">
          <tr>
      		<td align="center">&nbsp; CÓDIGO FACTURA &nbsp;</td>
      		<td align="center">&nbsp; FECHA FACTURA &nbsp;</td>
					<td align="center">&nbsp; VALOR FACTURA &nbsp;</td>
					<td align="center">&nbsp; SALDO FACTURA &nbsp;</td>
					<td align="center">&nbsp; ABONO FACTURA &nbsp;</td>
					<td align="center">&nbsp; NUEVO SALDO &nbsp;</td>
					<td align="center">&nbsp; FECHA ABONO &nbsp;</td>
					<td align="center">&nbsp; ESTADO FACTURA &nbsp;</td>
      		</tr>
					<tbody id="Mostrar">
          <td></td>
					<td></td>
				  <td></td>
					<td></td>
				  <td></td>
					<td></td>
				  <td></td>
					<td></td>
        </tbody>
      		</table>
      	</center>
      </div><!-- InstanceEndEditable --></td>
      </tr>
  </tbody>
</table>

</center>
</body>
<!-- InstanceEnd --></html>