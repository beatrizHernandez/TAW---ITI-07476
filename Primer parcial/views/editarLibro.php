<?php
	session_start(); //Iniciar sesión 
	if(!$_SESSION["validar"]) { //si la variable de sesión es diferente de "validar"
		header("location:index.php?action=ingresar"); //se redirige a "ingresar"
		exit();
	}
?>

<h1> EDITAR LIBRO </h1>
<form method="POST">
	<?php
		$editarLibro = new MvcController();
		$editarLibro -> editarLibroController(); //la variable ejecuta el método del controlador
		$editarLibro -> actualizarLibroController(); //la variable ejecuta el método del controlador
	?>
</form>