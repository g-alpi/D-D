<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="styles.css">
	<title>Login</title>
</head>

<body id="index">
	<?php include 'functions.php'; ?>
	<h1> Dungeons & Dragons </h1>
	
	<div class="row">
		<div class="descripcion-dnd">
			<div id="transicion">
				<div class="sprites enano"></div>
			</div>
			<img id="logo-dnd" src="imagenes/pagina/dnd.png" alt="Logotipo del juego"></img>
			<p>
				Los mundos y aventuras en <strong><em>Dungeons & Dragons</em></strong> parten de una base de fantasía medieval, que se amplía con lugares, criaturas y magia, haciendo este universo único y fantástico.<br><br>Hay incontables de mundos en <strong><em>Dungeons and Dragons</em></strong> y todos ellos están conectados entre sí, además de estar conectados con otros planos de existencia, formando así todo un cosmos llamado <em>Multiverso</em>.<br><br><strong>¡Adéntrate en esta magnífica aventura creándote una <em>ficha de personaje</em>!</strong>
			</p>
		</div>
		<div class="form-login">
			<h2>Login</h2>
			<form method="post">
				<input type="text" name="Nombre" id="Nombre" placeholder="Nombre">
				<input type="password" name="Contra" placeholder="Contraseña">
				<a href="#">Olvidaste la contraseña?</a>
				<input type="submit" value="Aceptar" name="Enviar">
			</form>
			<a href="register.php">Créate una cuenta gratuita</a>
			<?php
				session_start();
				if (isset($_POST["Nombre"]) || isset($_POST["Contra"])){
					login();
				}
				if (isset($_SESSION["exito"])) {
					unset($_SESSION["exito"]);
					notificacion("Cuenta creada.", "success");
				}
			?>
		</div>	
	</div>
	<?php include "footer.php" ?>	
</body>
</html>