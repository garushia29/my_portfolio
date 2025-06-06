<?php
require_once 'check_session.php';
require_once '../includes/db.php';

$db = new Database();
$conn = $db->getConnection();

// Eliminar mensaje
if (isset($_POST['delete_message'])) {
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$_POST['message_id']]);
    header('Location: messages.php');
    exit;
}

// Marcar como leído/no leído
if (isset($_POST['toggle_read'])) {
    $stmt = $conn->prepare("UPDATE messages SET is_read = NOT is_read WHERE id = ?");
    $stmt->execute([$_POST['message_id']]);
    header('Location: messages.php');
    exit;
}

// Obtener mensajes
$stmt = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</head>
<body class="admin-panel">
    <nav class="admin-nav">
        <!-- Mismo nav que index.php -->
    </nav>

    <main class="admin-main">
        <h2>Mensajes Recibidos</h2>

        <div class="messages-container">
            <?php if (empty($messages)): ?>
            <p class="no-messages">No hay mensajes nuevos</p>
            <?php else: ?>
            <div class="messages-grid">
                <?php foreach ($messages as $message): ?>
                <div class="message-card <?php echo $message['is_read'] ? 'read' : 'unread'; ?>">
                    <div class="message-header">
                        <h3><?php echo htmlspecialchars($message['subject']); ?></h3>
                        <span class="message-date"><?php echo date('d/m/Y H:i', strtotime($message['created_at'])); ?></span>
                    </div>
                    <div class="message-info">
                        <p><strong>De:</strong> <?php echo htmlspecialchars($message['name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($message['email']); ?></p>
                    </div>
                    <div class="message-content">
                        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                    </div>
                    <div class="message-actions">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                            <button type="submit" name="toggle_read" class="btn btn-small btn-secondary">
                                <i class="fas <?php echo $message['is_read'] ? 'fa-envelope' : 'fa-envelope-open'; ?>"></i>
                                <?php echo $message['is_read'] ? 'Marcar como no leído' : 'Marcar como leído'; ?>
                            </button>
                        </form>
                        <form method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este mensaje?');">
                            <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                            <button type="submit" name="delete_message" class="btn btn-small btn-danger">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>