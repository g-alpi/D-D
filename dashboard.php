<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilosGenerales.css">
	<title></title>
</head>
<body>
	<div class="dashboardHeader">
		<a href="home.php"><button>Logout</button></a>
		<?php 
			echo $_GET['nombre'];

		?>
	</div>
	<h1>Escoge una opción</h1>
	<div class="dashboardButtons">
		<a><button>Listar Fichas</button></a>
		<a><button>Crear Fichas</button></a>
		<a><button>Testear Ficha</button></a>
	</div>
</body>
</html>