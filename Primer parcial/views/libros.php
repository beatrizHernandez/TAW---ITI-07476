<?php
	session_start();
	if(!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
?>

<h1> LIBROS </h1>
<table border="1">
	<thead>
		<tr>
			<th>ISBN</th>
			<th>Nombre</th>
			<th>Autor</th>
			<th>Editorial</th>
			<th>Edición</th>
			<th>Año</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$vistaLibro = new MvcController();
			$vistaLibro -> vistaLibrosController();
			$vistaLibro -> borrarLibroController();
		?>
	</tbody>
</table>

<?php
	if(isset($_GET["action"])) {
		if($_GET["action"] == "cambioLibros") {
			echo "Cambio exitoso";
		}
	}
?>