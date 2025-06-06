<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Portafolio - Desarrollador Web</title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/responsive.css">
</head>
<body>
    <header class="main-header">
        <nav class="nav-container">
            <div class="logo">
                <a href="<?php echo SITE_URL; ?>">Mi Portafolio</a>
            </div>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="<?php echo SITE_URL; ?>">Inicio</a></li>
                <li><a href="<?php echo SITE_URL; ?>/about.php">Sobre Mí</a></li>
                <li><a href="<?php echo SITE_URL; ?>/projects.php">Proyectos</a></li>
                <li><a href="<?php echo SITE_URL; ?>/contact.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>