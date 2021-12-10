<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Dashboard</title>
</head>
<body>
	<div class="dashboardHeader">
		<a href="index.php"><button>Logout</button></a>
			<div class="sessionName">
				<p>
					<?php 
						session_start();
						echo $_SESSION['Nombre'];

					?>
				</p>
			</div>
	</div>
	<h1>Escoge una opción</h1>
	<div class="dashboardButtons">
		<a><button>Listar Fichas</button></a>
		<a><button>Crear Fichas</button></a>
		<a><button>Testear Ficha</button></a>
	</div>
</body>
</html>