<?php
	session_start(); //iniciar sesión
	if(!$_SESSION["validar"]) { //si la variable de sesión es diferente de "validar"
		header("location:index.php?action=ingresar"); //se redirige a "ingresar"
		exit();
	}
?>

<!-- Campos referentes al crud basados en los campos de la tabla -->
<h1><center> LIBROS </center></h1>
<table border="1" style="margin: 0 auto;">
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
			$vistaLibro -> vistaLibrosController(); //la variable ejecuta el método del controlador
			$vistaLibro -> borrarLibroController(); //la variable ejecuta el método del controlador
		?>
	</tbody>
</table>

<?php
	//Verificar la URL correcta
	if(isset($_GET["action"])) {
		if($_GET["action"] == "cambioLibros") { //si es igual a "cambioLibros" (referencia de "enlaces.php")
			echo "Cambio exitoso"; //imprime un mensaje
		}
	}
?>