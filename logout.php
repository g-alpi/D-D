<?php
    session_start();
    unset($_SESSION['Nombre']);
    unset($_SESSION["IDUsuario"]);
    header('Location: index.php');
?>