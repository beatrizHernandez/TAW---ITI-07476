<?php
	session_start();
	if(!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
?>

<h1> EDITAR CARRERA </h1>
<form method="POST">
	<?php
		$editarCarrera = new MvcController();
		$editarCarrera -> editarCarreraController();
		$editarCarrera -> actualizarCarreraController();
	?>
</form>