<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/articles-filters/component.css">';
}
?>

<section class="articles-filters">
    <div class="container">
        <!-- Десктопная версия - сетка кнопок -->
        <div class="articles-filters-desktop">
            <div class="articles-filters-grid">
                <button class="articles-filter-btn" data-filter="all">ВСЕ</button>
                <button class="articles-filter-btn" data-filter="metallurgy">ЭПБ МАТАЛЛУРГИЧЕСКИХ ПРОИЗВОДСТВ</button>
                <button class="articles-filter-btn" data-filter="energy">ЭПБ ЭНЕРГЕТИЧЕСКИХ УСТАНОВОК И КОТЛОВ</button>
                <button class="articles-filter-btn" data-filter="coal">ЭПБ ОБЪЕКТОВ УГОЛЬНОЙ ПРОМЫШЛЕННОСТИ</button>
                <button class="articles-filter-btn" data-filter="gas">ЭПБ ГАЗОВОГО ОБОРУДОВАНИЯ И ГАЗОПРОВОДОВ</button>
                <button class="articles-filter-btn" data-filter="flammable">ЭПБ ОБЪЕКТОВ С ГОРЮЧИМИ ЖИДКОСТЯМИ</button>
                <button class="articles-filter-btn" data-filter="explosive">ЭПБ ОБЪЕКТОВ СО ВЗЫВЧАТАМИ ВЕЩЕСТВАМИ</button>
                <button class="articles-filter-btn" data-filter="hazardous">ЭПБ ОБЪЕКТОВ С ОПАСНЫМИ ВЕЩЕСТВАМИ</button>
                <button class="articles-filter-btn" data-filter="pressure">ЭПБ ОБОРУДОВАНИЯ, РАБОТАЮЩЕГО ПОД ДАВЛЕНИЕМ</button>
                <button class="articles-filter-btn" data-filter="lifting">ЭПБ ПОДЪЕМНЫХ СООРУЖЕНИЙ И КРАНОВ</button>
                <button class="articles-filter-btn" data-filter="explosive-works">ЭПБ ВЗРЫВНЫХ РАБОТ И МАТЕРИАЛОВ</button>
                <button class="articles-filter-btn" data-filter="oil-refining">ЭПБ НЕФТЕПЕРЕРАБАТЫВАЮЩИХ И НЕФТЕХИМИЧЕСКИХ ОБЪЕКТОВ</button>
                <button class="articles-filter-btn" data-filter="mining">ЭПБ ГОРНОДОБЫВАЮЩИХ ОБЪЕКТОВ</button>
                <button class="articles-filter-btn" data-filter="underground">ЭПБ ПОДЗЕМНЫХ ОБЪЕКТОВ И ТОННЕЛЕЙ</button>
                <button class="articles-filter-btn" data-filter="pipelines">ЭПБ ТРУБО- ГАЗО- НЕФТЕ-ПРОДУКТО- АММИАКО- ПРОВОДОВ</button>
                <button class="articles-filter-btn" data-filter="storage">ЭПБ ОБЪЕКТОВ ХРАНЕНИЯ НЕФТИ И ГАЗА</button>
            </div>
        </div>

        <!-- Мобильная версия - выпадающий список -->
        <div class="articles-filters-mobile">
            <button class="articles-filters-toggle" aria-expanded="false">
                <span class="articles-filters-toggle-text">ВСЕ СТАТЬИ</span>
                <svg class="articles-filters-toggle-icon" width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.75 0.75L7.75 7.75L14.75 0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
            <div class="articles-filters-dropdown">
                <button class="articles-filter-item" data-filter="all">ВСЕ</button>
                <button class="articles-filter-item" data-filter="metallurgy">ЭПБ МАТАЛЛУРГИЧЕСКИХ ПРОИЗВОДСТВ</button>
                <button class="articles-filter-item" data-filter="energy">ЭПБ ЭНЕРГЕТИЧЕСКИХ УСТАНОВОК И КОТЛОВ</button>
                <button class="articles-filter-item" data-filter="coal">ЭПБ ОБЪЕКТОВ УГОЛЬНОЙ ПРОМЫШЛЕННОСТИ</button>
                <button class="articles-filter-item" data-filter="gas">ЭПБ ГАЗОВОГО ОБОРУДОВАНИЯ И ГАЗОПРОВОДОВ</button>
                <button class="articles-filter-item" data-filter="flammable">ЭПБ ОБЪЕКТОВ С ГОРЮЧИМИ ЖИДКОСТЯМИ</button>
                <button class="articles-filter-item" data-filter="explosive">ЭПБ ОБЪЕКТОВ СО ВЗЫВЧАТАМИ ВЕЩЕСТВАМИ</button>
                <button class="articles-filter-item" data-filter="hazardous">ЭПБ ОБЪЕКТОВ С ОПАСНЫМИ ВЕЩЕСТВАМИ</button>
                <button class="articles-filter-item" data-filter="pressure">ЭПБ ОБОРУДОВАНИЯ, РАБОТАЮЩЕГО ПОД ДАВЛЕНИЕМ</button>
                <button class="articles-filter-item" data-filter="lifting">ЭПБ ПОДЪЕМНЫХ СООРУЖЕНИЙ И КРАНОВ</button>
                <button class="articles-filter-item" data-filter="explosive-works">ЭПБ ВЗРЫВНЫХ РАБОТ И МАТЕРИАЛОВ</button>
                <button class="articles-filter-item" data-filter="oil-refining">ЭПБ НЕФТЕПЕРЕРАБАТЫВАЮЩИХ И НЕФТЕХИМИЧЕСКИХ ОБЪЕКТОВ</button>
                <button class="articles-filter-item" data-filter="mining">ЭПБ ГОРНОДОБЫВАЮЩИХ ОБЪЕКТОВ</button>
                <button class="articles-filter-item" data-filter="underground">ЭПБ ПОДЗЕМНЫХ ОБЪЕКТОВ И ТОННЕЛЕЙ</button>
                <button class="articles-filter-item" data-filter="pipelines">ЭПБ ТРУБО- ГАЗО- НЕФТЕ-ПРОДУКТО- АММИАКО- ПРОВОДОВ</button>
                <button class="articles-filter-item" data-filter="storage">ЭПБ ОБЪЕКТОВ ХРАНЕНИЯ НЕФТИ И ГАЗА</button>
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
    
    // Обработка фильтрации (можно расширить позже)
    const filterButtons = document.querySelectorAll('.articles-filter-btn, .articles-filter-item');
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            // Здесь можно добавить логику фильтрации статей
            console.log('Filter selected:', filter);
        });
    });
})();
</script>

