<h1><center> INGRESAR </center></h1>
<form method="POST" style="text-align: center;">
	<input type="text" placeholder="Usuario" name="usuarioIngreso" required> <!-- required = obligatorio-->
	<input type="password" placeholder="Contraseña" name="passwordIngreso" required>
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = new MvcController();
	$ingreso -> ingresoUsuarioController(); //la variable ejecuta el método del controlador

	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "fallo") { //si la acción es igual a "fallo"
			echo "Fallo al ingresar"; //imprime mensaje
		}
	}
?>