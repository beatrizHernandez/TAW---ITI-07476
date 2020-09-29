<?php
	session_start();
	if(!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
?>

<h1> MATERIAS </h1>
<table border="1">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Clave</th>
			<th>Carrera</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$vistaAlumno = new MvcController();
			$vistaAlumno -> vistaMateriasController();
			//$vistaAlumno -> borrarUsuarioController();
		?>
	</tbody>
</table>

<?php
	if(isset($_GET["action"])) {
		if($_GET["action"] == "cambio") {
			echo "Cambio exitoso";
		}
	}
?>