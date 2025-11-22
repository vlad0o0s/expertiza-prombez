<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/articles-filters/component.css">';
}

require_once __DIR__ . '/../../includes/articles-functions.php';

$currentCategory = $data['currentCategory'] ?? 'all';
$categories = getArticleCategories();
?>

<section class="articles-filters">
    <div class="container">
        <!-- Десктопная версия - сетка кнопок -->
        <div class="articles-filters-desktop">
            <div class="articles-filters-grid">
                <?php foreach ($categories as $key => $label): ?>
                    <a href="/articles<?php echo $key !== 'all' ? '?category=' . urlencode($key) : ''; ?>" 
                       class="articles-filter-btn <?php echo $currentCategory === $key ? 'active' : ''; ?>" 
                       data-filter="<?php echo $key; ?>">
                        <?php echo htmlspecialchars($label); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Мобильная версия - выпадающий список -->
        <div class="articles-filters-mobile">
            <button class="articles-filters-toggle" aria-expanded="false">
                <span class="articles-filters-toggle-text"><?php echo htmlspecialchars($categories[$currentCategory] ?? 'ВСЕ СТАТЬИ'); ?></span>
                <svg class="articles-filters-toggle-icon" width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.75 0.75L7.75 7.75L14.75 0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
            <div class="articles-filters-dropdown">
                <?php foreach ($categories as $key => $label): ?>
                    <a href="/articles<?php echo $key !== 'all' ? '?category=' . urlencode($key) : ''; ?>" 
                       class="articles-filter-item <?php echo $currentCategory === $key ? 'active' : ''; ?>" 
                       data-filter="<?php echo $key; ?>">
                        <?php echo htmlspecialchars($label); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    // Мобильное меню - открытие/закрытие
    const toggle = document.querySelector('.articles-filters-toggle');
    const dropdown = document.querySelector('.articles-filters-dropdown');
    
    if (toggle && dropdown) {
        toggle.addEventListener('click', function() {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !isExpanded);
            dropdown.classList.toggle('is-open');
        });
        
        // Обновление текста при выборе категории
        const filterItems = dropdown.querySelectorAll('.articles-filter-item');
        filterItems.forEach(item => {
            item.addEventListener('click', function() {
                const text = this.textContent.trim();
                if (text !== 'ВСЕ') {
                    toggle.querySelector('.articles-filters-toggle-text').textContent = text;
                } else {
                    toggle.querySelector('.articles-filters-toggle-text').textContent = 'ВСЕ СТАТЬИ';
                }
                dropdown.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }
    
    // Фильтрация теперь работает через ссылки, JS не нужен
})();
</script>

