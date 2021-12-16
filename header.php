<header>
    <div class="header-flex">
        <a href="dashboard.php"><img src="imagenes/pagina/dnd.png" alt="logo de d&d"></a>
    </div>
	<nav>
        <ul>
            <li><a href="/index.php">Home</a></li>
            <li><a href="/dashboard.php">Dashboard</a></li>
            <li><a href="/crearPersonaje.php">Crear Ficha</a></li>
            <li><a href="/tusFichas.php">Tus Fichas</a></li>
            <?php
                session_start();
                if (isset($_SESSION["Nombre"])){
                    ?>
                        <li><a href="/logout.php">Logout</a></li>
                    <?php
                }
            ?>
            
        </ul>
    </nav>
	<div class="header-flex">
        <?php
            if (isset($_SESSION["Nombre"])){
                ?>
                    <p><?php echo $_SESSION['Nombre']; ?></p>
                <?php
            } else {
                ?>
                    <a href="/index.php">Log in</a>
                <?php
            }
        ?>
    </div>
</header>