<?php
/**
 * Общий заголовок для админ-панели
 */
$currentPage = $currentPage ?? '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Админ-панель'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f5f5;
        }
        
        .admin-header {
            background: #152333;
            color: #ffffff;
            padding: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .admin-header-top {
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-header h1 {
            font-size: 20px;
            font-weight: 700;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .admin-user span {
            font-size: 14px;
        }
        
        .btn-logout {
            padding: 8px 20px;
            background: #E60012;
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
        
        .btn-logout:hover {
            background: #cc0010;
        }
        
        .admin-nav {
            background: #0a141c;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .admin-nav-list {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .admin-nav-item {
            margin: 0;
        }
        
        .admin-nav-link {
            display: block;
            padding: 15px 25px;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.3s ease;
            border-bottom: 3px solid transparent;
        }
        
        .admin-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .admin-nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            border-bottom-color: #E60012;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="admin-header-top">
            <h1>Админ-панель</h1>
            <div class="admin-user">
                <span>Вы вошли как: <strong><?php echo htmlspecialchars(getAdminUsername()); ?></strong></span>
                <a href="/admin/logout" class="btn-logout">Выйти</a>
            </div>
        </div>
        <nav class="admin-nav">
            <ul class="admin-nav-list">
                <li class="admin-nav-item">
                    <a href="/admin/dashboard" class="admin-nav-link <?php echo $currentPage === 'dashboard' ? 'active' : ''; ?>">
                        Главная
                    </a>
                </li>
                       <li class="admin-nav-item">
                           <a href="/admin/articles" class="admin-nav-link <?php echo $currentPage === 'articles' ? 'active' : ''; ?>">
                               Статьи
                           </a>
                       </li>
                       <li class="admin-nav-item">
                           <a href="/admin/epb" class="admin-nav-link <?php echo $currentPage === 'epb' ? 'active' : ''; ?>">
                               ЭПБ
                           </a>
                       </li>
            </ul>
        </nav>
    </header>

