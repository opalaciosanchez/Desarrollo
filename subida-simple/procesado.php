<?php
//incluimos la clase S3 desde la ruta correcta            
if (!class_exists('S3'))require_once('s3/S3.php');
 
//Para poder acceder, necesitamos hacer uso de las credenciales de acceso (cifrado)
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIJYRIUVQN3BYCR6Q');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
 
//instanciamos la clase
$s3 = new S3(awsAccessKey, awsSecretKey);

require('includes/header.php');

echo "<article id='respuesta'><div class='form'>";

//comprobamos si, efectivamente se ha realizado el envío, comprobando la variable 'subida'
if(isset($_POST['subida'])){
 
    //recuperamos los valores del fichero, tanto el nombre como la carpeta temporal donde se alojará
    $nombre = $_FILES['fichero']['name'];
    $nombreTemp = $_FILES['fichero']['tmp_name'];

    //especificamos las características permitidas de la subida: sólo imágenes y tamaño de 2MB
    $tipo_permitido = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    $size_maximo = 2000000;

    // nos aseguramos de que no haya caracteres extraños y evitar un SQL Injection
    // usamos las funciones preg_replace y preg_match
    $patron = "/[^(a-zA-Z0-9)]+([a-zA-Z0-9\._-])/i";
    // $nombre_fichero = preg_replace("/[^A-Z0-9._-]/i", "_", $imagen["name"]);
    // comprobamos que en el texto no haya caracteres no permitidos
    if (!preg_match($patron, $nombre)) {
        echo "<h2>Elimina los caracteres no permitidos en el texto: solo numeros, letras y puntuacion</h2>";
        echo "<h2>" . $nombre . "</h2>";
        echo "<h3><a href='index.php'>Volver a subida de ficheros</a></h3>";
        echo '</div></article></section>';
        require('includes/footer.php');
        exit;
    } elseif ($_FILES['fichero']["size"] > $size_maximo) {// comprobamos si el fichero supera el tamaño máximo esteblecido en la variable definida arriba
        echo "<h2>Has superado el tamaño maximo del fichero (2MB) </h2>";
        echo "<h3><a href='index.php'>Volver a subida de ficheros</a></h3>";
        echo '</div></article></section>';
        require('includes/footer.php');
        exit;
        // la función exif_imagetype da información exif sobre el fichero, depender de la extensión no es seguro:
    } elseif (!in_array(exif_imagetype($nombreTemp), $tipo_permitido)) {
        echo "<h2>Sólo se permite la subida de imagenes</h2>";
        echo "<h3><a href='index.php'>Volver a subida de ficheros</a></h3>";
        echo '</div></article></section>';
        require('includes/footer.php');
        exit;
    }
     
    //SI NO SE PRODUCE ERRORES DE COMPROBACIÓN, creamos el bucket
    $nombreBucket = "adjuntos";

    $s3->putBucket($nombreBucket, S3::ACL_PUBLIC_READ);
     
    //movemos el fichero a S3
    if ($s3->putObjectFile($nombreTemp, $nombreBucket, $nombre, S3::ACL_PUBLIC_READ)) {
       echo "<h2>SUBIDA REALIZADA CON EXITO</h2>";
       echo "<h3><a href='index.php'>Volver a subida de ficheros</a></h3>";
    } else {
       echo "<h2>NO SE HA PODIDO REALIZAR LA SUBIDA </h2>";
       echo "<h3><a href='index.php'>Volver a subida de ficheros</a></h3>";
    }
} else {
    echo "<h2>No se permite acceder desde URL. Por favor, visita el formulario</h2>";
    echo "<h3><a href='index.php'>Subida de ficheros</a></h3>";
}

// obtenemos el listado de ficheros del Bucket
// para ello usamos el mçetodo getBucket, que devuelve un listado de ficheros almacenados del bucket que le pasemos
$contenidosBucket = $s3->getBucket($nombreBucket);
 
if (count($contenidosBucket) > 0) {
    echo '<br/><h3 class="listado"><b>Listado de contenidos del bucket:</h3><br/>';
} else {
    echo '<br/><h3 class="listado"><b>No hay archivos almacenados</h3><br/>';
}

foreach ($contenidosBucket as $fichero){
// creamos un bucle que recorra todos los resultados almacenados por la variable resultado del método
    // obtenemos el nombre del fichero concreto. ATENCION porque debemos usar la iteración del bucle en que nos encontramos
    // por eso usamos $fichero['name'], ya que $fichero es la variable de iteración
    $fnombre = $fichero['name'];
    // obtenemos tanto su nombre como su enlace, mediante la variable anterior y el nombre del bucket
    $furl = "http://".$nombreBucket.".s3.amazonaws.com/".$fnombre;
     
    //mostramos por pantalla los resultados
    echo "<a href=\"$furl\">$fnombre</a><br />";
}

echo '</div></article></section>';

require('includes/footer.php');
?>