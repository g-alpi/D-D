<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functionsAvatar.js"></script>
    <title>Tus fichas</title>
</head>
<body> 
    <?php include "header.php";?>
    <section class="section-personajes">
        <h1>TUS FICHAS</h1>
        <div>
           
            <?php
                

                // $_FILES["fileToUpload"]["name"]="";
                // unset($_POST["fileToUpload"]);
                include "functions.php";
                $pdo = accesoBBDD();

                if(isset($_POST["personajeID"])){
                    cambiarAvatar($pdo,$_POST["personajeID"]);
                    unset($_POST["personajeID"]);
                }
                
                $query = $pdo -> prepare("select usuarios.usuario as usuario, personajes.nombre as personaje,personajes.id as id, clases.nombre as clase, razas.nombre as raza, personajes.ruta_imagen as ruta 
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
                            <div class="img-wrapper" id='personaje<?php echo $row["id"]?>'>
                                <img src="<?php echo $row["ruta"];?>" alt="">
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
    

    <!-- codigo para subir la foto  -->
    
    <?php include "footer.php";?>
</body>
</html>