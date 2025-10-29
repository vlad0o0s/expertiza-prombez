<?php
// Базовая конфигурация сайта
define('SITE_NAME', 'Экспертиза Промбезопасность');
define('SITE_URL', 'http://expertiza-prombez.ru');

// Настройки SMTP для отправки писем
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_USERNAME', 'your_email@example.com');
define('SMTP_PASSWORD', 'your_password');
define('SMTP_PORT', 587);
define('SMTP_FROM_EMAIL', 'noreply@expertiza-prombez.ru');
define('SMTP_FROM_NAME', 'Экспертиза Промбезопасность');

// Подключение автозагрузки Composer
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
} else {
    // Composer зависимости не установлены
    // Запустите: composer install
    define('COMPOSER_NOT_INSTALLED', true);
}
?>
