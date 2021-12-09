<header>
    <div class="header-flex">
        <a href="dashboard.php"><img src="imagenes/dnd.png" alt="logo de d&d"></a>
    </div>
	<nav>
        <ul>
            <li><a href="/index.php">Home</a></li>
            <li><a href="/dashboard.php">Dashboard</a></li>
        </ul>
    </nav>
	<div class="header-flex">
	    <p><?php session_start(); echo $_SESSION['Nombre'];?>Carlos</p>
	</div>
</header>