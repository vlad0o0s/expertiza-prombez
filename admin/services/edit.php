<?php
/**
 * Редактирование услуги
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/services-functions.php';

$pdo = getDBConnection();
$error = '';
$service = null;

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/services');
    exit;
}

$service = getServiceById($id);
if (!$service) {
    header('Location: /admin/services');
    exit;
}

// Получаем список категорий для выбора
$allCategories = getServiceCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $category_id = !empty($_POST['category_id']) ? intval($_POST['category_id']) : null;
    $description = trim($_POST['description'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $hero_image = trim($_POST['hero_image'] ?? '');
    $equipment_list = trim($_POST['equipment_list'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $term = trim($_POST['term'] ?? '');
    $published = isset($_POST['published']) ? 1 : 0;

    // Генерируем slug из title, если не указан
    if (empty($slug) && !empty($title)) {
        $slug = transliterate($title);
    }

    if (empty($title)) {
        $error = 'Заполните название услуги';
    } elseif (empty($slug)) {
        $error = 'Заполните URL (slug)';
    } elseif (empty($category_id)) {
        $error = 'Выберите категорию';
    } else {
        // Проверяем уникальность slug (исключая текущую услугу)
        try {
            $stmt = $pdo->prepare("SELECT id FROM services WHERE slug = ? AND id != ?");
            $stmt->execute([$slug, $id]);
            if ($stmt->fetch()) {
                $error = 'Услуга с таким URL уже существует';
            } else {
                try {
                    $stmt = $pdo->prepare("UPDATE services SET title = ?, slug = ?, category_id = ?, description = ?, content = ?, hero_image = ?, equipment_list = ?, price = ?, term = ?, published = ? WHERE id = ?");
                    $stmt->execute([$title, $slug, $category_id, $description ?: null, $content ?: null, $hero_image ?: null, $equipment_list ?: null, $price ?: null, $term ?: null, $published, $id]);

                    header('Location: /admin/services?success=1');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Ошибка при сохранении: ' . $e->getMessage();
                    error_log("Service update error: " . $e->getMessage());
                }
            }
        } catch (PDOException $e) {
            $error = 'Ошибка при проверке уникальности URL: ' . $e->getMessage();
            error_log("Service slug check error: " . $e->getMessage());
        }
    }

    // Обновляем данные услуги для формы
    $service = array_merge($service, $_POST);
}

// Функция для транслитерации
function transliterate($text)
{
    $translit = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
        'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm',
        'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo',
        'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M',
        'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'H', 'Ц' => 'Ts', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
        'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
    ];

    $text = strtr($text, $translit);
    $text = preg_replace('/[^a-z0-9-]/i', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);

    return $text;
}

$pageTitle = 'Редактировать услугу - Админ-панель';
$currentPage = 'services';
include __DIR__ . '/../../includes/admin-header.php';
?>
<link rel="stylesheet" href="/admin/assets/admin-forms.css">
<script src="/admin/assets/tinymce/tinymce/js/tinymce/tinymce.min.js"></script>
<style>
    .admin-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 30px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
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
    }

    .delete-image-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e60012;
        color: #ffffff;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .delete-image-btn:hover {
        background: #cc0010;
        transform: scale(1.1);
    }

    .delete-image-btn span {
        line-height: 1;
    }
</style>

<div class="admin-container">
    <div class="admin-content">
        <h2>Редактировать услугу</h2>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="category_id">
                    Категория *
                    <span class="tooltip-icon">?
                        <span class="tooltip-text">Выберите категорию услуги из списка. Обязательное поле.</span>
                    </span>
                </label>
                <select id="category_id" name="category_id" required data-custom-select="false">
                    <option value="">Выберите категорию</option>
                    <?php foreach ($allCategories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" data-slug="<?php echo htmlspecialchars($cat['slug']); ?>" <?php echo ($service['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">
                    Название услуги *
                    <span class="tooltip-icon">?
                        <span class="tooltip-text">Название услуги. Обязательное поле.</span>
                    </span>
                </label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($service['title'] ?? ''); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="slug">
                    URL (slug) *
                    <span class="tooltip-icon">?
                        <span class="tooltip-text">Уникальный URL-адрес услуги. Используйте только латинские буквы, цифры и дефисы.</span>
                    </span>
                </label>
                <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($service['slug']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="description">
                    Описание
                    <span class="tooltip-icon">?
                        <span class="tooltip-text">Краткое описание услуги. Будет отображаться в карточке услуги и в начале страницы.</span>
                    </span>
                </label>
                <textarea id="description"
                    name="description"><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="content">
                    Содержание *
                    <span class="tooltip-icon">?
                        <span class="tooltip-text">Основной текст услуги. Используйте редактор для форматирования текста, добавления изображений, ссылок и других элементов. Обязательное поле.</span>
                    </span>
                </label>
                <textarea id="content" name="content"><?php echo htmlspecialchars($service['content'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="hero_image">
                    Изображение
                    <span class="tooltip-icon">?
                        <span class="tooltip-text">Главное изображение услуги, которое будет отображаться в шапке страницы. Поддерживаются форматы: JPG, PNG, GIF, WebP. Перетащите файл сюда или нажмите для выбора.</span>
                    </span>
                </label>
                <input type="hidden" id="hero_image" name="hero_image"
                    value="<?php echo htmlspecialchars($service['hero_image'] ?? ''); ?>">
                <div class="drag-drop-zone" id="hero_image_dropzone">
                    <input type="file" id="hero_image_file" name="hero_image_file" accept="image/*"
                        style="display: none;" onchange="handleImageUpload(this, 'hero_image')">
                    <div class="drag-drop-content">
                        <div class="drag-drop-icon">📁</div>
                        <div class="drag-drop-text">
                            <span class="drag-drop-main-text">Перетащите изображение сюда</span>
                            <span class="drag-drop-sub-text">или нажмите для выбора файла</span>
                        </div>
                    </div>
                </div>
                <div id="hero_image_preview" style="margin-top: 10px; display: none; position: relative;">
                    <div class="image-preview-wrapper">
                        <img id="hero_image_preview_img" src="" alt="Превью"
                            style="max-width: 300px; max-height: 200px; border-radius: 5px; border: 1px solid #91A2B8; display: block;">
                        <button type="button" class="delete-image-btn" onclick="deleteImage('hero_image')"
                            title="Удалить изображение">
                            <span>×</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Поля для лаборатории неразрушающего контроля -->
            <div id="lab-fields" style="display: none;">
                <div class="form-group">
                    <label for="equipment_list">
                        Список оборудования
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Список оборудования лаборатории. Каждый пункт с новой строки, можно начинать с "-".</span>
                        </span>
                    </label>
                    <textarea id="equipment_list" name="equipment_list" rows="8" placeholder="- аппараты рентгеновские импульсные&#10;- аппараты ультразвуковые&#10;- денситометры"><?php echo htmlspecialchars($service['equipment_list'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">
                        Стоимость экспертизы
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Например: от 17 000₽</span>
                        </span>
                    </label>
                    <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($service['price'] ?? 'от 17 000₽'); ?>" placeholder="от 17 000₽">
                </div>

                <div class="form-group">
                    <label for="term">
                        Сроки проведения
                        <span class="tooltip-icon">?
                            <span class="tooltip-text">Например: от 20 дней</span>
                        </span>
                    </label>
                    <input type="text" id="term" name="term" value="<?php echo htmlspecialchars($service['term'] ?? 'от 20 дней'); ?>" placeholder="от 20 дней">
                </div>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="published" value="1" <?php echo $service['published'] ? 'checked' : ''; ?>>
                    Опубликовано
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Сохранить</button>
                <a href="/admin/services" class="btn-cancel">Отмена</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('slug').addEventListener('input', function () {
        this.dataset.manual = 'true';
    });

    // Показываем/скрываем поля для лаборатории в зависимости от выбранной категории
    const categorySelect = document.getElementById('category_id');
    const labFields = document.getElementById('lab-fields');
    
    function toggleLabFields() {
        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
        const categorySlug = selectedOption.getAttribute('data-slug');
        if (categorySlug === 'laboratoriya-nerazrushayushchego-kontrolya') {
            labFields.style.display = 'block';
        } else {
            labFields.style.display = 'none';
        }
    }
    
    // Проверка по data-slug атрибуту
    categorySelect.addEventListener('change', function() {
        toggleLabFields();
    });
    
    // Проверяем при загрузке страницы
    toggleLabFields();

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
        image_advtab: true,
        file_picker_types: 'image',
        automatic_uploads: true,
        images_upload_url: '/admin/articles/upload-image',
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    // Обработка отправки формы - синхронизация TinyMCE и валидация
    document.querySelector('form').addEventListener('submit', function (e) {
        if (tinymce.get('content')) {
            tinymce.get('content').save();
            const content = tinymce.get('content').getContent();
            if (!content || content.trim() === '' || content === '<p></p>' || content === '<p><br></p>') {
                e.preventDefault();
                alert('Пожалуйста, заполните содержание услуги');
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
                        const dropzone = document.getElementById('hero_image_dropzone');
                        if (preview && previewImg) {
                            previewImg.src = data.location;
                            preview.style.display = 'block';
                        }
                        if (dropzone) {
                            dropzone.style.display = 'none';
                        }
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
    const heroImageInput = document.getElementById('hero_image');

    function updateImagePreview() {
        const dropzone = document.getElementById('hero_image_dropzone');
        if (heroImageInput && heroImageInput.value) {
            const preview = document.getElementById('hero_image_preview');
            const previewImg = document.getElementById('hero_image_preview_img');
            if (preview && previewImg) {
                previewImg.src = heroImageInput.value;
                preview.style.display = 'block';
            }
            if (dropzone) {
                dropzone.style.display = 'none';
            }
        } else {
            const preview = document.getElementById('hero_image_preview');
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
    if (heroImageInput) {
        heroImageInput.addEventListener('input', updateImagePreview);
        updateImagePreview();
    }

    // Drag and Drop функционал
    const dropzone = document.getElementById('hero_image_dropzone');
    const fileInput = document.getElementById('hero_image_file');

    if (dropzone && fileInput) {
        dropzone.addEventListener('click', function (e) {
            if (e.target !== fileInput) {
                fileInput.click();
            }
        });

        dropzone.addEventListener('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('drag-over');
        });

        dropzone.addEventListener('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('drag-over');
        });

        dropzone.addEventListener('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('drag-over');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    handleImageUpload(fileInput, 'hero_image');
                } else {
                    alert('Пожалуйста, выберите изображение');
                }
            }
        });
    }
</script>
</body>

</html>
