<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "functions.php"; recuperarDatosBBDD();?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functions.js"></script>
    <title>Crea tu Personaje</title>
</head>
<body>
    <?php include "header.php";?>
    <form method="post"></form>
    <div id="flexDiv">
        <div id="nombreForm">
                <label for="nombreFicha"><h2 id="escogerNombre">Escoge tu nombre</h2></label>
                <input type="text" name="nombreFicha" id="nombreFicha">
                <button id="botonNombre">Siguiente</button>
        </div>
        <section id="nombrePersonaje"></section>
        <section id="trasfondo"></section> <!-- eliminar al implementar trasfondo  -->
    </div>
    
    <?php include "footer.php";?>
</body>
</html>