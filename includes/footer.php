    <footer class="site-footer">
        <!-- Десктопная версия футера -->
        <div class="footer-desktop">
            <div class="container-fluid">
                <div class="footer-box">
                    <div class="footer-inner">
                        <div class="footer-row">
                            <a class="logo" href="/">
                                <img src="/assets/images/logo.png" alt="<?php echo SITE_NAME; ?>">
                            </a>

                            <div class="footer-center">
                                <a class="footer-btn" href="/sitemap.php">
                                    <img class="icon-sitemap" src="/assets/images/iconSitemap.svg" alt="">
                                    КАРТА САЙТА
                                </a>
                                <nav class="footer-menu">
                                    <ul>
                                        <li><a href="/contacts.php">Контакты</a></li>
                                        <li><a href="/services.php">Услуги</a></li>
                                        <li><a href="/about.php">О компании</a></li>
                                        <li><a href="/articles.php">Статьи</a></li>
                                    </ul>
                                </nav>
                            </div>

                            <div class="footer-contacts">
                                <a class="footer-phone" href="tel:+74951270935">+ 7 495 127 09-35</a>
                                <a class="footer-email" href="mailto:info@te-g.ru">info@te-g.ru</a>
                                <ul class="footer-social">
                                    <li>
                                        <a href="https://wa.me/74951270935" target="_blank" rel="noopener" aria-label="WhatsApp">
                                            <img src="/assets/images/wa.svg" alt="WhatsApp">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://t.me/" target="_blank" rel="noopener" aria-label="Telegram">
                                            <img src="/assets/images/tg.svg" alt="Telegram">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:info@te-g.ru" aria-label="Email">
                                            <img src="/assets/images/mailfooter.svg" alt="Email">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Мобильная версия футера -->
        <div class="footer-mobile">
            <div class="container-fluid">
                <div class="footer-mobile-content">
                    <div class="footer-mobile-left">
                        <div class="footer-mobile-brand">
                            <a class="logo" href="/">
                                <img src="/assets/images/logo.png" alt="<?php echo SITE_NAME; ?>">
                            </a>
                            <div class="footer-mobile-name">ТОП ЭКСПЕРТ</div>
                        </div>
                        <div class="footer-mobile-contacts">
                            <a class="footer-mobile-phone" href="tel:+74951270935">+ 7 495 127 09-35</a>
                            <a class="footer-mobile-email" href="mailto:info@te-g.ru">info@te-g.ru</a>
                        </div>
                        <ul class="footer-mobile-social">
                            <li>
                                <a href="https://wa.me/74951270935" target="_blank" rel="noopener" aria-label="WhatsApp">
                                    <img src="/assets/images/wa.svg" alt="WhatsApp">
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/" target="_blank" rel="noopener" aria-label="Telegram">
                                    <img src="/assets/images/tg.svg" alt="Telegram">
                                </a>
                            </li>
                            <li>
                                <a href="mailto:info@te-g.ru" aria-label="Email">
                                    <img src="/assets/images/mailfooter.svg" alt="Email">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-mobile-right">
                        <a class="footer-mobile-btn" href="/sitemap.php">
                            <img class="icon-sitemap" src="/assets/images/iconSitemap.svg" alt="">
                            КАРТА САЙТА
                        </a>
                        <nav class="footer-mobile-menu">
                            <ul>
                                <li><a href="/contacts.php">Контакты</a></li>
                                <li><a href="/services.php">Услуги</a></li>
                                <li><a href="/about.php">О компании</a></li>
                                <li><a href="/articles.php">Статьи</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" 
            onerror="this.onerror=null; this.src='https://unpkg.com/swiper@11/swiper-bundle.min.js';"></script>
    
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
