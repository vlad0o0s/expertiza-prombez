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
</main>

<?php include 'includes/footer.php'; ?>
