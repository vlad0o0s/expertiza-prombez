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

// Schema.org Organization Data (для структурированных данных)
define('ORG_NAME', 'Экспертиза Промбезопасность');
define('ORG_LEGAL_NAME', 'ООО "Экспертиза Промбезопасность"'); // Полное юридическое название
define('ORG_URL', 'http://expertiza-prombez.ru');
define('ORG_LOGO', SITE_URL . '/assets/images/logo.png');
define('ORG_DESCRIPTION', 'Профессиональная экспертиза промышленной безопасности');
define('ORG_EMAIL', 'info@expertiza-prombez.ru');
define('ORG_PHONE', '+7 (xxx) xxx-xx-xx');
define('ORG_ADDRESS_STREET', 'ул. Примерная, д. 1');
define('ORG_ADDRESS_CITY', 'Москва');
define('ORG_ADDRESS_COUNTRY', 'Россия');
define('ORG_ADDRESS_POSTAL_CODE', '123456');

// Подключение автозагрузки Composer
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
} else {
    // Composer зависимости не установлены
    // Запустите: composer install
    define('COMPOSER_NOT_INSTALLED', true);
}

// Подключение SEO конфигурации
$seoConfig = require __DIR__ . '/seo.php';

// Подключение функций для генерации Schema.org разметки
require_once __DIR__ . '/schema.php';
?>
