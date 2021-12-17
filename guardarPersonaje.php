<?php

    include "functions.php";

    $pdo = accesoBBDD();

    $query = $pdo->prepare("insert into personajes values(null, :nombre, :raza, :clase, :nivel, :experiencia, :trasfondo, :rasgo, :ideales, :vinculos, :defectos,
    :fuerza, :destreza, :constitucion, :inteligencia, :sabiduria, :carisma, :rutaImagen)");
    $null = null;

    $query->bindParam(':nombre', $_POST["nombreFicha"]);
    if(isset($_POST["subraza"])){$query->bindParam(':raza', $_POST["subraza"]);} 
    else {$query->bindParam(':raza', $_POST["raza"]);}
    $query->bindParam(':clase', $_POST["clase"]); !
    $query->bindParam(':nivel', $null);
    $query->bindParam(':experiencia', $null);
    $query->bindParam(':trasfondo', $_POST["trasfondo"]); !
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
    $query->bindParam(':rutaImagen', $_POST["nombre"]);


    $query->execute();      

    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
      die("Error accedint a dades: " . $e[2]);  
    } 

    header("location: ficha.php");
?>