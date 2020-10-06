<?php
	class Conexion {
		//Método para la conexión con la base de datos (nombre, usuario, contraseña)
		public function conectar () {
			$link = new PDO("mysql:host=localhost;dbname=primer_parcial","root","");
			return $link;
		}
	}
?>