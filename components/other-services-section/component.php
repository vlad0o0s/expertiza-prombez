<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/other-services-section/component.css">';
}

// Подключаем JS для компонента
$jsPath = __DIR__ . '/component.js';
if (file_exists($jsPath)) {
    echo '<script src="/components/other-services-section/component.js" defer></script>';
}

// Получаем данные из параметров компонента
$title = $data['title'] ?? 'ДРУГИЕ<br>ЭКСПЕРТИЗЫ';
$services = $data['services'] ?? [];
?>

<!-- Другие экспертизы -->
<section class="other-services-section">
    <div class="container">
        <div class="other-services-header">
            <h2 class="other-services-title"><?php echo $title; ?></h2>
            <div class="other-services-navigation">
                <button class="other-services-prev" aria-label="Предыдущий слайд">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="other-services-next" aria-label="Следующий слайд">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="swiper other-services-swiper">
            <div class="swiper-wrapper other-services-carousel">
                <?php foreach ($services as $service): ?>
                    <div class="swiper-slide">
                        <article class="service-card <?php echo isset($service['active']) && $service['active'] ? 'service-card-active' : ''; ?>">
                            <img class="service-card-image" src="<?php echo htmlspecialchars($service['image']); ?>"
                                alt="<?php echo htmlspecialchars(strip_tags($service['title'])); ?>" />
                            <div class="service-card-content">
                                <div class="service-card-info">
                                    <div class="service-card-info-item">
                                        <span class="service-card-info-label">Стоимость</span>
                                        <span
                                            class="service-card-info-value"><?php echo htmlspecialchars($service['price']); ?></span>
                                    </div>
                                    <span class="service-card-divider"></span>
                                    <div class="service-card-info-item">
                                        <span class="service-card-info-label">Сроки</span>
                                        <span
                                            class="service-card-info-value"><?php echo htmlspecialchars($service['term']); ?></span>
                                    </div>
                                </div>
                                <h3 class="service-card-title"><?php echo $service['title']; ?></h3>
                                <p class="service-card-description">
                                    <?php echo htmlspecialchars($service['description']); ?>
                                </p>
                                <a href="<?php echo htmlspecialchars($service['link']); ?>" class="service-card-link">
                                    <span>Подробнее</span>
                                    <img src="/assets/images/arrow-39-4.svg" alt="" />
                                </a>
                                <span
                                    class="service-card-category"><?php echo htmlspecialchars($service['category']); ?></span>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

