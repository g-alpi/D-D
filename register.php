<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title></title>
</head>
<body id="register">
	<h1>Crear Usuario</h1>
	<div class="formularioRegistro">
		<h2>¡Comencemos!</h2>
		<form method="post">
			<input type="text" name="nombre" id="nombreRegistro" placeholder="Nombre">
			<input type="email" name="correo" id="correoRegistro" placeholder="Email">
			<div>
				<label for="fechaNatalRegistro">Fecha de Nacimiento:</label>
				<input type="date" name="fechaNatal" id="fechaNatalRegistro" max="<?php echo date("Y-m-d");?>">
			</div>
			<input type="password" name="contrasena" id="contrasenaRegistro" placeholder="Contraseña">
			<input type="password" name="confirmarContrasena" id="confirmarContrasenaRegistro" placeholder="Confirma tu contraseña">
			<input type="submit" name="registro" value="Registrarse">
		</form>
		<p>¿Ya tienes una cuenta? <a href="index.php">¡Haz login!</a></p>
	</div>
	<?php
		session_start();
		include "footer.php";
		include 'functions.php'; 
		if (isset($_POST["nombre"]) || isset($_POST["correo"]) || isset($_POST["fechaNatal"]) || isset($_POST["contrasena"]) || isset($_POST["confirmarContrasena"])){
			registro();
		}
	?>
</body>
</html>