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
	$Cifrado   = "SHA1";
	$tipo  = $_POST['tipo'];
	$importe = intval(Functions::informacion(2, $tipo)*100);

  // valores aportados por el pdf y las URL para el cálculo de la firma
  $MERCHANT_ID = "082108630";
  $CLAVE_ENCRIPTACION = "87401456";
  $ACQUIRER_BIN = "0000554002";
  $TERMINAL_ID = "00000003";
  $TIPO_MONEDA = "978";
  $EXPONENTE = "2";
  $URL_OK = "http://localhost/modelos-pago/ok.php";
  $URL_NOK = "http://localhost/modelos-pago/error.php";

  // calculo de la firma
  $firma = sha1($CLAVE_ENCRIPTACION . $MERCHANT_ID . $ACQUIRER_BIN . $TERMINAL_ID . $operacion . $importe .
  		   $TIPO_MONEDA . $EXPONENTE . $Cifrado . $URL_OK . $URL_NOK);
?>

<section id="contenido">

<h2 class="encabezadoprincipal">REVISE LA INFORMACION</h2>

<article id="tpv"> <h3>Nº de operación: <?php echo $operacion;?></h3>
  <div class="procesado">
  <p><label>Nombre: </label> <?php echo $nombre; ?></p>
  <p><label>Email: </label> <?php echo $email; ?></p>
  <p><label>Tarjeta: </label> <?php echo $PAN; ?></p>
  <p><label>Producto: </label> <?php echo Functions::informacion(1, $tipo); ?></p>
  <p><label>Importe: </label> <?php echo $importe/100; ?> €</p>
  <p><img class="imagen" src="imagenes/<?php echo Functions::informacion(3, $tipo); ?>"></p>

<div class="form">
  <form name="tpv" action="http://tpv.ceca.es:8000/cgi-bin/tpv" method="POST" enctype="application/x-www-form-urlencoded">
  <!-- CAMPOS OCULTOS PARA TPV -->
  <!-- Capturados -->
	<input type="hidden" name="PAN" value="<?php echo $PAN; ?>">
    <input type="hidden" name="Caducidad" value="<?php echo $caducidad; ?>">
    <input type="hidden" name="CVV2" value="<?php echo $CVV2; ?>">
    <input type="hidden" name="Importe" value="<?php echo $importe; ?>">
   <!-- Pasados -->
	<input type="hidden" name="MerchantID" value="082108630">
	<input type="hidden" name="AcquirerBIN" value="<?php echo $ACQUIRER_BIN; ?>">
	<input type="hidden" name="TerminalID" value="<?php echo $TERMINAL_ID; ?>">
	<input type="hidden" name="Num_operacion" value="<?php echo $operacion;?>">
	<input type="hidden" name="Cifrado" value="SHA1">
	<input type="hidden" name="Firma" value="<?php echo $firma; ?>">
	<input type="hidden" name="TipoMoneda" value="<?php echo $TIPO_MONEDA; ?>">
	<input type="hidden" name="Exponente" value="<?php echo $EXPONENTE; ?>">
	<input type="hidden" name="Idioma" value="1">
	<input type="hidden" id="Pago_soportado" name="Pago_soportado" value="SSL">
	<input type="hidden" name="URL_OK" value="<?php echo $URL_OK; ?>">
	<input type="hidden" name="URL_NOK" value="<?php echo $URL_NOK; ?>">

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
