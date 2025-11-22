<?php
/**
 * Загрузка изображений для TinyMCE и форм статей
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Проверка на ошибки загрузки
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['error' => 'Ошибка загрузки файла: ' . $file['error']]);
        exit;
    }
    
    // Проверка типа файла
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (!in_array($file['type'], $allowedTypes) || !in_array($extension, $allowedExtensions)) {
        echo json_encode(['error' => 'Недопустимый тип файла. Разрешены: JPG, PNG, GIF, WEBP']);
        exit;
    }
    
    // Проверка размера (макс 10MB)
    if ($file['size'] > 10 * 1024 * 1024) {
        echo json_encode(['error' => 'Файл слишком большой. Максимальный размер: 10MB']);
        exit;
    }
    
    // Создаем директорию для загрузок, если её нет
    $uploadDir = __DIR__ . '/../../uploads/articles/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            echo json_encode(['error' => 'Не удалось создать директорию для загрузок']);
            exit;
        }
    }
    
    // Генерируем уникальное имя файла
    $filename = uniqid() . '_' . time() . '.' . $extension;
    $filepath = $uploadDir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        $url = '/uploads/articles/' . $filename;
        echo json_encode(['location' => $url]);
    } else {
        echo json_encode(['error' => 'Ошибка сохранения файла']);
    }
} else {
    echo json_encode(['error' => 'Файл не загружен']);
}

