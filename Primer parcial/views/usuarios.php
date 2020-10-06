<?php
	session_start(); //iniciar sesión
	if(!$_SESSION["validar"]) { //si la variable de sesión es diferente de "validar"
		header("location:index.php?action=ingresar"); //se redirige a "ingresar"
		exit();
	}
?>

<!-- Campos referentes al crud basados en los campos de la tabla -->
<h1><center> USUARIOS </center></h1>
<table border="1" style="margin: 0 auto;">
	<thead>
		<tr>
			<th>Usuario</th>
			<th>Contraseña</th>
			<th>Email</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$vistaUsuario = new MvcController();
			$vistaUsuario -> vistaUsuariosController(); //la variable ejecuta el método del controlador
			$vistaUsuario -> borrarUsuarioController(); //la variable ejecuta el método del controlador
		?>
	</tbody>
</table>

<?php
	//Verificar la URL correcta
	if(isset($_GET["action"])) { 
		if($_GET["action"] == "cambio") { //si es igual a "cambio" (referencia de "enlaces.php")
			echo "¡Cambio exitoso!"; //imprime un mensaje
		}
	}
?>