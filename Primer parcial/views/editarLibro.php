<?php
	session_start();
	if(!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
?>

<h1> EDITAR LIBRO </h1>
<form method="POST">
	<?php
		$editarLibro = new MvcController();
		$editarLibro -> editarLibroController();
		$editarLibro -> actualizarLibroController();
	?>
</form>