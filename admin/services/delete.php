<?php
/**
 * Удаление услуги
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/services-functions.php';

$pdo = getDBConnection();

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/services');
    exit;
}

// Проверяем существование услуги
$service = getServiceById($id);
if (!$service) {
    header('Location: /admin/services');
    exit;
}

// Удаляем услугу (каскадное удаление дочерних услуг настроено в БД)
try {
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$id]);
    
    header('Location: /admin/services?deleted=1');
    exit;
} catch (PDOException $e) {
    error_log("Service deletion error: " . $e->getMessage());
    header('Location: /admin/services?error=1');
    exit;
}

