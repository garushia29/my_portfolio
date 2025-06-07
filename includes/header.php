<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIMMY DEV</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/responsive.css">
</head>

<body>
    <header class="main-header">
        <nav class="nav-container">
            <div class="logo-container ">
                <img src="assets/images/profile/jimmy.png" alt="logo" class="logo-img">
                <a class="logo-text" href="<?php echo SITE_URL; ?>">JIMMY</a>
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
            <div class="social-icons">
                <a href="https://www.linkedin.com/in/jimmy-garcia-72707918a/" target="_blank" aria-label="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://github.com/garushia29" target="_blank" aria-label="GitHub">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://twitter.com/tu-usuario" target="_blank" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </nav>
    </header>
    <main>
</head>
</body>
</html>
