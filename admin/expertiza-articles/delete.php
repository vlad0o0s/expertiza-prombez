<?php
/**
 * Удаление статьи экспертизы
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';

$pdo = getDBConnection();
$id = $_GET['id'] ?? 0;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM expertiza_articles WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        error_log("Expertiza article deletion error: " . $e->getMessage());
    }
}

header('Location: /admin/expertiza-articles');
exit;

