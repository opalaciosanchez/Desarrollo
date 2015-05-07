<?php
require_once 'php/includes/header.php';
$operacion = rand(1000, 100000);
?>
<!--fin socialMovil-->

<!-- <nav id="navegacion">
  <ul>
    <li><a href="index.html">quien soy</a></li>
    <li><a href="profesional.html">curriculum</a></li>
    <li><a href="contacta.html">contacta</a></li>
    <li><a href="multimedia.html">multimedia</a></li>
  </ul>
</nav> -->
<!--fin de navegacion ppal-->

<!-- <div id="banner"> <img src="imagenes/logo.jpg" alt=""> </div> -->

<section id="contenido">

<h2 class="encabezadoprincipal">CARRITO</h2>

<!-- <nav id="navegacionPC">
  <ul>
    <li><a href="index.html">quien soy</a></li>
    <li><a href="#profesional.html">curriculum</a></li>
    <li><a href="#contacta.html">contacta</a></li>
    <li><a href="multimedia.html">multimedia</a></li>
  </ul>
</nav> -->
<!--fin de navegacionPC-->

<article id="tpv"> <h3>Nº de operación: <?php echo $operacion;?></h3>

<div class="form"> <form name="tpv" action="procesado.php" method="POST">
<input type="hidden" name="operacion" id="operacion" value="<?php echo $operacion; ?>">
<p><label for="nombre">Nombre</label><input type="text" name="nombre" id="nombre" required placeholder="nombre completo"/></p>
<p><label for="email">Email</label><input type="email" name="email" id="email" required placeholder="inserta el email"/></p>
<p>
<p>
  <label for="PAN">Nº tarjeta</label>
  <input type="number" name="PAN" id="PAN" required placeholder="Inserte su número de tarjeta">
</p>
<p>
  <label for="Caducidad">caducidad</label>
  <input type="number" name="caducidad" id="caducidad" required placeholder="Formato AAAAMM" maxlength="6" style="width:20%;">
</p>
<p>
  <label for="CVV2">Digito control</label>
  <input type="number" name="CVV2" id="CVV2" required placeholder="Formato NNN" maxlength="3" style="width:20%;">
</p>
<label for="list">producto</label>
<?php Functions::listado('productos', 1);?>
</p>
<p>
  <label for="consulta">Indicaciones</label><textarea id="consulta" rows="6" cols="10" placeholder="tus comentarios, aquí"></textarea>
</p>
<p>
  <label for="precio">Precio</label><input style="width:20%;" type="number" id="precio" name="precio" value="<?php Functions::listado('productos', 0)?>">
</p>
<p>
  <label for="unidades">Unidades</label><input style="width:20%;" type="number" id="unidades" name="unidades">
</p>

<p>
  <label for="importe">Importe Total</label><input style="width:20%;" type="number" id="importe" name="importe">
</p>

<p><input type="submit" id="comprar" name="comprar" value="COMPRAR"></p>

</form>
</div>
</article>

</section><!-- fin de section -->

<?php
require_once 'php/includes/footer.php';
?>
