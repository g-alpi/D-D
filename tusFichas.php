<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
    <title>Tus fichas</title>
</head>
<body> 
    <?php include "header.php";?>
    <section class="section-personajes">
        <h1>TUS FICHAS</h1>
        <div>
            <?php
                include "functions.php";
                $pdo = accesoBBDD();
                $query = $pdo -> prepare("select usuarios.usuario as usuario, personajes.nombre as personaje, clases.nombre as clase, razas.nombre as raza, razas.ruta_imagen as ruta 
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
                            <div class="img-wrapper">
                                <img src="imagenes/personajes/<?php echo $row["ruta"];?>" alt="">
                            </div>
                            <div>
                                <p>Nombre: <?php echo $row["personaje"];?></p>
                                <p>Raza: <?php echo $row["raza"];?></p>
                                <p>Clase: <?php echo $row["clase"];?></p>
                            </div>
                            <div class="botones-ficha">
                                <a href="#">Visualizar ficha</a>
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