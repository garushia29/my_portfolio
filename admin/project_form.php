<?php
require_once 'check_session.php';
require_once '../includes/db.php';

$db = new Database();
$conn = $db->getConnection();

$project = [
    'title' => '',
    'description' => '',
    'technologies' => '',
    'project_url' => '',
    'github_url' => '',
    'image_url' => ''
];

// Si es edición, cargar datos del proyecto
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejar la subida de imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "../assets/images/projects/";
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $project['image_url'] = "assets/images/projects/" . $new_filename;
        }
    }

    // Actualizar o insertar proyecto
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, technologies = ?, project_url = ?, github_url = ?, image_url = ? WHERE id = ?");
        $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['technologies'],
            $_POST['project_url'],
            $_POST['github_url'],
            $project['image_url'],
            $_GET['id']
        ]);
    } else {
        $stmt = $conn->prepare("INSERT INTO projects (title, description, technologies, project_url, github_url, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['technologies'],
            $_POST['project_url'],
            $_POST['github_url'],
            $project['image_url']
        ]);
    }

    header('Location: projects.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_GET['id']) ? 'Editar' : 'Nuevo'; ?> Proyecto - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="admin-panel">
    <nav class="admin-nav">
        <!-- Mismo nav que index.php -->
    </nav>

    <main class="admin-main">
        <h2><?php echo isset($_GET['id']) ? 'Editar' : 'Nuevo'; ?> Proyecto</h2>

        <form class="admin-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="technologies">Tecnologías</label>
                <input type="text" id="technologies" name="technologies" value="<?php echo htmlspecialchars($project['technologies']); ?>" required>
            </div>

            <div class="form-group">
                <label for="project_url">URL del Proyecto</label>
                <input type="url" id="project_url" name="project_url" value="<?php echo htmlspecialchars($project['project_url']); ?>">
            </div>

            <div class="form-group">
                <label for="github_url">URL de GitHub</label>
                <input type="url" id="github_url" name="github_url" value="<?php echo htmlspecialchars($project['github_url']); ?>">
            </div>

            <div class="form-group">
                <label for="image">Imagen del Proyecto</label>
                <input type="file" id="image" name="image" accept="image/*">
                <?php if ($project['image_url']): ?>
                <p class="form-help">Imagen actual: <?php echo htmlspecialchars($project['image_url']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
                <a href="projects.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>