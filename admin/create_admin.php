<?php
require_once '../includes/config.php';
require_once '../includes/db.php';

// Verificar si ya existe un usuario administrador
$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->query("SELECT COUNT(*) FROM users");
$userCount = $stmt->fetchColumn();

if ($userCount > 0) {
    die("Ya existe un usuario administrador. Por seguridad, este script solo puede ejecutarse una vez.");
}

// Crear usuario administrador
$username = 'admin';
$password = 'admin123'; // Cambiar esta contraseña
$email = 'admin@example.com'; // Cambiar este email

// Hash de la contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario
try {
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password_hash, $email]);
    echo "Usuario administrador creado exitosamente.\n";
    echo "Username: " . $username . "\n";
    echo "Password: " . $password . "\n";
    echo "Email: " . $email . "\n";
    echo "\nPor favor, cambia estas credenciales inmediatamente después de iniciar sesión.";
} catch (PDOException $e) {
    die("Error al crear el usuario administrador: " . $e->getMessage());
}
?>