<?php
/**
 * Главная страница админ-панели
 */

require_once __DIR__ . '/../includes/admin-auth.php';
requireAdminAuth();

$pageTitle = 'Админ-панель - Главная';
$currentPage = 'dashboard';
include __DIR__ . '/../includes/admin-header.php';
?>
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
            margin-bottom: 20px;
        }
        
        .admin-content p {
            color: #91A2B8;
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
    
    <div class="admin-container">
        <div class="admin-content">
            <h2>Добро пожаловать в админ-панель!</h2>
            <p>Здесь будет размещена функциональность админ-панели.</p>
            
            <div style="margin-top: 30px; display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="/admin/articles" style="display: inline-block; padding: 12px 24px; background: #152333; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: 600;">
                    Управление статьями
                </a>
                <a href="/admin/epb" style="display: inline-block; padding: 12px 24px; background: #152333; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: 600;">
                    Управление ЭПБ
                </a>
            </div>
            
            <div style="margin-top: 20px;">
                <a href="/admin/logout" style="display: inline-block; padding: 8px 20px; background: #E60012; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: 600;">
                    Выйти
                </a>
            </div>
        </div>
    </div>
</body>
</html>

