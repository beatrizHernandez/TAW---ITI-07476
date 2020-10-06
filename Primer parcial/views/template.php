<!DOCTYPE html>
<html>
<head>
	<title>Registro de libros</title>

	<style>
		header {
			position: relative;
			margin: auto;
			text-align: center;
            font-family: "Segoe UI";
            font-style: oblique;
			padding: 5px;	
        }
            
        nav {
            position: relative;
            margin: auto;
            width: 100%;
            height: auto;
            background-image: url(images/madera_1.jpg);
        }

        nav ul {
            position: relative;
            margin: auto;
            width: 50%;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            width: 24%;
            line-height: 50px;
            list-style: none;
        }

        nav ul li a {
            color: white;
            font-family: "Latin Modern Roman 10";
            font-style: oblique;
            font-weight: bolder;
            text-decoration: none;
        }

        section {
            position: relative; 
            padding: 20px;
        }

	</style>
</head>
<body background="images/gris_1.jpg" style = "background-size: cover">

	<header><h1>Evaluación: primer parcial</h1></header>

	<?php
		//Inlcuir el menú de navegación
		include "navegacion.php";
	?>
	<section>
		<!-- Contenedor donde se muestran a las opciones del sistema -->
		<?php
			//Mostrar opciones
			$mvc = new MvcController();
			$mvc -> enlacesPaginasController(); //la variable ejecuta el método del controlador
		?>
	</section>
</body>
</html>