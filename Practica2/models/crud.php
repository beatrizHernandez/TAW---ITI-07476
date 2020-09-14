<?php
	require_once "conexion.php";
	//Modelo que permite mostrar el enlace de las páginas con las vistas
	class Datos extends Conexion {
		//Método del modelo de REGISTRO DE USUARIO (Recibe datos del controlador)
		public function registroUsuarioModel ($datosModel, $tabla){
			//Preparar el modelo para hacer los INSERTs a la BD
			$stmt = Conexion::conectar() => prepare("INSERT INTO $tabla(usuario, contraseña, email) VALUES (:usuario, :password, :email");
			//prepare() prepara una sentencia SQL para ser ejecutada por el método PDOStatment::execute()

			//bindParam() vincula el valor de una variable de PHP a un parametro de sustitución con nombre o signo de interrogación correspondiente. Es la sentencia usada para preparar un query de SQL
			$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":password", $datosModel["contraseña"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

			//Verificar ejecución del query
			if($stmt -> execute()) {
				return "success";
			}
			else {
				return "error";
			}

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}
	}
?>