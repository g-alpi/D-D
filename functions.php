<?php
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

    function login(){ 
      if(!isset($_POST["Nombre"])){
                    
                    die();
                }
          
              $pdo = accesoBBDD();

              //encriptació de la contrasenya amb SHA256
              $encriptedPwd = hash("sha256", $_POST["Contra"]);

              //preparem i executem la consulta
              $query = $pdo->prepare("select * FROM usuarios where usuario= :user and password= :password");

              $query->bindParam(':user', $_POST["Nombre"]);
              $query->bindParam(':password',$encriptedPwd);

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
            /* header('Location:dashboard.php');)*/
    //Función de registro de cuenta
    function registro(){
      /*
      if (!formularioLleno()) {
        echo '<div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>ERROR!</strong> Rellena todos los campos.
        </div>';
        die();
      }
      */
      $pdo = accesoBBDD();

      //Usamos la funcion para verificar que las dos contraseñas son iguales.
      if(!verificarContrasena()){
        unset($pdo); 
        unset($query);
       die(); 
      }


      //encriptació de la contrasenya amb SHA256
      $encriptedPwd = hash("sha256", $_POST["contrasena"]);
      
      //preparem i executem la consulta
      $query = $pdo->prepare("insert into usuarios values(null, :user, :password, :fecha, :correo)");

      $query->bindParam(':user', $_POST["nombre"]);
      $query->bindParam(':password', $encriptedPwd);
      $query->bindParam(':correo', $_POST["correo"]);
      $query->bindParam(':fecha',$_POST["fechaNatal"]);

      //Usamos la funcion para verificar que las dos contraseñas son iguales.
      $query->execute();      
        //Compruebo errores
      
      $e= $query->errorInfo();
      if ($e[0]!='00000') {
        echo '<div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>ERROR!</strong> PDO::errorInfo():';
        die("Error: " . $e[2]);
        echo'</div>';
        
      }  
      //eliminem els objectes per alliberar memòria 
      unset($pdo);
      unset($query);
      
    }
    //Funcion para verificar que el usuario ha sido creado
    function usuarioCreado($pdo ,$encriptedPwd){
      $query = $pdo->prepare("select from usuarios where usuario = ".$_POST["nombre"]. " AND password = ".$encriptedPwd);
      $query->execute();

      //Compruebo errores
      $e= $query->errorInfo();
      if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error: " . $e[2]);
      } 

      //Cogemos las filas una a una
      $row = $query->fetch();
      if($row){
        header('Location:dashboard');
      }
      else{
        echo '<div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>ERROR!</strong> Registro Incorrecto.
        </div>';
      }
    }
    //Formulario lleno
    function formularioLleno(){      
      if(isset($_POST['nombre'])){
        if(isset($_POST['contrasena'])){
          if(isset($_POST['correo'])){
            if(isset($_POST['fechaNatal'])){
              return true;
              echo"<p>Todo correcto</p>";
            }
            else{
              echo "<p>Fecha Vacia</p>";
              return false;
            }
          }
          else{
            echo "<p>Correo vacio</p>";
            return false;
          }
          
          }
        else{
          echo "<p>Contraseña vacia</p>";
          return false;
        }
      }
      else{
        echo "<p>Nombre vacio</p>";
        return false;
      }
    }


    //Funcion para verificar la contraseña
    function verificarContrasena(){
      $contrasena = $_POST['contrasena'];
      $confirmarContrasena = $_POST['confirmarContrasena'];
      if($confirmarContrasena != $contrasena){
        echo '<div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>ERROR!</strong> Las contraseñas no coinciden.
        </div>';
        return false;
      }
      else{
        return true;
      }
    }
  ?>

