<?php
require_once 'check_session.php';
require_once '../includes/db.php';

$db = new Database();
$conn = $db->getConnection();

// Obtener estadísticas
$projectCount = $conn->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$messageCount = $conn->query("SELECT COUNT(*) FROM messages")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Mi Portafolio</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</head>
<body class="admin-panel">
    <nav class="admin-nav">
        <div class="admin-nav-header">
            <h1>Panel Admin</h1>
            <span class="user-info"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
        <ul class="admin-menu">
            <li><a href="index.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="projects.php"><i class="fas fa-project-diagram"></i> Proyectos</a></li>
            <li><a href="messages.php"><i class="fas fa-envelope"></i> Mensajes</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </nav>

    <main class="admin-main">
        <h2>Dashboard</h2>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Proyectos</h3>
                <p class="stat-number"><?php echo $projectCount; ?></p>
                <a href="projects.php" class="btn btn-primary">Gestionar Proyectos</a>
            </div>

            <div class="stat-card">
                <h3>Mensajes</h3>
                <p class="stat-number"><?php echo $messageCount; ?></p>
                <a href="messages.php" class="btn btn-primary">Ver Mensajes</a>
            </div>
        </div>
    </main>
</body>
</html>