<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio');
define('SITE_URL', 'http://localhost/my_portfolio');

// Configuración de zona horaria
date_default_timezone_set('America/Mexico_City');

// Configuración de errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>