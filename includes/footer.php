    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php echo SITE_NAME; ?></h3>
                    <p>Профессиональная экспертиза промышленной безопасности</p>
                </div>
                
                <div class="footer-section">
                    <h4>Контакты</h4>
                    <p>Email: info@expertiza-prombez.ru</p>
                    <p>Телефон: +7 (xxx) xxx-xx-xx</p>
                </div>
                
                <div class="footer-section">
                    <h4>Навигация</h4>
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/about.php">О нас</a></li>
                        <li><a href="/services.php">Услуги</a></li>
                        <li><a href="/contacts.php">Контакты</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Все права защищены.</p>
            </div>
        </div>
    </footer>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Основной JavaScript -->
    <script src="/assets/js/main.js"></script>
    
    <!-- Дополнительные скрипты страницы (если есть) -->
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
