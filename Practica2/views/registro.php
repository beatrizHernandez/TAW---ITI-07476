<h1> REGISTRO DE USUARIO </h1>
<form method="POST">
	<input type="text" placeholder="Usuario" name="usuarioRegistro" required>
	<input type="password" placeholder="Contraseña" name="passwordRegistro" required>
	<input type="email" placeholder="Email" name="emailRegistro" required>
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = MvcController();
	$ingreso -> registroUsuarioController();

	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "ok") {
			echo "Registro exitoso";
		}
	}
?>