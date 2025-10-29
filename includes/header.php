<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Сайт экспертизы промбезопасности'; ?>">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?><?php echo SITE_NAME; ?></title>
    
    <!-- Основные стили -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/header-footer.css">
    <link rel="stylesheet" href="/assets/css/messages.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- Дополнительные стили страницы (если есть) -->
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="/">
                        <h1><?php echo SITE_NAME; ?></h1>
                    </a>
                </div>
                
                <nav class="main-nav">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/about.php">О нас</a></li>
                        <li><a href="/services.php">Услуги</a></li>
                        <li><a href="/contacts.php">Контакты</a></li>
                    </ul>
                </nav>
                
                <button class="mobile-menu-toggle" aria-label="Меню">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
        
        <nav class="mobile-menu">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/about.php">О нас</a></li>
                <li><a href="/services.php">Услуги</a></li>
                <li><a href="/contacts.php">Контакты</a></li>
            </ul>
        </nav>
    </header>
