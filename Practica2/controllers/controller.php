<?php
	class MvcController {
		//Método para llamar a la plantilla templete
		public function plantilla () {
			include "views/template.php";
		}
		//Método para mostrar los enlaces de las página
		public function enlacesPaginasController () {
			if(isset($_GET['action'])) {
				$enlaces = $_GET['action'];
			}
			else {
				$enlaces = "index";
			}
			$respuesta = Paginas::enlacesPaginasModel($enlaces);
			include $respuesta;
		}
		//Método del controlador para registro de usuarios
		public function resgistroUsuarioController() {
			//Almaceno en un array los valores de la vista de registro
			$datosController = array("usuario" => $_POST["usuarioResgitro"], "password" => $_POST["passwordResgistro"], "email" => $_POST["emailRegistro"]);

			//Enviamos los parametros al modelo para que procese el registro
			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

			//Recibir la respuesta del modelo para saber que sucedió (success o error)
			if($respuesta == "success") {
				header("location:index.php?action=ok");
			}
			else {
				header("location:index.php");
			}
		}

		//Método para INGREO DE USUARIOS
		public function ingresoUsuarioController() {
			if(isset($_POST["usuarioIngreso"])) {
				$datosController = array("usuario" => $_POST["usuarioIngreso"], "password" => $_POST["passwordIngreso"]);

				//Mandar valores del array al modelo
				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

				//Recibe respuesta del modelo
				if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]) {
					session_start();

					$_SESSION["validar"] = true;

					header("location:index.php?action=usuarios");
				}
				else {
					header("location:index.php?action=fallo");
				}
			}
		}
	}
?>