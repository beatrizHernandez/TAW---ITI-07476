<h1> REGISTRO DE LIBROS </h1>
<form method="POST">
	<input type="text" placeholder="ISBN" name="ISBNRegistro" required>
	<input type="text" placeholder="Nombre" name="nombreRegistro" required>
	<input type="text" placeholder="Autor" name="autorRegistro" required>
	<input type="text" placeholder="Editorial" name="editorialRegistro" required>
	<input type="text" placeholder="Edicion" name="edicionRegistro" required>
	<input type="text" placeholder="Año" name="anioRegistro" required>
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = new MvcController();
	$ingreso -> registroLibrosController();

	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "ok") {
			echo "¡Registro exitoso!";
		}
	}
?>