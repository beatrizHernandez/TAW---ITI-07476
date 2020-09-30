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
			$vistaCarreras = new MvcController();
			$vistaCarreras -> vistaCarrerasController();
			$vistaCarreras -> borrarCarreraController();
		?>
	</tbody>
</table>

<?php
	if(isset($_GET["action"])) {
		if($_GET["action"] == "cambioCarrera") {
			echo "¡Cambio exitoso!";
		}
	}
?>