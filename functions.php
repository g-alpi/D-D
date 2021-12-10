<?php
function conectar
    function login(){ 
      if(!isset($_POST["Nombre"])){
                    
                    die();
                }
              try {
                $hostname = "localhost";
                $dbname = "dnd";
                $username = "edupedu";
                $pw = "edupedu1";
                $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
              } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
              }


              //preparem i executem la consulta
              $query = $pdo->prepare("select * FROM usuarios where login_usuario= :user and passwd= :password");

              $query->bindParam(':user', $_POST["Nombre"]);
              $query->bindParam(':password',$_POST["Contra"]);

              $query->execute();      


                //comprovo errors:
              $e= $query->errorInfo();
              if ($e[0]!='00000') {
                echo "\nPDO::errorInfo():\n";
                die("Error accedint a dades: " . $e[2]);
              }  
            

              //anem agafant les fileres d'amb una amb una
              $row = $query->fetch();

              if($row){
                  $_SESSION['Nombre'] = $_POST['Nombre'];
                  header('Location:dashboard.php');

              }else{
                echo "Login Incorrecto";
              }
              //eliminem els objectes per alliberar memòria 
              unset($pdo); 
              unset($query);
            }
            /* header('Location:dashboard.php');)*/
    //Función de registro de cuenta
    function registro(){
        if(!isset($_POST["nombre"])){
            die();
        }
      //connexió dins block try-catch:
      //  prova d'executar el contingut del try
      //  si falla executa el catch
      try {
        $hostname = "localhost";
        $dbname = "dnd";
        $username = "master";
        $pw = "Master1234";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
      } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
      }

      //encriptació de la contrasenya amb SHA256
      $encriptedPwd = hash("sha256", $_POST["contrasena"]);


      //preparem i executem la consulta
      $query = $pdo->prepare("insert into usuarios values(null, :user, :password, :correo)");

      $query->bindParam(':user', $_POST["contrasena"]);
      $query->bindParam(':password', $encriptedPwd);
      $query->bindParam(':correo', $_POST["correo"]);


      $query->execute();      


        //comprovo errors:
      $e= $query->errorInfo();
      if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error: " . $e[2]);
      }  


      //eliminem els objectes per alliberar memòria 
      unset($pdo); 
      unset($query);
    }
            ?>

