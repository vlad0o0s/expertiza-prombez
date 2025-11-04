<?php
require_once 'config/config.php';

// Указание ключа страницы для SEO (используется конфигурация из config/seo.php)
$page_key = 'index';

// Подключение CSS для главной страницы
$additional_css = ['/assets/css/index.css'];

// Подключение JavaScript для анимаций и маски телефона
$additional_js = [
    'https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js',
    '/assets/js/index-animations.js',
    '/assets/js/index-forms.js',
    '/assets/js/index-reviews.js',
    '/assets/js/index-faq.js'
];

include 'includes/header.php';
?>

<main>
    <section class="main-hero">
        <div class="container-fluid">
            <div class="main-hero-inner">
                <div class="hero-content animate-on-scroll fade-in">
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
                <div class="info-card card-1 animate-on-scroll delay-1">
                    <h3 class="card-title">ЭКСПЕРТИЗЫ<br>ПРОМБЕЗОПАСНОСТИ</h3>
                    <p class="card-description">Категории от Э1 до Э15</p>
                    <a href="#" class="card-link">
                        Перейти на страницу
                        <img src="/assets/images/arrowR.svg" alt="">
                    </a>
                </div>
                
                <div class="info-card card-2 animate-on-scroll delay-2">
                    <h3 class="card-title">ИНТЕРЕСНЫЕ СТАТЬИ<br>И НОВОСТИ</h3>
                    <p class="card-description">Свежие материалы о промбезопасности</p>
                    <a href="#" class="card-link">
                        Перейти на страницу
                        <img src="/assets/images/arrowR.svg" alt="">
                    </a>
                </div>
                
                <div class="info-card card-3 animate-on-scroll delay-3">
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
            <div class="services-header animate-on-scroll">
                <div class="services-title-row">
                    <img src="/assets/images/polygon.svg" alt="" class="services-icon">
                    <h2 class="services-subtitle">НАШИ УСЛУГИ</h2>
                    <div class="services-line"></div>
                    <h3 class="services-main-title">ОСНОВНЫЕ НАПРАВЛЕНИЯ<br>НАШЕЙ РАБОТЫ</h3>
                </div>
            </div>
            
            <div class="services-grid">
                <div class="service-card animate-on-scroll delay-1">
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
                
                <div class="service-card animate-on-scroll delay-2">
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
                
                <div class="service-card animate-on-scroll delay-3">
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
                
                <div class="service-card animate-on-scroll delay-4">
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
                
                <div class="service-card animate-on-scroll delay-5">
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
                
                <div class="service-card animate-on-scroll delay-6">
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
                
                <div class="service-card animate-on-scroll delay-7">
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
                
                <div class="service-card animate-on-scroll delay-8">
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
    
    <section class="company-banner animate-on-scroll">
        <div class="container-fluid">
            <div class="company-banner-inner">
                <!-- ПК версия -->
                <div class="company-desktop">
                    <img src="/assets/images/small_icon.png" alt="" class="company-icon">
                    <p class="company-text">Компания «ТОП ЭКСПЕРТ» – это команда опытных специалистов в сфере промбезопасности, обучения и аттестации экспертов,<br>а также лицензирования бизнеса</p>
                    <div class="company-buttons">
                        <a href="#" class="btn-order-company">ЗАКАЗАТЬ УСЛУГУ</a>
                        <button class="btn-arrow-company" aria-label="Перейти">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </button>
                    </div>
                </div>
                
                <!-- Мобильная версия -->
                <div class="company-mobile">
                    <p class="company-text">Компания «ТОП ЭКСПЕРТ» – это команда опытных специалистов в сфере промбезопасности, обучения и аттестации экспертов,<br>а также лицензирования бизнеса</p>
                    <div class="company-bottom-row">
                        <img src="/assets/images/small_icon.png" alt="" class="company-icon">
                        <div class="company-buttons">
                            <a href="#" class="btn-order-company">ЗАКАЗАТЬ УСЛУГУ</a>
                            <button class="btn-arrow-company" aria-label="Перейти">
                                <img src="/assets/images/Arrow.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="why-choose-us">
        <div class="container-fluid">
            <div class="why-choose-us-inner">
                <div class="why-choose-header animate-on-scroll">
                    <h2 class="why-choose-title">ПОЧЕМУ НАС ВЫБИРАЮТ</h2>
                    <div class="why-choose-line"></div>
                    <h3 class="why-choose-subtitle">ПРЕИМУЩЕСТВА</h3>
                </div>
                
                <div class="advantages-grid">
                    <div class="advantage-card animate-on-scroll delay-1">
                        <div class="advantage-icon">
                            <img src="/assets/images/our1.svg" alt="">
                        </div>
                        <h4 class="advantage-title">БОЛЕЕ 10 ЛЕТ РАБОТЫ</h4>
                        <p class="advantage-description">на рынке с 2014 года и имеем огромный опыт в работе</p>
                    </div>
                    
                    <div class="advantage-card animate-on-scroll delay-2">
                        <div class="advantage-icon">
                            <img src="/assets/images/our2.svg" alt="">
                        </div>
                        <h4 class="advantage-title">БОЛЕЕ 20 ОПЫТНЫХ ЭКСПЕРТОВ</h4>
                        <p class="advantage-description">АНО «ТОП ЭКСПЕРТ» гордится своей командой</p>
                    </div>
                    
                    <div class="advantage-card animate-on-scroll delay-3">
                        <div class="advantage-icon">
                            <img src="/assets/images/our3.svg" alt="">
                        </div>
                        <h4 class="advantage-title">НАЛИЧИЕ ЛИЦЕНЗИЙ И ДОПУСК К СРО</h4>
                        <p class="advantage-description">дает право на выполнение экспертных работ</p>
                    </div>
                    
                    <div class="advantage-card animate-on-scroll delay-4">
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
    
    <section class="contacts-section animate-on-scroll">
        <div class="container-fluid">
            <div class="contacts-inner">
                <!-- Левая колонка - Контактная информация -->
                <div class="contacts-info">
                    <div class="contacts-header">
                        <img src="/assets/images/polygon.svg" alt="" class="contacts-icon">
                        <h2 class="contacts-subtitle">КОНТАКТНАЯ ИНФОРМАЦИЯ</h2>
                    </div>
                    <h3 class="contacts-title">СВЯЖИТЕСЬ С НАМИ ЛЮБЫМ<br>СПОСОБОМ</h3>
                    
                    <div class="contacts-details">
                        <div class="contacts-row">
                            <div class="contact-item">
                                <div class="contact-label">НОМЕР ТЕЛЕФОНА</div>
                                <a href="tel:+74951270935" class="contact-value">+ 7 495 127 09-35</a>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">ЭЛЕКТРОННАЯ ПОЧТА</div>
                                <a href="mailto:info@te-g.ru" class="contact-value">info@te-g.ru</a>
                            </div>
                        </div>
                        <div class="contacts-row">
                            <div class="contact-item">
                                <div class="contact-label">АДРЕС</div>
                                <div class="contact-value">Гамсоновский пер., 2, стр. 2, этаж 2, офис 211</div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">СОЦИАЛЬНЫЕ СЕТИ</div>
                                <div class="contact-social">
                                    <a href="https://wa.me/74951270935" target="_blank" rel="noopener" aria-label="WhatsApp" class="social-icon">
                                        <img src="/assets/images/wa.svg" alt="WhatsApp">
                                    </a>
                                    <a href="https://t.me/" target="_blank" rel="noopener" aria-label="Telegram" class="social-icon">
                                        <img src="/assets/images/tg.svg" alt="Telegram">
                                    </a>
                                    <a href="mailto:info@te-g.ru" aria-label="Email" class="social-icon">
                                        <img src="/assets/images/mailfooter.svg" alt="Email">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="contacts-link">
                        Запросить коммерческое предложение
                        <img src="/assets/images/arrowR.svg" alt="">
                    </a>
                </div>
                
                <!-- Правая колонка - Форма обратного звонка -->
                <div class="callback-form-wrapper animate-on-scroll delay-1">
                    <form class="callback-form" method="POST" action="">
                        <h2 class="callback-title">ОБРАТНЫЙ ЗВОНОК</h2>
                        <p class="callback-description">Заполните форму обратной связи. После обращения с вами свяжется менеджер в рабочее время с 9:00 до 19:00</p>
                        
                        <div class="form-row">
                            <input type="text" name="name" placeholder="Ваше имя" class="form-input" required>
                            <input type="tel" name="phone" id="callback-phone" placeholder="+7 495 127 09-35" class="form-input" required>
                        </div>
                        
                        <textarea name="comment" placeholder="Комментарий" class="form-textarea" rows="4"></textarea>
                        
                        <div class="form-checkbox-wrapper">
                            <input type="checkbox" name="agree" id="callback-agree" class="form-checkbox" required>
                            <label for="callback-agree" class="form-checkbox-label">
                                Нажимая кнопку "Отправить", Вы даете согласие на обработку персональных данных и соглашаетесь с <a href="#" target="_blank">политикой конфиденциальности</a>
                            </label>
                            <div class="callback-buttons">
                                <button type="submit" class="btn-order-company">ОТПРАВИТЬ</button>
                                <button type="submit" class="btn-arrow-company" aria-label="Отправить">
                                    <img src="/assets/images/Arrow.svg" alt="">
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <section class="about-us-section animate-on-scroll">
        <div class="container-fluid">
            <!-- ПК версия -->
            <div class="about-us-inner about-us-desktop">
                <div class="about-us-image">
                    <img src="/assets/images/toch.png" alt="О компании">
                </div>
                <div class="about-us-content">
                    <div class="about-us-header">
                        <img src="/assets/images/polygon.svg" alt="" class="about-us-icon">
                        <h2 class="about-us-subtitle">О НАС</h2>
                    </div>
                    <h3 class="about-us-title">ТОЧНОСТЬ. ЭФФЕКТИВНОСТЬ. РЕЗУЛЬТАТ.</h3>
                    <div class="about-us-text">
                        <p>Наша компания работает в сфере промышленной безопасности с 2014 года и за это время зарекомендовала себя как надежный и высококвалифицированный экспертный центр. Мы сотрудничаем с предприятиями из 25 городов России, охватывая различные отрасли производства.</p>
                        <p>В штате — эксперты с многолетним опытом работы в нефтегазовой, металлургической, химической, строительной и других сферах. Специалисты активно участвуют в разработке и обсуждении технических регламентов, анализируют российский опыт предупреждения аварий и вопросы сертификации.</p>
                    </div>
                    <div class="about-us-stats">
                        <div class="stat-item">
                            <div class="stat-number" data-target="150">0+</div>
                            <div class="stat-description">отзывов на различных площадках</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-target="54">0+</div>
                            <div class="stat-description">видов судебных экспертиз по каждому направлению</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-target="3000">0+</div>
                            <div class="stat-description">проведенных экспертиз для различных судов</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Мобильная версия -->
            <div class="about-us-inner about-us-mobile">
                <div class="about-us-mobile-header">
                    <img src="/assets/images/polygon.svg" alt="" class="about-us-mobile-icon">
                    <h2 class="about-us-mobile-subtitle">О НАС</h2>
                </div>
                <div class="about-us-mobile-top">
                    <div class="about-us-mobile-image">
                        <img src="/assets/images/toch.png" alt="О компании">
                    </div>
                    <h3 class="about-us-mobile-title">
                        <span>ТОЧНОСТЬ.</span>
                        <span>ЭФФЕКТИВНОСТЬ.</span>
                        <span>РЕЗУЛЬТАТ.</span>
                    </h3>
                </div>
                <div class="about-us-mobile-text">
                    <p>Наша компания работает в сфере промышленной безопасности с 2014 года и за это время зарекомендовала себя как надежный и высококвалифицированный экспертный центр. Мы сотрудничаем с предприятиями из 25 городов России, охватывая различные отрасли производства.</p>
                    <p>В штате — эксперты с многолетним опытом работы в нефтегазовой, металлургической, химической, строительной и других сферах. Специалисты активно участвуют в разработке и обсуждении технических регламентов, анализируют российский опыт предупреждения аварий и вопросы сертификации.</p>
                </div>
                <div class="about-us-mobile-stats">
                    <div class="stat-mobile-item">
                        <div class="stat-mobile-number" data-target="150">0+</div>
                        <div class="stat-mobile-description">отзывов на различных площадках</div>
                    </div>
                    <div class="stat-mobile-item">
                        <div class="stat-mobile-number" data-target="54">0+</div>
                        <div class="stat-mobile-description">видов судебных экспертиз по каждому направлению</div>
                    </div>
                    <div class="stat-mobile-item">
                        <div class="stat-mobile-number" data-target="3000">0+</div>
                        <div class="stat-mobile-description">проведенных экспертиз для различных судов</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="reviews-section animate-on-scroll">
        <div class="container-fluid">
            <div class="reviews-header">
                <h2 class="reviews-title">ОТЗЫВЫ</h2>
                <div class="reviews-navigation">
                    <button class="reviews-prev" aria-label="Предыдущий слайд">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button class="reviews-next" aria-label="Следующий слайд">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="swiper reviews-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="review-card">
                            <div class="review-author">
                                <div class="review-name">Сергей Кузнецов</div>
                                <div class="review-role">предприниматель</div>
                            </div>
                            <div class="review-text">
                                Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">
                            <div class="review-author">
                                <div class="review-name">Сергей Кузнецов</div>
                                <div class="review-role">предприниматель</div>
                            </div>
                            <div class="review-text">
                                Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">
                            <div class="review-author">
                                <div class="review-name">Сергей Кузнецов</div>
                                <div class="review-role">предприниматель</div>
                            </div>
                            <div class="review-text">
                                Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">
                            <div class="review-author">
                                <div class="review-name">Сергей Кузнецов</div>
                                <div class="review-role">предприниматель</div>
                            </div>
                            <div class="review-text">
                                Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">
                            <div class="review-author">
                                <div class="review-name">Сергей Кузнецов</div>
                                <div class="review-role">предприниматель</div>
                            </div>
                            <div class="review-text">
                                Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">
                            <div class="review-author">
                                <div class="review-name">Сергей Кузнецов</div>
                                <div class="review-role">предприниматель</div>
                            </div>
                            <div class="review-text">
                                Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination reviews-pagination"></div>
            </div>
            <div class="reviews-footer">
                <a href="#" class="reviews-link" target="_blank">
                    Отзывы на Яндекс Картах
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 3L11 8L6 13M11 8H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    
    <section class="faq-section animate-on-scroll">
        <div class="container-fluid">
            <h2 class="faq-title">ОТВЕТЫ НА ЧАСТЫЕ ВОПРОСЫ</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-question-text">Зачем нужна экспертиза промышленной безопасности?</span>
                        <span class="faq-icon">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Она помогает выявить риски аварий и продлить срок безопасной эксплуатации оборудования и объектов.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-question-text">Как часто проводится экспертиза?</span>
                        <span class="faq-icon">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Обычно раз в несколько лет, в зависимости от типа оборудования и требований нормативных документов.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-question-text">Что проверяют эксперты?</span>
                        <span class="faq-icon">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Техническое состояние устройств, документацию, условия эксплуатации и соответствие требованиям безопасности.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-question-text">Сколько времени занимает экспертиза?</span>
                        <span class="faq-icon">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Сроки зависят от объема работ и сложности объекта, в среднем от нескольких дней до нескольких недель.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-question-text">Что делать, если объект не прошел экспертизу?</span>
                        <span class="faq-icon">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Нужно устранить выявленные нарушения, провести ремонт или модернизацию, после чего пройти повторную проверку.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
