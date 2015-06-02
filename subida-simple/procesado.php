<?php
//incluimos la clase S3 desde la ruta correcta            
if (!class_exists('S3'))require_once('s3/S3.php');
 
//Para poder acceder, necesitamos hacer uso de las credenciales de acceso (cifrado)
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIJYRIUVQN3BYCR6Q');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
 
//instanciamos la clase
$s3 = new S3(awsAccessKey, awsSecretKey);
 
//comprobamos si, efectivamente se ha realizado el envío, comprobando la variable 'subida'
if(isset($_POST['subida'])){
 
    //recuperamos los valores del fichero, tanto el nombre como la carpeta temporal donde se alojará
    $nombre = $_FILES['fichero']['name'];
    $nombreTemp = $_FILES['fichero']['tmp_name'];

    //especificamos las características permitidas de la subida: sólo imágenes y tamaño de 2MB
    $tipo_permitido = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    $size_maximo    = 2000000;

    // nos aseguramos de que no haya caracteres extraños y evitar un SQL Injection
    // usamos las funciones preg_replace y preg_match
    $patron         = "/[^A-Z0-9ñáéíóú,._]/i";
    // $nombre_fichero = preg_replace("/[^A-Z0-9._-]/i", "_", $imagen["name"]);
    // comprobamos que en el texto no haya caracteres no permitidos
    if (preg_match($patron, $nombre)) {
        echo "<h3>Elimina los caracteres no permitidos en el texto: solo numeros, letras y puntuacion</h3>";
        exit;
    } elseif ($_FILES['fichero']["size"] > $size_maximo) {// comprobamos si el fichero supera el tamaño máximo esteblecido en la variable definida arriba
        echo "<h3>Has superado el tamaño maximo del fichero:".$_FILES['fichero']['size']." </h3>";
        exit;
        // la función exif_imagetype da información exif sobre el fichero, depender de la extensión no es seguro:
    } elseif (!in_array(exif_imagetype($nombreTemp), $tipo_permitido)) {
        echo "<h3>Sólo se permite la subida de imagenes</h3>";
        exit;
    }
     
    //SI NO SE PRODUCE ERRORES DE COMPROBACIÓN, creamos el bucket
    $s3->putBucket("adjuntos", S3::ACL_PUBLIC_READ);
     
    //movemos el fichero a S3
    if ($s3->putObjectFile($nombreTemp, "adjuntos", $nombre, S3::ACL_PUBLIC_READ)) {
        echo "<h2>SUBIDA REALIZADA CON EXITO</h2>";
    }else{
        echo "<h2>NO SE HA PODIDO REALIZAR LA SUBIDA </h2>";
    }
}
?>