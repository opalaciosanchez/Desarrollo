<?php
// insertamos las constantes de conexion
require_once 'config_variables.php';
/* clase que contiene la conexión a la base de datos MySQLi */
class Database {
	// una variable privada (no modificable externamente) controla la conexión
	private $_conexion;
	// creamos una variable estática que almacene la información de la conexión. Así nos aseguramos de que su valor sea fijo
	// controla la creación de instancias que permitan la conexión con la DB
	private static $_instancia;
	// private $_seleccionDB;
	// como se trata de de una variable privada, debemos asegurarnos de que podemos acceder
	// para ello usamos un "getter"
	public static function getInstancia() {
		// comprobamos si hay una instancia ya creada o no
		// si no es así, la generamos automáticamente. Usamos self:: porque es una propiedad estática
		if (!self::$_instancia) {
			// fijemonos en que estamos almacenando UNA NUEVA INSTANCIA DE LA CLASE (new self) DENTRO de la variable instancia
			// estamos añadiendo un paso intermedio al instanciamiento directo de la clase en el código posterior
			self::$_instancia = new self();
			// sería lo mismo que poner new Database();
		}
		// si existe la instancia (tiene valor) la devolvemos para poder usarla en la conexión
		return self::$_instancia;
	}
	// vamos a hacer uso dela variante orientada a objetos de mysqli
	// al tratarse de una objeto lo instanciaremos y almacenaremos la conexión en la primera variable $_conexion
	// queremos que la conexión se establezca en el uso de clase, así que insertamos un constructor
	public function __construct() {
		// instanciamos la clase mysqli en nuestra propia conexion, insertando los valores de la misma
		$this->_conexion = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		// comprobamos que la conexión se ha establecido
		if (mysqli_connect_error()) {
			echo "Ha habido un error al conectar con la DB MySQL: ".mysqli_connect_error();
		}
		// seleccionamos la base de datos a usar
		// 	$this->_seleccionDB = mysqli_select_db($_conexion, DB_NAME);
		// 	if (!$_seleccionDB) {
		// 		die("la base de datos seleccionada no esta disponible");
		// }

		// nos aseguramos de que la conexión entre la DB y la página acepte ñ y tildes
		mysqli_set_charset($this->_conexion, "utf8");
	}
	// vamos a evitar que la db sea clonada (con el magic method clone), llamándolo vacío
	private function __clone() {}
	// hemos creado la conexion, pero sigue siendo privada (hemos definido la variable como private)
	// creamos un segundo getter para que se devuelva la conexión (su valor)
	public function getConexion() {
		return $this->_conexion;
	}

}
?>