<?php
	class MvcController {
		//Método para llamar al templete
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

////////////////////////////////////////////// FUNCIONES REFERENTES A LOS USUARIOS //////////////////////////////////////////////////////////

		//Método del controlador para registro de usuarios
		public function registroUsuarioController() {

			if(isset($_POST["usuarioRegistro"])) {

				//Almaceno en un array los valores de la vista de registro
				$datosController = array("usuario" => $_POST["usuarioRegistro"], 
										"password" => $_POST["passwordRegistro"], 
										"email" => $_POST["emailRegistro"]);

				//Enviamos los parametros al modelo para que procese el registro
				$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

				//Recibir la respuesta del modelo para saber que sucedió (success o error)
				if($respuesta == "success") {
					echo "¡REGISTRO EXITOSO!";
					//header("location:index.php?action=ok");
				}
				else {
					header("location:index.php");
				}
			}
		}

		//Método para INGREO DE USUARIOS
		public function ingresoUsuarioController() {
			if(isset($_POST["usuarioIngreso"])) {
				$datosController = array("usuario" => $_POST["usuarioIngreso"], "password" => $_POST["passwordIngreso"]);

				//Mandar valores del array al modelo
				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

				//Recibe respuesta del modelo
				if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["contrasena"] == $_POST["passwordIngreso"]) {

					session_start();
					$_SESSION["validar"] = true;

					header("location:index.php?action=usuarios");
				}
				else {
					header("location:index.php?action=fallo");
				}
			}
		}

		//Método VISTA USUARIOS
		public function vistaUsuariosController() {
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaUsuariosModel("usuarios");

			foreach ($respuesta as $row => $item) {

				echo '<tr>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["contrasena"].'</td>
					<td>'.$item["email"].'</td>

					<!-- COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=editar&id='.$item["id"].'"><button> EDITAR </button></a></td>

					<!-- COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button> ELIMINAR </button></a></td>
				</tr>';	
			}
		}

		//Método LISTAR USUARIOS PARA EDITAR
		public function editarUsuarioController() {
			//Solictar el id del usuario a editar
			$datosController = $_GET["id"];
			//Enviamos al modelo el id para hacer la consulta y obtener sus datos
			$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

			//Recibimmos respuesta del modelo e imprimimos un FORM para editar
			echo '<input type="hidden" value="'.$respuesta["id"].'"name="idEditar">
				<input type="text" value="'.$respuesta["usuario"].'"name="usuarioEditar" required>
				<input type="text" value="'.$respuesta["contrasena"].'"name="passwordEditar" required>
				<input type="text" value="'.$respuesta["email"].'"name="emailEditar" required>
				<input type="submit" value="Actualizar">';
		}

		//Método para ACTUALIZAR USUARIO (UPDATE)
		public function actualizarUsuarioController() {
			if(isset($_POST["usuarioEditar"])) {
				//Preparamos un array con los id del form del controlador anterior para ejecutar la actualización en un modelo
				$datosController = array("id" => $_POST["idEditar"], 
										"usuario" => $_POST["usuarioEditar"], 
										"password" => $_POST["passwordEditar"], 
										"email" => $_POST["emailEditar"]);

				//Enviar el array al modelo que generará el UPDATE
				$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

				//Recibimos respuesta del modelo para determinar si se llevó acabo el UPDATE de manera correcta
				if($respuesta == "success") {
					header("location:index.php?action=cambio");
				}
				else {
					echo "error";
				}
			}
		}

		//Borrado de usuario
		public function borrarUsuarioController() {
			if(isset($_GET["idBorrar"])) {
				$datosController = $_GET["idBorrar"];

				//Mandar ID al controlador para que ejecute el DELETE
				$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

				//Recibimos la respuesta del modelo de eliminación
				if($respuesta == "success") {
					header("location:index.php?action=usuarios");
				}
			}
		}

