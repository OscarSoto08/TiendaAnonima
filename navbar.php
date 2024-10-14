<?php 
session_start(); 
if(!isset($_SESSION["id"])){
    header("Location: iniciarSesion.php");
    exit(); // Asegúrate de salir después de redirigir
}
$id = $_SESSION["id"];
require ("logica/Persona.php");
require ("logica/Administrador.php");
$administrador = new Administrador($id);
$administrador->consultar();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="sesionAdministrador.php"><img src="img/logo2.png" width="50" alt="Logo" /></a>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Producto</a>
                    <ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='formularioProducto.php' id='nuevoProducto'>Nuevo Producto</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($administrador->getNombre() . " " . $administrador->getApellido()); ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='index.php?cerrarSesion=true'>Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>          
        </div>
    </div>
</nav>

<?php
// Si se cierra sesión, maneja la lógica aquí
if (isset($_GET['cerrarSesion']) && $_GET['cerrarSesion'] === 'true') {
    session_destroy();
    header("Location: iniciarSesion.php");
    exit();
}
?>
