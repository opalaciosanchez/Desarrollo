<?php
require_once 'php/includes/header.php';
$operacion = rand(1000, 100000);
?>

<section id="contenido">

<h2 class="encabezadoprincipal">CARRITO</h2>

<article id="tpv"> <h3>Nº de operación: <?php echo $operacion;?></h3>

<div class="form"> <form name="tpv" action="procesado.php" method="POST">
<input type="hidden" name="operacion" id="operacion" value="<?php echo $operacion; ?>">
<p><label for="nombre">Nombre</label><input type="text" name="nombre" id="nombre" required placeholder="nombre completo"/></p>
<p><label for="email">Email</label><input type="email" name="email" id="email" required placeholder="inserta el email"/></p>
<p>
<p>
  <label for="PAN">Nº tarjeta</label>
  <input type="text" name="PAN" id="PAN" required placeholder="Inserte su número de tarjeta">
</p>
<p>
  <label for="Caducidad">caducidad</label>
  <input type="text" name="caducidad" id="caducidad" required placeholder="Formato AAAAMM" maxlength="6" style="width:20%;">
</p>
<p>
  <label for="CVV2">Digito control</label>
  <input type="text" name="CVV2" id="CVV2" required placeholder="Formato NNN" maxlength="3" style="width:20%;">
</p>
<label for="list">producto</label>
<?php Functions::listado('productos', 1);?>
</p>
<p>
  <label for="consulta">Indicaciones</label><textarea id="consulta" rows="6" cols="10" placeholder="tus comentarios, aquí"></textarea>
</p>

<p><input type="submit" id="comprar" name="comprar" value="COMPRAR"></p>

</form>
</div>
</article>

</section><!-- fin de section -->

<?php
require_once 'php/includes/footer.php';
?>
