<?php

	class MvcController {

		//Método del controlador para el registro (creación) de libros
		public function registroLibroController() {

			if(isset($_POST["libroRegistro"])) {

				//Almaceno en un array los valores de la vista de registro
				$datosController = array("ISBN" => $_POST["libroRegistro"], 
										"nombre" => $_POST["nombreLibroRegistro"], 
										"autor" => $_POST["autorLibroRegistro"],
										"editorial" => $_POST["editorialLibroRegistro"],
										"edicion" => $_POST["edicionLibroRegistro"],
										"anio" => $_POST["anioLibroRegistro"]);

				//NOTA: id incrementable y ISBN funge como un campo más//

				//Enviamos los parametros al modelo para que procese el registro
				$respuesta = Datos::registroLibroModel($datosController, "libros");

				//Recibir la respuesta del modelo para saber que sucedió (success o error)
				if($respuesta == "success") {
					echo "¡REGISTRO EXITOSO!";
				}
				else {
					header("location:index.php");
				}
			}
		}

		//Método del controlador para el listado de libros
		public function vistaLibroController() {
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaLibroModel("libros");

			foreach ($respuesta as $row => $item) {

				echo '<tr>
					<td>'.$item["ISBN"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["autor"].'</td>
					<td>'.$item["editorial"].'</td>
					<td>'.$item["edicion"].'</td>
					<td>'.$item["anio"].'</td>

					<!-- COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=editar&id='.$item["id"].'"><button> EDITAR </button></a></td>

					<!-- COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=libros&idBorrar='.$item["id"].'"><button> ELIMINAR </button></a></td>
				</tr>';	
			}
		}

		//Método del controlador para la edición de la información de los libros
		public function editarLibroController() {
			//Solictar el id del libro cuya información se quiere editar
			$datosController = $_GET["id"];
			//Enviamos al modelo el id para hacer la consulta y obtener sus datos
			$respuesta = Datos::editarLibroModel($datosController, "libros");

			//Recibimmos respuesta del modelo e imprimimos un FORM para editar
			echo '<input type="hidden" value="'.$respuesta["id"].'"name="idEditar">
				<input type="text" value="'.$respuesta["ISBN"].'"name="libroEditar" required>
				<input type="text" value="'.$respuesta["nombre"].'"name="nombreEditar" required>
				<input type="text" value="'.$respuesta["autor"].'"name="autorEditar" required>
				<input type="text" value="'.$respuesta["editorial"].'"name="editorialEditar" required>
				<input type="text" value="'.$respuesta["edicion"].'"name="edicionEditar" required>
				<input type="text" value="'.$respuesta["anio"].'"name="anioEditar" required>
				<input type="submit" value="Actualizar">';
		}

		//Método del controlador para la actualización de la información de los libros
		public function actualizarLibroController() {
			if(isset($_POST["libroEditar"])) {
				//Preparamos un array con los id del form del controlador anterior para ejecutar la actualización en un modelo
				$datosController = array("id" => $_POST["idEditar"], 
										"ISBN" => $_POST["libroEditar"], 
										"nombre" => $_POST["nombreEditar"], 
										"autor" => $_POST["autorEditar"],
										"editorial" => $_POST["editorialEditar"],
										"edicion" => $_POST["edicionEditar"],
										"anio" => $_POST["anioEditar"]);

				//Enviar el array al modelo que generará el UPDATE
				$respuesta = Datos::actualizarLibroModel($datosController, "libros");

				//Recibimos respuesta del modelo para determinar si se llevó acabo el UPDATE de manera correcta
				if($respuesta == "success") {
					header("location:index.php?action=cambio");
				}
				else {
					echo "error";
				}
			}
		}

		//Método del controlador para la eliminación de determinado libro (toda la información)
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