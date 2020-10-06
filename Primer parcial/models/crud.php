<?php
	require_once "conexion.php";
	//Modelo que permite mostrar el enlace de las páginas con las vistas
	class Datos extends Conexion {

////////////////////////////////////////////// FUNCIONES REFERENTES A LOS USUARIOS //////////////////////////////////////////////////////////

		//Método del modelo de REGISTRO DE USUARIO (Recibe datos del controlador)
		public function registroUsuarioModel ($datosModel, $tabla){
			//Preparar el modelo para hacer los INSERTs a la BD
			$stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(usuario, contrasena, email) VALUES (:usuario, :password, :email)");
			//prepare() prepara una sentencia SQL para ser ejecutada por el método PDOStatment::execute()

			//bindParam() vincula el valor de una variable de PHP a un parametro de sustitución con nombre o signo de interrogación correspondiente. Es la sentencia usada para preparar un query de SQL
			$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

			//Verificar ejecución del query
			if($stmt -> execute()) {
				return "success";
			}
			else {
				//Informa que se ha producido un error
				echo "\nPDO::errorInfo():\n";
    			print_r($stmt->errorInfo());
				return "error";
			}

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}

		//Método INGRESO USUARIO
		public function ingresoUsuarioModel($datosModel, $tabla) {
			//Preparamos el PDO
			$stmt = Conexion::conectar() -> prepare("SELECT usuario, contrasena FROM $tabla WHERE usuario = :usuario");
			//Recibimos el valor usuario desde el array almacenado del controlador
			$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
			//ejecutamos la consulta con PDO
			$stmt -> execute();
			//retornamos el fetch que es el que obtiene una fila o posición de un array
			return $stmt -> fetch();
			//Cerramos el PDO
			$stmt -> close();
		}

		//Método para VISTA USUARIO (TABLA)
		public function vistaUsuariosModel($tabla) {
			//SELECT a la base de datos
			$stmt = Conexion::conectar() -> prepare("SELECT id, usuario, contrasena, email FROM $tabla");
			$stmt -> execute();

			return $stmt -> fetchAll();

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}

		//Método para SELECCIONAR USUARIO
		public function editarUsuarioModel($datosModel, $tabla) {
			//SELECT a la base de datos
			$stmt = Conexion::conectar() -> prepare("SELECT id, usuario, contrasena, email FROM $tabla WHERE id = :id");
			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
			$stmt -> execute();

			return $stmt -> fetch();

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}

		//Método para actualizar usuarios (UPDATE)
		public function actualizarUsuarioModel($datosModel, $tabla) {
			//Preparar el query
			$stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET usuario = :usuario, contrasena = :password, email = :email WHERE id = :id");

			//Ejecutar el query en base a los campos de la tabla
			$stmt -> bindParam(":usuario",$datosModel["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

			//Preparar respuesta
			if($stmt -> execute()) {
				return "success";
			}
			else {
				var_dump($stmt); //Muestra el contenido y el tipo de variable ($stmt)
			}

			//Cerrar la conexión PDO
			$stmt -> close();
		}

		//Borrar usuario
		public function borrarUsuarioModel($datosModel, $tabla) {
			//Preparar el query para eliminar
			$stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

			//Ejecutar
			if($stmt -> execute()) {
				return "success";
			}
			else {
				return "error";
			}

			$stmt -> close();
		}

////////////////////////////////////////////// FUNCIONES REFERENTES A LOS LIBROS //////////////////////////////////////////////////////////

		//Método del modelo de REGISTRO DE LIBRO (Recibe datos del controlador)
		public function registroLibrosModel ($datosModel, $tabla){
			//Preparar el modelo para hacer los INSERTs a la BD
			$stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(ISBN, nombre, autor, editorial, edicion, anio) VALUES (:ISBN, :nombre, :autor, :editorial, :edicion, :anio)");
			//prepare() prepara una sentencia SQL para ser ejecutada por el método PDOStatment::execute()

			//bindParam() vincula el valor de una variable de PHP a un parametro de sustitución con nombre o signo de interrogación correspondiente. Es la sentencia usada para preparar un query de SQL
			$stmt -> bindParam(":ISBN", $datosModel["ISBN"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":autor", $datosModel["autor"], PDO::PARAM_STR);
			$stmt -> bindParam(":editorial", $datosModel["editorial"], PDO::PARAM_STR);
			$stmt -> bindParam(":edicion", $datosModel["edicion"], PDO::PARAM_STR);
			$stmt -> bindParam(":anio", $datosModel["anio"], PDO::PARAM_STR);

			//Verificar ejecución del query
			if($stmt -> execute()) {
				return "success";
			}
			else {
				//Informa que se ha producido un error
				echo "\nPDO::errorInfo():\n";
    			print_r($stmt->errorInfo());
				return "error";
			}

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}

		//Método para VISTA LIBROS (TABLA)
		public function vistaLibrosModel($tabla) {
			//SELECT a la base de datos
			$stmt = Conexion::conectar() -> prepare("SELECT id_libro, ISBN, nombre, autor, editorial, edicion, anio FROM $tabla");
			$stmt -> execute();

			return $stmt -> fetchAll(); //trae todos los datos de golpe y se almacenan en $stmt

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}

		//Método para SELECCIONAR LIBRO
		public function editarLibroModel($datosModel, $tabla) {
			//SELECT a la base de datos
			$stmt = Conexion::conectar() -> prepare("SELECT id_libro, ISBN, nombre, autor, editorial, edicion, anio FROM $tabla WHERE id_libro = :id");
			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
			$stmt -> execute();

			return $stmt -> fetch(); //recorre los datos uno por uno

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}

		//Método para actualizar libros (UPDATE)
		public function actualizarLibroModel($datosModel, $tabla) {
			//Preparar el query
			$stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET ISBN = :ISBN, nombre = :nombre, autor = :autor, editorial = :editorial, edicion = :edicion, anio = :anio WHERE id_libro = :id");

			//Ejecutar el query
			$stmt -> bindParam(":ISBN",$datosModel["ISBN"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre",$datosModel["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":autor", $datosModel["autor"], PDO::PARAM_STR);
			$stmt -> bindParam(":editorial", $datosModel["editorial"], PDO::PARAM_STR);
			$stmt -> bindParam(":edicion", $datosModel["edicion"], PDO::PARAM_STR);
			$stmt -> bindParam(":anio", $datosModel["anio"], PDO::PARAM_STR);
			$stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

			//Preparar respuesta
			if($stmt -> execute()) {
				return "success";
			}
			else {
				var_dump($stmt); //Muestra el contenido y el tipo de variable ($stmt)
			}

			//Cerrar la conexión PDO
			$stmt -> close();
		}

		//Método para borrar un libro
		public function borrarLibroModel($datosModel, $tabla) {
			//Preparar el query para eliminar
			$stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id_libro = :id");

			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

			//Ejecutar
			if($stmt -> execute()) {
				return "success";
			}
			else {
				return "error";
			}

			//Cerrar la conexión PDO
			$stmt -> close();
		}
	}
?>