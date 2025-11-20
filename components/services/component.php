<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/services/component.css">';
}
?>

<section class="our-services">
    <div class="container-fluid">
        <div class="our-services-inner">
            <div class="services-header animate-on-scroll">
                <div class="services-title-row">
                    <img src="/assets/images/polygon.svg" alt="" class="services-icon">
                    <h2 class="services-subtitle">НАШИ УСЛУГИ</h2>
                    <div class="services-line"></div>
                    <h3 class="services-main-title">ОСНОВНЫЕ НАПРАВЛЕНИЯ<br>НАШЕЙ РАБОТЫ</h3>
                </div>
            </div>
            
            <div class="services-grid">
            <a href="/expertiza-prombezopasnosti" class="service-card service-card--link animate-on-scroll delay-1">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services1.png" alt="Экспертиза промбезопасности">
                    <div class="service-number-mobile">01</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">01</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">ЭКСПЕРТИЗА<br>ПРОМБЕЗОПАСНОСТИ</h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Оценка оборудования и сооружений<br>на соответствие требованиям, предотвращение аварий</p>
            </a>
            
            <a href="#" class="service-card service-card--link animate-on-scroll delay-2">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services2.png" alt="Экологическая экспертиза">
                    <div class="service-number-mobile">02</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">02</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">ЭКОЛОГИЧЕСКАЯ<br>ЭКСПЕРТИЗА</h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Анализ воздействия на природу, подготовка отчетов и природоохранных решений</p>
            </a>
            
            <a href="#" class="service-card service-card--link animate-on-scroll delay-3">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services3.png" alt="Техническое обследование зданий">
                    <div class="service-number-mobile">03</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">03</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">ТЕХНИЧЕСКОЕ ОБСЛЕДОВАНИЕ<br>ЗДАНИЙ</h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Диагностика конструкций и систем<br>для ремонта, реконструкции или ввода в эксплуатацию</p>
            </a>
            
            <a href="https://sudexp.org" target="_blank" class="service-card service-card--link animate-on-scroll delay-4">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services4.png" alt="Судебная экспертиза">
                    <div class="service-number-mobile">04</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">04</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">СУДЕБНАЯ ЭКСПЕРТИЗА<br><span class="service-link-text">sudexp.org</span></h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Независимые исследования<br>и заключения для арбитражных<br>и гражданских дел</p>
            </a>
            
            <a href="#" class="service-card service-card--link animate-on-scroll delay-5">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services5.png" alt="Лаборатория неразрушающего контроля">
                    <div class="service-number-mobile">05</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">05</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">ЛАБОРАТОРИЯ<br>НЕРАЗРУШАЮЩЕГО КОНТРОЛЯ</h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Выявление дефектов конструкций<br>и сварки без повреждений изделий</p>
            </a>
            
            <a href="#" class="service-card service-card--link animate-on-scroll delay-6">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services6.png" alt="Химическая лаборатория">
                    <div class="service-number-mobile">06</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">06</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">ХИМИЧЕСКАЯ<br>ЛАБОРАТОРИЯ</h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Анализ материалов, сырья и выбросов на соответствие нормам</p>
            </a>
            
            <a href="#" class="service-card service-card--link animate-on-scroll delay-7">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services7.png" alt="Образование и повышение квалификации">
                    <div class="service-number-mobile">07</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">07</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">ОБРАЗОВАНИЕ И<br>ПОВЫШЕНИЕ КВАЛИФИКАЦИИ</h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Обучение специалистов и выдача удостоверений</p>
            </a>
            
            <a href="#" class="service-card service-card--link animate-on-scroll delay-8">
                <div class="service-image-wrapper">
                    <img src="/assets/images/our_services8.png" alt="Аудит СУОТ и внедрение">
                    <div class="service-number-mobile">08</div>
                </div>
                <div class="service-title-row">
                    <div class="service-number">08</div>
                    <div class="service-title-wrapper">
                        <h4 class="service-title">АУДИТ СУОТ<br>И ВНЕДРЕНИЕ</h4>
                    </div>
                </div>
                <div class="service-line"></div>
                <p class="service-description">Проверка и улучшение систем охраны труда на предприятии</p>
            </a>
            </div>
        </div>
    </div>
</section>

