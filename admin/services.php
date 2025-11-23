<?php
/**
 * Список услуг в админ-панели
 */

require_once __DIR__ . '/../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/services-functions.php';

$pdo = getDBConnection();

// Получаем список записей услуг
try {
    $services = getAllServices();
} catch (PDOException $e) {
    $services = [];
}

$pageTitle = 'Услуги - Админ-панель';
$currentPage = 'services';
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
    .btn-delete,
    .btn-add-subcategory,
    .btn-preview {
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
    }

    .btn-preview {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: #ffffff;
        padding: 8px;
        min-width: 36px;
        justify-content: center;
    }

    .btn-preview:hover {
        background: linear-gradient(135deg, #45a049 0%, #3d8b40 100%);
        box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        transform: translateY(-1px);
    }

    .btn-preview svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        flex-shrink: 0;
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

    .btn-add-subcategory {
        background: linear-gradient(135deg, #152333 0%, #0a141c 100%);
        color: #ffffff;
    }

    .btn-add-subcategory:hover {
        background: linear-gradient(135deg, #0a141c 0%, #152333 100%);
        box-shadow: 0 4px 8px rgba(21, 35, 51, 0.3);
        transform: translateY(-1px);
    }

    .btn-delete {
        background: linear-gradient(135deg, #e60012 0%, #cc0010 100%);
        color: #ffffff;
        padding: 8px;
        min-width: 36px;
        justify-content: center;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #cc0010 0%, #b3000e 100%);
        box-shadow: 0 4px 8px rgba(230, 0, 18, 0.3);
        transform: translateY(-1px);
    }

    .btn-delete svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        flex-shrink: 0;
    }

    .status-published {
        color: #155724;
        font-weight: 600;
    }

    .status-draft {
        color: #856404;
        font-weight: 600;
    }

    .empty-message {
        text-align: center;
        padding: 40px;
        color: #91A2B8;
        font-size: 14px;
    }

</style>

<div class="admin-container">
    <div class="admin-actions">
        <h2>Услуги</h2>
        <a href="/admin/services/create" class="btn-add">+ Создать услугу</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
            Услуга успешно сохранена!
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
            Услуга успешно удалена!
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
            Произошла ошибка при выполнении операции.
        </div>
    <?php endif; ?>

    <?php if (empty($services)): ?>
        <div class="empty-message">
            <p>Услуг пока нет. <a href="/admin/services/create"
                    style="color: #152333; text-decoration: underline;">Создайте первую услугу</a></p>
        </div>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>URL</th>
                    <th>Категория</th>
                    <th>Статус</th>
                    <th>Создано</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($service['id']); ?></td>
                        <td><strong><?php echo htmlspecialchars($service['title']); ?></strong></td>
                        <td><?php echo htmlspecialchars($service['slug']); ?></td>
                        <td><?php echo htmlspecialchars($service['category_name'] ?? '-'); ?></td>
                        <td>
                            <span class="<?php echo $service['published'] ? 'status-published' : 'status-draft'; ?>">
                                <?php echo $service['published'] ? 'Опубликовано' : 'Черновик'; ?>
                            </span>
                        </td>
                        <td><?php echo date('d.m.Y H:i', strtotime($service['created_at'])); ?></td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <?php if ($service['published']): ?>
                                <a href="/<?php echo htmlspecialchars($service['slug']); ?>" target="_blank" class="btn-preview" title="Предпросмотр">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                <a href="/admin/services/edit?id=<?php echo $service['id']; ?>"
                                    class="btn-edit">Редактировать</a>
                                <a href="/admin/services/delete?id=<?php echo $service['id']; ?>" class="btn-delete"
                                    onclick="return confirm('Вы уверены, что хотите удалить эту услугу?');" title="Удалить">
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

