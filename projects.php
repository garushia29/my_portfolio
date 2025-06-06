<?php 
require_once 'includes/header.php';
require_once 'includes/db.php';

$db = new Database();
$conn = $db->getConnection();

// Obtener proyectos de la base de datos
$stmt = $conn->prepare("SELECT * FROM projects ORDER BY created_at DESC");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="projects-section">
    <div class="projects-container">
        <h1>Mis Proyectos</h1>
        
        <div class="projects-filter">
            <button class="filter-btn active" data-filter="all">Todos</button>
            <button class="filter-btn" data-filter="web">Web</button>
            <button class="filter-btn" data-filter="app">Aplicaciones</button>
            <button class="filter-btn" data-filter="design">Diseño</button>
        </div>

        <div class="projects-grid">
            <?php foreach ($projects as $project): ?>
            <div class="project-card" data-category="<?php echo htmlspecialchars($project['technologies']); ?>">
                <div class="project-image">
                    <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                </div>
                <div class="project-info">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                    <div class="project-links">
                        <?php if ($project['project_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['project_url']); ?>" class="btn btn-primary" target="_blank">Ver Proyecto</a>
                        <?php endif; ?>
                        <?php if ($project['github_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['github_url']); ?>" class="btn btn-secondary" target="_blank">Ver Código</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>