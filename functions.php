<?php
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
                echo '<div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                        <strong>ERROR!</strong> El nombre de usuario o la contraseña que has introducido no es correcto.
                      </div>';
              }
              //eliminem els objectes per alliberar memòria 
              unset($pdo); 
              unset($query);
            }
            ?>

<!--  header('Location:dashboard.php'); -->