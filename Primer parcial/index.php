<?php
	//Invoca al controlador y modelo solicitado
	require_once "models/enlaces.php";
	require_once "controllers/controller.php";
	require_once "models/crud.php";

	//Se crea un nuevo controlador llamando a la plantilla que mostrará al usuario
	$mvc = new MvcController();
	$mvc-> plantilla();  //la variable ejecuta el método del controlador (que al mismo tiempo incluye al archivo "template.php")
	
?>