<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'laboratoriya-nerazrushayushchego-kontrolya';

// Подключение CSS
$additional_css = [];
$additional_css[] = '/assets/css/index.css';
$additional_css[] = '/components/breadcrumbs/component.css';
$additional_css[] = '/components/company-banner/component.css';
$additional_css[] = '/components/lab-licenses-banner/component.css';
$additional_css[] = '/components/why-choose-us/component.css';
$additional_css[] = '/components/reviews/component.css';
$additional_css[] = '/components/faq/component.css';
$additional_css[] = '/assets/css/laboratoriya-nerazrushayushchego-kontrolya.css';

// Подключение JavaScript
$additional_js = [];
$additional_js[] = '/assets/js/index-animations.js';
$additional_js[] = '/components/reviews/component.js';
$additional_js[] = '/components/faq/component.js';

include __DIR__ . '/../includes/header.php';
?>

<main>
    <?php
    load_component('breadcrumbs', [
        'items' => [
            ['title' => 'Главная', 'url' => '/'],
            ['title' => 'Лаборатория неразрушающего контроля', 'url' => null]
        ]
    ]);
    ?>

    <section class="hero-section">
        <div class="hero-content-wrapper">
            <div class="hero-content">
                <h1 class="hero-title">ЛАБОРАТОРИЯ НЕРАЗРУШАЮЩЕГО КОНТРОЛЯ</h1>
                <p class="hero-description">
                    Лаборатория неразрушающего контроля является структурным подразделением компании «ТОП ЭКСПЕРТ».
                    Главной
                    целью функционирования лаборатории является обеспечение и поддержание высокого качества работ при
                    изготовлении, строительстве, эксплуатации, монтаже, ремонте, реконструкции и техническом
                    диагностировании
                    объектов, за счет выявления недопустимых дефектов методами неразрушающего контроля, обеспечение
                    достоверности результатов контроля и проведения на этой основе технически обоснованных
                    корректирующих и
                    предупреждающих действий.
                </p>
            </div>
            <div class="equipment-section">
                <h2 class="equipment-title">ЛАБОРАТОРИЯ ОСАЩЕНА СОВРЕМЕННЫМ ОБОРУДОВАНИЕМ И ПРИБОРАМИ:</h2>
                <ul class="equipment-list">
                    <li class="equipment-item">- аппараты рентгеновские импульсные</li>
                    <li class="equipment-item">- аппараты ультразвуковые</li>
                    <li class="equipment-item">- денситометры</li>
                    <li class="equipment-item">- эталоны, комплекты мер, ручной РЭП</li>
                    <li class="equipment-item">- наборы ВИК</li>
                    <li class="equipment-item">- толщиномеры</li>
                    <li class="equipment-item">- дозиметры и т.д.</li>
                </ul>
                <div class="company-buttons">
                    <a href="#" class="btn-order-company">ЗАКАЗАТЬ УСЛУГУ</a>
                    <button class="btn-arrow-company" aria-label="Перейти">
                        <img src="/assets/images/Arrow.svg" alt="">
                    </button>
                </div>
            </div>
        </div>
        <div class="equipment-chemical-section">
            <div class="hero-image-wrapper">
                <img class="hero-image" src="/assets/images/lb.png" alt="Специалист изучает планы миссии" />
                <div class="hero-image-overlay" aria-hidden="true"></div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <p class="hero-stat-label">Стоимость экспертизы</p>
                        <p class="hero-stat-value">от 17 000₽</p>
                    </div>
                    <span class="hero-stat-divider" aria-hidden="true"></span>
                    <div class="hero-stat">
                        <p class="hero-stat-label">Сроки проведения</p>
                        <p class="hero-stat-value">от 20 дней</p>
                    </div>
                </div>
            </div>

            <div class="chemical-lab-section">
                <div class="chemical-lab-images">
                    <img class="chemical-lab-image" src="/assets/images/himlab.png" alt="Лабораторная посуда" />
                    <img class="chemical-lab-image-secondary" src="/assets/images/himlab.png"
                        alt="Химическая лаборатория" />
                </div>
                <div class="chemical-lab-content">
                    <h2 class="chemical-lab-title">ХИМИЧЕСКАЯ ЛАБОРАТОРИЯ</h2>
                    <ul class="chemical-lab-list">
                        <li class="chemical-lab-item">Химическая экспертиза строительных материалов</li>
                        <li class="chemical-lab-item">Анализ нефтепродуктов и ГСМ</li>
                        <li class="chemical-lab-item">Химический анализ металлов и сплавов</li>
                        <li class="chemical-lab-item">Лабораторные испытания бетона и цемента</li>
                        <li class="chemical-lab-item">Экспертиза коррозии металлоконструкций</li>
                        <li class="chemical-lab-item">Анализ агрессивности производственной среды</li>
                    </ul>
                    <a href="#chemical-lab-details" class="chemical-lab-link">
                        <span class="chemical-lab-link-text">Подробнее</span>
                        <img class="chemical-lab-link-icon" src="/assets/images/Arrow.svg" alt="" aria-hidden="true" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    load_component('lab-services-section', [
        'title' => 'УСЛУГИ<br>ЛАБОРАТОРИИ<br>НЕРАЗРУШАЮЩЕГО КОНТРОЛЯ',
        'services' => [
            [
                'image' => '/assets/images/test.png',
                'title' => 'УЛЬТРАЗВУКОВОЙ КОНТРОЛЬ СВАРНЫХ ШВОВ',
                'description' => 'Неразрушающий метод диагностики, который использует ультразвуковые волны для обнаружения внутренних дефектов в сварных швах без повреждения конструкции',
                'price' => 'от 30 000 ₽',
                'term' => 'от 15 дней',
                'link' => '#service-details-1',
                'category' => '01',
                'active' => true
            ],
            [
                'image' => '/assets/images/test.png',
                'title' => 'РАДИОГРАФИЧЕСКИЙ КОНТРОЛЬ МЕТАЛЛОВ',
                'description' => 'Метод неразрушающего контроля, который позволяет выявлять скрытые дефекты в металлических изделиях и сварных соединениях без их повреждения',
                'price' => 'от 30 000 ₽',
                'term' => 'от 15 дней',
                'link' => '#service-details-2',
                'category' => '02',
                'active' => false
            ],
            [
                'image' => '/assets/images/test.png',
                'title' => 'МАГНИТОПОРОШКОВАЯ ЭКСПЕРТИЗА',
                'description' => 'Вид неразрушающего контроля, используемый для выявления поверхностных и подповерхностных дефектов в ферромагнитных материалах (сталь, чугун и т.д.)',
                'price' => 'от 30 000 ₽',
                'term' => 'от 15 дней',
                'link' => '#service-details-3',
                'category' => '03',
                'active' => false
            ],
            [
                'image' => '/assets/images/test.png',
                'title' => 'КАППИЛЯРНЫЙ КОНТРОЛЬ (ДЕФЕКТОСКОПИЯ)',
                'description' => 'Неразрушающий метод выявления поверхностных и сквозных дефектов в материалах путем проникновения в них специальных индикаторных жидкостей (пенетрантов)',
                'price' => 'от 30 000 ₽',
                'term' => 'от 15 дней',
                'link' => '#service-details-4',
                'category' => '04',
                'active' => false
            ]
        ]
    ]);
    ?>

    <?php
    load_component('lab-licenses-banner', [
        'downloadLink' => '#',
        'iconPath' => '/assets/images/ss.png'
    ]);
    ?>

    <?php load_component('why-choose-us'); ?>

    <?php load_component('reviews'); ?>

    <?php load_component('faq'); ?>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>