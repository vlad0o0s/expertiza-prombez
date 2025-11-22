<?php
/**
 * Редактирование ЭПБ
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/epb-functions.php';

$pageTitle = 'Редактировать ЭПБ - Админ-панель';
$currentPage = 'epb';

$pdo = getDBConnection();
$error = '';
$epb = null;

$id = $_GET['id'] ?? 0;

if (!$id) {
    header('Location: /admin/epb');
    exit;
}

// Получаем ЭПБ
$epb = getEpbById($id);

if (!$epb) {
    header('Location: /admin/epb');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $hero_content = $_POST['hero_content'] ?? '';
    $features_content = $_POST['features_content'] ?? '';
    $hero_image = trim($_POST['hero_image'] ?? '');
    $published = 1; // Всегда публикуем сразу
    
    // Обработка загрузки изображения
    if (isset($_FILES['hero_image_file']) && $_FILES['hero_image_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../uploads/epb/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $file = $_FILES['hero_image_file'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (in_array($file['type'], $allowedTypes) && in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $filepath = $uploadDir . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $filepath)) {
                $hero_image = '/uploads/epb/' . $filename;
            }
        }
    }
    
    if (empty($title) || empty($slug) || empty($hero_content) || empty($features_content)) {
        $error = 'Заполните все обязательные поля';
    } else {
        // Проверяем уникальность slug (кроме текущей ЭПБ)
        $stmt = $pdo->prepare("SELECT id FROM epb WHERE slug = ? AND id != ?");
        $stmt->execute([$slug, $id]);
        if ($stmt->fetch()) {
            $error = 'ЭПБ с таким URL уже существует';
        } else {
            try {
                $stmt = $pdo->prepare("UPDATE epb SET title = ?, slug = ?, category = ?, hero_content = ?, features_content = ?, hero_image = ?, published = ?, updated_at = NOW() WHERE id = ?");
                $stmt->execute([$title, $slug, $category ?: null, $hero_content, $features_content, $hero_image ?: null, $published, $id]);
                
                header('Location: /admin/epb?success=1');
                exit;
            } catch (PDOException $e) {
                $error = 'Ошибка при сохранении: ' . $e->getMessage();
            }
        }
    }
    
    // Обновляем данные ЭПБ для формы
    $epb = array_merge($epb, $_POST);
}

$pageTitle = 'Редактировать ЭПБ - Админ-панель';
$currentPage = 'epb';
include __DIR__ . '/../../includes/admin-header.php';
?>
    <script src="/admin/assets/tinymce/tinymce/js/tinymce/tinymce.min.js"></script>
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 30px;
        }
        
        .admin-content {
            background: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .admin-content h2 {
            color: #152333;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #152333;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #91A2B8;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #152333;
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-group small {
            display: block;
            color: #91A2B8;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .tooltip-icon {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #91A2B8;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            cursor: help;
            flex-shrink: 0;
        }
        
        .tooltip-icon:hover {
            background: #152333;
        }
        
        .tooltip-text {
            visibility: hidden;
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background: #152333;
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 400;
            white-space: normal;
            max-width: 300px;
            width: max-content;
            line-height: 1.5;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
            text-align: left;
        }
        
        .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid transparent;
            border-top-color: #152333;
        }
        
        .tooltip-icon:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        
        .drag-drop-zone {
            width: 100%;
            min-height: 150px;
            border: 2px dashed #91A2B8;
            border-radius: 5px;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .drag-drop-zone:hover {
            border-color: #152333;
            background: #f5f5f5;
        }
        
        .drag-drop-zone.drag-over {
            border-color: #152333;
            background: #e8f0fe;
        }
        
        .drag-drop-content {
            text-align: center;
            padding: 20px;
        }
        
        .drag-drop-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        
        .drag-drop-text {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .drag-drop-main-text {
            font-size: 16px;
            font-weight: 600;
            color: #152333;
        }
        
        .drag-drop-sub-text {
            font-size: 14px;
            color: #91A2B8;
        }
        
        .image-preview-wrapper {
            position: relative;
            display: inline-block;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .delete-image-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 36px;
            height: 36px;
            border-radius: 6px;
            background: rgba(230, 0, 18, 0.9);
            color: #ffffff;
            border: none;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 400;
            line-height: 1;
            padding: 0;
            transition: all 0.2s ease;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .delete-image-btn:hover {
            background: rgba(230, 0, 18, 1);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(230, 0, 18, 0.4);
        }
        
        .delete-image-btn:active {
            transform: scale(0.95);
        }
        
        .delete-image-btn span {
            display: block;
            line-height: 1;
        }
        
        .image-preview-wrapper:hover .delete-image-btn {
            display: flex;
        }
        
        .image-preview-wrapper:hover #hero_image_preview_img {
            opacity: 0.9;
        }
        
        #hero_image_preview_img {
            transition: opacity 0.2s ease;
        }
        
        .error-message {
            background: #ffe6e6;
            color: #e60012;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn-save, .btn-cancel {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .btn-save {
            background: #152333;
            color: #ffffff;
        }
        
        .btn-save:hover {
            background: #0a141c;
        }
        
        .btn-cancel {
            background: #91A2B8;
            color: #ffffff;
        }
        
        .btn-cancel:hover {
            background: #7a8fa8;
        }
    </style>
    
    <div class="admin-container">
        <div class="admin-content">
            <h2>Редактировать ЭПБ</h2>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">
                        Заголовок *
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Основной заголовок ЭПБ, который будет отображаться на странице. Обязательное поле.</span>
                        </span>
                    </label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($epb['title']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="slug">
                        URL (slug) *
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Уникальный URL-адрес ЭПБ (например: epb-podemnih-sooruzheniy-i-kranov). Используйте только латинские буквы, цифры и дефисы.</span>
                        </span>
                    </label>
                    <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($epb['slug']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="category">
                        Категория
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Категория ЭПБ (например: Э3, Э1, Э2 и т.д.). Можно оставить пустым.</span>
                        </span>
                    </label>
                    <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($epb['category'] ?? ''); ?>" placeholder="Например: Э3">
                </div>
                
                <div class="form-group">
                    <label for="hero_image">
                        Изображение
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Главное изображение ЭПБ, которое будет отображаться в hero-секции. Поддерживаются форматы: JPG, PNG, GIF, WebP. Перетащите файл сюда или нажмите для выбора.</span>
                        </span>
                    </label>
                    <input type="hidden" id="hero_image" name="hero_image" value="<?php echo htmlspecialchars($epb['hero_image'] ?? ''); ?>">
                    <div class="drag-drop-zone" id="hero_image_dropzone">
                        <input type="file" id="hero_image_file" name="hero_image_file" accept="image/*" style="display: none;" onchange="handleImageUpload(this, 'hero_image')">
                        <div class="drag-drop-content">
                            <div class="drag-drop-icon">📁</div>
                            <div class="drag-drop-text">
                                <span class="drag-drop-main-text">Перетащите изображение сюда</span>
                                <span class="drag-drop-sub-text">или нажмите для выбора файла</span>
                            </div>
                        </div>
                    </div>
                    <div id="hero_image_preview" style="margin-top: 10px; <?php echo !empty($epb['hero_image']) ? 'display: block;' : 'display: none;'; ?> position: relative;">
                        <div class="image-preview-wrapper">
                            <img id="hero_image_preview_img" src="<?php echo htmlspecialchars($epb['hero_image'] ?? ''); ?>" alt="Превью" style="max-width: 300px; max-height: 200px; border-radius: 5px; border: 1px solid #91A2B8; display: block;">
                            <button type="button" class="delete-image-btn" onclick="deleteImage('hero_image')" title="Удалить изображение">
                                <span>×</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="hero_content">
                        Первая часть контента (Hero) *
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Первая часть контента, которая будет отображаться в hero-секции вместе с изображением. Кнопка "ЗАКАЗАТЬ УСЛУГУ" будет автоматически добавлена после этого контента. Обязательное поле.</span>
                        </span>
                    </label>
                    <textarea id="hero_content" name="hero_content"><?php echo htmlspecialchars($epb['hero_content']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="features_content">
                        Вторая часть контента (Особенности) *
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Вторая часть контента, которая будет отображаться в секции "Особенности ЭПБ" на полную ширину. Обязательное поле.</span>
                        </span>
                    </label>
                    <textarea id="features_content" name="features_content"><?php echo htmlspecialchars($epb['features_content']); ?></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn-save">Сохранить</button>
                    <a href="/admin/epb" class="btn-cancel">Отмена</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Инициализация TinyMCE для обеих частей контента
        tinymce.init({
            selector: '#hero_content',
            height: 400,
            menubar: false,
            base_url: '/admin/assets/tinymce/tinymce/js/tinymce',
            suffix: '.min',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | link image | code | help',
            content_style: 'body { font-family: Montserrat, sans-serif; font-size: 14px; }',
            image_advtab: true,
            file_picker_types: 'image',
            automatic_uploads: true,
            images_upload_url: '/admin/articles/upload-image',
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
        
        tinymce.init({
            selector: '#features_content',
            height: 400,
            menubar: false,
            base_url: '/admin/assets/tinymce/tinymce/js/tinymce',
            suffix: '.min',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | link image | code | help',
            content_style: 'body { font-family: Montserrat, sans-serif; font-size: 14px; }',
            image_advtab: true,
            file_picker_types: 'image',
            automatic_uploads: true,
            images_upload_url: '/admin/articles/upload-image',
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
        
        // Обработка отправки формы - синхронизация TinyMCE и валидация
        document.querySelector('form').addEventListener('submit', function(e) {
            // Сохраняем содержимое редакторов в textarea
            if (tinymce.get('hero_content')) {
                tinymce.get('hero_content').save();
                
                const content = tinymce.get('hero_content').getContent();
                if (!content || content.trim() === '' || content === '<p></p>' || content === '<p><br></p>') {
                    e.preventDefault();
                    alert('Пожалуйста, заполните первую часть контента');
                    tinymce.get('hero_content').focus();
                    return false;
                }
            }
            
            if (tinymce.get('features_content')) {
                tinymce.get('features_content').save();
                
                const content = tinymce.get('features_content').getContent();
                if (!content || content.trim() === '' || content === '<p></p>' || content === '<p><br></p>') {
                    e.preventDefault();
                    alert('Пожалуйста, заполните вторую часть контента');
                    tinymce.get('features_content').focus();
                    return false;
                }
            }
        });
        
        // Обработка загрузки изображения
        function handleImageUpload(input, targetInputId) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('file', input.files[0]);
                
                fetch('/admin/articles/upload-image', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.location) {
                        document.getElementById(targetInputId).value = data.location;
                        const preview = document.getElementById(targetInputId + '_preview');
                        const previewImg = document.getElementById(targetInputId + '_preview_img');
                        const dropzone = document.getElementById('hero_image_dropzone');
                        if (preview && previewImg) {
                            previewImg.src = data.location;
                            preview.style.display = 'block';
                        }
                        // Скрываем dropzone после загрузки
                        if (dropzone) {
                            dropzone.style.display = 'none';
                        }
                    } else if (data.error) {
                        alert('Ошибка загрузки: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ошибка при загрузке изображения');
                });
            }
        }
        
        // Функция удаления изображения
        function deleteImage(inputId) {
            document.getElementById(inputId).value = '';
            const preview = document.getElementById(inputId + '_preview');
            const previewImg = document.getElementById(inputId + '_preview_img');
            const dropzone = document.getElementById('hero_image_dropzone');
            if (preview) {
                preview.style.display = 'none';
            }
            if (dropzone) {
                dropzone.style.display = 'flex';
            }
        }
        
        // Drag and Drop функционал
        const dropzone = document.getElementById('hero_image_dropzone');
        const fileInput = document.getElementById('hero_image_file');
        
        if (dropzone) {
            // Клик по зоне открывает выбор файла
            dropzone.addEventListener('click', function(e) {
                if (e.target !== fileInput) {
                    fileInput.click();
                }
            });
            
            // Предотвращаем стандартное поведение браузера
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('drag-over');
            });
            
            dropzone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('drag-over');
            });
            
            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('drag-over');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const file = files[0];
                    if (file.type.startsWith('image/')) {
                        // Создаем FileList для input
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                        
                        // Запускаем обработку загрузки
                        handleImageUpload(fileInput, 'hero_image');
                    } else {
                        alert('Пожалуйста, выберите файл изображения');
                    }
                }
            });
        }
        
        // Скрываем dropzone если есть изображение при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            const heroImageInput = document.getElementById('hero_image');
            const dropzone = document.getElementById('hero_image_dropzone');
            if (heroImageInput && heroImageInput.value && dropzone) {
                dropzone.style.display = 'none';
            }
        });
    </script>
</body>
</html>

