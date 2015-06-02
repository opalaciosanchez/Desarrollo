
<!DOCTYPE html>
<html>
<head>
  <title>Subida de ficheros</title>
</head>
<body>
  <h1>Subida a AWS</h1>
  <form action="procesado.php?subida=correcto" method="post" enctype="multipart/form-data">
    <input name="fichero" type="file" />
    <input name="subida" type="submit" value="Subir Fichero">
  </form>
</body>
</html>