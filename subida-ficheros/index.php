<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Oscar Palacios - Quién soy</title>
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

<div id="banner"> <img src="imagenes/logo.jpg" alt="Oscar Palacios"> </div>

<section id="contenido">

<h2 class="encabezadoprincipal">CONTACTA</h2>

<article id="contacta">
<h3>Envío de adjuntos</h3>
<div class="form">
<form name="contacto" action="procesado.php?subida=completado" method="POST" enctype="multipart/form-data">
    <p><label for="nombre">Nombre</label><input type="text" id="nombre" required placeholder="nombre completo"/></p>
    <p><label for="email">Email</label><input type="email" id="email" required placeholder="inserta el email"/></p>
    <p><label for="adjunto">Adjuntos</label><input type="file" name="adjuntos" id="adjuntos" /></p>
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
