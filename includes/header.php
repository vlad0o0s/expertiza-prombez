<?php
// Получение SEO конфигурации для текущей страницы
$seoKey = isset($page_key) ? $page_key : 'default';
$seo = isset($seoConfig[$seoKey]) ? $seoConfig[$seoKey] : $seoConfig['default'];

// Если на странице заданы $page_title или $page_description, они имеют приоритет
// но если их нет, используются значения из SEO конфига
$pageTitle = isset($page_title) ? $page_title : $seo['title'];
$pageDescription = isset($page_description) ? $page_description : $seo['description'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Fonts: Montserrat, Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    </noscript>
    
    <!-- SEO Meta Tags -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <?php if (isset($seo['keywords'])): ?>
    <meta name="keywords" content="<?php echo htmlspecialchars($seo['keywords']); ?>">
    <?php endif; ?>
    
    <!-- Canonical URL -->
    <?php if (isset($seo['canonical'])): ?>
    <link rel="canonical" href="<?php echo htmlspecialchars($seo['canonical']); ?>">
    <?php endif; ?>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($seo['og_title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo['og_description']); ?>">
    <meta property="og:type" content="<?php echo htmlspecialchars($seo['og_type']); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($seo['canonical'] ?? SITE_URL . $_SERVER['REQUEST_URI']); ?>">
    <?php if (isset($seo['og_image'])): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($seo['og_image']); ?>">
    <?php endif; ?>
    <meta property="og:site_name" content="<?php echo htmlspecialchars(SITE_NAME); ?>">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo['og_title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo['og_description']); ?>">
    <?php if (isset($seo['og_image'])): ?>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($seo['og_image']); ?>">
    <?php endif; ?>
    
    <!-- Schema.org Structured Data (JSON-LD) -->
    <?php if (isset($seo['schema_type'])): ?>
    <script type="application/ld+json">
    <?php
    // Передаем переменные в функцию для корректной работы
    $schemaData = $seo;
    $schemaData['page_title'] = $pageTitle;
    echo generateSchemaOrg($seo['schema_type'], $schemaData);
    ?>
    </script>
    <?php endif; ?>
    
    <!-- Основные стили -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/header-footer.css">
    <link rel="stylesheet" href="/assets/css/messages.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" 
          onerror="this.onerror=null; this.href='https://unpkg.com/swiper@11/swiper-bundle.min.css';">
    
    <!-- Дополнительные стили страницы (если есть) -->
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <header class="site-header">
        <div class="container-fluid">
            <div class="header-box">
                <div class="header-inner">
                    <div class="header-row">
                        <a class="logo" href="/">
                            <img src="/assets/images/logo.png" alt="<?php echo SITE_NAME; ?>">
                        </a>
                        <div class="site-name">ТОП ЭКСПЕРТ</div>
                        <nav class="main-nav header-menu">
                            <?php include_once __DIR__ . '/menu.php'; ?>
                            <ul>
                                <?php render_menu_items($menuItems); ?>
                            </ul>
                        </nav>
                        <div class="header-contacts">
                            <a href="tel:+74951270935">+ 7 495 127 09-35</a>
                            <a href="mailto:info@te-g.ru">info@te-g.ru</a>
                        </div>
                        <a class="header-btn" href="/sitemap.php">
                            <img class="icon-sitemap" src="/assets/images/iconSitemap.svg" alt="">
                            КАРТА САЙТА
                        </a>
                        <button class="mobile-menu-toggle" aria-label="Меню">
                            <img src="/assets/images/burgermenu.svg" alt="">
                        </button>
                    </div>
                    <div class="header-mobile-secondary">
                        <div class="header-contacts">
                            <a href="tel:+74951270935">+ 7 495 127 09-35</a>
                            <a href="mailto:info@te-g.ru">info@te-g.ru</a>
                        </div>
                        <a class="header-btn" href="/sitemap.php">
                            ЗАКАЗАТЬ УСЛУГУ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Мобильное модальное меню -->
    <div class="mobile-modal" aria-hidden="true">
        <div class="mobile-modal-content">
            <div class="mobile-modal-inner">
                <?php
                // Подключаем функцию рендеринга модального меню
                require_once __DIR__ . '/modal-menu-render.php';
                render_modal_menu();
                ?>
            </div>
        </div>
    </div>
