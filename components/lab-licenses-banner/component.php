<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/lab-licenses-banner/component.css">';
}

// Получаем данные из параметров компонента
$downloadLink = $data['downloadLink'] ?? '#';
$iconPath = $data['iconPath'] ?? '/assets/images/ss.png';
?>

<section class="lab-licenses-banner animate-on-scroll">
    <div class="container-fluid">
        <div class="lab-licenses-banner-inner">
            <!-- ПК версия -->
            <div class="lab-licenses-desktop">
                <img src="<?php echo htmlspecialchars($iconPath); ?>" alt="Лицензия" class="lab-licenses-icon">
                <p class="lab-licenses-text">Лицензии лаборатории неразрушающего контроля</p>
                <div class="lab-licenses-download">
                    <a href="<?php echo htmlspecialchars($downloadLink); ?>" class="lab-licenses-download-text">Скачать файл</a>
                    <a href="<?php echo htmlspecialchars($downloadLink); ?>" class="btn-arrow-company" aria-label="Скачать файл">
                        <img src="/assets/images/Arrow.svg" alt="">
                    </a>
                </div>
            </div>
            
            <!-- Мобильная версия -->
            <div class="lab-licenses-mobile">
                <p class="lab-licenses-text">Лицензии лаборатории неразрушающего контроля</p>
                <div class="lab-licenses-bottom-row">
                    <img src="<?php echo htmlspecialchars($iconPath); ?>" alt="Лицензия" class="lab-licenses-icon">
                    <div class="lab-licenses-download">
                        <a href="<?php echo htmlspecialchars($downloadLink); ?>" class="lab-licenses-download-text">Скачать файл</a>
                        <a href="<?php echo htmlspecialchars($downloadLink); ?>" class="btn-arrow-company" aria-label="Скачать файл">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

