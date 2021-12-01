    <?php
    function login(){  
        if(!isset($_GET["userName"])){
            die();
        }
      try {
        $hostname = "localhost";
        $dbname = "d-d";
        $username = "dduser";
        $pw = "ddser123";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
      } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
      }


      //preparem i executem la consulta
      $query = $pdo->prepare("select * FROM encriptedUsers where username= :user and password= SHA2(:password,256)");

      $query->bindParam(':user', $_GET["userName"]);
      $query->bindParam(':password',$_GET["password"]);

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
          header('Location:dashboard.php')

      }else{
        echo "Login Incorrecto";
      }
      //eliminem els objectes per alliberar memòria 
      unset($pdo); 
      unset($query);
     
    ?>


