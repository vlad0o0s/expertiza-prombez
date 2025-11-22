<?php
/**
 * Список статей в админ-панели
 */

require_once __DIR__ . '/../includes/admin-auth.php';
requireAdminAuth();

require_once __DIR__ . '/../config/database.php';

$pdo = getDBConnection();

// Получаем список статей
try {
    $stmt = $pdo->query("SELECT id, title, slug, category, published, created_at, updated_at FROM articles ORDER BY created_at DESC");
    $articles = $stmt->fetchAll();
} catch (PDOException $e) {
    $articles = [];
}

$pageTitle = 'Статьи - Админ-панель';
$currentPage = 'articles';
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
        
        .articles-table {
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #152333;
            color: #ffffff;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        th {
            font-weight: 600;
            font-size: 14px;
        }
        
        td {
            font-size: 14px;
            color: #152333;
        }
        
        tbody tr:hover {
            background: #f9f9f9;
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
            margin-right: 5px;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .btn-edit {
            background: #91A2B8;
            color: #ffffff;
        }
        
        .btn-edit:hover {
            background: #7a8fa8;
        }
        
        .btn-delete {
            background: #E60012;
            color: #ffffff;
        }
        
        .btn-delete:hover {
            background: #cc0010;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-published {
            background: #d4edda;
            color: #155724;
        }
        
        .status-draft {
            background: #fff3cd;
            color: #856404;
        }
    </style>
    
    <div class="admin-container">
        <div class="admin-actions">
            <h2>Статьи</h2>
            <a href="/admin/articles/create" class="btn-add">+ Добавить статью</a>
        </div>
        
        <div class="articles-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Категория</th>
                        <th>Статус</th>
                        <th>Дата создания</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($articles)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #91A2B8;">
                                Статьи не найдены. <a href="/admin/articles/create">Создать первую статью</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?php echo $article['id']; ?></td>
                                <td><?php echo htmlspecialchars($article['title']); ?></td>
                                <td><?php echo htmlspecialchars($article['category'] ?? 'Без категории'); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $article['published'] ? 'status-published' : 'status-draft'; ?>">
                                        <?php echo $article['published'] ? 'Опубликовано' : 'Черновик'; ?>
                                    </span>
                                </td>
                                <td><?php echo date('d.m.Y H:i', strtotime($article['created_at'])); ?></td>
                                <td>
                                    <a href="/admin/articles/edit?id=<?php echo $article['id']; ?>" class="btn-edit">Редактировать</a>
                                    <a href="/admin/articles/delete?id=<?php echo $article['id']; ?>" class="btn-delete" onclick="return confirm('Вы уверены, что хотите удалить эту статью?')">Удалить</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

