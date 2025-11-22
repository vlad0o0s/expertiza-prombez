<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/why-choose-us/component.css">';
}
?>

<section class="why-choose-us">
    <div class="container-fluid">
        <div class="why-choose-us-inner">
            <div class="why-choose-header animate-on-scroll animated">
                <h2 class="why-choose-title">ПОЧЕМУ НАС ВЫБИРАЮТ</h2>
                <div class="why-choose-line"></div>
                <h3 class="why-choose-subtitle">ПРЕИМУЩЕСТВА</h3>
            </div>
            
            <div class="advantages-grid">
                <div class="advantage-card animate-on-scroll delay-1 animated">
                    <div class="advantage-icon">
                        <img src="/assets/images/our1.svg" alt="">
                    </div>
                    <h4 class="advantage-title">БОЛЕЕ 10 ЛЕТ РАБОТЫ</h4>
                    <p class="advantage-description">на рынке с 2014 года и имеем огромный опыт в работе</p>
                </div>
                
                <div class="advantage-card animate-on-scroll delay-2 animated">
                    <div class="advantage-icon">
                        <img src="/assets/images/our2.svg" alt="">
                    </div>
                    <h4 class="advantage-title">БОЛЕЕ 20 ОПЫТНЫХ ЭКСПЕРТОВ</h4>
                    <p class="advantage-description">АНО «ТОП ЭКСПЕРТ» гордится своей командой</p>
                </div>
                
                <div class="advantage-card animate-on-scroll delay-3 animated">
                    <div class="advantage-icon">
                        <img src="/assets/images/our3.svg" alt="">
                    </div>
                    <h4 class="advantage-title">НАЛИЧИЕ ЛИЦЕНЗИЙ И ДОПУСК К СРО</h4>
                    <p class="advantage-description">дает право на выполнение экспертных работ</p>
                </div>
                
                <div class="advantage-card animate-on-scroll delay-4 animated">
                    <div class="advantage-icon">
                        <img src="/assets/images/our4.svg" alt="">
                    </div>
                    <h4 class="advantage-title">БОЛЕЕ 2000 КЛИЕНТОВ</h4>
                    <p class="advantage-description">и реализованных проектов различной сложности</p>
                </div>
            </div>
        </div>
    </div>
</section>

