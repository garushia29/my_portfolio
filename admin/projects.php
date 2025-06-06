<?php
require_once 'check_session.php';
require_once '../includes/db.php';

$db = new Database();
$conn = $db->getConnection();

// Eliminar proyecto
if (isset($_POST['delete_project'])) {
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$_POST['project_id']]);
    header('Location: projects.php');
    exit;
}

// Obtener proyectos
$stmt = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</head>
<body class="admin-panel">
    <nav class="admin-nav">
        <!-- Mismo nav que index.php -->
    </nav>

    <main class="admin-main">
        <div class="admin-header">
            <h2>Gestión de Proyectos</h2>
            <a href="project_form.php" class="btn btn-primary">Nuevo Proyecto</a>
        </div>

        <div class="projects-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Tecnologías</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                        <td><?php echo htmlspecialchars($project['technologies']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($project['created_at'])); ?></td>
                        <td class="actions">
                            <a href="project_form.php?id=<?php echo $project['id']; ?>" class="btn btn-small btn-secondary">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?');">
                                <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                                <button type="submit" name="delete_project" class="btn btn-small btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>