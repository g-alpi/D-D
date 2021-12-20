<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functionsAvatar.js"></script>
	<title>PDF</title>
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
    <table>
        <tr>
            <td>
                <h2>Nombre:</h2>
            </td>
            <td>
                <p><?php echo $personaje["nombre"]; ?></p>
            </td>
            <td>
                <h2>Trasfondo:</h2>
            </td>
            <td>
                <p><?php echo $personaje["trasfondo"]; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Raza:</h2>
            </td>
            <td>
                <p><?php echo $personaje["raza"]; ?></p>
            </td>
            <td>
                <h2>Clase:</h2>
            </td>
            <td>
                <p><?php echo $personaje["clase"]; ?></p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <h2>FUE:</h2>
            </td>
            <td>
                <p><?php echo $personaje["fuerza"]; ?></p>
            </td>
            <td>
                <h2>DES:</h2>
            </td>
            <td>
                <p><?php echo $personaje["destreza"]; ?></p>
            </td>
            <td>
                <h2>CON:</h2>
            </td>
            <td>
                <p><?php echo $personaje["constitucion"]; ?></p>
            </td>
            <td>
                <h2>INT:</h2>
            </td>
            <td>
                <p><?php echo $personaje["inteligencia"]; ?></p>
            </td>
            <td>
                <h2>SAB:</h2>
            </td>
            <td>
                <p><?php echo $personaje["sabiduria"]; ?></p>
            </td>
            <td>
                <h2>CAR:</h2>
            </td>
            <td>
                <p><?php echo $personaje["carisma"]; ?></p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <h2>Proficiencia:</h2>
            </td>
            <td>
                <p>0</p>
            </td>
            <td>
                <h2>Velocidad:</h2>
            </td>
            <td>
                <p><?php echo $personaje["velocidad"]?> pies</p>
            </td>
            <td>
                <h2>Puntos de Golpe:</h2>
            </td>
            <td>
                <p><?php echo explode("d", $personaje["dg"])[1]?></p>
            </td>
        </tr>
    </table>
    <h2>Tiradas de Salvacion</h2>
    <table>
        <tr>
            <td>
                <h2>FUE:</h2>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["fuerza"])?></p>
            </td>
            <td>
                <h2>DES:</h2>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["destreza"])?></p>
            </td>
            <td>
                <h2>CON:</h2>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["constitucion"])?></p>
            </td>
            <td>
                <h2>INT:</h2>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
            </td>
            <td>
                <h2>SAB:</h2>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
            </td>
            <td>
                <h2>CAR:</h2>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
            </td>
        </tr>
    </table>
    <div id="colIzquierda">
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
    <table>
        <tr>
            <td>
                <h2>CA</h2>
            </td>
            <td>
                <?php echo maximoDestreza(modificadorEstadistica($personaje["destreza"]), $personaje["maxDestreza"]) + $personaje["ca"];?>
            </td>
            <td>
                <h2>RD</h2>
            </td>
            <td>
                <p>0</p>
            </td>
            <td>
                <h2>Condiciones</h2>
            </td>
        </tr>
    </table>
    <br><br><br><br><br><br><br><br>
    <h2>Habilidades</h2>
    <table>
        <tr>
            <td>
                <h2>Proficiencia</h2>
            </td>
            <td>
                <h2>Modificador</h2>
            </td>
            <td>
                <h2>Habilidad</h2>
            </td>
            <td>
                <h2>Bonus</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>DES</p>
            </td>
            <td>
                <p>Acrobacias</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["destreza"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>INT</p>
            </td>
            <td>
                <p>Arcanos</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>FUE</p>
            </td>
            <td>
                <p>Atletismo</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["fuerza"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>CAR</p>
            </td>
            <td>
                <p>Engaño</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>INT</p>
            </td>
            <td>
                <p>Historia</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>CAR</p>
            </td>
            <td>
                <p>Interpretacion</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>CAR</p>
            </td>
            <td>
                <p>Intimidacion</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>INT</p>
            </td>
            <td>
                <p>Investigación</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>DES</p>
            </td>
            <td>
                <p>Juego de Manos</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["destreza"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>SAB</p>
            </td>
            <td>
                <p>Medicina</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>INT</p>
            </td>
            <td>
                <p>Naturaleza</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>SAB</p>
            </td>
            <td>
                <p>Percepción</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>SAB</p>
            </td>
            <td>
                <p>Perspicacia</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>CAR</p>
            </td>
            <td>
                <p>Persuasión</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["carisma"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>INT</p>
            </td>
            <td>
                <p>Religión</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["inteligencia"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>DES</p>
            </td>
            <td>
                <p>Sigilo</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["destreza"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>SAB</p>
            </td>
            <td>
                <p>Supervivencia</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>+0</p>
            </td>
            <td>
                <p>SAB</p>
            </td>
            <td>
                <p>Trato con Animales</p>
            </td>
            <td>
                <p><?php echo modificadorEstadistica($personaje["sabiduria"])?></p>
            </td>
        </tr>
    </table>
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
</body>
</html>
<?php
$html = ob_get_clean();

require_once "dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array("isRemoteEnabled" => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream("ficha.pdf",array("Attachment" => false));

?>