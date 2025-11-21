<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'about';

// Подключение CSS
$additional_css = [];
$additional_css[] = '/components/breadcrumbs/component.css';
$additional_css[] = '/components/about-hero/component.css';
$additional_css[] = '/components/about-features/component.css';
$additional_css[] = '/components/about-contact-section/component.css';
$additional_css[] = '/components/about-company-info/component.css';
$additional_css[] = '/components/about-documents/component.css';
$additional_css[] = '/components/contact-form/component.css';

// Подключение JavaScript
$additional_js = [];
$additional_js[] = 'https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js';
// JS для contact-form подключается автоматически через load_component

include __DIR__ . '/../includes/header.php';
?>

<main>
    <?php
    load_component('breadcrumbs', [
        'items' => [
            ['title' => 'Главная', 'url' => '/'],
            ['title' => 'О компании', 'url' => null]
        ]
    ]);
    ?>

    <?php load_component('about-hero'); ?>

    <?php load_component('about-features'); ?>

    <?php load_component('about-contact-section'); ?>

    <?php load_component('about-company-info'); ?>

    <?php load_component('contact-form', [
        'form_id' => 'contact-form',
        'name_id' => 'name',
        'phone_id' => 'phone',
        'consent_id' => 'consent'
    ]); ?>

    <?php load_component('about-documents'); ?>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>