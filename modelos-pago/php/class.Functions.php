<?php
class Functions {
	// creamos la variable privada que almacena el valor de la conexión y que evite que sea modificado
	private static $_conexionEstablecida;
	// creamos la conexión y almacenamos su valor para ser llamado cuando sea preciso
	private static function _establecerConexion() {
		$db                   = Database::getInstancia();
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
		$query  = "SELECT *
				FROM {$tabla}
				ORDER BY nombre ASC";
		$result_set = mysqli_query($mysqli, $query);
		self::confirma_consulta($result_set);
		return $result_set;
	}

	// llamada a todos los productos
	public static function listado($tabla, $columna) {
		// llamamos en cada caso al método que ejecuta la consulta de productos, pasando como argumento el tipo de éste
		$te_set = self::consulta($tabla);
		// lanzamos una estructura de control que compruebe que columna quiere devolverse, para lanzar una funcion diferente
		switch ($columna) {
			case 0:
				$id = self::idHidden($salida['hidden']);
				echo $id;
			case 1:
				$salida = self::salida($te_set);
				echo $salida['output'];
				break;
			case 2:
				$precio = self::informacion($te_set,$columna);
				echo $precio;
				break;
			case 4:
				$img = self::informacion($te_set,$columna);
				break;
			default:
				echo "NO corresponde la columna";
				break;
		}

	}

	// metodo que utiliza los resultados de la consulta y los muestra por pantalla
	public static function salida($tipo) {
		$hidden = "";
		$output = "<select id='tipo' name='tipo'>";
		while ($producto = mysqli_fetch_array($tipo)) {
			$output .= '<option label="'.$producto[1].'" value="'.$producto[1].'">'.$producto[1].'</option>';
			$hidden .= $producto[0];
		}
		$output .= "</select>";

		return $salida = array('output' => $output, 'hidden' => $hidden);
	}

	public static function informacion($columna,$tipo) {
		// primero obtenemos el listado de resultados
		$mysqli = self::_establecerConexion();
		$query  = "SELECT *
				FROM productos
				WHERE nombre = '{$tipo}'";
		$resultado = mysqli_query($mysqli, $query);
		self::confirma_consulta($resultado);
		while ($producto = mysqli_fetch_array($resultado)) {
			$informacion = $producto[$columna];
		}
		return $informacion;
	}

	// método que muestra la id del producto seleccionado
	public static function idHidden($id) {
		$mysqli     = self::_establecerConexion();
		$query      = "SELECT precio FROM productos WHERE idProducto = 100";
		$result_set = mysqli_query($mysqli, $query);
		self::confirma_consulta($result_set);
		$idHidden = "";
		while ($id = mysqli_fetch_array($result_set)) {
			$idHidden = $id[0];
		}
		return $idHidden;
	}

}
?>