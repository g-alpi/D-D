<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title></title>
</head>
<body>
<?php
    session_start();
    include "functions.php";

    $pdo = accesoBBDD();

    $query = $pdo->prepare("insert into personajes values(null, :nombre, :raza, :clase, :nivel, :experiencia, :trasfondo, :rasgo, :ideales, :vinculos, :defectos,
    :fuerza, :destreza, :constitucion, :inteligencia, :sabiduria, :carisma, :rutaImagen)");
    $null = null;

    $query->bindParam(':nombre', $_POST["nombreFicha"]);
    if(isset($_POST["subraza"])){$query->bindParam(':raza', $_POST["subraza"]);} 
    else {$query->bindParam(':raza', $_POST["raza"]);}
    $query->bindParam(':clase', $_POST["clase"]);
    $query->bindParam(':nivel', $null);
    $query->bindParam(':experiencia', $null);
    $query->bindParam(':trasfondo', $_POST["trasfondo"]);
    $query->bindParam(':rasgo', $null);
    $query->bindParam(':ideales', $null);
    $query->bindParam(':vinculos', $null);
    $query->bindParam(':defectos', $null);
    $query->bindParam(':fuerza', $_POST["fuerza"]);
    $query->bindParam(':destreza', $_POST["destreza"]);
    $query->bindParam(':constitucion', $_POST["constitucion"]);
    $query->bindParam(':inteligencia', $_POST["inteligencia"]);
    $query->bindParam(':sabiduria', $_POST["sabiduria"]);
    $query->bindParam(':carisma', $_POST["carisma"]);
    $query->bindParam(':rutaImagen', $_POST["imagen"]);
    $query->execute();      

    $query = $pdo->prepare("select id from personajes order by id desc limit 1;");
    $query->execute();
    $rows = $query -> fetchAll();
    foreach ($rows as $row) {
      $idPersonaje = $row["id"];
    }

    $query = $pdo->prepare("set foreign_key_checks=0; insert into usuarios_personajes values(:id_usuario, :id_personaje);set foreign_key_checks=1;");
    $query->bindParam(':id_usuario', $_SESSION["IDUsuario"]);
    $query->bindParam(':id_personaje', $idPersonaje);
    $query->execute();
    
    $query = $pdo->prepare("select idiomas.idioma
    from razas
    inner join razas_idiomas on razas.id = razas_idiomas.id_raza
    inner join idiomas on razas_idiomas.id_idioma = idiomas.id
    where razas.id = :raza_padre;");
    $query->bindParam(':raza_padre', $_POST["raza"]);
    $query->execute();
    
    $idiomas = $query -> fetchAll();

    foreach ($idiomas as $idioma){
      $query = $pdo->prepare("set foreign_key_checks=0; insert into personajes_idiomas values(:id_personaje, :id_idioma);set foreign_key_checks=1;");
      $query->bindParam(':id_personaje', $idPersonaje);
      $query->bindParam(':id_idioma', $idioma["idioma"]);
      $query->execute();
    }

    foreach ($_POST["idioma"] as $idioma){
      $query = $pdo->prepare("set foreign_key_checks=0; insert into personajes_idiomas values(:id_personaje, :id_idioma);set foreign_key_checks=1;");
      $query->bindParam(':id_personaje', $idPersonaje);
      $query->bindParam(':id_idioma', $idioma);
      $query->execute();
    }

    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
      die("Error accedint a dades: " . $e[2]);  
    }   
?>
  <form id="id_ficha" action="ficha.php" method="get">
    <input type="hidden" name="id_ficha" value="<?php echo $idPersonaje;?>">
  </form>
  <script>
    $(document).ready(function() {
      $("#id_ficha").submit();
    });
  </script>
</body>
</html>
