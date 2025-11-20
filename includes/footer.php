    <?php
    // Подключаем компонент footer
    require_once __DIR__ . '/component-loader.php';
    load_component('footer');
    ?>

    <!-- Swiper JS -->
    <script src="/assets/js/vendor/swiper.min.js"></script>
    
    <!-- IMask JS (если нужен на странице) -->
    <?php if (isset($additional_js) && in_array('https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js', $additional_js)): ?>
        <script src="https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js" 
                onerror="this.onerror=null; this.src='https://unpkg.com/imask@6.4.3/dist/imask.min.js';"></script>
    <?php endif; ?>

    <!-- Основной JavaScript -->
    <script src="/assets/js/main.js"></script>

    <!-- Дополнительные скрипты страницы (если есть) -->
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <?php 
            // Пропускаем IMask, так как он уже загружен выше
            if ($js === 'https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js') {
                continue;
            }
            ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
