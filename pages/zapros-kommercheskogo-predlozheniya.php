<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'zapros-kommercheskogo-predlozheniya';

// Подключаем CSS для компонентов
$additional_css = [];

$breadcrumbs_css = '/components/breadcrumbs/component.css';
if (file_exists(__DIR__ . '/../components/breadcrumbs/component.css')) {
    $additional_css[] = $breadcrumbs_css;
}

// Подключаем JS для страницы
$additional_js = [
    // 'https://www.google.com/recaptcha/api.js',
    'https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js',
    '/assets/js/zapros.js'
];

include __DIR__ . '/../includes/header.php';

?>

<main>
    <?php
    load_component('breadcrumbs', [
        'current_title' => 'Запрос коммерческого предложения'
    ]);
    ?>

    <div class="custom-form-wrapper-top-site">
        <div class="page">
            <h1>Запрос коммерческого предложения</h1>
        </div>
    </div>

    <div class="custom-form-wrapper-top-site-mobile">
        <div class="page">
            <div class="custom-form-wrapper-main-block">
                <div class="custom-form-wrapper-main-block-top">
                    <h2>Запрос коммерческого предложения</h2>
                    <p class="p-big-form">Данная форма предназначена для запроса коммерческого предложения
                        (информационного письма)
                        в
                        досудебном и судебном порядке</p>
                    <div class="custom-form-wrapper-main-block-duo">
                        <p class="p-small-form">С ее помощью Вы можете получить информацию о стоимости и
                            сроках
                            проведения
                            независимой
                            экспертизы для решения правовых споров</p>
                        <p class="p-small-form">Заполните необходимые поля, и наши специалисты подготовят
                            для
                            Вас индивидуальное
                            коммерческое предложение с учетом специфики вашего дела и направят его вам на
                            E-mail
                        </p>
                    </div>
                </div>
                <div class="custom-form-wrapper-main-block-bottom">
                    <p class="p-small-form">Коммерческое предложение будет направлено Вам на E-mail в
                        течение 3
                        рабочих дней</p>
                </div>
            </div>
        </div>
    </div>

    <?php load_component('commercial-proposal-form'); ?>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>