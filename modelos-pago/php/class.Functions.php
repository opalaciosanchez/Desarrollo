<?php
class Functions {
	// creamos la variable privada que almacena el valor de la conexión y que evite que sea modificado
	private static $_conexionEstablecida;
	// creamos la conexión y almacenamos su valor para ser llamado cuando sea preciso
	private static function _establecerConexion() {
		$db = Database::getInstancia();
		$_conexionEstablecida = $db->getConexion();
		return $_conexionEstablecida;
	}
	// método que cierra la conexión cuando sea preciso
	public function cierra_conexion() {
		if (isset(self::$_conexionEstablecida)) {
			mysqli_close(self::$_conexionEstablecida);
			unset(self::$_conexionEstablecida);
		}
	}
	
	// la primera de los métodos de "uso" comprueba si la consulta realizada es correcta. 
	// la función usa un argumento que será pasado en el momento de su uso
	// la hacemos publica para que pueda ser usada, y al estar en el interior de la clase puede hacer uso del método privado anterior
	public static function confirma_consulta($result_query) {
		$mysqli = self::_establecerConexion();
		// para poder evaluar el fallo de conexión, capturamos como global la variable que la establece
		if (!$result_query) {
			// *** el método antiguo hace uso de mysql_error() sin necesidad de ningún argumento (no tendríamos que usar la variable global $conexion)
			// ejecutamos la función mysqli_error pasando como argumento $conexion
			die("la consulta ha fallado por: ".mysqli_error($mysqli));
		}
	}
	
	// metodo que ejecuta las consultas de seleccion genericas para evitar codigo repetido. Después podremos seleccionar los campos en la salida
	public static function consulta($tabla) {
		$mysqli = self::_establecerConexion();
		$query = "SELECT *
				FROM {$tabla}
				ORDER BY producto ASC";		
		$result_set = mysqli_query($mysqli, $query);
		self::confirma_consulta($result_set);
		return $result_set;
	}
	

	// llamada a todos los productos
	public static function listado($tabla) {
		// llamamos en cada caso al método que ejecuta la consulta de productos, pasando como argumento el tipo de éste
		$te_set = self::consulta($tabla);
		// almacenamos en la salida el resultado de ejecutar el método que muestra por pantalla los resultados
		// como parámetro usamos los resultados almacenados en la variable anterior de la llamada a la primera función
		$output = self::salida($te_set);
		return $output;
	}
	
	// metodo que utiliza los resultados de la consulta y los muestra por pantalla
	public static function salida($tipo) {
		$output = "";
		while ($producto = mysqli_fetch_array($tipo)) {
			echo $producto[1];
			//$output .= "
			//<option label='{$producto[1]}' value='{$producto[1]}'>{$producto[1]}</option>";
		}
		return $output;
	}
	
	/* ESTA SECCIÓN CONTROLA EL FILTRADO DE LOS PRODUCTOS SEGÚN EL FORMULARIO DE ESA MISMA PÁG */
	public static function filtrado_tipo($producto, $precio_menor, $precio_mayor) {
		$mysqli = self::_establecerConexion();
		// sino se ha insertado un valor de filtrado por precio...
		if ($precio_menor == 0 && $precio_mayor == 0) {
			// llamamos al método que ejecuta las consultas genéricas y devuleve resultados
			$result_set = self::consulta($producto);
			
				$output = self::salida($result_set);
				return $output;
		}
		// si se detecta un valor de filtrado de precio... 
		else {
			$query = "SELECT *";
			$query .= "FROM {$producto} WHERE precio BETWEEN {$precio_menor} AND {$precio_mayor}";
			$result_set = mysqli_query($mysqli, $query);
			if (mysqli_num_rows($result_set) > 0) {
				self::confirma_consulta($result_set);
				$output = self::salida($result_set);
				return $output;
			} else {
				$output = "No se han encontrado productos con esos criterios. Vuelva a <a href='productos.php'>ejecutar el filtro</a>";
				return $output;
			}
		}
	}
	
	/* CREACIÓN DE NUEVOS PRODUCTOS */
	// creamos primero un método protegido (para evitar creaciones de productos no permitidas) que genera los productos
	private static function insertarProducto($tabla, $columnas, $datos) {
	// capturamos los valores pasados como matriz para campo y valor	
		$campo1 = $columnas[0];
		$campo2 = $columnas[1];
		$campo3 = $columnas[2];
		$campo4 = $columnas[3];
		
		$valor1 = $datos[0];
		$valor2 = $datos[1];
		$valor3 = $datos[2];
		$valor4 = $datos[3];
		
 		$mysqli = self::_establecerConexion();
		$query = "INSERT INTO {$tabla} ({$campo1}, {$campo2}, {$campo3}, {$campo4})
				 VALUES ('{$valor1}', '{$valor2}', '{$valor3}', '{$valor4}')";
		$insertar = mysqli_query($mysqli, $query);
		return $insertar;
	}
	
	// evaluamos qué tipo de producto ha de insertarse en la base de datos
	public static function nuevo_producto($tipo, $nombre, $precio, $descripcion, $nombre_img) {
		$mysqli = self::_establecerConexion();
		
		// creamos las matrices que almacenarán los valores
		$campos = array('nombre', 'precio', 'descripcion', 'imagen');
		$valores = array($nombre, $precio, $descripcion, $nombre_img);

		switch ($tipo) {
			case 'Te':
				// insertamos en la tabla te
				$tabla = "tipos_te";
				self::insertarProducto($tabla, $campos, $valores);
				break;
			case 'Teteras':
				// insertamos en la tabla teteras
				$tabla = "teteras";
				self::insertarProducto($tabla, $campos, $valores);
				break;
			case 'Complementos':
				// insertamos en la tabla complementos
				$tabla = "complementos";
				self::insertarProducto($tabla, $campos, $valores);
				break;
			default:
				echo "<h1>Escoge un tipo de producto</h1>";
				break;
		}
	}
	
	
	/* COMPROBACIÓN DE USUARIOS */
	// creamos la función que recuperará el listado de usuario y contraseña
	public static function comprueba_usuario($usuario) {
		$mysqli = self::_establecerConexion();
		// sólo devolvemos el usuario cuando coincida el nombre
		$query = "SELECT usuario,password FROM usuarios WHERE usuario = '{$usuario}'";
		$result_set = mysqli_query($mysqli, $query);
		return $result_set;
	}
}
?>