<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/lab-services-section/component.css">';
}

// Подключаем JS для компонента
$jsPath = __DIR__ . '/component.js';
if (file_exists($jsPath)) {
    echo '<script src="/components/lab-services-section/component.js" defer></script>';
}

// Получаем данные из параметров компонента
$title = $data['title'] ?? 'УСЛУГИ<br>ЛАБОРАТОРИИ<br>НЕРАЗРУШАЮЩЕГО КОНТРОЛЯ';
$services = $data['services'] ?? [
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
];
?>

<!-- Услуги лаборатории неразрушающего контроля -->
<section class="lab-services-section">
    <div class="container">
        <div class="lab-services-header">
            <h2 class="lab-services-title">
                <span class="lab-services-title-accent">УСЛУГИ</span>
                <span class="lab-services-title-main"> ЛАБОРАТОРИИ<br />НЕРАЗРУШАЮЩЕГО КОНТРОЛЯ</span>
            </h2>
            <div class="lab-services-navigation">
                <button class="lab-services-prev" aria-label="Предыдущий слайд">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="lab-services-next" aria-label="Следующий слайд">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="swiper lab-services-swiper">
            <div class="swiper-wrapper lab-services-carousel">
                <?php foreach ($services as $service): ?>
                    <div class="swiper-slide">
                        <article class="lab-service-card <?php echo isset($service['active']) && $service['active'] ? 'lab-service-card-active' : ''; ?>">
                            <img class="lab-service-card-image" src="<?php echo htmlspecialchars($service['image']); ?>"
                                alt="<?php echo htmlspecialchars(strip_tags($service['title'])); ?>" />
                            <div class="lab-service-card-content">
                                <div class="lab-service-card-info">
                                    <div class="lab-service-card-info-item">
                                        <span class="lab-service-card-info-label">Стоимость</span>
                                        <span class="lab-service-card-info-value"><?php echo htmlspecialchars($service['price']); ?></span>
                                    </div>
                                    <span class="lab-service-card-divider"></span>
                                    <div class="lab-service-card-info-item">
                                        <span class="lab-service-card-info-label">Сроки</span>
                                        <span class="lab-service-card-info-value"><?php echo htmlspecialchars($service['term']); ?></span>
                                    </div>
                                </div>
                                <h3 class="lab-service-card-title"><?php echo $service['title']; ?></h3>
                                <p class="lab-service-card-description">
                                    <?php echo htmlspecialchars($service['description']); ?>
                                </p>
                                <a href="<?php echo htmlspecialchars($service['link']); ?>" class="lab-service-card-link">
                                    <span>Подробнее</span>
                                    <img src="/assets/images/Arrow.svg" alt="" />
                                </a>
                                <span class="lab-service-card-category"><?php echo htmlspecialchars($service['category']); ?></span>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