////////////////////////////////////////////// FUNCIONES REFERENTES A LOS LIBROS //////////////////////////////////////////////////////////

		public function registroLibrosController() {
			if(isset($_POST["ISBNRegistro"])) {

				//Almaceno en un array los valores de la vista de registro
				$datosController = array("ISBN" => $_POST["ISBNRegistro"], 
										"nombre" => $_POST["nombreRegistro"],
										"autor" => $_POST["autorRegistro"],
										"editorial" => $_POST["editorialRegistro"],
										"edicion" => $_POST["edicionRegistro"],
										"anio" => $_POST["anioRegistro"]);

				//Enviamos los parametros al modelo para que procese el registro
				$respuesta = Datos::registroLibrosModel($datosController, "libros");

				//Recibir la respuesta del modelo para saber que sucedió (success o error)
				if($respuesta == "success") {
					echo "¡REGISTRO EXITOSO!";
					//header("location:index.php?action=ok");
				}
				else {
					header("location:libros.php");
				}
			}
		}

		public function vistaLibrosController() {
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaLibrosModel("libros");

			foreach ($respuesta as $row => $item) {
				echo '<tr>
					<td>'.$item["ISBN"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["autor"].'</td>
					<td>'.$item["editorial"].'</td>
					<td>'.$item["edicion"].'</td>
					<td>'.$item["anio"].'</td>

					<!-- COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=editarLibro&id='.$item["id_libro"].'"><button> EDITAR </button></a></td>

					<!-- COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=libros&idBorrar='.$item["id_libro"].'"><button> ELIMINAR </button></a></td>
				</tr>';	
			}
		}

		public function editarLibroController() {
			//Solictar el id del usuario a editar
			$datosController = $_GET["id"];
			//Enviamos al modelo el id para hacer la consulta y obtener sus datos
			$respuesta = Datos::editarLibroModel($datosController, "libros");

			//Recibimmos respuesta del modelo e imprimimos un FORM para editar
			echo '<input type="hidden" value="'.$respuesta["id_libro"].'"name="idLibroEditar">
				<input type="text" value="'.$respuesta["ISBN"].'"name="ISBNEditar" required>
				<input type="text" value="'.$respuesta["nombre"].'"name="nombreEditar" required>
				<input type="text" value="'.$respuesta["autor"].'"name="autorEditar" required>
				<input type="text" value="'.$respuesta["editorial"].'"name="editorialEditar" required>
				<input type="text" value="'.$respuesta["edicion"].'"name="edicionEditar" required>
				<input type="text" value="'.$respuesta["anio"].'"name="anioEditar" required>
				<input type="submit" value="Actualizar">';
		}

		//Método para ACTUALIZAR USUARIO (UPDATE)
		public function actualizarLibroController() {
			if(isset($_POST["idLibroEditar"])) {
				//Preparamos un array con los id del form del controlador anterior para ejecutar la actualización en un modelo
				$datosController = array("id" => $_POST["idLibroEditar"],
										"ISBN" => $_POST["ISBNEditar"], 
										"nombre" => $_POST["nombreEditar"], 
										"autor" => $_POST["autorEditar"],
										"editorial" => $_POST["editorialEditar"],
										"edicion" => $_POST["edicionEditar"],
										"anio" => $_POST["anioEditar"]);

				//Enviar el array al modelo que generará el UPDATE
				$respuesta = Datos::actualizarLibroModel($datosController, "libros");

				//Recibimos respuesta del modelo para determinar si se llevó acabo el UPDATE de manera correcta
				if($respuesta == "success") {
					header("location:index.php?action=cambioLibro");
				}
				else {
					echo "error";
				}
			}
		}

		public function borrarLibroController() {
			if(isset($_GET["idBorrar"])) {
				$datosController = $_GET["idBorrar"];

				//Mandar ID al controlador para que ejecute el DELETE
				$respuesta = Datos::borrarLibroModel($datosController, "libros");

				//Recibimos la respuesta del modelo de eliminación
				if($respuesta == "success") {
					header("location:index.php?action=libros");
				}
			}
		}
	}
?>