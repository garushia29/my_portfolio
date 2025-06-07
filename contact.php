<?php
require_once 'includes/header.php';
require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'libs/PHPMailer/Exception.php';
require_once 'libs/PHPMailer/PHPMailer.php';
require_once 'libs/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Guardar en la base de datos
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['subject'],
            $_POST['message']
        ]);

        // Enviar correo electrónico
        $mail = new PHPMailer(true);
        
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;
        $mail->CharSet = 'UTF-8';

        // Remitente y destinatario
        $mail->setFrom(SMTP_USER, SMTP_FROM_NAME);
        $mail->addAddress(SMTP_USER); // Te envías el correo a ti mismo

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto: ' . $_POST['subject'];
        $mail->Body = "<h2>Nuevo mensaje de contacto</h2>
                      <p><strong>Nombre:</strong> {$_POST['name']}</p>
                      <p><strong>Email:</strong> {$_POST['email']}</p>
                      <p><strong>Asunto:</strong> {$_POST['subject']}</p>
                      <p><strong>Mensaje:</strong></p>
                      <p>{$_POST['message']}</p>";

        $mail->send();
        $message = 'Mensaje enviado correctamente.';
        $messageType = 'success';
    } catch (Exception $e) {
        $message = 'Error al enviar el mensaje. Por favor, intente nuevamente.';
        $messageType = 'error';
    }
}
?>

<section class="contact-section">
    <h1 style="text-align: center;">Contactame</h1>
    <div class="contact-container">
        

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="contact-content">
            <!-- <div class="contact-info"> -->
                <div class="contact-map">
                    <div class="map-card">
                        <div class="card-header">
                            <h3>Aqui estoy!</h3>
                        </div>
                        <div id="map-container" class="map-container">
                            <div class="custom-marker">
                                <img src="assets/images/profile/jimmy.png" alt="Ubicación de Jimmy" class="marker-image">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Calle Mamoré #68</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>garushia29@gmail.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+59179378969</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Cochabamba, Bolivia</span>
                            </div>

                        </div>

                    </div>
                </div>
            <!-- </div> -->
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

    <script src="<?php echo SITE_URL; ?>/assets/js/map.js"></script>
</section>


<?php require_once 'includes/footer.php'; ?>