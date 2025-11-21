<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/warning-section/component.css">';
}

// Получаем данные из параметров компонента
$warning_secondary = $data['warning_secondary'] ?? '';
$warning_primary = $data['warning_primary'] ?? '';
$contact_form_id = $data['contact_form_id'] ?? 'contact-form';
$warning_image = $data['warning_image'] ?? '/assets/images/Текст абзаца (3) 1.png';
$background_image = $data['background_image'] ?? '/assets/images/image 6344877.png';
?>

<!-- Предупреждение -->
<section class="warning-section">
    <div class="container">
        <div class="warning-section-inner" style="background-image: url('<?php echo htmlspecialchars($background_image); ?>');">
            <img class="warning-image" src="<?php echo htmlspecialchars($warning_image); ?>" alt="Предупреждение" />
            <div class="warning-content">
                <p class="warning-text-secondary">
                    <?php echo htmlspecialchars($warning_secondary); ?>
                </p>
                <a href="#<?php echo htmlspecialchars($contact_form_id); ?>" class="warning-link">
                    <span>Оставить заявку на проведение экспертизы</span>
                    <img src="/assets/images/arrow-43.svg" alt="" />
                </a>
            </div>
        </div>
        <p class="warning-text-primary">
            <?php echo htmlspecialchars($warning_primary); ?>
        </p>
    </div>
</section>

