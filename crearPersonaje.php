<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functions.js"></script>
    <title>Crea tu Personaje</title>
</head>
<body id="crearPersonaje">
    <?php include "header.php";?>
    <?php
		if (!isset($_SESSION["IDUsuario"])){
            $_SESSION["noAcount"] = true;
			header("location: register.php");
		}
	?>
    <?php include "functions.php"; recuperarRazasBBDD(); recuperarClasesBBDD();?>
    <nav class="breadcrumbs">
		<ol>
			<li><a href="dashboard.php">Dashboard</a></li>
            <li><span>></span><a href="crearPersonaje.php">Crear Personaje</a></li>
		</ol>
	</nav>
    <h1>Crea tu personaje</h1>
    <form id="crearPersonajeForm" action="guardarPersonaje.php" method="post">
        <section id="nombrePersonaje">
            <h2>Introduce el nombre de tu personaje</h2>
            <div id="nombreForm">
                <input type="text" name="nombreFicha" id="nombreFicha" placeholder="Nombre">
            </div>
        </section>
    </form>
    <?php include "footer.php";?>
</body>
</html>