<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'expertiza-prombezopasnosti';

// Подключаем CSS для компонентов ДО header.php
$additional_css = [];
$breadcrumbs_css = '/components/breadcrumbs/component.css';
if (file_exists(__DIR__ . '/../components/breadcrumbs/component.css')) {
    $additional_css[] = $breadcrumbs_css;
}

$categories_css = '/components/categories-expertiza/component.css';
if (file_exists(__DIR__ . '/../components/categories-expertiza/component.css')) {
    $additional_css[] = $categories_css;
}

$company_banner_css = '/components/company-banner/component.css';
if (file_exists(__DIR__ . '/../components/company-banner/component.css')) {
    $additional_css[] = $company_banner_css;
}

$articles_css = '/components/articles/component.css';
if (file_exists(__DIR__ . '/../components/articles/component.css')) {
    $additional_css[] = $articles_css;
}

$clients_css = '/components/clients/component.css';
if (file_exists(__DIR__ . '/../components/clients/component.css')) {
    $additional_css[] = $clients_css;
}

$reviews_css = '/components/reviews/component.css';
if (file_exists(__DIR__ . '/../components/reviews/component.css')) {
    $additional_css[] = $reviews_css;
}

$faq_css = '/components/faq/component.css';
if (file_exists(__DIR__ . '/../components/faq/component.css')) {
    $additional_css[] = $faq_css;
}

$additional_js = [];

include __DIR__ . '/../includes/header.php';

?>

<main>
    <?php
    load_component('breadcrumbs', [
        'current_title' => 'Экспертизы промбезопасности'
    ]);

    load_component('categories-expertiza');
    ?>

    <div class="company-banner-wrapper">
        <?php load_component('company-banner'); ?>
    </div>

    <?php load_component('articles'); ?>

    <?php load_component('clients'); ?>

    <?php load_component('reviews'); ?>

    <?php load_component('faq'); ?>

    <style>
        .company-banner-wrapper {
            padding: 0 100px;
        }

        @media (max-width: 768px) {
            .company-banner-wrapper {
                padding: 0;
            }
        }
    </style>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>