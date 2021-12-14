<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Dashboard</title>
</head>
<body id="dashboard">
	<?php include "header.php";?>
	<section id="section-dashboard">
		<h1>Escoge una opción</h1>
		<div class="dashboardButtons">
			<a href="/crearPersonaje.php">
				<div class="container-btn">
					<div class="img-btn">
						<img src="imagenes/pagina/crear_personaje.jpg" alt="Imagen de crear personaje" srcset="">
					</div>
					<div class="p-btn">
						<p>Crea tu personaje</p>
					</div>
				</div>
			</a>
			<a href="/tusFichas.php">
				<div class="container-btn">
					<div class="img-btn">
						<img src="imagenes/pagina/tusFichas.png" alt="Imagen de tus fichas" srcset="">
					</div>
					<div class="p-btn">
						<p>Tus personajes</p>
					</div>
				</div>
			</a>
			<a href="#">
				<div class="container-btn">
					<div class="img-btn">
						<img src="imagenes/pagina/prueba_ficha.jpg" alt="Imagen de probar tus fichas" srcset="">
					</div>
					<div class="p-btn">
						<p>Prueba tus personajes</p>
					</div>
				</div>
			</a>
		</div>
	</section>
	<?php include "footer.php";?>
</body>
</html>