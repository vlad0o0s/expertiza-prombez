<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'stati';

// Подключаем CSS для компонентов ДО header.php
$additional_css = [];
// Подключение CSS с анимациями
$additional_css[] = '/assets/css/index.css';

$breadcrumbs_css = '/components/breadcrumbs/component.css';
if (file_exists(__DIR__ . '/../components/breadcrumbs/component.css')) {
    $additional_css[] = $breadcrumbs_css;
}

$categories_css = '/components/categories-expertiza/component.css';
if (file_exists(__DIR__ . '/../components/categories-expertiza/component.css')) {
    $additional_css[] = $categories_css;
}

$articles_filters_css = '/components/articles-filters/component.css';
if (file_exists(__DIR__ . '/../components/articles-filters/component.css')) {
    $additional_css[] = $articles_filters_css;
}

$articles_list_css = '/components/articles-list/component.css';
if (file_exists(__DIR__ . '/../components/articles-list/component.css')) {
    $additional_css[] = $articles_list_css;
}

$pagination_css = '/components/pagination/component.css';
if (file_exists(__DIR__ . '/../components/pagination/component.css')) {
    $additional_css[] = $pagination_css;
}

// Подключение JavaScript для анимаций
$additional_js = ['/assets/js/index-animations.js'];

include __DIR__ . '/../includes/header.php';

?>

<main>
    <?php
    load_component('breadcrumbs', [
        'current_title' => 'Статьи'
    ]);
    ?>
    
    <div class="categories-expertiza">
        <div class="container-fluid">
            <div class="categories-header">
                <div class="categories-title-row">
                    <h3 class="categories-main-title animate-on-scroll fade-in">НАШИ СТАТЬИ</h3>
                    <div class="categories-line animate-on-scroll delay-1"></div>
                    <h2 class="categories-subtitle animate-on-scroll delay-2">НОВОСТИ</h2>
                    <img src="/assets/images/polygon.svg" alt="" class="categories-icon animate-on-scroll delay-3">
                </div>
            </div>
        </div>
    </div>
    
    <?php load_component('articles-filters'); ?>
    
    <?php load_component('articles-list'); ?>
    
    <?php load_component('pagination'); ?>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>


