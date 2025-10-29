<?php
require_once 'config/config.php';
require_once 'config/mail.php';

$page_title = 'Контакты';
$page_description = 'Свяжитесь с нами для консультации по вопросам промышленной безопасности';

// Обработка формы обратной связи
$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message_text = trim($_POST['message'] ?? '');
    
    if ($name && $email && $message_text) {
        $mailSender = new MailSender();
        
        $email_body = "
            <h2>Новое сообщение с сайта</h2>
            <p><strong>Имя:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Телефон:</strong> {$phone}</p>
            <p><strong>Тема:</strong> {$subject}</p>
            <p><strong>Сообщение:</strong></p>
            <p>{$message_text}</p>
        ";
        
        if ($mailSender->send(SMTP_FROM_EMAIL, "Сообщение с сайта: {$subject}", $email_body)) {
            $message_sent = true;
        } else {
            $error_message = 'Произошла ошибка при отправке сообщения. Попробуйте позже.';
        }
    } else {
        $error_message = 'Заполните все обязательные поля.';
    }
}

include 'includes/header.php';
?>

<main class="section">
    <div class="container">
        <h1 class="section-title"><?php echo $page_title; ?></h1>
        
        <?php if ($message_sent): ?>
            <div class="message message-success" style="position: relative; margin-bottom: 2rem;">
                Спасибо! Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время.
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="message message-error" style="position: relative; margin-bottom: 2rem;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-6">
                <h2>Свяжитесь с нами</h2>
                <p>Заполните форму обратной связи, и мы обязательно вам ответим.</p>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label" for="name">Имя *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="phone">Телефон</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="subject">Тема сообщения</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="message">Сообщение *</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" name="send_message" class="btn btn-primary">Отправить сообщение</button>
                </form>
            </div>
            
            <div class="col-6">
                <h2>Контактная информация</h2>
                <p><strong>Email:</strong> info@expertiza-prombez.ru</p>
                <p><strong>Телефон:</strong> +7 (xxx) xxx-xx-xx</p>
                <p><strong>Адрес:</strong> г. Москва, ул. Примерная, д. 1</p>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
