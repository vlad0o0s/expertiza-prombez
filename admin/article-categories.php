<?php
/**
 * Список категорий статей в админ-панели
 */

require_once __DIR__ . '/../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/expertiza-articles-functions.php';

$pdo = getDBConnection();

// Получаем список категорий
try {
    $categories = getAllArticleCategories();
} catch (PDOException $e) {
    $categories = [];
}

$pageTitle = 'Категории статей - Админ-панель';
$currentPage = 'expertiza-articles';
include __DIR__ . '/../includes/admin-header.php';
?>
<style>
    .admin-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 30px;
    }

    .admin-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .admin-actions h2 {
        color: #152333;
        font-size: 24px;
        font-weight: 700;
    }

    .btn-add {
        padding: 12px 24px;
        background: #152333;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background 0.3s ease;
        font-family: inherit;
    }

    .btn-add:hover {
        background: #0a141c;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .admin-table thead {
        background: #152333;
        color: #ffffff;
    }

    .admin-table th {
        padding: 15px;
        text-align: left;
        font-size: 14px;
        font-weight: 600;
    }

    .admin-table td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        font-size: 14px;
        color: #152333;
    }

    .admin-table tbody tr:hover {
        background: #f5f5f5;
    }

    .admin-table tbody tr:last-child td {
        border-bottom: none;
    }

    .btn-edit,
    .btn-delete {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        font-family: inherit;
        margin-right: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .btn-edit::before,
    .btn-delete::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-edit:hover::before,
    .btn-delete:hover::before {
        left: 100%;
    }

    .btn-edit {
        background: linear-gradient(135deg, #91A2B8 0%, #7a8fa8 100%);
        color: #ffffff;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #7a8fa8 0%, #6a7f98 100%);
        box-shadow: 0 4px 8px rgba(145, 162, 184, 0.3);
        transform: translateY(-1px);
    }

    .btn-edit:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(145, 162, 184, 0.2);
    }

    .btn-delete {
        background: linear-gradient(135deg, #e60012 0%, #cc0010 100%);
        color: #ffffff;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #cc0010 0%, #b3000e 100%);
        box-shadow: 0 4px 8px rgba(230, 0, 18, 0.3);
        transform: translateY(-1px);
    }

    .btn-delete:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(230, 0, 18, 0.2);
    }

    .btn-delete svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        flex-shrink: 0;
    }

    .btn-delete {
        padding: 8px;
        min-width: 36px;
        justify-content: center;
    }

    .category-level {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        background: #e8f0fe;
        color: #152333;
    }

    .category-level.level-1 {
        background: #d4edda;
        color: #155724;
    }

    .category-level.level-2 {
        background: #fff3cd;
        color: #856404;
    }

    .category-level.level-3 {
        background: #d1ecf1;
        color: #0c5460;
    }

    .category-indent {
        padding-left: 20px;
    }

    .category-indent.level-2 {
        padding-left: 40px;
    }

    .category-indent.level-3 {
        padding-left: 60px;
    }

    .empty-message {
        text-align: center;
        padding: 40px;
        color: #91A2B8;
        font-size: 14px;
    }
</style>

<style>
    .tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        border-bottom: 2px solid #e0e0e0;
    }

    .tab {
        padding: 12px 24px;
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        color: #91A2B8;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .tab:hover {
        color: #152333;
    }

    .tab.active {
        color: #152333;
        border-bottom-color: #E60012;
    }
</style>

<div class="admin-container">
    <div class="tabs">
        <a href="/admin/expertiza-articles" class="tab">Статьи</a>
        <a href="/admin/article-categories" class="tab active">Категории</a>
    </div>

    <div class="admin-actions">
        <h2>Категории статей</h2>
        <a href="/admin/article-categories/create" class="btn-add">+ Создать категорию</a>
    </div>

    <?php if (empty($categories)): ?>
        <div class="empty-message">
            <p>Категории пока нет. <a href="/admin/article-categories/create"
                    style="color: #152333; text-decoration: underline;">Создайте первую категорию</a></p>
        </div>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>URL</th>
                    <th>Уровень</th>
                    <th>Родитель</th>
                    <th>Порядок</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Группируем категории по уровням для отображения
                $categoriesByLevel = [];
                foreach ($categories as $cat) {
                    $categoriesByLevel[$cat['level']][] = $cat;
                }

                // Выводим категории с отступами
                foreach ($categories as $category):
                    $indentClass = 'category-indent level-' . $category['level'];
                    $parentName = '-';
                    if ($category['parent_id']) {
                        $parent = getArticleCategoryById($category['parent_id']);
                        if ($parent) {
                            $parentName = htmlspecialchars($parent['name']);
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category['id']); ?></td>
                        <td class="<?php echo $indentClass; ?>"><?php echo htmlspecialchars($category['name']); ?></td>
                        <td><?php echo htmlspecialchars($category['slug']); ?></td>
                        <td>
                            <span class="category-level level-<?php echo $category['level']; ?>">
                                Уровень <?php echo $category['level']; ?>
                            </span>
                        </td>
                        <td><?php echo $parentName; ?></td>
                        <td><?php echo htmlspecialchars($category['sort_order']); ?></td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <a href="/admin/article-categories/edit?id=<?php echo $category['id']; ?>"
                                    class="btn-edit">Редактировать</a>
                                <a href="/admin/article-categories/delete?id=<?php echo $category['id']; ?>" class="btn-delete"
                                    onclick="return confirm('Вы уверены, что хотите удалить эту категорию? Все дочерние категории и статьи также будут удалены.');"
                                    title="Удалить">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>

</html>