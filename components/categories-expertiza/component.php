<?php
// Подключаем функции для работы с ЭПБ
require_once __DIR__ . '/../../includes/epb-functions.php';

// Получаем список всех опубликованных ЭПБ
$epbList = getEpbList();

// Определяем задержки для анимации (циклически от 1 до 8)
$delayClasses = ['delay-1', 'delay-2', 'delay-3', 'delay-4', 'delay-5', 'delay-6', 'delay-7', 'delay-8'];
?>

<section class="categories-expertiza">
    <div class="container-fluid">
        <div class="categories-header">
            <div class="categories-title-row">
                <h3 class="categories-main-title animate-on-scroll fade-in">ЭКСПЕРТИЗЫ<br>ПРОМБЕЗОПАСНОСТИ</h3>
                <div class="categories-line animate-on-scroll delay-1"></div>
                <h2 class="categories-subtitle animate-on-scroll delay-2">КАТЕГОРИИ</h2>
                <img src="/assets/images/polygon.svg" alt="" class="categories-icon animate-on-scroll delay-3">
            </div>
        </div>
        
        <div class="categories-grid">
            <?php if (empty($epbList)): ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #91A2B8;">
                    <p>ЭПБ пока нет. Добавьте их через админ-панель.</p>
                </div>
            <?php else: ?>
                <?php foreach ($epbList as $index => $epb): ?>
                    <?php
                    // Определяем задержку для анимации (циклически)
                    $delayIndex = ($index % 8);
                    $delayClass = $delayClasses[$delayIndex];
                    
                    // Получаем описание из hero_content (первые 150 символов без HTML)
                    $description = strip_tags($epb['hero_content']);
                    $description = mb_substr($description, 0, 150);
                    if (mb_strlen(strip_tags($epb['hero_content'])) > 150) {
                        $description .= '...';
                    }
                    
                    // Изображение или дефолтное
                    $image = !empty($epb['hero_image']) ? $epb['hero_image'] : '/assets/images/categories (' . (($index % 15) + 1) . ').png';
                    
                    // Категория (номер)
                    $category = !empty($epb['category']) ? htmlspecialchars($epb['category']) : 'Э' . ($index + 1);
                    
                    // Заголовок в верхнем регистре
                    $title = mb_strtoupper(htmlspecialchars($epb['title']));
                    ?>
                    <a href="/<?php echo htmlspecialchars($epb['slug']); ?>" class="category-card animate-on-scroll <?php echo $delayClass; ?>" style="text-decoration: none; color: inherit;">
                        <div class="category-image-wrapper">
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($epb['title']); ?>">
                            <div class="category-number-mobile"><?php echo $category; ?></div>
                        </div>
                        <div class="category-title-row">
                            <div class="category-number"><?php echo $category; ?></div>
                            <div class="category-title-wrapper">
                                <h4 class="category-title"><?php echo $title; ?></h4>
                            </div>
                        </div>
                        <div class="category-line"></div>
                        <p class="category-description"><?php echo htmlspecialchars($description); ?></p>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

