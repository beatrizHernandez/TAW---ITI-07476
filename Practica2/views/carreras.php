<?php
	session_start();
	if(!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
?>

<h1> CARRERAS </h1>
<table border="1">
	<thead>
		<tr>
			<th>Nombre</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$vistaAlumno = new MvcController();
			$vistaAlumno -> vistaCarrerasController();
			//$vistaAlumno -> borrarUsuarioController();
		?>
	</tbody>
</table>

<?php
	if(isset($_GET["action"])) {
		if($_GET["action"] == "cambio") {
			echo "¡Cambio exitoso!";
		}
	}
?>