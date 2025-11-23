<?php
/**
 * API endpoint для получения дочерних категорий
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/expertiza-articles-functions.php';

header('Content-Type: application/json; charset=utf-8');

$parentId = intval($_GET['parent_id'] ?? 0);

if (!$parentId) {
    echo json_encode([]);
    exit;
}

$children = getChildArticleCategories($parentId);
echo json_encode($children, JSON_UNESCAPED_UNICODE);

