<?php
/**
 * Список ЭПБ в админ-панели
 */

require_once __DIR__ . '/../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/epb-functions.php';

$pdo = getDBConnection();

// Получаем список ЭПБ
try {
    $epbList = getAllEpb();
} catch (PDOException $e) {
    $epbList = [];
}

$pageTitle = 'ЭПБ - Админ-панель';
$currentPage = 'epb';
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
        
        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-family: inherit;
            margin-right: 5px;
        }
        
        .btn-edit {
            background: #91A2B8;
            color: #ffffff;
        }
        
        .btn-edit:hover {
            background: #7a8fa8;
        }
        
        .btn-delete {
            background: #e60012;
            color: #ffffff;
        }
        
        .btn-delete:hover {
            background: #cc0010;
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
            <h2>ЭПБ</h2>
            <a href="/admin/epb/create" class="btn-add">+ Создать ЭПБ</a>
        </div>
        
        <?php if (empty($epbList)): ?>
            <div class="empty-message">
                <p>ЭПБ пока нет. <a href="/admin/epb/create" style="color: #152333; text-decoration: underline;">Создайте первую запись</a></p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>URL</th>
                        <th>Категория</th>
                        <th>Статус</th>
                        <th>Создано</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($epbList as $epb): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($epb['id']); ?></td>
                            <td><?php echo htmlspecialchars($epb['title']); ?></td>
                            <td><?php echo htmlspecialchars($epb['slug']); ?></td>
                            <td><?php echo htmlspecialchars($epb['category'] ?? '-'); ?></td>
                            <td>
                                <span class="<?php echo $epb['published'] ? 'status-published' : 'status-draft'; ?>">
                                    <?php echo $epb['published'] ? 'Опубликовано' : 'Черновик'; ?>
                                </span>
                            </td>
                            <td><?php echo date('d.m.Y H:i', strtotime($epb['created_at'])); ?></td>
                            <td>
                                <a href="/admin/epb/edit?id=<?php echo $epb['id']; ?>" class="btn-edit">Редактировать</a>
                                <a href="/admin/epb/delete?id=<?php echo $epb['id']; ?>" class="btn-delete" onclick="return confirm('Вы уверены, что хотите удалить эту запись?');">Удалить</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

