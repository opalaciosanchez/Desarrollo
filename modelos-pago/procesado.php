<?php
require_once 'php/includes/header.php';

// SI SE HA LLEGADO A LA PÁGINA DESDE EL ENVÍO DE FORMULARIO

if (isset($_POST['comprar'])) {
	// capturamos las variables pasadas
	$operacion = (int) $_POST['operacion'];
	$nombre    = $_POST['nombre'];
	$email     = $_POST['email'];
	$PAN       = (int) $_POST['PAN'];
	$caducidad = (int) $_POST['caducidad'];
	$CVV2      = (int) $_POST['CVV2'];
	$importe   = (int) $_POST['importe'];

  // valores aportados por el pdf y las URL para el cálculo de la firma
  $MERCHANT_ID = "082108630";
  $CLAVE_ENCRIPTATION = 87401456;
  $ACQUIRER_BIN = 0000554002;
  $TERMINAL_ID = 00000003;
  $TIPO_MONEDA = 978;
  $EXPONENTE = 2;
  $URL_OK = "http://localhost:8888/modelos-pago/ok.php";
  $URL_NOK = "http://localhost:8888/modelos-pago/error.php";

  // calculo de la firma
  $firma = sha1($MERCHANT_ID . $CLAVE_ENCRIPTATION . $ACQUIRER_BIN . $TERMINAL_ID . 
  		   $URL_OK . $URL_NOK . $operacion . $importe . $TIPO_MONEDA . $EXPONENTE . "SHA1");
?>

<section id="contenido">

<h2 class="encabezadoprincipal">REVISE LA INFORMACION</h2>
<article id="tpv"> <h3>Nº de operación: <?php echo $operacion;?></h3>
  <div class="procesado">
  <p><label>Nombre: </label> <?php echo $nombre; ?></p>
  <p><label>Email: </label> <?php echo $email; ?></p>
  <p><label>Tarjeta: </label> <?php echo $PAN; ?></p>

<div class="form">
  <form name="tpv" action="http://tpv.ceca.es:8000/cgi-bin/tpv" method="POST">
  <!-- CAMPOS OCULTOS PARA TPV -->
  <!-- Capturados -->
	<!-- <input type="hidden" id="nombre" value="<?php echo $nombre; ?>" />
	<input type="hidden" id="email" value="<?php echo $email; ?>" /> -->
    <input type="hidden" name="PAN" id="PAN" required value="<?php echo (int) $PAN; ?>">
    <input type="hidden" name="Caducidad" id="Caducidad" value="<?php echo (int) $caducidad; ?>">
    <input type="hidden" name="CVV2" id="CVV2" value="<?php echo (int) $CVV2; ?>">
    <input type="hidden" id="Importe" name="Importe" value="<?php echo (int) $importe; ?>">
   <!-- Pasados -->
	<input type="hidden" id="MerchantID" name="MerchantID" value="<?php echo $MERCHANT_ID; ?>">
	<input type="hidden" id="AcquirerBIN" name="AcquirerBIN" value="<?php echo (int) $ACQUIRER_BIN; ?>">
	<input type="hidden" id="TerminalID" name="TerminalID" value="<?php echo (int) $TERMINAL_ID; ?>">
	<!-- <input type="hidden" name="CLAVE_ENCRIPTATION" value="<?php echo (int) $CLAVE_ENCRIPTATION; ?>"> -->
	<input type="hidden" id="Num_operacion" name="Num_operacion" value="<?php echo (int) $operacion;?>">
	<input type="hidden" id="Cifrado" name="Cifrado" value="<?php sha1('pruebadecaja');?>">
	<input type="hidden" id="Firma" name="Firma" value="<?php echo $firma; ?>">
	<input type="hidden" id="TipoMoneda" name="TipoMoneda" value="<?php echo (int) $TIPO_MONEDA; ?>">
	<input type="hidden" id="Exponente" name="Exponente" value="<?php echo (int) $EXPONENTE; ?>">
	<input type="hidden" id="Idioma" name="Idioma" value="1">
	<input type="hidden" id="Pago_soportado" name="Pago_soportado" value="SSL">
	<input type="hidden" id="Pago_elegido" name="Pago_elegido" value="SSL">
	<input type="hidden" id="URL_OK" name="URL_OK" value="<?php echo $URL_OK; ?>">
	<input type="hidden" id="URL_NOK" name="URL_NOK" value="<?php echo $URL_NOK; ?>">

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
