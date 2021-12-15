<?php

  // Esta funcion te permite el acceso a BBDD y te devuelve el pdo

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

  // Esta funcion te permite hacer el login 

  function login() {  
    $pdo = accesoBBDD();
    $encriptedPwd = hash("sha256", $_POST["Contra"]);

    $query = $pdo->prepare("select * FROM usuarios where usuario= :user and password= :password");

    $query->bindParam(':user', $_POST["Nombre"]);
    $query->bindParam(':password',$encriptedPwd);

    $query->execute();      

    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
      die("Error accedint a dades: " . $e[2]);
    }  
            
    $row = $query->fetch();

    if($row){
      $_SESSION['Nombre'] = $row['usuario'];
      $_SESSION["IDUsuario"] = $row["id"];
      header('Location:dashboard.php');
    } else {
        notificacion("No hemos podido verificar tu cuenta con la información proporcionada.", "error");
    }
  }

  // Esta funcion te permite registrar una cuenta nueva

  function registro(){
    $pdo = accesoBBDD();

    if (usuarioexistente($pdo, $_POST["nombre"])){
      notificacion("Ya existe un usuario con ese nombre.", "warning");
      return;
    }

    if(verificarContrasena() && formularioLleno()){
      
      $encriptedPwd = hash("sha256", $_POST["contrasena"]);
        
      $query = $pdo->prepare("insert into usuarios values(null, :user, :password, :fecha, :correo)");

      $query->bindParam(':user', $_POST["nombre"]);
      $query->bindParam(':password', $encriptedPwd);
      $query->bindParam(':correo', $_POST["correo"]);
      $query->bindParam(':fecha',$_POST["fechaNatal"]);

      $query->execute();      

      $e= $query->errorInfo();
      if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error accedint a dades: " . $e[2]);  
      } 

      if ($_POST["nombre"]){
        usuarioCreado($pdo, $_POST["nombre"], $encriptedPwd);
      }
    }
  }

  // Funcion para verificar que el usuario ha sido creado

  function usuarioCreado($pdo, $user, $encriptedPwd){
    $query = $pdo->prepare("select * from usuarios where usuario = :user AND password = :password");

    $query->bindParam(':user', $user);
    $query->bindParam(':password', $encriptedPwd);

    $query->execute();

    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
      die("Error: " . $e[2]);
    } 

    $row = $query->fetch();
    if($row){
      $_SESSION["exito"] = true;
      header('Location:dashboard');
    }
    else{
      notificacion("No se ha podido finalizar el registro, inténtalo más tarde.", "error");
    }
  }

  // Esta función te comprueba que el formulario de registro de usuarios este completo

  function formularioLleno(){      
    if(empty($_POST['nombre'])){
      notificacion("Por favor, introduce un nombre de usuario.", "error");
      return false; 
    }
    if(empty($_POST['correo'])){
      notificacion("Por favor, introduce un Email.", "error");
      return false; 
    }
    if(empty($_POST['fechaNatal'])){
      notificacion("Por favor, introduce una fecha de nacimiento.", "error");
      return false; 
    }
    if(empty($_POST['contrasena'])){
      notificacion("Por favor, introduce una contraseña.", "error");
      return false; 
    }
    return true;
  }

  // Funcion para verificar la contraseña

  function verificarContrasena(){
    $contrasena = $_POST['contrasena'];
    $confirmarContrasena = $_POST['confirmarContrasena'];
    if($confirmarContrasena != $contrasena){
      notificacion("Las contraseñas tienen que ser las mismas.", "error");
      return false;
    }
    return true;
  }

  // Si existe el usuario devuelve true

  function usuarioExistente($pdo, $nombre){
    $query = $pdo->prepare("select * from usuarios where usuario = :nombre");

    $query->bindParam(':nombre', $nombre);
    $query->execute();
    $row = $query -> fetch();

    if ($row) {
      return true;
    }

    return false;
  }

  // Esta función genera mensajes de error ($tipoDeMensaje = error), avisos ($tipoDeMensaje = warning), información($tipoDeMensaje = info) y exito ($tipoDeMensaje = success)

  function notificacion($texto, $tipoDeMensaje) {
    if ($tipoDeMensaje == "error") { $informacionTipoDeMensaje = "¡ERROR!";}
    if ($tipoDeMensaje == "warning") { $informacionTipoDeMensaje = "¡ATENCIÓN!";}
    if ($tipoDeMensaje == "info") { $informacionTipoDeMensaje = "Información:";}
    if ($tipoDeMensaje == "success") { $informacionTipoDeMensaje = "¡Éxito!";}
    echo 
    '<div class="alert '.$tipoDeMensaje.'">
    <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
    <strong>'.$informacionTipoDeMensaje.'</strong> '.$texto.'
    </div>';
  }

  // Esta funcion recupera las razas de la BBDD

    function recuperarRazasBBDD(){
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

  // Esta funcion recupera las clases de la BBDD

  function recuperarClasesBBDD(){
    $pdo = accesoBBDD();
    $query = $pdo->prepare("select * from clases;");

    $query -> execute();
    $rows = $query -> fetchAll();
    ?> <script> var clases = {}; <?php 
    foreach ($rows as $row) {
        ?>
          clases["<?php echo $row["nombre"]?>"] = {
            "nombre"                  : "<?php echo $row["nombre"];?>",
            "dg"                      : "<?php echo $row["DG"];?>",
            "caracteristicaPrimaria1" : "<?php echo $row["caracteristicaPrimaria1"];?>",
            "caracteristicaPrimaria2" : "<?php echo $row["caracteristicaPrimaria2"];?>",
            "competenciaSalvacion1"   : "<?php echo $row["competenciaSalvacion1"];?>",
            "competenciaSalvacion2"   : "<?php echo $row["competenciaSalvacion2"];?>",
          };

        <?php
    }
    ?> </script> <?php 
  }

  ?>

