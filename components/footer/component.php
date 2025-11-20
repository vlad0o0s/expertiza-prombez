<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/footer/component.css">';
}
?>

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
                            <a class="footer-btn" href="/sitemap">
                                <img class="icon-sitemap" src="/assets/images/iconSitemap.svg" alt="">
                                КАРТА САЙТА
                            </a>
                            <nav class="footer-menu">
                                <ul>
                                    <li><a href="/contacts">Контакты</a></li>
                                    <li><a href="/services">Услуги</a></li>
                                    <li><a href="/about">О компании</a></li>
                                    <li><a href="/articles">Статьи</a></li>
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
                    <a class="footer-mobile-btn" href="/sitemap">
                        <img class="icon-sitemap" src="/assets/images/iconSitemap.svg" alt="">
                        КАРТА САЙТА
                    </a>
                    <nav class="footer-mobile-menu">
                        <ul>
                            <li><a href="/contacts">Контакты</a></li>
                            <li><a href="/services">Услуги</a></li>
                            <li><a href="/about">О компании</a></li>
                            <li><a href="/articles">Статьи</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>

