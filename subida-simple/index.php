
<?php require 'includes/header.php'; ?>

<section id="contenido">

<h2 class="encabezadoprincipal">SUBIDA DE FICHEROS</h2>

<article id="tpv">

  <div class="form">
  <h3>Selecciona un fichero y pulsa en Subir fichero para alojarlo en S3</h3>
  <form action="procesado.php?subida=correcto" method="post" enctype="multipart/form-data">
    <p><input name="fichero" type="file" /></p>
    <p><input name="subida" type="submit" value="Subir Fichero"></p>
  </form>
  </div>
  <div class="lateral">
  	<p><b>Recuerda que sólo se permite la subida de imágenes con un tamaño máximo de 2MB.</b>
  	Tampoco incluyas caracteres no permitidos en el nombre del fichero. Sólo caracteres alfanuméricos y guiones</p>
  </div>
</article>

</section>

<?php require 'includes/footer.php'; ?>