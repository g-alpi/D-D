<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title></title>
</head>
<body>
	<?php 
		include'functions.php'; 
	?>
	<h1>Crear Usuario</h1>
	<div class="registroFlex">
		<div class="formularioRegistro">
			<form method="post">
				<div class="inputRegistro">
					<label for="registerName" >Nombre:</label>
					<input type="text" name="nombre" id="nombreRegistro">
				</div>
				<div class="inputRegistro">
					<label for="correoRegistro">Correo Electronico:</label>
					<input type="text" name="correo" id="correoRegistro">
				</div>
				<div class="inputRegistro">
					<label for="fechaNatalRegistro">Fecha de Nacimiento:</label>
					<input type="date" name="fechaNatal" id="fechaNatalRegistro">
				</div>
				<div class="inputRegistro">
					<div class="inputContrasenaRegistro">
					<label for="contrasenaRegistro">Contraseña:</label>
					<input type="contrasena" name="contrasena" id="contrasenaRegistro">
					</div>
					<div class="inputContrasenaRegistro">
					<label for="confirmarContrasenaRegistro">Confirmar contraseña:</label>
					<input type="contrasena" name="confirmarContrasena" id="confirmarContrasenaRegistro">
					</div>
				</div>
				<input type="submit" name="registro" value="Registrarse">
			</form>
			<?php 
				registro();
			?>
		</div>
	</div>

</body>
</html>