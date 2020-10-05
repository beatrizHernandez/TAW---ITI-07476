<?php
	class Paginas {
		public function enlacesPaginasModel($enlaces) {
			if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "registroMaterias" || $enlaces == "editar" || $enlaces == "editarMateria" || $enlaces == "salir" || $enlaces == "materias") {
				$module = "views/".$enlaces.".php";
			}
			else if($enlaces == "index") {
				$module = "views/registro.php";		
			}
			else if($enlaces == "ok") {
				$module = "views/registro.php";
			}
			else if($enlaces == "fallo") {
				$module = "views/ingresar.php";
			}
			else if($enlaces == "cambio") {
				$module = "views/usuarios.php";
			}
			else if($enlaces == "cambioMateria") {
				$module = "views/materias.php";
			}
			else {
				$module = "views/registro.php";
			}
			return $module;
		}
	}
?>