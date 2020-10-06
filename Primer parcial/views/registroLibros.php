<h1><center> REGISTRO DE LIBROS </center></h1>
<form method="POST">
	<!-- Campos de la vista que deben ser rellenados a la hora de registrar un libro -->
	<span class="dashicons dashicons-media-text"></span><input type="text" placeholder="ISBN" name="ISBNRegistro" required>
	<input type="text" placeholder="Nombre" name="nombreRegistro" required>
	<input type="text" placeholder="Autor" name="autorRegistro" required>
	<input type="text" placeholder="Editorial" name="editorialRegistro" required>
	<input type="text" placeholder="Edicion" name="edicionRegistro" required>
	<input type="text" placeholder="Año" name="anioRegistro" required>
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = new MvcController();
	$ingreso -> registroLibrosController(); //la variable ejecuta el método del controlador

	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "ok") { //si es igual a "ok"
			echo "¡Registro exitoso!"; //imprime un mensaje
		}
	}
?>