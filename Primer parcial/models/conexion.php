<?php
	class Conexion {
		public function conectar () {
			$link = new PDO("mysql:host=localhost;dbname=primer_parcial","root","HERNANDEZ99");
			return $link;
		}
	}
?>