<h1><center> REGISTRO DE USUARIO </center></h1>
<form method="POST" style="text-align: center;">
	<!-- Campos de la vista que deben ser rellenados a la hora de registrarse como usuario -->
	<input type="text" placeholder="Usuario" name="usuarioRegistro" required>
	<input type="password" placeholder="Contraseña" name="passwordRegistro" required>
	<input type="email" placeholder="Email" name="emailRegistro" required>
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = new MvcController();
	$ingreso -> registroUsuarioController(); //la variable ejecuta el método del controlador

	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "ok") { //si es igual a "ok"
			echo "¡Registro exitoso!"; //imprime un mensaje
		}
	}
?>