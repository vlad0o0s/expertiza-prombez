<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/stages-section/component.css">';
}

// Получаем данные из параметров компонента
$title = $data['title'] ?? 'ЭТАПЫ ПРОВЕДЕНИЯ ЭПБ';
$stages = $data['stages'] ?? [];
$indicator_image = $data['indicator_image'] ?? '/assets/images/Group 1597882155.png';
$contact_form_id = $data['contact_form_id'] ?? 'contact-form';
?>

<!-- Этапы проведения -->
<section class="stages-section">
    <div class="container">
        <h2 class="stages-title"><?php echo htmlspecialchars($title); ?></h2>
        <div class="stages-list">
            <?php foreach ($stages as $stage): ?>
                <article class="stage-item">
                    <span class="stage-number"><?php echo htmlspecialchars($stage['number']); ?></span>
                    <h3 class="stage-title"><?php echo $stage['title']; ?></h3>
                    <p class="stage-description"><?php echo htmlspecialchars($stage['description']); ?></p>
                    <?php if (isset($stage['link']) && $stage['link']): ?>
                        <a href="#<?php echo htmlspecialchars($contact_form_id); ?>" class="stage-link">
                            <span>Оставить заявку</span>
                            <img src="/assets/images/Arrow.svg" alt="" />
                        </a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

