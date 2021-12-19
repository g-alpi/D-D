<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="testPJ.js"></script>
	<title>Prueba tu personaje</title>
</head>
<body id="testPJ">
	<?php include "header.php";?>
	<nav class="breadcrumbs">
		<ol>
			<li><a href="dashboard.php">Dashboard</a></li>
            <li><span>></span><a href="eligePJ.php">Elige personaje</a></li>
            <li><span>></span><a href="testPJ.php">Prueba tu personaje</a></li>
		</ol>
	</nav>
    <?php
            include "functions.php";
    
            $id_ficha=$_GET["id_ficha"];
    		$personaje = recuperarFicha($id_ficha);
            $idiomas = recuperarIdiomasPersonaje($id_ficha);
            $ruta=recuperarAvatar($id_ficha);
    ?>
    <section id="personaje">
        <section id="fotoPersonaje" >
            <div id="imagenPJ">
                    <img src="<?php echo $ruta["ruta"]?>" alt="pj img" srcset="">
            </div>
        </section>
        <h2>Información del personaje</h2>
    <section id="estadisticasBaseTest">
            
            <div id="estadisticasTest">
                <div>
                    <p><span id="spanFuerza"><?php echo $personaje["fuerza"]; ?></span>FUE</p>
                </div>
                <div>
                    <p><span id="spanDestreza"><?php echo $personaje["destreza"]; ?></span>DES</p>
                </div> 
                <div>
                    <p><span id="spanConstitucion"><?php echo $personaje["constitucion"]; ?></span>CON</p>
                </div> 
                <div>
                    <p><span id="spanInteligencia"><?php echo $personaje["inteligencia"]; ?></span>INT</p>
                </div> 
                <div>
                    <p><span id="spanSabiduria"><?php echo $personaje["sabiduria"]; ?></span>SAB</p>
                </div> 
                <div>
                    <p><span id="spanCarisma"><?php echo $personaje["carisma"]; ?></span>CAR</p>
                </div> 
            </div>
            <div id="proficiencia">
			<p>Proficiencia<span>0</span></p>
            </div>
            <div id="velocidadMovimiento">
                <p>Velocidad<span><?php echo $personaje["velocidad"]?> pies</span></p>
            </div>
            <div id="hitPoints">
                <p>Putnos de vida<span id="vida">15/15</span></p>
            </div>
    </section>
    <h1 id="ronda">Encuentro 1/5</h1>
    <section id="juego">

        <div id="encuentro">
            <div id="btnHabilidades" >
                <h3> Test habilidad</h3>
                <button id="fuerza">Fuerza</button>
                <button id="destreza">Destreza</button>
                <button id="constitucion">Constitucion</button>
                <button id="inteligencia">Inteligencia</button>
                <button id="sabiduria">Sabiduria</button>
                <button id="carisma">Carisma</button>
            </div>

            <div id="evento" >
                <h3>Bienvenido aventurero, ¿estás preparado para esta travesía?</h3>
                <h3>Espero que así sea, acabas de despertarte aturdido en un bosque, a lo lejos ves que se esta acercando un grupo de personas desconocidas.</h3>
                <br>
                <h2>¿Qué vas ha hacer?</h2>
            </div>

            <div id="narrador" ><img src="./imagenes/personajes/juglar.png" alt=""></div>


        </div>


    </section>
    
	
	<?php include "footer.php";?>
</body>
</html>