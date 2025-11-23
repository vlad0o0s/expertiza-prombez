<?php
/**
 * Удаление категории статей
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/expertiza-articles-functions.php';

$pdo = getDBConnection();

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/article-categories');
    exit;
}

// Проверяем существование категории
$category = getArticleCategoryById($id);
if (!$category) {
    header('Location: /admin/article-categories');
    exit;
}

// Удаляем категорию (каскадное удаление дочерних категорий и статей настроено в БД)
try {
    $stmt = $pdo->prepare("DELETE FROM article_categories WHERE id = ?");
    $stmt->execute([$id]);
    
    header('Location: /admin/article-categories?deleted=1');
    exit;
} catch (PDOException $e) {
    error_log("Article category deletion error: " . $e->getMessage());
    header('Location: /admin/article-categories?error=1');
    exit;
}

