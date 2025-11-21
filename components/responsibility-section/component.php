<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/responsibility-section/component.css">';
}

// Получаем данные из параметров компонента
$title = $data['title'] ?? 'КАКАЯ ОТВЕТСТВЕННОСТЬ<br>ЗА НЕПРОВЕДЕНИЕ ЭПБ?';
$text = $data['text'] ?? '';
$icon = $data['icon'] ?? '/assets/images/Polygon 7.svg';
?>

<!-- Ответственность -->
<section class="responsibility-section">
    <div class="container">
        <div class="responsibility-inner">
            <h2 class="responsibility-title"><?php echo $title; ?></h2>
            <div class="responsibility-content">
                <div class="responsibility-text">
                    <p>
                        <?php echo htmlspecialchars($text); ?>
                    </p>
                    <img class="responsibility-icon" src="<?php echo htmlspecialchars($icon); ?>" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>

