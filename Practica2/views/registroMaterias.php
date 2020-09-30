<h1> REGISTRO DE MATERIAS </h1>
<form method="POST">
	<input type="text" placeholder="Nombre" name="nombreRegistro" required>
	<input type="text" placeholder="Clave" name="claveRegistro" required>
	<input type="text" placeholder="Carrera" name="idCarreraRegistro" required>
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = new MvcController();
	$ingreso -> registroMateriasController();

	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "ok") {
			echo "¡Registro exitoso!";
		}
	}
?>