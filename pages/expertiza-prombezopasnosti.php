<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'expertiza-prombezopasnosti';

// Подключаем CSS для компонента breadcrumbs ДО header.php
$breadcrumbs_css = '/components/breadcrumbs/component.css';
if (file_exists(__DIR__ . '/../components/breadcrumbs/component.css')) {
    $additional_css = [$breadcrumbs_css];
} else {
    $additional_css = [];
}

$additional_js = [];

include __DIR__ . '/../includes/header.php';

?>

<main>
    <?php
    load_component('breadcrumbs', [
        'current_title' => 'Экспертизы промбезопасности'
    ]);
    ?>
    
    <!-- TODO: сюда позже добавим контент страницы экспертиз промбезопасности -->
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

