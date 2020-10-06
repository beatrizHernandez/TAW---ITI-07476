<?php
	session_start(); //Iniciar sesión
	if(!$_SESSION["validar"]) { //si la variable de sesión es diferente de "validar"
		header("location:index.php?action=ingresar"); //se redirige a "ingresar"
		exit();
	}
?>

<h1> EDITAR USUARIO </h1>
<form method="POST">
	<?php
		$editarUsuario = new MvcController();
		$editarUsuario -> editarUsuarioController(); //la variable ejecuta el método del controlador
		$editarUsuario -> actualizarUsuarioController(); //la variable ejecuta el método del controlador
	?>
</form>