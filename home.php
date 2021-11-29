<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" href="estilos/estilosGenerales.css">
</head>
<body id="bodyHomePage">
	<div id="contenedorCuerpo">

		<div class="contTitle">
			<h1> Dungeons & Dragons </h1>
		</div>

		<div class="contenedorInfo">

			<div class="divImgHomePage">

				<img class="imgHomePage" src="imagenes/dnd.png" alt="Logotipo del juego">  </img>

			</div>

			<p class="txtDesc">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi euismod elementum massa, eu vestibulum lorem venenatis eget. Aliquam erat volutpat. Suspendisse vehicula tortor felis, a aliquet purus congue non. Nulla eget augue eu neque fringilla luctus gravida nec ex. Sed lacinia orci id tortor tincidunt vehicula. Proin ut sollicitudin tellus. Phasellus a dictum leo. 
			</p>

		</div>

		<div class="contenedorInfo">
			<h2 class="titleInfoHomePage">Login</h2>
				<form class="homePagForm" method="GET">

					<p class="titleInpForm">Nombre</p>
					<input type="text" name="Nombre"><br>

					<p class="titleInpForm">Contraseña</p>
					<input type="text" name="Contra" ><br>

					<p class="linkPswForgot"><a href="www.google.com">Olvidaste la contraseña?</a></p>

				

				<div class="loginButton">
					<input type="submit" value="Aceptar" name="Enviar">
					
				</div>
				</form>

				<div class="newAccBtn">
					<a href="www.google.com">Crear cuenta nueva</a>
				</div>
				<?php include"functionsPHP.php";
							login($_GET['Nombre']);
					?>
		</div>
</body>
</html>