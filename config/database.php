<?php
/**
 * Конфигурация базы данных
 */

define('DB_HOST', 'vadim007.beget.tech');
define('DB_NAME', 'vadim007_prombez');
define('DB_USER', 'vadim007_prombez');
define('DB_PASS', 'Izn4CJmkCh*i');
define('DB_CHARSET', 'utf8mb4');

/**
 * Подключение к базе данных с переподключением при ошибке
 * @param bool $forceReconnect Принудительное переподключение
 */
function getDBConnection($forceReconnect = false) {
    static $pdo_connection = null;
    
    // Если требуется принудительное переподключение, сбрасываем соединение
    if ($forceReconnect) {
        $pdo_connection = null;
    }
    
    // Проверяем, существует ли соединение и активно ли оно
    if ($pdo_connection !== null) {
        try {
            // Проверяем соединение простым запросом
            $pdo_connection->query("SELECT 1");
            return $pdo_connection;
        } catch (PDOException $e) {
            // Соединение разорвано, сбрасываем
            $pdo_connection = null;
        }
    }
    
    // Создаем новое соединение
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_PERSISTENT         => false, // Не используем persistent connections
            PDO::ATTR_TIMEOUT            => 5, // Таймаут подключения
        ];
        
        $pdo_connection = new PDO($dsn, DB_USER, DB_PASS, $options);
        
        // Устанавливаем таймауты для запросов
        $pdo_connection->exec("SET SESSION wait_timeout = 300");
        $pdo_connection->exec("SET SESSION interactive_timeout = 300");
        
        return $pdo_connection;
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage());
        $pdo_connection = null;
        die("Ошибка подключения к базе данных");
    }
}

