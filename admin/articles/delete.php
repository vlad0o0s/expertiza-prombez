<?php
/**
 * Удаление статьи
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';

$pdo = getDBConnection();
$id = $_GET['id'] ?? 0;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        // Ошибка удаления
    }
}

header('Location: /admin/articles');
exit;

