<?php
	session_start();
	if(!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
?>

<h1> EDITAR MATERIA </h1>
<form method="POST">
	<?php
		$editarMateria = new MvcController();
		$editarMateria -> editarMateriaController();
		$editarMateria -> actualizarMateriaController();
	?>
</form>