<?php 
	require_once 'php/conexion/class.Database.php';
	require_once 'php/class.Functions.php';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Pasarela de pago segura</title>
<link href="CSS/principal.css" rel="stylesheet" type="text/css">
</head>

<body>
<header id="encabezado">
  <h1 class="nombre">OSCAR <span class="nombreDestacado">PALACIOS</span> SANCHEZ</h1>
  <div id="redes">
    <ul>
      <li><a href="http://facebook.com/bitbeta">facebook</a></li>
      <li><a href="http://es.linkedin.com/in/palaciossanchez">linkedin</a></li>
      <li><a class="derecha" href="http://twitter.com/opalaciosanchez">twitter</a></li>
    </ul>
  </div>
  <!-- fin div redes -->
  <div id="redesMovil"><a href="#socialMovil">Social Media</a></div>
</header>
<!--fin header-->
<nav id="socialMovil">
  <ul>
    <li class="socialMovil"><a href="http://facebook.com/bitbeta">FACEBOOK</a></li>
    <li class="socialMovil"><a href="http://es.linkedin.com/in/palaciossanchez">LINKEDIN</a></li>
    <li class="socialMovil"><a href="http://twitter.com/opalaciosanchez">TWITTER</a></li>
  </ul>
</nav>
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

<div id="banner"> <img src="imagenes/logo.jpg" alt=""> </div>

<section id="contenido">

<h2 class="encabezadoprincipal">CONTACTA</h2>

<!-- <nav id="navegacionPC">
  <ul>
    <li><a href="index.html">quien soy</a></li>
    <li><a href="#profesional.html">curriculum</a></li>
    <li><a href="#contacta.html">contacta</a></li>
    <li><a href="multimedia.html">multimedia</a></li>
  </ul>
</nav> -->
<!--fin de navegacionPC-->

<article id="tpv">
<h3>Todos los campos son obligatorios</h3>
<div class="form">
<form name="tpv" action="mailto:profesor.zgz@gmail.com" method="POST">
    <p><label for="nombre">Nombre</label><input type="text" id="nombre" required placeholder="nombre completo"/></p>
    <p><label for="email">Email</label><input type="email" id="email" required placeholder="inserta el email"/></p>
    <p>
        <label for="list">Escoge el producto</label><input list="tipo" id="list" required/>
        <?php Functions::listado('productos'); ?>
<!-- 
        <datalist id="tipo">  	
            <option label="Diseño" value="Diseño">Diseño</option>
            <option label="Hardware" value="Hardware">Hardware</option>
            <option label="Redes" value="Redes">Redes</option> 
-->
        </datalist>    
    </p>
    <p><label for="consulta">Cuéntame</label><textarea id="consulta" rows="6" cols="10" required placeholder="tus dudas, aquí"></textarea></p>
    <p><input type="submit" id="envio" value="Enviar"></p>
</form>
</div>
</article>

</section><!-- fin de section -->

<footer id="pie">
  <p>Oscar Palacios Sanchez - 2014 -  Todos los derechos reservados</p>
  <p><a href="http://facebook.com/bitbeta">Encuéntrame en Facebook</a></p>
  <p><a href="http://twitter.com/opalaciosanchez">Sígueme en Twitter</a></p>
</footer>

<!--fin de pie-->

</body>
</html>
