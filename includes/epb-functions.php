<?php
/**
 * Функции для работы с ЭПБ
 */

require_once __DIR__ . '/../config/database.php';

/**
 * Получить ЭПБ по slug
 */
function getEpbBySlug($slug) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM epb WHERE slug = ? AND published = 1");
            $stmt->execute([$slug]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $retryCount++;
            
            // Если это ошибка "MySQL server has gone away" и есть попытки
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    // Принудительно переподключаемся
                    $pdo = getDBConnection(true);
                    usleep(100000); // Небольшая задержка перед повтором (0.1 секунды)
                    continue;
                }
            }
            
            // Если это другая ошибка или закончились попытки
            error_log("Error in getEpbBySlug: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить список ЭПБ
 */
function getEpbList($limit = null) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            
            $sql = "SELECT * FROM epb WHERE published = 1 ORDER BY published_at DESC, created_at DESC";
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            // Если это ошибка "MySQL server has gone away" и есть попытки
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    // Принудительно переподключаемся
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getEpbList: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить все ЭПБ (для админки)
 */
function getAllEpb() {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM epb ORDER BY published_at DESC, created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getAllEpb: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить ЭПБ по ID (для админки)
 */
function getEpbById($id) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM epb WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getEpbById: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

