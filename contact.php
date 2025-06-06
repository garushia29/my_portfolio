<?php 
require_once 'includes/header.php';
require_once 'includes/db.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['subject'],
            $_POST['message']
        ]);
        
        $message = 'Mensaje enviado correctamente.';
        $messageType = 'success';
    } catch (PDOException $e) {
        $message = 'Error al enviar el mensaje. Por favor, intente nuevamente.';
        $messageType = 'error';
    }
}
?>

<section class="contact-section">
    <div class="contact-container">
        <h1>Contacto</h1>
        
        <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>

        <div class="contact-content">
            <div class="contact-info">
                <h2>Información de Contacto</h2>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>email@ejemplo.com</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <p>+1234567890</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Ciudad, País</p>
                </div>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="contact-form">
                <form method="POST" action="" id="contactForm">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>