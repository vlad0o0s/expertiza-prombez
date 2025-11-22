<?php
/**
 * Создание новой статьи
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';

$pdo = getDBConnection();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = $_POST['content'] ?? '';
    $header_image = trim($_POST['header_image'] ?? '');
    $published = 1; // Всегда публикуем сразу
    
    // Обработка загрузки изображения заголовка
    if (isset($_FILES['header_image_file']) && $_FILES['header_image_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../uploads/articles/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $file = $_FILES['header_image_file'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (in_array($file['type'], $allowedTypes) && in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $filepath = $uploadDir . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $filepath)) {
                $header_image = '/uploads/articles/' . $filename;
            }
        }
    }
    
    // Генерируем slug из title, если не указан
    if (empty($slug) && !empty($title)) {
        $slug = transliterate($title);
    }
    
    if (empty($title)) {
        $error = 'Заполните заголовок статьи';
    } elseif (empty($slug)) {
        $error = 'Заполните URL (slug) статьи';
    } elseif (empty($content)) {
        $error = 'Заполните содержание статьи';
    } else {
        // Проверяем уникальность slug
        try {
            $stmt = $pdo->prepare("SELECT id FROM articles WHERE slug = ?");
            $stmt->execute([$slug]);
            if ($stmt->fetch()) {
                $error = 'Статья с таким URL уже существует';
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO articles (title, slug, category, excerpt, content, header_image, published, published_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                    $stmt->execute([$title, $slug, $category ?: null, $excerpt ?: null, $content, $header_image ?: null, $published]);
                    
                    header('Location: /admin/articles?success=1');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Ошибка при сохранении статьи: ' . $e->getMessage();
                    error_log("Article creation error: " . $e->getMessage());
                }
            }
        } catch (PDOException $e) {
            $error = 'Ошибка при проверке уникальности URL: ' . $e->getMessage();
            error_log("Article slug check error: " . $e->getMessage());
        }
    }
}

// Функция для транслитерации
function transliterate($text) {
    $translit = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
        'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'Ts', 'Ч' => 'Ch',
        'Ш' => 'Sh', 'Щ' => 'Sch', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
    ];
    
    $text = strtr($text, $translit);
    $text = preg_replace('/[^a-z0-9-]/i', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    
    return $text;
}

$pageTitle = 'Создать статью - Админ-панель';
$currentPage = 'articles';
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
            display: block;
            color: #152333;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-group input[type="text"],
        .form-group input[type="url"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #91A2B8;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
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
        
        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
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
        
        .image-preview-wrapper:hover #header_image_preview_img {
            opacity: 0.9;
        }
        
        #header_image_preview_img {
            transition: opacity 0.2s ease;
        }
        
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        
        .error-message {
            background: #ffe6e6;
            color: #e60012;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
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
            <h2>Создать статью</h2>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">
                        Заголовок *
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Основной заголовок статьи, который будет отображаться на странице. Обязательное поле.</span>
                        </span>
                    </label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="slug">
                        URL (slug) *
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Уникальный URL-адрес статьи (например: oboznacheniye-trass-polietilenovykh-gazoprovodov). Будет автоматически сгенерирован из заголовка, если оставить пустым. Используйте только латинские буквы, цифры и дефисы.</span>
                        </span>
                    </label>
                    <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>" required>
                    <small>Будет автоматически сгенерирован из заголовка, если оставить пустым</small>
                </div>
                
                <div class="form-group">
                    <label for="category">
                        Категория
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Категория статьи для фильтрации на странице со списком статей. Можно оставить пустым.</span>
                        </span>
                    </label>
                    <select id="category" name="category">
                        <option value="">Без категории</option>
                        <option value="metallurgy" <?php echo (isset($_POST['category']) && $_POST['category'] === 'metallurgy') ? 'selected' : ''; ?>>ЭПБ МАТАЛЛУРГИЧЕСКИХ ПРОИЗВОДСТВ</option>
                        <option value="energy" <?php echo (isset($_POST['category']) && $_POST['category'] === 'energy') ? 'selected' : ''; ?>>ЭПБ ЭНЕРГЕТИЧЕСКИХ УСТАНОВОК И КОТЛОВ</option>
                        <option value="coal" <?php echo (isset($_POST['category']) && $_POST['category'] === 'coal') ? 'selected' : ''; ?>>ЭПБ ОБЪЕКТОВ УГОЛЬНОЙ ПРОМЫШЛЕННОСТИ</option>
                        <option value="gas" <?php echo (isset($_POST['category']) && $_POST['category'] === 'gas') ? 'selected' : ''; ?>>ЭПБ ГАЗОВОГО ОБОРУДОВАНИЯ И ГАЗОПРОВОДОВ</option>
                        <option value="flammable" <?php echo (isset($_POST['category']) && $_POST['category'] === 'flammable') ? 'selected' : ''; ?>>ЭПБ ОБЪЕКТОВ С ГОРЮЧИМИ ЖИДКОСТЯМИ</option>
                        <option value="explosive" <?php echo (isset($_POST['category']) && $_POST['category'] === 'explosive') ? 'selected' : ''; ?>>ЭПБ ОБЪЕКТОВ СО ВЗЫВЧАТАМИ ВЕЩЕСТВАМИ</option>
                        <option value="hazardous" <?php echo (isset($_POST['category']) && $_POST['category'] === 'hazardous') ? 'selected' : ''; ?>>ЭПБ ОБЪЕКТОВ С ОПАСНЫМИ ВЕЩЕСТВАМИ</option>
                        <option value="pressure" <?php echo (isset($_POST['category']) && $_POST['category'] === 'pressure') ? 'selected' : ''; ?>>ЭПБ ОБОРУДОВАНИЯ, РАБОТАЮЩЕГО ПОД ДАВЛЕНИЕМ</option>
                        <option value="lifting" <?php echo (isset($_POST['category']) && $_POST['category'] === 'lifting') ? 'selected' : ''; ?>>ЭПБ ПОДЪЕМНЫХ СООРУЖЕНИЙ И КРАНОВ</option>
                        <option value="explosive-works" <?php echo (isset($_POST['category']) && $_POST['category'] === 'explosive-works') ? 'selected' : ''; ?>>ЭПБ ВЗРЫВНЫХ РАБОТ И МАТЕРИАЛОВ</option>
                        <option value="oil-refining" <?php echo (isset($_POST['category']) && $_POST['category'] === 'oil-refining') ? 'selected' : ''; ?>>ЭПБ НЕФТЕПЕРЕРАБАТЫВАЮЩИХ И НЕФТЕХИМИЧЕСКИХ ОБЪЕКТОВ</option>
                        <option value="mining" <?php echo (isset($_POST['category']) && $_POST['category'] === 'mining') ? 'selected' : ''; ?>>ЭПБ ГОРНОДОБЫВАЮЩИХ ОБЪЕКТОВ</option>
                        <option value="underground" <?php echo (isset($_POST['category']) && $_POST['category'] === 'underground') ? 'selected' : ''; ?>>ЭПБ ПОДЗЕМНЫХ ОБЪЕКТОВ И ТОННЕЛЕЙ</option>
                        <option value="pipelines" <?php echo (isset($_POST['category']) && $_POST['category'] === 'pipelines') ? 'selected' : ''; ?>>ЭПБ ТРУБО- ГАЗО- НЕФТЕ-ПРОДУКТО- АММИАКО- ПРОВОДОВ</option>
                        <option value="storage" <?php echo (isset($_POST['category']) && $_POST['category'] === 'storage') ? 'selected' : ''; ?>>ЭПБ ОБЪЕКТОВ ХРАНЕНИЯ НЕФТИ И ГАЗА</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="excerpt">
                        Краткое описание
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Краткое описание статьи, которое будет отображаться в списке статей и в превью. Необязательное поле.</span>
                        </span>
                    </label>
                    <textarea id="excerpt" name="excerpt"><?php echo htmlspecialchars($_POST['excerpt'] ?? ''); ?></textarea>
                    <small>Используется в списке статей и превью</small>
                </div>
                
                <div class="form-group">
                    <label for="header_image">
                        Изображение заголовка
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Главное изображение статьи, которое будет отображаться в шапке страницы статьи. Поддерживаются форматы: JPG, PNG, GIF, WebP. Рекомендуемый размер: 1280x407px. Перетащите файл сюда или нажмите для выбора.</span>
                        </span>
                    </label>
                    <input type="hidden" id="header_image" name="header_image" value="<?php echo htmlspecialchars($_POST['header_image'] ?? ''); ?>">
                    <div class="drag-drop-zone" id="header_image_dropzone">
                        <input type="file" id="header_image_file" name="header_image_file" accept="image/*" style="display: none;" onchange="handleImageUpload(this, 'header_image')">
                        <div class="drag-drop-content">
                            <div class="drag-drop-icon">📁</div>
                            <div class="drag-drop-text">
                                <span class="drag-drop-main-text">Перетащите изображение сюда</span>
                                <span class="drag-drop-sub-text">или нажмите для выбора файла</span>
                            </div>
                        </div>
                    </div>
                    <div id="header_image_preview" style="margin-top: 10px; display: none; position: relative;">
                        <div class="image-preview-wrapper">
                            <img id="header_image_preview_img" src="" alt="Превью" style="max-width: 300px; max-height: 200px; border-radius: 5px; border: 1px solid #91A2B8; display: block;">
                            <button type="button" class="delete-image-btn" onclick="deleteImage('header_image')" title="Удалить изображение">
                                <span>×</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="content">
                        Содержание статьи *
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Основной текст статьи. Используйте редактор для форматирования текста, добавления изображений, ссылок и других элементов. Обязательное поле.</span>
                        </span>
                    </label>
                    <textarea id="content" name="content"><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
                </div>
                
                
                <div class="form-actions">
                    <button type="submit" class="btn-save">Сохранить</button>
                    <a href="/admin/articles" class="btn-cancel">Отмена</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Автогенерация slug из title
        document.getElementById('title').addEventListener('input', function() {
            const slugInput = document.getElementById('slug');
            if (!slugInput.value || slugInput.dataset.manual !== 'true') {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[а-яё]/g, function(match) {
                        const map = {
                            'а':'a','б':'b','в':'v','г':'g','д':'d','е':'e','ё':'yo',
                            'ж':'zh','з':'z','и':'i','й':'y','к':'k','л':'l','м':'m',
                            'н':'n','о':'o','п':'p','р':'r','с':'s','т':'t','у':'u',
                            'ф':'f','х':'h','ц':'ts','ч':'ch','ш':'sh','щ':'sch',
                            'ъ':'','ы':'y','ь':'','э':'e','ю':'yu','я':'ya'
                        };
                        return map[match] || match;
                    })
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });
        
        document.getElementById('slug').addEventListener('input', function() {
            this.dataset.manual = 'true';
        });
        
        // Инициализация TinyMCE
        tinymce.init({
            selector: '#content',
            height: 500,
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
            // language: 'ru', // Раскомментируйте после добавления ru.js в langs/
            image_advtab: true,
            file_picker_types: 'image',
            automatic_uploads: true,
            images_upload_url: '/admin/articles/upload-image',
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            setup: function(editor) {
                // Убеждаемся, что содержимое синхронизируется с textarea перед отправкой формы
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
        
        // Обработка отправки формы - синхронизация TinyMCE и валидация
        document.querySelector('form').addEventListener('submit', function(e) {
            // Сохраняем содержимое редактора в textarea
            if (tinymce.get('content')) {
                tinymce.get('content').save();
                
                // Проверяем, что содержимое не пустое
                const content = tinymce.get('content').getContent();
                if (!content || content.trim() === '' || content === '<p></p>' || content === '<p><br></p>') {
                    e.preventDefault();
                    alert('Пожалуйста, заполните содержание статьи');
                    tinymce.get('content').focus();
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
                        const dropzone = document.getElementById('header_image_dropzone');
                        if (preview && previewImg) {
                            previewImg.src = data.location;
                            preview.style.display = 'block';
                        }
                        // Скрываем dropzone после загрузки
                        if (dropzone) {
                            dropzone.style.display = 'none';
                        }
                        // Обновляем превью
                        updateImagePreview();
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
        
        // Показ превью при загрузке существующего изображения
        const headerImageInput = document.getElementById('header_image');
        
        function updateImagePreview() {
            const dropzone = document.getElementById('header_image_dropzone');
            if (headerImageInput && headerImageInput.value) {
                const preview = document.getElementById('header_image_preview');
                const previewImg = document.getElementById('header_image_preview_img');
                if (preview && previewImg) {
                    previewImg.src = headerImageInput.value;
                    preview.style.display = 'block';
                }
                if (dropzone) {
                    dropzone.style.display = 'none';
                }
            } else {
                const preview = document.getElementById('header_image_preview');
                if (preview) {
                    preview.style.display = 'none';
                }
                if (dropzone) {
                    dropzone.style.display = 'flex';
                }
            }
        }
        
        // Функция удаления изображения
        function deleteImage(inputId) {
            document.getElementById(inputId).value = '';
            updateImagePreview();
        }
        
        // Обновляем превью при изменении значения
        headerImageInput.addEventListener('input', updateImagePreview);
        
        // Инициализация при загрузке
        updateImagePreview();
        
        // Обновляем превью после загрузки изображения
        const originalHandleImageUpload = handleImageUpload;
        handleImageUpload = function(input, targetInputId) {
            originalHandleImageUpload(input, targetInputId);
            setTimeout(updateImagePreview, 100);
        };
        
        // Drag and Drop функционал
        const dropzone = document.getElementById('header_image_dropzone');
        const fileInput = document.getElementById('header_image_file');
        
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
                        handleImageUpload(fileInput, 'header_image');
                    } else {
                        alert('Пожалуйста, выберите файл изображения');
                    }
                }
            });
        }
        
    </script>
</body>
</html>

