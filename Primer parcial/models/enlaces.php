<?php
	class Paginas {
		//Método encargado de redirigir dependiendo de la sentencia
		public function enlacesPaginasModel($enlaces) {
			if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "registroLibros" || $enlaces == "editar" || $enlaces == "editarLibro" || $enlaces == "salir" || $enlaces == "libros") {
				$module = "views/".$enlaces.".php";
			}
			//si $enlaces es igual "index", $module -> toma la dirección de "registro.php"
			else if($enlaces == "index") {
				$module = "views/registro.php";		
			}
			//si $enlaces es igual "ok", $module -> toma la dirección de "registro.php"
			else if($enlaces == "ok") {
				$module = "views/registro.php";
			}
			//si $enlaces es igual "fallo", $module -> toma la dirección de "ingresar.php"
			else if($enlaces == "fallo") {
				$module = "views/ingresar.php";
			}
			//si $enlaces es igual "cambio", $module -> toma la dirección de "usuarios.php"
			else if($enlaces == "cambio") {
				$module = "views/usuarios.php";
			}
			//si $enlaces es igual "cambioLibro", $module -> toma la dirección de "libros.php"
			else if($enlaces == "cambioLibro") {
				$module = "views/libros.php";
			}
			else {
				//sino, $module -> toma la dirección de "registro.php"
				$module = "views/registro.php";
			}
			return $module;
		}
	}
?>