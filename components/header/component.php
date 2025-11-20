<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/header/component.css">';
}
?>

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
                        <?php include_once __DIR__ . '/../../includes/menu.php'; ?>
                        <ul>
                            <?php render_menu_items($menuItems); ?>
                        </ul>
                    </nav>
                    <div class="header-contacts">
                        <a href="tel:+74951270935">+ 7 495 127 09-35</a>
                        <a href="mailto:info@te-g.ru">info@te-g.ru</a>
                    </div>
                    <a class="header-btn" href="/sitemap">
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
                    <a class="header-btn" href="/sitemap">
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
            require_once __DIR__ . '/../../includes/modal-menu-render.php';
            render_modal_menu();
            ?>
        </div>
    </div>
</div>

