<?php
require_once 'php/includes/header.php';

// SI SE HA LLEGADO A LA PÁGINA DESDE EL ENVÍO DE FORMULARIO

if (isset($_POST['comprar'])) {
	// capturamos las variables pasadas
	$operacion = $_POST['operacion'];
	$nombre    = $_POST['nombre'];
	$email     = $_POST['email'];
	$PAN       = $_POST['PAN'];
	$caducidad = $_POST['caducidad'];
	$CVV2      = $_POST['CVV2'];
	$importe   = $_POST['importe'];

  // valores aportados por el pdf y las URL para el cálculo de la firma
  $MERCHANT_ID = "082108630";
  $CLAVE_ENCRIPTATION = "87401456";
  $ACQUIRER_BIN = "0000554002";
  $TERMINAL_ID = "00000003";
  $TIPO_MONEDA = "978";
  $EXPONENTE = "2";
  $URL_OK = "http://localhost:8888/modelos-pago/ok.php";
  $URL_NOK = "http://localhost:8888/modelos-pago/error.php";

  // calculo de la firma
  $firma = sha1($MERCHANT_ID . $CLAVE_ENCRIPTATION . $ACQUIRER_BIN . $TERMINAL_ID . $URL_OK . $URL_NOK . $operacion . $importe . $TIPO_MONEDA . $EXPONENTE . "SHA1");
	?>

	<section id="contenido">

	<h2 class="encabezadoprincipal">REVISE LA INFORMACION</h2>

	<article id="tpv"> <h3>Nº de operación: <?php echo $operacion;?></h3>
  <div class="procesado">
  <p><label>Nombre: </label> <?php echo $nombre; ?></p>
  <p><label>Email: </label> <?php echo $email; ?></p>
  <p><label>Tarjeta: </label> <?php echo $PAN; ?></p>
 <!-- CAMPOS OCULTOS PARA TPV -->
 <!-- Capturados -->
	<div class="form">
  <form name="tpv" action="http://tpv.ceca.es:8000/cgi-bin/tpv" method="POST">
	<input type="hidden" id="nombre" value="{$nombre}" />
	<input type="hidden" id="email" value="{$email}" />
  <input type="hidden" name="PAN" id="PAN" required value="{$PAN}">
  <input type="hidden" name="Caducidad" id="Caducidad" value="{$caducidad}">
  <input type="hidden" name="CVV2" id="CVV2" value="{$CVV2}">
  <input type="hidden" id="importe" name="importe" value="{$importe}">
  <!-- Pasados -->
	<input type="hidden" name="MERCHANT_ID" value="<?php echo $MERCHANT_ID; ?>">
	<input type="hidden" name="ACQUIRER_BIN" value="<?php echo $ACQUIRER_BIN; ?>">
	<input type="hidden" name="TERMINAL_ID" value="<?php echo $TERMINAL_ID; ?>">
	<input type="hidden" name="CLAVE_ENCRIPTATION" value="<?php echo $CLAVE_ENCRIPTATION; ?>">
	<input type="hidden" name="NUM_OPERACION" value="<?php echo $operacion;?>">
	<input type="hidden" name="CIFRADO" value="<?php sha1('pruebadecaja');?>">
	<input type="hidden" name="FIRMA" value="<?php echo $firma; ?>">
	<input type="hidden" name="TIPO_MONEDA" value="<?php echo $TIPO_MONEDA; ?>">
	<input type="hidden" name="EXPONENTE" value="<?php echo $EXPONENTE; ?>">
	<input type="hidden" name="IDIOMA" value="1">
	<input type="hidden" name="PAGO_SOPORTADO" value="SSL">
	<input type="hidden" name="PAGO_ELEGIDO" value="SSL">
	<input type="hidden" name="URL_OK" value="<?php echo $URL_OK; ?>">
	<input type="hidden" name="URL_NOK" value="<?php echo $URL_NOK; ?>">

	<!-- CAMPOS PARA TPV
	MERCHANT_ID ="082108630";
	ACQUIRER_BIN ="0000554002";
	TERMINAL_ID ="00000003";
	CLAVE_ENCRIPTATION ="87401456";
	TIPO_MONEDA ="978";
	EXPONENTE ="2";
	URL_OK  = "http://localhost:8080/PasarelaPago/ok.jsp";
	URL_NOK = "http://localhost:8080/PasarelaPago/error.jsp";
	-->
	<p><input type="submit" id="aceptar" value="ACEPTAR Y COMPRAR"></p>
	</form>
	</div>
	</article>

	</section><!-- fin de section -->

  <!-- SI NO SE HA LLEGADO A LA PÁGINA DESDE EL ENVÍO DEL FORMULARIO -->
	<?php } else {?>
	<section id="contenido">

	<h2 class="encabezadoprincipal">NO ESTÁ PERMITIDO ACCEDER</h2>

	<?php }?>

<?php
require_once 'php/includes/footer.php';
?>
