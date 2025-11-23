<?php
/**
 * Функции для работы с услугами
 */

require_once __DIR__ . '/../config/database.php';

/**
 * Получить все категории услуг
 */
function getServiceCategories() {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM services_categories ORDER BY sort_order, name");
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
            
            error_log("Error in getServiceCategories: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить категорию услуги по ID
 */
function getServiceCategoryById($id) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM services_categories WHERE id = ?");
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
            
            error_log("Error in getServiceCategoryById: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить все записи услуг
 */
function getAllServices() {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("
                SELECT s.*, sc.name as category_name, sc.slug as category_slug 
                FROM services s 
                LEFT JOIN services_categories sc ON s.category_id = sc.id 
                ORDER BY s.created_at DESC
            ");
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
            
            error_log("Error in getAllServices: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить услугу по ID
 */
function getServiceById($id) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("
                SELECT s.*, sc.name as category_name, sc.slug as category_slug 
                FROM services s 
                LEFT JOIN services_categories sc ON s.category_id = sc.id 
                WHERE s.id = ?
            ");
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
            
            error_log("Error in getServiceById: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить услугу по slug
 */
function getServiceBySlug($slug) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("
                SELECT s.*, sc.name as category_name, sc.slug as category_slug 
                FROM services s 
                LEFT JOIN services_categories sc ON s.category_id = sc.id 
                WHERE s.slug = ? AND s.published = 1
            ");
            $stmt->execute([$slug]);
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
            
            error_log("Error in getServiceBySlug: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить услуги по категории
 */
function getServicesByCategory($categoryId) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("
                SELECT s.*, sc.name as category_name, sc.slug as category_slug 
                FROM services s 
                LEFT JOIN services_categories sc ON s.category_id = sc.id 
                WHERE s.category_id = ? AND s.published = 1
                ORDER BY s.created_at DESC
            ");
            $stmt->execute([$categoryId]);
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
            
            error_log("Error in getServicesByCategory: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}
