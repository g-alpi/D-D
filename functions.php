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
      $query = $pdo->prepare("select razas.id as idRaza, razas.nombre, razas.descripcion, razas.ruta_imagen, razas.incremento_estadistica, razas.estadistica_incrementada, razas.tamano, razas.velocidad, razas.vision, razaPadre.nombre as razaPadre 
      from razas 
      left join razas as razaPadre on razas.id_razaPadre = razaPadre.id;");

      $query -> execute();
      $rows = $query -> fetchAll();
      ?> <script> var razas = {}; <?php 
      foreach ($rows as $row) {
          ?>
            razas["<?php echo $row["nombre"]?>"] = {
              "idRaza"                    : "<?php echo $row["idRaza"];?>",
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
      ?> 
          <?php
            $queryTrasfondos = $pdo->prepare("select id, nombre,descripcion ,habilidad_adicional_1, habilidad_adicional_2 from trasfondos;");
            $queryTrasfondos -> execute();
            $rowsTrasfondos = $queryTrasfondos -> fetchAll();
            ?>
            var trasfondos= {};
            <?php
            foreach ($rowsTrasfondos as $rowTrasfondos) {
              ?>
              trasfondos["<?php echo $rowTrasfondos["nombre"]?>"]  ={
                "idTrasfondo"           : "<?php echo $rowTrasfondos["id"];?>",
                "descripcion"           : "<?php echo $rowTrasfondos["descripcion"];?>",
                "habilidad_adicional_1" : "<?php echo $rowTrasfondos["habilidad_adicional_1"];?>",
                "habilidad_adicional_2" : "<?php echo $rowTrasfondos["habilidad_adicional_2"];?>"
              };
              <?php
            }
          ?>
            var idiomas=[];
          <?php
            $queryIdiomas= $pdo -> prepare("select id, idioma  from idiomas;");
            $queryIdiomas -> execute();
            $rowsIdiomas = $queryIdiomas -> fetchAll();
            foreach ($rowsIdiomas as $rowIdiomas) {
              ?>
                idiomas.push([<?php echo $rowIdiomas["id"]?>, "<?php echo $rowIdiomas["idioma"]?>"]);
              <?php
            }
        ?> </script> <?php 
    }

  // Esta funcion recupera las clases de la BBDD

  function recuperarClasesBBDD(){
    $pdo = accesoBBDD();
    $query = $pdo->prepare("select clases.id as idClase, clases.nombre, clases.DG, clases.caracteristicaPrimaria1, clases.caracteristicaPrimaria2, clases.competenciaSalvacion1, clases.competenciaSalvacion2,
    clases.armaBase, clases.armaduraBase, clases.POInicial, armas.nombre as nombreArma, armaduras.nombre as nombreArmadura
    from clases
    left join armas on clases.armaBase = armas.id
    left join armaduras on clases.armaduraBase = armaduras.id;");

    $query -> execute();
    $rows = $query -> fetchAll();
    ?> <script> var clases = {}; <?php 
    foreach ($rows as $row) {
        ?>
          clases["<?php echo $row["nombre"]?>"] = {
            "id"                      : "<?php echo $row["idClase"]?>",
            "nombre"                  : "<?php echo $row["nombre"];?>",
            "dg"                      : "<?php echo $row["DG"];?>",
            "caracteristicaPrimaria1" : "<?php echo $row["caracteristicaPrimaria1"];?>",
            "caracteristicaPrimaria2" : "<?php echo $row["caracteristicaPrimaria2"];?>",
            "competenciaSalvacion1"   : "<?php echo $row["competenciaSalvacion1"];?>",
            "competenciaSalvacion2"   : "<?php echo $row["competenciaSalvacion2"];?>",
            "armaInicial"             : "<?php echo $row["nombreArma"];?>",
            "armaduraInicial"         : "<?php echo $row["nombreArmadura"];?>",
            "oroInicial"              : "<?php echo $row["POInicial"];?>"
          };

        <?php
    }
    ?> </script> <?php 
  }

  //Esta funcion cambia el Avatar del persnaje

  function cambiarAvatar($pdo,$id){
      $target_dir = "./imagenes/personajes/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


      $id=intval($id);
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
          notificacion("Solo se puede subir ficheros con los siguientes formatops: JPG, JPEG, PNG & GIF ",'warning');
      }
      elseif (file_exists($target_file)) {
          // notificacion('La imagen ya existe!','warning');
          $data = ['ruta' => $target_file,
                   'id' => $id];
          $update= $pdo -> prepare('update personajes  set ruta_imagen= :ruta where id=:id'); 
          $update-> execute($data);

      }
      if ($uploadOk == 0) {
          notificacion('La imagen no se a podido subir al servidor','error');
      // if everything is ok, try to upload file
      } 
      else if($uploadOk==1) {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              notificacion('La imagen se ha subido correctamente','success');
              $data = ['ruta' => $target_file,
                        'id' => $id];
              $update= $pdo -> prepare('update personajes  set ruta_imagen= :ruta where id=:id');
              $update-> execute($data);
              unset($_POST["personajeID"]);              

          } else {
              notificacion('La imagen no se a podido subir al servidor','error');
          }
      }
  }



  ?>

    </script>  <?php 

  // Esta funcion te devuelve todos los datos necesarios del personaje menos los idiomas

  function recuperarFicha($idPersonaje){
    $pdo = accesoBBDD();
    $query = $pdo->prepare("select personajes.nombre, personajes.fuerza, personajes.destreza, personajes.constitucion, personajes.inteligencia, personajes.sabiduria, personajes.carisma,
    razas.nombre as nombreRaza, razas.velocidad, clases.nombre as nombreClase, clases.dg, trasfondos.nombre as nombreTrasfondo, armas.nombre as nombreArma,
    armaduras.nombre as nombreArmadura, clases.POInicial, armaduras.ca, armaduras.MaximoDestreza
    from personajes
    inner join razas on personajes.raza = razas.id
    inner join clases on personajes.clase = clases.id
    inner join trasfondos on personajes.trasfondo = trasfondos.id
    inner join armas on clases.armaBase = armas.id
    inner join armaduras on clases.armaduraBase = armaduras.id
    where personajes.id = :id_personaje;");
    $query->bindParam(':id_personaje', $idPersonaje);
    $query -> execute();
    $rows = $query -> fetchAll();
    foreach ($rows as $row) {
      $personaje = array(
        "nombre"        => $row["nombre"],
        "trasfondo"     => $row["nombreTrasfondo"],
        "clase"         => $row["nombreClase"],
        "raza"          => $row["nombreRaza"],
        "fuerza"        => $row["fuerza"],
        "destreza"      => $row["destreza"],
        "constitucion"  => $row["constitucion"],
        "inteligencia"  => $row["inteligencia"],
        "sabiduria"     => $row["sabiduria"],
        "carisma"       => $row["carisma"],
        "velocidad"     => $row["velocidad"],
        "dg"            => $row["dg"],
        "po"            => $row["POInicial"],
        "arma"          => $row["nombreArma"],
        "armadura"      => $row["nombreArmadura"],
        "ca"            => $row["ca"],
        "maxDestreza"   => $row["MaximoDestreza"]
      );
    }
    return $personaje;
  }

  // Esta funcion devuelve los idiomas de un personaje

  function recuperarIdiomasPersonaje($idPersonaje) {
    $pdo = accesoBBDD();
    $query = $pdo->prepare("select idiomas.idioma
    from personajes
    inner join razas on personajes.raza = razas.id
    inner join razas_idiomas on razas.id_razaPadre = razas_idiomas.id_raza
    inner join idiomas on razas_idiomas.id_idioma = idiomas.id
    where personajes.id = :id_personaje
    union
    select idiomas.idioma
    from personajes
    inner join personajes_idiomas on personajes.id = personajes_idiomas.id_personaje
    inner join idiomas on idiomas.id = personajes_idiomas.id_idioma
    where personajes.id = :id_personaje;");
    $query->bindParam(':id_personaje', $idPersonaje);
    $query -> execute();
    $rows = $query -> fetchAll();
    $idiomas = array();
    foreach ($rows as $row) {
      array_push($idiomas, $row["idioma"]);
    }
    return $idiomas;
  }

  // Esta funcion devuelve el modificador de una estadistica

  function modificadorEstadistica($estadistica) {
    return round((($estadistica - 10)/2), 0, PHP_ROUND_HALF_DOWN);
  }

  // Esta funcion te devuelve el modificador de destreza maximo aplicable

  function maximoDestreza ($modificadorDestreza, $maximoDestreza) {
    if($modificadorDestreza < $maximoDestreza) {
      return $modificadorDestreza;
    }
    return $maximoDestreza;
  }