<?php
/**
 * Создание новой категории статей
 */

require_once __DIR__ . '/../../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/expertiza-articles-functions.php';

$pdo = getDBConnection();
$error = '';

// Получаем список категорий для выбора родителя
$allCategories = getAllArticleCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : null;
    $level = intval($_POST['level'] ?? 1);
    $description = trim($_POST['description'] ?? '');
    $sort_order = intval($_POST['sort_order'] ?? 0);

    // Автоматически определяем уровень, если выбран родитель
    if ($parent_id) {
        $parent = getArticleCategoryById($parent_id);
        if ($parent) {
            $level = $parent['level'] + 1;
            if ($level > 3) {
                $error = 'Максимальный уровень категории - 3';
            }
        }
    }

    // Генерируем slug из name, если не указан
    if (empty($slug) && !empty($name)) {
        $slug = transliterate($name);
    }

    if (empty($name)) {
        $error = 'Заполните название категории';
    } elseif (empty($slug)) {
        $error = 'Заполните URL (slug)';
    } elseif ($level < 1 || $level > 3) {
        $error = 'Уровень категории должен быть от 1 до 3';
    } else {
        // Проверяем уникальность slug
        try {
            $stmt = $pdo->prepare("SELECT id FROM article_categories WHERE slug = ?");
            $stmt->execute([$slug]);
            if ($stmt->fetch()) {
                $error = 'Категория с таким URL уже существует';
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO article_categories (name, slug, parent_id, level, description, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $slug, $parent_id, $level, $description ?: null, $sort_order]);

                    header('Location: /admin/article-categories?success=1');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Ошибка при сохранении: ' . $e->getMessage();
                    error_log("Article category creation error: " . $e->getMessage());
                }
            }
        } catch (PDOException $e) {
            $error = 'Ошибка при проверке уникальности URL: ' . $e->getMessage();
            error_log("Article category slug check error: " . $e->getMessage());
        }
    }
}

// Функция для транслитерации
function transliterate($text)
{
    $translit = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'Yo',
        'Ж' => 'Zh',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'Y',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'Ts',
        'Ч' => 'Ch',
        'Ш' => 'Sh',
        'Щ' => 'Sch',
        'Ъ' => '',
        'Ы' => 'Y',
        'Ь' => '',
        'Э' => 'E',
        'Ю' => 'Yu',
        'Я' => 'Ya'
    ];

    $text = strtr($text, $translit);
    $text = preg_replace('/[^a-z0-9-]/i', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);

    return $text;
}

$pageTitle = 'Создать категорию - Админ-панель';
$currentPage = 'expertiza-articles';
include __DIR__ . '/../../includes/admin-header.php';
?>
<link rel="stylesheet" href="/admin/assets/admin-forms.css">
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
</style>

<div class="admin-container">
    <div class="admin-content">
        <h2>Создать категорию</h2>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Название категории *</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="slug">URL (slug) *</label>
                <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>"
                    required>
                <small>Будет автоматически сгенерирован из названия, если оставить пустым</small>
            </div>

            <div class="form-group">
                <label for="parent_id">Родительская категория</label>
                <select id="parent_id" name="parent_id">
                    <option value="">Нет (категория 1 уровня)</option>
                    <?php foreach ($allCategories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo (isset($_POST['parent_id']) && $_POST['parent_id'] == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?> (Уровень <?php echo $cat['level']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <small>Если выбран родитель, уровень будет автоматически определен</small>
            </div>

            <div class="form-group">
                <label for="level">Уровень категории *</label>
                <input type="number" id="level" name="level" min="1" max="3"
                    value="<?php echo htmlspecialchars($_POST['level'] ?? '1'); ?>" required>
                <small>Уровень от 1 до 3. Будет автоматически определен, если выбран родитель</small>
            </div>

            <div class="form-group">
                <label for="sort_order">Порядок сортировки</label>
                <input type="number" id="sort_order" name="sort_order"
                    value="<?php echo htmlspecialchars($_POST['sort_order'] ?? '0'); ?>">
                <small>Чем меньше число, тем выше в списке</small>
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea id="description"
                    name="description"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Сохранить</button>
                <a href="/admin/article-categories" class="btn-cancel">Отмена</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Автогенерация slug из name
    document.getElementById('name').addEventListener('input', function () {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.dataset.manual !== 'true') {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[а-яё]/g, function (match) {
                    const map = {
                        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo',
                        'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm',
                        'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u',
                        'ф': 'f', 'х': 'h', 'ц': 'ts', 'ч': 'ch', 'ш': 'sh', 'щ': 'sch',
                        'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya'
                    };
                    return map[match] || match;
                })
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        }
    });

    document.getElementById('slug').addEventListener('input', function () {
        this.dataset.manual = 'true';
    });

    // Автоматическое определение уровня при выборе родителя
    document.getElementById('parent_id').addEventListener('change', function () {
        const levelInput = document.getElementById('level');
        if (this.value) {
            // Уровень будет определен на сервере, но можно показать подсказку
            levelInput.disabled = true;
            levelInput.value = '?';
        } else {
            levelInput.disabled = false;
            if (levelInput.value === '?') {
                levelInput.value = '1';
            }
        }
    });
</script>
</body>

</html>