<?php
require_once 'config/config.php';

// Указание ключа страницы для SEO (используется конфигурация из config/seo.php)
$page_key = 'index';

// Подключение CSS для главной страницы
$additional_css = ['/assets/css/index.css'];

include 'includes/header.php';
?>

<main>
    <section class="main-hero">
        <div class="container-fluid">
            <div class="main-hero-inner">
                <div class="hero-content">
                    <h1 class="hero-title">ЭКСПЕРТИЗА ПРОМЫШЛЕННОЙ БЕЗОПАСНОСТИ<br>АНО ЭПЦ "ТОП ЭКСПЕРТ"</h1>
                    <div class="hero-line"></div>
                    <div class="hero-bottom-row">
                        <p class="hero-description">Процедура для исследования положения объектов, оборудования и систем на предприятиях с повышенной опасностью</p>
                        <div class="hero-buttons">
                            <a href="#" class="btn-order">ЗАКАЗАТЬ УСЛУГУ</a>
                            <button class="btn-arrow" aria-label="Перейти">
                                <img src="/assets/images/Arrow.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="info-cards">
        <div class="container-fluid">
            <div class="info-cards-inner">
                <div class="info-card card-1">
                    <h3 class="card-title">ЭКСПЕРТИЗЫ<br>ПРОМБЕЗОПАСНОСТИ</h3>
                    <p class="card-description">Категории от Э1 до Э15</p>
                    <a href="#" class="card-link">
                        Перейти на страницу
                        <img src="/assets/images/arrowR.svg" alt="">
                    </a>
                </div>
                
                <div class="info-card card-2">
                    <h3 class="card-title">ИНТЕРЕСНЫЕ СТАТЬИ<br>И НОВОСТИ</h3>
                    <p class="card-description">Свежие материалы о промбезопасности</p>
                    <a href="#" class="card-link">
                        Перейти на страницу
                        <img src="/assets/images/arrowR.svg" alt="">
                    </a>
                </div>
                
                <div class="info-card card-3">
                    <h3 class="card-title">ОТЗЫВЫ О НАШЕЙ<br>ЭКСПЕРТНОЙ РАБОТЕ</h3>
                    <p class="card-description">Компании, доверившие нам экспертизу</p>
                    <a href="#" class="card-link">
                        Отзывы на Яндекс Картах
                        <img src="/assets/images/arrowR.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="our-services">
        <div class="container-fluid">
            <div class="services-header">
                <div class="services-title-row">
                    <img src="/assets/images/polygon.svg" alt="" class="services-icon">
                    <h2 class="services-subtitle">НАШИ УСЛУГИ</h2>
                    <div class="services-line"></div>
                    <h3 class="services-main-title">ОСНОВНЫЕ НАПРАВЛЕНИЯ<br>НАШЕЙ РАБОТЫ</h3>
                </div>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
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
                </div>
                
                <div class="service-card">
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
                </div>
                
                <div class="service-card">
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
                </div>
                
                <div class="service-card">
                    <div class="service-image-wrapper">
                        <img src="/assets/images/our_services4.png" alt="Судебная экспертиза">
                        <div class="service-number-mobile">04</div>
                    </div>
                    <div class="service-title-row">
                        <div class="service-number">04</div>
                        <div class="service-title-wrapper">
                            <h4 class="service-title">СУДЕБНАЯ ЭКСПЕРТИЗА<br><a href="https://sudexp.org" class="service-link-text" target="_blank">sudexp.org</a></h4>
                        </div>
                    </div>
                    <div class="service-line"></div>
                    <p class="service-description">Независимые исследования<br>и заключения для арбитражных<br>и гражданских дел</p>
                </div>
                
                <div class="service-card">
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
                </div>
                
                <div class="service-card">
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
                </div>
                
                <div class="service-card">
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
                </div>
                
                <div class="service-card">
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
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
