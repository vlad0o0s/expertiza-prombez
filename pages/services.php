<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'services';

// Подключение CSS
$additional_css = [];
$additional_css[] = '/components/breadcrumbs/component.css';
$additional_css[] = '/components/services/component.css';
$additional_css[] = '/assets/css/index.css';

// Подключение JavaScript
$additional_js = [];
$additional_js[] = '/assets/js/index-animations.js';

include __DIR__ . '/../includes/header.php';
?>

<main>
    <?php
    load_component('breadcrumbs', [
        'items' => [
            ['title' => 'Главная', 'url' => '/'],
            ['title' => 'Услуги', 'url' => null]
        ]
    ]);
    ?>

    <?php load_component('services'); ?>

    <?php load_component('company-banner'); ?>

    <?php load_component('articles'); ?>

    <?php load_component('clients'); ?>

    <?php load_component('reviews'); ?>

    <?php load_component('faq'); ?>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

