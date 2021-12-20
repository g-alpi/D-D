<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functionsAvatar.js"></script>
	<title>Tu ficha</title>
</head>
<body id="ficha">
	<?php
		session_start();
		include "functions.php";
		$id_ficha=$_GET["id_ficha"];
		$personaje = recuperarFicha($id_ficha);
		$idiomas = recuperarIdiomasPersonaje($id_ficha);
		cambiarAvatar($id_ficha);
		$ruta=recuperarAvatar($id_ficha);
	?>
	<section id="cabeceraFicha" class="<?php echo $id_ficha?>">
		<div id="logo">
			<img src="<?php echo $ruta["ruta"]?>" alt="logo dnd" srcset="">
		</div>
		<div id="detallesPersonaje">
			<div>
				<h2>Nombre:</h2>
				<p><?php echo $personaje["nombre"]; ?></p>
			</div>
			<div>
				<h2>Trasfondo:</h2>
				<p><?php echo $personaje["trasfondo"]; ?></p>
			</div>
			<div>
				<h2>Raza:</h2>
				<p><?php echo $personaje["raza"]; ?></p>
			</div>
			<div>
				<h2>Clase:</h2>
				<p><?php echo $personaje["clase"]; ?></p>
			</div>	
		</div>
	</section>
	<section id="estadisticasBase">
		<div id="estadisticas"> 
			<div>
				<p><span><?php echo $personaje["fuerza"]; ?></span>FUE</p>
			</div>
			<div>
				<p><span><?php echo $personaje["destreza"]; ?></span>DES</p>
			</div> 
			<div>
				<p><span><?php echo $personaje["constitucion"]; ?></span>CON</p>
			</div> 
			<div>
				<p><span><?php echo $personaje["inteligencia"]; ?></span>INT</p>
			</div> 
			<div>
				<p><span><?php echo $personaje["sabiduria"]; ?></span>SAB</p>
			</div> 
			<div>
				<p><span><?php echo $personaje["carisma"]; ?></span>CAR</p>
			</div> 
		</div>
		<div id="proficiencia">
			<p>Proficiencia<span>0</span></p>
		</div>
		<div id="velocidadMovimiento">
			<p>Velocidad<span><?php echo $personaje["velocidad"]?> pies</span></p>
		</div>
		<div id="hitPoints">
			<p>Puntos de Golpe<span><?php echo explode("d", $personaje["dg"])[1]?></span></p>
		</div>
	</section>
	<section id="centroFicha">
		<div id="colIzquierda">
			<div id="salvaciones">
				<h2>Tiradas de Salvacion</h2>
				<div id="valoresSalvacion">
					<div>
						<p>FUE: <span><?php echo modificadorEstadistica($personaje["fuerza"])?></span></p>
					</div>
					<div>
						<p>DES: <span><?php echo modificadorEstadistica($personaje["destreza"])?></span></p>
					</div>
					<div>
						<p>CON: <span><?php echo modificadorEstadistica($personaje["constitucion"])?></span></p>
					</div>
					<div>
						<p>INT: <span><?php echo modificadorEstadistica($personaje["inteligencia"])?></span></p>
					</div>
					<div>
						<p>SAB: <span><?php echo modificadorEstadistica($personaje["sabiduria"])?></span></p>
					</div>
					<div>
						<p>CAR: <span><?php echo modificadorEstadistica($personaje["carisma"])?></span></p>
					</div>
				</div>
			</div>
			<div id="rasgosAtributos">
				<h2>Rasgos y Atributos</h2>
				<ul title="Rasgos y Atributos">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
				</ul>
			</div>
			<div id="idiomasProficiencias">
				<h2>Idiomas y proficiencias</h2>
				<ul title="Idiomas y proficiencias">
					<?php foreach($idiomas as $idioma){?>
						<li><?php echo $idioma ?></li>
					<?php }?>
				</ul>
			</div>
		</div>
		<div id="colDerecha">
			<div id="defensas">
				<div id="ca">
					<p>CA<span><?php echo maximoDestreza(modificadorEstadistica($personaje["destreza"]), $personaje["maxDestreza"]) + $personaje["ca"];?></span></p>
				</div>
				<div id="reduccionDano">
					<p>RD<span>0</span></p>
				</div>
				<div id="condiciones">
					<p>Condiciones</p>
				</div>
			</div>
			<div id="habilidades">
				<ol title="Habilidades">
					<li>
						<div>
							<h2>Proficiencia</h2>
						</div>
						<div>
							<h2>Modificador</h2>
						</div>
						<div>
							<h2>Habilidad</h2>
						</div>
						<div>
							<h2>Bonus</h2>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>DES</p>
						</div>
						<div>
							<p>Acrobacias</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["destreza"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>INT</p>
						</div>
						<div>
							<p>Arcanos</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>FUE</p>
						</div>
						<div>
							<p>Atletismo</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["fuerza"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>CAR</p>
						</div>
						<div>
							<p>Engaño</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>INT</p>
						</div>
						<div>
							<p>Historia</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>CAR</p>
						</div>
						<div>
							<p>Interpretacion</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>CAR</p>
						</div>
						<div>
							<p>Intimidacion</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>INT</p>
						</div>
						<div>
							<p>Investigación</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>DES</p>
						</div>
						<div>
							<p>Juego de Manos</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["destreza"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>SAB</p>
						</div>
						<div>
							<p>Medicina</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>INT</p>
						</div>
						<div>
							<p>Naturaleza</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>SAB</p>
						</div>
						<div>
							<p>Percepción</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>SAB</p>
						</div>
						<div>
							<p>Perspicacia</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>CAR</p>
						</div>
						<div>
							<p>Persuasión</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>INT</p>
						</div>
						<div>
							<p>Religión</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>DES</p>
						</div>
						<div>
							<p>Sigilo</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["destreza"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>SAB</p>
						</div>
						<div>
							<p>Supervivencia</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
						</div>
					</li>
					<li>
						<div>
							<p>+0</p>
						</div>
						<div>
							<p>SAB</p>
						</div>
						<div>
							<p>Trato con Animales</p>
						</div>
						<div>
							<p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
						</div>
					</li>
				</ol>
			</div>
		</div>
	</section>
	<section id="pieFicha">
		<div id="historia">
			<h2>Historia</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras in mi a tellus commodo facilisis. Quisque suscipit sagittis nibh, in vehicula nibh elementum at. Sed eget diam nec dui placerat ultrices eget et diam. Ut quis tincidunt urna. In hac habitasse platea dictumst. Sed auctor nisl nec pulvinar aliquam. Nunc vulputate metus tortor, nec pharetra elit consectetur in. Cras feugiat ex non libero tincidunt tincidunt. Nulla facilisi. Curabitur in dolor ante. Vivamus purus quam, finibus vel hendrerit sed, dictum ac nibh. Sed lorem magna, vulputate at accumsan id, convallis non nunc.</p>
		</div>
		<div id="hechizos">
			<h2>Hechizos</h2>
			<ul title="Hechizos">
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
			</ul>
		</div>
		<div id="equipo">
			<h2>Equipo</h2>
			<ul title="Equipo">
				<li>Arma: <?php echo $personaje["arma"];?></li>
				<li>Armadura: <?php echo $personaje["armadura"];?></li>
				<li><?php echo $personaje["po"];?> PO</li>
			</ul>
		</div>
	</section>
	<form id="btnPdf" action="pdf.php" method="get">
		<input type="hidden" name="id_ficha" value="<?php echo $id_ficha;?>">
		<input type="submit" value="PDF">
	</form>
</body>
</html>