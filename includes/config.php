<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio');
define('SITE_URL', 'http://localhost/my_portfolio');

// Configuración de zona horaria
date_default_timezone_set('America/La_Paz');

// Configuración de errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración del correo electrónico
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'garushia29@gmail.com'); // Tu correo
define('SMTP_PASS', ''); // Contraseña de aplicación de Gmail
define('SMTP_FROM_NAME', 'Jimmy Dev Portfolio');
?>