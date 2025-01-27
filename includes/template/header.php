<?php

if(!isset($_SESSION)){
    session_start();
}
    $auth = $_SESSION['login'] ?? false;

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="preload" href="/build/css/app.css" as="style">
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="preload" href="/build/js/app.js" as="script">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menu Responsive">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="Boton Dark Mode" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>

                        <?php if($auth): ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
                
            </div> <!--.barra-->

            <?php echo $inicio ? '<h1>Venta de Casas y Departamentos Exclusivos</h1>' : ''; ?>
            
        </div>
    </header>