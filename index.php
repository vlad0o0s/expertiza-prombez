<?php
require_once 'config/config.php';
require_once 'includes/component-loader.php';
require_once 'config/mail.php';

// Указание ключа страницы для SEO (используется конфигурация из config/seo.php)
$page_key = 'index';

// Обработка формы обратного звонка
$form_sent = false;
$form_error = '';

// Обработка AJAX-запроса формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['phone'])) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $agree = isset($_POST['agree']) ? true : false;
    
    // Валидация
    if (empty($name) || empty($phone)) {
        $form_error = 'Заполните обязательные поля: имя и телефон';
    } elseif (!$agree) {
        $form_error = 'Необходимо согласие на обработку персональных данных';
    } else {
        try {
            $mailSender = new MailSender();
            
            $email_body = "
                <html>
                <head>
                    <meta charset='UTF-8'>
                </head>
                <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                    <h2 style='color: #152333;'>Новая заявка с формы обратного звонка</h2>
                    <p><strong>Имя:</strong> " . htmlspecialchars($name) . "</p>
                    <p><strong>Телефон:</strong> " . htmlspecialchars($phone) . "</p>
                    " . (!empty($comment) ? "<p><strong>Комментарий:</strong><br>" . nl2br(htmlspecialchars($comment)) . "</p>" : "") . "
                    <hr style='margin: 20px 0; border: none; border-top: 1px solid #eee;'>
                    <p style='color: #666; font-size: 12px;'>Дата отправки: " . date('d.m.Y H:i:s') . "</p>
                </body>
                </html>
            ";
            
            $subject = "Новая заявка с сайта: обратный звонок от " . htmlspecialchars($name);
            
            if ($mailSender->send(SMTP_TO_EMAIL, $subject, $email_body)) {
                $form_sent = true;
            } else {
                $form_error = 'Произошла ошибка при отправке сообщения. Попробуйте позже.';
            }
        } catch (Exception $e) {
            $form_error = 'Произошла ошибка при отправке сообщения. Попробуйте позже.';
            error_log("Ошибка отправки формы: " . $e->getMessage());
        }
    }
    
    // Если это AJAX-запрос, возвращаем JSON
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => $form_sent,
            'message' => $form_sent ? 'Ваше сообщение успешно отправлено. Мы свяжемся с вами в ближайшее время.' : $form_error
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// Подключение CSS для главной страницы (общие анимации)
$additional_css = ['/assets/css/index.css'];

// Подключение JavaScript для общих анимаций (анимации счетчиков и scroll-анимации)
// Остальные JS файлы (для форм, reviews, faq) подключаются автоматически через компоненты
$additional_js = [
    'https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js',
    '/assets/js/index-animations.js'
];

include 'includes/header.php';
?>

<main>
    <?php load_component('hero'); ?>
    <?php load_component('info-cards'); ?>
    <?php load_component('services'); ?>
    <?php load_component('company-banner'); ?>
    <?php load_component('why-choose-us'); ?>
    <?php load_component('contacts'); ?>
    <?php load_component('about-us'); ?>
    <?php load_component('reviews'); ?>
    <?php load_component('faq'); ?>
</main>

<?php include 'includes/footer.php'; ?>
