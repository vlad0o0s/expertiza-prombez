<?php
/**
 * Обработка запросов коммерческого предложения
 * Адаптировано из public_html/sendmail.php
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/mail.php';

// Устанавливаем заголовки для JSON ответа
header('Content-Type: application/json; charset=utf-8');

// Проверка метода запроса
$requestMethod = $_SERVER["REQUEST_METHOD"] ?? '';

// Для отладки - логируем метод запроса
error_log("Sendmail request method: " . $requestMethod);

if (strtoupper($requestMethod) === "POST") {

    // --- Проверка reCAPTCHA (если используется) ---
    // $recaptchaSecret = '6LfLuBsrAAAAAHrQLWjQ5XQtVYrBtfQSLTRzGu1x'; // Замените на ваш секретный ключ
    // $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

    // if (!empty($recaptchaResponse)) {
    //     $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
    //     $captchaSuccess = json_decode($verify);

    //     if (!$captchaSuccess->success) {
    //         http_response_code(403);
    //         header('Content-Type: application/json; charset=utf-8');
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Пожалуйста, подтвердите, что вы не робот.'
    //         ], JSON_UNESCAPED_UNICODE);
    //         exit;
    //     }
    // }
    // ---------------------------

    $formName = isset($_POST['form_name']) ? $_POST['form_name'] : "Запрос коммерческого предложения";
    
    // Собираем данные из формы
    $message = "<html><head><meta charset='UTF-8'></head><body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>";
    $message .= "<h2 style='color: #152333;'>Новая заявка: " . htmlspecialchars($formName) . "</h2>";
    $message .= "<hr style='margin: 20px 0; border: none; border-top: 1px solid #eee;'>";
    
    foreach ($_POST as $key => $value) {
        if ($key !== 'form_name' && $key !== 'g-recaptcha-response') {
            $label = str_replace('_', ' ', $key);
            $label = ucfirst($label);
            $message .= "<p><strong>" . htmlspecialchars($label) . ":</strong> " . nl2br(htmlspecialchars($value)) . "</p>";
        }
    }
    
    $message .= "<hr style='margin: 20px 0; border: none; border-top: 1px solid #eee;'>";
    $message .= "<p style='color: #666; font-size: 12px;'>Дата отправки: " . date('d.m.Y H:i:s') . "</p>";
    $message .= "</body></html>";

    // Обработка файлов
    $files = [];
    $userName = isset($_POST['ФИО']) ? preg_replace('/[^a-zA-Zа-яА-Я0-9_]/u', '_', $_POST['ФИО']) : 'Без_имени';

    if (isset($_FILES['pdf_files']) && is_array($_FILES['pdf_files']['name'])) {
        $fileCount = count($_FILES['pdf_files']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['pdf_files']['error'][$i] === 0) {
                $file_tmp = $_FILES['pdf_files']['tmp_name'][$i];
                $original_name = basename($_FILES['pdf_files']['name'][$i]);
                
                // Проверка размера файла (максимум 10Мб)
                $file_size = $_FILES['pdf_files']['size'][$i];
                if ($file_size > 10 * 1024 * 1024) {
                    continue; // Пропускаем файл, если он больше 10Мб
                }

                // Уникальное имя файла
                $timestamp = date('d-m-Y_H-i-s');
                $extension = pathinfo($original_name, PATHINFO_EXTENSION);
                $new_name = $userName . '_' . $timestamp . '_' . $i . '.' . $extension;

                $upload_dir = __DIR__ . "/uploads/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $file_path = $upload_dir . $new_name;
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $files[] = $file_path;
                }
            }
        }
    }

    // Отправка письма через MailSender
    try {
        if (!class_exists('MailSender')) {
            throw new Exception('Класс MailSender не найден. Проверьте подключение config/mail.php');
        }
        
        $mailSender = new MailSender();
        
        if (!defined('SMTP_TO_EMAIL')) {
            throw new Exception('Константа SMTP_TO_EMAIL не определена. Проверьте config/config.php');
        }
        
        $subject = "Новая заявка с сайта: " . htmlspecialchars($formName);
        
        if ($mailSender->send(SMTP_TO_EMAIL, $subject, $message, $files)) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Заявка успешно отправлена!'
            ], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Ошибка отправки письма. Попробуйте позже.'
            ], JSON_UNESCAPED_UNICODE);
            error_log("Ошибка отправки письма через MailSender");
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка отправки: ' . htmlspecialchars($e->getMessage())
        ], JSON_UNESCAPED_UNICODE);
        error_log("Ошибка отправки формы коммерческого предложения: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
    }
} else {
    // Если это прямой доступ к файлу (GET), показываем более понятное сообщение
    if (strtoupper($requestMethod) === 'GET') {
        http_response_code(405); // Method Not Allowed
        echo json_encode([
            'success' => false,
            'message' => 'Прямой доступ к этому файлу запрещен. Используйте форму на сайте.'
        ], JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'Доступ запрещен. Метод запроса: ' . htmlspecialchars($requestMethod) . '. Ожидается POST.'
        ], JSON_UNESCAPED_UNICODE);
    }
    error_log("Sendmail: Access denied. Method: " . $requestMethod);
}
?>

