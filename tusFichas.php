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

    <script src="functionsAvatar.js"></script>

    <title>Tus fichas</title>
</head>
<body id="tusFichas"> 
    <?php include "header.php";?>
    <?php
		if (!isset($_SESSION["IDUsuario"])){
            $_SESSION["noAcount"] = true;
			header("location: register.php");
		}
	?>
    <nav class="breadcrumbs">
		<ol>
			<li><a href="dashboard.php">Dashboard</a></li>
            <li><span>></span><a href="tusFichas.php">Tus Fichas</a></li>
		</ol>
	</nav>
    <section class="section-personajes">
        <h1>TUS FICHAS</h1>
        <div>
           
            <?php
                
                include "functions.php";
                $pdo = accesoBBDD();


                if(isset($_POST["personajeID"])){
                    cambiarAvatar($_POST["personajeID"]);
                    unset($_POST["personajeID"]);
                }
                
                $query = $pdo -> prepare("select usuarios.usuario as usuario, personajes.nombre as personaje,personajes.id as idPersonaje, clases.nombre as clase, razas.nombre as raza, personajes.ruta_imagen as ruta 
                from usuarios
                inner join usuarios_personajes on usuarios.id = usuarios_personajes.id_usuario
                inner join personajes on usuarios_personajes.id_personaje = personajes.id
                inner join clases on personajes.clase = clases.id
                inner join razas on personajes.raza = razas.id
                where usuarios.id = :IDUsuario;");
                
                $query->bindParam(':IDUsuario', $_SESSION["IDUsuario"]);

                $query -> execute();
                $rows = $query -> fetchAll();
            

                foreach ($rows as $row) {
                    ?>
                     
                        <div class="marco-personaje">
                            <div class="img-wrapper" id='<?php echo $row["idPersonaje"]?>'>
                                <img src="<?php echo $row["ruta"];?>" alt="">
                            </div>
                            
                            <div>
                                <p>Nombre: <?php echo $row["personaje"];?></p>
                                <p>Raza: <?php echo $row["raza"];?></p>
                                <p>Clase: <?php echo $row["clase"];?></p>
                            </div>
                            <div class="botones-ficha">
                                <form action="ficha.php" method="get">
                                    <input type="hidden" name="id_ficha" value="<?php echo $row["idPersonaje"] ?>">
                                    <input type="submit" value="Visualizar ficha">
                                </form>
                                
                                <a class="borrar" href="#">Borrar ficha</a>
                            </div>
                        </div>
                    <?php
                }
            ?>
                
                
        </div>
    </section>
    
    
    <?php include "footer.php";?>
</body>
</html>