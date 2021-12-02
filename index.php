<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="styles.css">
	<title>Home</title>
</head>
<body id="bodyHomePage">
	<?php include 'functions.php'; ?>
	<div id="contenedorCuerpo">

		<div class="contTitle">
			<h1> Dungeons & Dragons </h1>
		</div>

		<div class="contenedorInfo">

			<div class="divImgHomePage">

				<img class="imgHomePage" src="imagenes/dnd.png" alt="Logotipo del juego">  </img>

			</div>

			<p class="txtDesc">
				Los mundos de las aventuras en Dungeons & Dragons parten de la base de una fantasía medieval que se amplía con lugares, criaturas y magia, haciéndolos únicos y fantásticos.
				Hay montones de mundos en Dungeons and Dragons, todos ellos están conectados entre sí y con otros planos de existencia formando todo un cosmos llamado Multiverso.
				Adentrate en esta aventura y create una ficha de personaje!!!
			</p>

		</div>

		<div class="contenedorInfo">
			<h2 class="titleInfoHomePage">Login</h2>
				<form class="homePagForm" method="POST">

					<p class="titleInpForm">Nombre</p>
					<input type="text" name="Nombre" id="Nombre"><br>

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
				<?php
					session_start();
					login();
				     
				?>
		</div>
</body>
</html>