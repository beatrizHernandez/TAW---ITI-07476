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
		public function registroUsuarioController() {

			if(isset($_POST["usuarioRegistro"])) {

				//Almaceno en un array los valores de la vista de registro
				$datosController = array("usuario" => $_POST["usuarioRegistro"], 
										"password" => $_POST["passwordRegistro"], 
										"email" => $_POST["emailRegistro"],
										"idCarrera" => $_POST["idCarreraRegistro"],
										"idMateria" => $_POST["idMateriaRegistro"]);

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

				$carrera = Datos::VistaCarreraAlumnoModel($item["id_carrera"], "carreras");
				$materia = Datos::VistaMateriaAlumnoModel($item["id_mat"], "materias");

				echo '<tr>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["contrasena"].'</td>
					<td>'.$item["email"].'</td>
					<td>'.$carrera["nombre"].'</td>
					<td>'.$materia["nombre"].'</td>

					<!-- COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=editar&id='.$item["id"].'"><button> EDITAR </button></a></td>

					<!-- COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button> ELIMINAR </button></a></td>
				</tr>';	
			}
		}

		////////////////////////////////////////////////////////////////////////////////////////////
		public function vistaCarrerasController() {
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaCarrerasModel("carreras");

			foreach ($respuesta as $row => $item) {
				echo '<tr>
					<td>'.$item["nombre"].'</td>

					<!-- COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=editarCarrera&id='.$item["id_carrera"].'"><button> EDITAR </button></a></td>

					<!-- COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=carreras&idBorrar='.$item["id_carrera"].'"><button> ELIMINAR </button></a></td>
				</tr>';	
			}
		}

		public function vistaMateriasController() {
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaMateriasModel("materias");

			foreach ($respuesta as $row => $item) {
				echo '<tr>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["clave"].'</td>
					<td>'.$item["carrera"].'</td>

					<!-- COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=editarMateria&id='.$item["id_mat"].'"><button> EDITAR </button></a></td>

					<!-- COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=materias&idBorrar='.$item["id_mat"].'"><button> ELIMINAR </button></a></td>
				</tr>';	
			}
		}

		//////////////////////////////////////////////////////////////////////////////////////////

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
				<input type="text" value="'.$respuesta["id_carrera"].'"name="idCarreraEditar" required>
				<input type="text" value="'.$respuesta["id_mat"].'"name="idMateriaEditar" required>
				<input type="submit" value="Actualizar">';
		}

		//Método para ACTUALIZAR USUARIO (UPDATE)
		public function actualizarUsuarioController() {
			if(isset($_POST["usuarioEditar"])) {
				//Preparamos un array con los id del form del controlador anterior para ejecutar la actualización en un modelo
				$datosController = array("id" => $_POST["idEditar"], 
										"usuario" => $_POST["usuarioEditar"], 
										"password" => $_POST["passwordEditar"], 
										"email" => $_POST["emailEditar"],
										"idCarrera" => $_POST["idCarreraEditar"],
										"idMateria" => $_POST["idMateriaEditar"]);

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

		////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function registroMateriasController() {
			if(isset($_POST["nombreRegistro"])) {

				//Almaceno en un array los valores de la vista de registro
				$datosController = array("nombre" => $_POST["nombreRegistro"], 
										"clave" => $_POST["claveRegistro"],
										"carrera" => $_POST["idCarreraRegistro"]);

				//Enviamos los parametros al modelo para que procese el registro
				$respuesta = Datos::registroMateriasModel($datosController, "materias");

				//Recibir la respuesta del modelo para saber que sucedió (success o error)
				if($respuesta == "success") {
					echo "¡REGISTRO EXITOSO!";
					//header("location:index.php?action=ok");
				}
				else {
					header("location:materias.php");
				}
			}
		}

		public function editarMateriaController() {
			//Solictar el id del usuario a editar
			$datosController = $_GET["id"];
			//Enviamos al modelo el id para hacer la consulta y obtener sus datos
			$respuesta = Datos::editarMateriaModel($datosController, "materias");

			//Recibimmos respuesta del modelo e imprimimos un FORM para editar
			echo '<input type="hidden" value="'.$respuesta["id_mat"].'"name="idMateriaEditar">
				<input type="text" value="'.$respuesta["nombre"].'"name="nombreEditar" required>
				<input type="text" value="'.$respuesta["clave"].'"name="claveEditar" required>
				<input type="text" value="'.$respuesta["carrera"].'"name="CarreraEditar" required>
				<input type="submit" value="Actualizar">';
		}

		//Método para ACTUALIZAR USUARIO (UPDATE)
		public function actualizarMateriaController() {
			if(isset($_POST["idMateriaEditar"])) {
				//Preparamos un array con los id del form del controlador anterior para ejecutar la actualización en un modelo
				$datosController = array("id" => $_POST["idMateriaEditar"], 
										"nombre" => $_POST["nombreEditar"], 
										"clave" => $_POST["claveEditar"],
										"carrera" => $_POST["CarreraEditar"]);

				//Enviar el array al modelo que generará el UPDATE
				$respuesta = Datos::actualizarMateriaModel($datosController, "materias");

				//Recibimos respuesta del modelo para determinar si se llevó acabo el UPDATE de manera correcta
				if($respuesta == "success") {
					header("location:index.php?action=cambioMateria");
				}
				else {
					echo "error";
				}
			}
		}

		public function borrarMateriaController() {
			if(isset($_GET["idBorrar"])) {
				$datosController = $_GET["idBorrar"];

				//Mandar ID al controlador para que ejecute el DELETE
				$respuesta = Datos::borrarMateriaModel($datosController, "materias");

				//Recibimos la respuesta del modelo de eliminación
				if($respuesta == "success") {
					header("location:index.php?action=materias");
				}
			}
		}
	}
?>