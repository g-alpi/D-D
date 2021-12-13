<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Dashboard</title>
</head>
<body>
	<?php include "header.php";?>
	<section id="dashboard">
		<h1>Escoge una opción</h1>
		<div class="dashboardButtons">
			<a href="/crearPersonaje.php"><button>Crear Ficha</button></a>
			<a href="/tusFichas.php"><button>Listar Fichas</button></a>
			<a href="#"><button>Probar Ficha</button></a>
		</div>
	</section>
	<?php include "footer.php";?>
</body>
</html>