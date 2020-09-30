<h1> REGISTRO DE CARRERA </h1>
<form method="POST">
	<input type="text" placeholder="Nombre" name="carreraRegistro" required>
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = new MvcController();
	$ingreso -> registroCarreraController();

	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "ok") {
			echo "¡Registro exitoso!";
		}
	}
?>