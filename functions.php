<?php

    /* Esta funcion te permite el acceso a BBDD */

    function accesoBBDD() {
      try {
        $hostname = "localhost";
        $dbname = "dnd";
        $username = "Master";
        $pw = "Master1234!";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
        return $pdo;
      } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e -> getMessage() . "\n";
        exit;
      }
    }

    /* Esta funcion comprueba que el login del usuario sea correcto */

    function login(){ 
      if(!isset($_POST["Nombre"])){
        return;
      }
      
      $pdo = accesoBBDD();

      $query = $pdo->prepare("select * FROM usuarios where usuario= :user and password = :password");

      $query -> bindParam(':user', $_POST["Nombre"]);
      $query -> bindParam(':password',$_POST["Contra"]);

      $query -> execute();      

      $e = $query -> errorInfo();
      
      if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error accedint a dades: " . $e[2]);
      }  
      
      $row = $query -> fetch();

      if($row){
        $_SESSION['Nombre'] = $_POST['Nombre'];
        $_SESSION["IDUsuario"] = $row["id"];
        header('Location:dashboard.php');
      } else {
        echo '<div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>ERROR!</strong> El nombre de usuario o la contraseña que has introducido no es correcto.
        </div>';
      } 
    }

    function recuperarDatosBBDD(){
      $pdo = accesoBBDD();
      $query = $pdo->prepare("select razas.nombre, razas.descripcion, razas.ruta_imagen, razas.incremento_estadistica, razas.estadistica_incrementada, razas.tamano, razas.velocidad, razas.vision, razaPadre.nombre as razaPadre 
      from razas 
      left join razas as razaPadre on razas.id_razaPadre = razaPadre.id;");

      $query -> execute();
      $rows = $query -> fetchAll();
      ?> <script> var razas = {}; <?php 
      foreach ($rows as $row) {
          ?>
            razas["<?php echo $row["nombre"]?>"] = {
              "incremento_estadistica"    : "<?php echo $row["incremento_estadistica"];?>",
              "estadistica_incrementada"  : "<?php echo $row["estadistica_incrementada"];?>",
              "tamaño"                    : "<?php echo $row["tamano"];?>",
              "velocidad"                 : "<?php echo $row["velocidad"];?>",
              "raza_padre"                : "<?php echo $row["razaPadre"];?>",
              "descripcion"               : "<?php echo $row["descripcion"];?>",
              "vision"                    : "<?php echo $row["vision"];?>",
              "idiomas"                   : [],
              "habilidades_raciales"      : [],
              "ruta_imagen"               : "<?php echo $row["ruta_imagen"];?>"
            };

            <?php

            if (!empty($row["razaPadre"])) {
              ?>
               razas["<?php echo $row["razaPadre"]; ?>"]["tiene_hijos"] = true;
              <?php
            }
            $queryIdiomas = $pdo->prepare("select idiomas.idioma 
            from razas 
            left join razas as razaPadre on razas.id_razaPadre = razaPadre.id 
            left join razas_idiomas on razas.id = razas_idiomas.id_raza 
            left join idiomas on idiomas.id = razas_idiomas.id_idioma 
            where razas.nombre = :raza;");

            $queryIdiomas -> bindParam(':raza', $row["nombre"]);
            $queryIdiomas -> execute();

            $rowsIdiomas = $queryIdiomas -> fetchAll();
            foreach ($rowsIdiomas as $rowIdioma) {
              ?>
              razas["<?php echo $row["nombre"]?>"]["idiomas"].push("<?php echo $rowIdioma["idioma"] ?>");
              <?php
            }

            $queryHabilidadesRaciales = $pdo -> prepare("select habilidadesRaciales.nombre as habilidadRacial, habilidadesRaciales.descripcion as descripcion 
            from razas
            inner join habilidadesRaciales_razas on habilidadesRaciales_razas.id_raza = razas.id
            inner join habilidadesRaciales on habilidadesRaciales_razas.id_habilidadRacial = habilidadesRaciales.id
            where razas.nombre = :raza; ");

            $queryHabilidadesRaciales -> bindParam(':raza', $row["nombre"]);
            $queryHabilidadesRaciales -> execute();

            $rowsHabilidadesRaciales = $queryHabilidadesRaciales -> fetchAll();

            foreach ($rowsHabilidadesRaciales as $rowHabilidadRacial) {
              ?>
                razas["<?php echo $row["nombre"]?>"]["habilidades_raciales"].push(["<?php echo $rowHabilidadRacial["habilidadRacial"] ?>", "<?php echo $rowHabilidadRacial["descripcion"] ?>"]);
              <?php
            }

            ?>

          <?php
      }
      ?> </script> <?php 
    }
?>