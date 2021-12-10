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
        echo "Login Incorrecto";
      } 
    }
?>