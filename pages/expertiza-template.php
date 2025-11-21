<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';

$page_key = 'expertiza-template';

// Данные для страницы (в будущем можно вынести в БД или конфиг)
$expertiza_data = [
    'title' => 'ЭПБ подъемных сооружений и кранов',
    'category' => 'Категория Э3',
    'image' => '/assets/images/hero.png',
    'description' => '— это комплекс работ по оценке их технического состояния и соответствия нормам промышленной безопасности, проводимый для безаварийной работы и снижения затрат на обслуживание.',
    'full_text' => '<p>Эксплуатация подъемных сооружений работающих в составе опасных промышленных объектов без положительного заключения экспертизы промышленной безопасности не допускается, и является административным правонарушением, влекущим за собой приостановление деятельности и крупные штрафы (<a href="https://www.consultant.ru/document/cons_doc_LAW_34661/6db72644d55f955ad23b924b678184a5d027d99f/" target="_blank" rel="noopener noreferrer" class="hero-link">ст. 9.1. КоАП</a>)</p>
    <p>При этом наступления каких-либо последствий не обязательно, достаточно самого факта нарушения. Обязанность проведения своевременной экспертизы возложена на эксплуатирующую организацию в лице ответственного за промышленную безопасность, либо руководителя.</p>
    <p>Обязательность проведения экспертизы промышленной безопасности (ЭПБ) в отношении кранов и других подъемных сооружений установлена <a href="https://docs.cntd.ru/document/578329532" target="_blank" rel="noopener noreferrer" class="hero-link">ФЗ №116</a>. Положения Федерального Закона развиваются в приказе Ростехнадзора <a href="https://docs.cntd.ru/document/573275657" target="_blank" rel="noopener noreferrer" class="hero-link">№ 461</a> содержащем «Правила безопасности опасных производственных объектов, на которых используются подъемные сооружения» (далее ФНП №461). Данный норматив содержит классификацию групп ПС, приводит перечень кранов подлежащих учету в Ростехнадзоре, устанавливает основные требования ЭПБ, особенности оценки технического состояния и критерии браковки отдельных элементов.</p>',
    'features_text' => '<p><strong>При проведении экспертизы промышленной безопасности ПС должны быть выполнены следующие работы:</strong></p>
    <ul>
        <li>полное техническое освидетельствование;</li>
        <li>оценка качества завершенного монтажа, ремонта, реконструкции;</li>
        <li>оценка комплектности и работоспособности системы управления, указателей, ограничителей и регистраторов;</li>
        <li>проверка комплектности и качества болтовых соединений;</li>
        <li>подтверждение качества ремонта, реконструкции, либо указать на приостановку эксплуатации ПС и отправку его на исправление отмеченных несоответствий, либо дать разрешение на дальнейшую эксплуатацию со снижением показателей назначения (например, грузоподъемности, скоростей механизмов).</li>
    </ul>
    <p>Экспертиза промышленной безопасности проводится только для подъемных сооружений, которые подлежат учету в федеральном органе исполнительной власти в области промбезопасности, осуществляющий ведение реестра ОПО, и не подлежащие учету, экспертизе промышленной безопасности не подлежат.</p>
    <p>При проведении экспертизы промышленной безопасности ПС проводится визуальный и измерительный контроль основного металла, сварных и болтовых соединений, геометрических параметров и состояния несущих металлоконструкций, проводятся проверки работоспособности и соответствия требованиям, установленным в документации изготовителя, узлов, механизмов, гидравлического оборудования, канатно-блочной системы, электрооборудования техники, приборов безопасности, указателей, ограничителей, регистраторов, средств автоматической остановки, предупредительной сигнализации, кранового пути для кранов передвигающихся по рельсовым направляющим в зоне обследования крана, протяженностью не менее трех баз крана.</p>
    <p><strong>При проведении экспертизы промышленной безопасности ПС с истекшим сроком службы обследования подразделяется на следующие виды:</strong></p>
    <ul>
        <li><strong>Первичное</strong> - проверка проводится после выработки срока службы, установленного изготовителем.</li>
        <li><strong>Повторное</strong> - проводится в сроки, установленные экспертной организацией.</li>
        <li><strong>Внеочередное</strong> - может проводиться вне зависимости от срока эксплуатации крана: по требованию ФСЭТАН или по заявлению заказчика; в случаях выявления опасных дефектов в металлоконструкциях техники, вызывающих переход ее в предельное состояние; при подготовке дубликата паспорта; после модернизации, реконструкции, ремонта, монтажа, аварии.</li>
    </ul>
    <p>Экспертное обследование проводится на основании заявки владельца ПС или других документов в соответствии с согласованными экспертной организацией и заказчиком условиями.</p>
    <p><strong>Документы на проведение экспертизы ПС составляются после согласования договаривающимися сторонами:</strong></p>
    <ul>
        <li>типов ПС и их количества</li>
        <li>технических характеристик и условий эксплуатации</li>
        <li>перечня информации, в соответствии с действующей НТД</li>
        <li>требований, обязательных для проведения экспертизы</li>
        <li>сроков проведения работ по экспертному обследованию и передачи заключения владельцу ПС</li>
        <li>других организационно-технических вопросов</li>
    </ul>',
    'responsibility_text' => 'Всё зависит от конкретной ситуации, но в целом, штрафы для ЮЛ и ИП колеблются от 500 000₽ до 1 000 000₽',
    'warning_primary' => 'Чтобы быть уверенными в безопасности своего предприятия и получить объективные результаты, а также полностью исключить возможность претензий со стороны контролирующих и надзорных органов, следует обращаться только в проверенные экспертные организации, основной специализацией которых является промышленная безопасность, какой является компания «ТОП ЭКСПЕРТ».',
    'warning_secondary' => 'Компания «ТОП ЭКСПЕРТ» предупреждает вас, что заключение, подготовленное без фактического проведения указанной экспертизы или которое противоречит содержанию материалов предоставленных эксперту по промышленной безопасности или не соответствует фактическому состоянию технических устройств, зданий и сооружений на ОПО, являвшихся объектами экспертизы промышленной безопасности влечет за собой исключение из реестра ложного заключения ЭПБ, а ответственные должностные лица несут административную (п.4 ст.9.1 КоАП РФ) или уголовную ответственность (ст.217.2 УК РФ).',
    'other_services' => [
        [
            'image' => '/assets/images/test.png',
            'title' => 'ЭПБ ОБЪЕКТОВ С ОПАСНЫМИ ВЕЩЕСТВАМИ',
            'description' => 'Проверяем соответствие ОПО, анализируем риски утечек и меры защиты',
            'category' => 'Э1',
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '#',
            'active' => true
        ],
        [
            'image' => '/assets/images/test.png',
            'title' => 'ЭПБ ОБОРУДОВАНИЯ, РАБОТАЮЩЕГО ПОД ДАВЛЕНИЕМ',
            'description' => 'Оцениваем прочность и герметичность, подтверждаем безопасную дальнейшую эксплуатацию',
            'category' => 'Э2',
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '#',
            'active' => false
        ],
        [
            'image' => '/assets/images/test.png',
            'title' => 'ЭПБ ГАЗОВОГО ОБОРУДОВАНИЯ<br />И ГАЗОПРОВОДОВ',
            'description' => 'Диагностируем состояния и режимы, предупреждаем утечки и взрывоопасные ситуации',
            'category' => 'Э4',
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '#',
            'active' => false
        ],
        [
            'image' => '/assets/images/test.png',
            'title' => 'ЭПБ ОБЪЕКТОВ С ГОРЮЧИМИ <br />ЖИДКОСТЯМИ',
            'description' => 'Оцениваем хранение и перекачку, контролируем пожарную и противоаварийную защиту',
            'category' => 'Э5',
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '#',
            'active' => false
        ],
        [
            'image' => '/assets/images/test.png',
            'title' => 'ЭПБ ПОДЪЕМНЫХ СООРУЖЕНИЙ И КРАНОВ',
            'description' => 'Проводим экспертизу подъемных сооружений и кранов для обеспечения безопасности',
            'category' => 'Э3',
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '#',
            'active' => false
        ],
        [
            'image' => '/assets/images/test.png',
            'title' => 'ЭПБ МЕТАЛЛУРГИЧЕСКОГО ОБОРУДОВАНИЯ',
            'description' => 'Оцениваем состояние металлургического оборудования и его соответствие нормам',
            'category' => 'Э6',
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '#',
            'active' => false
        ],
        [
            'image' => '/assets/images/test.png',
            'title' => 'ЭПБ ГОРНОРУДНОГО ОБОРУДОВАНИЯ',
            'description' => 'Проверяем безопасность горнорудного оборудования и его эксплуатацию',
            'category' => 'Э7',
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '#',
            'active' => false
        ]
    ],
    'stages' => [
        [
            'number' => '01',
            'title' => 'Консультация и сбор информации',
            'description' => 'Вы описываете ситуацию, предоставляете необходимые документы и материалы',
            'link' => true
        ],
        [
            'number' => '02',
            'title' => 'Анализ запроса <br />и определение задач',
            'description' => 'Мы оцениваем предоставленные данные, формируем перечень необходимых исследований <br />и согласовываем условия сотрудничества'
        ],
        [
            'number' => '03',
            'title' => 'Оформление договора <br />и оплата услуг',
            'description' => 'Заключается договор, уточняются сроки, после чего производится оплата выбранных услуг'
        ],
        [
            'number' => '04',
            'title' => 'Проведение <br />экспертизы',
            'description' => 'Наши специалисты проводят исследование, применяя современные методики <br />и оборудование'
        ],
        [
            'number' => '05',
            'title' => 'Подготовка и выдача экспертного заключения',
            'description' => 'Вы получаете официальный документ с детальным анализом, выводами и обоснованиями, который можно использовать <br />в суде или других инстанциях'
        ]
    ]
];

// Подключение CSS
$additional_css = [];
$additional_css[] = '/components/breadcrumbs/component.css';
$additional_css[] = '/components/commercial-proposal-form/component.css';
$additional_css[] = '/components/reviews/component.css';
$additional_css[] = '/components/faq/component.css';
$additional_css[] = '/components/expertiza-template/component.css';

// Подключение JavaScript
$additional_js = [];
$additional_js[] = '/components/expertiza-template/component.js';

include __DIR__ . '/../includes/header.php';

?>

<main>
    <?php
    load_component('breadcrumbs', [
        'items' => [
            ['title' => 'Главная', 'url' => '/'],
            ['title' => $expertiza_data['title'], 'url' => null]
        ]
    ]);
    ?>

    <!-- Hero секция экспертизы -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-section-inner">
                <div class="hero-left-column">
                    <img class="hero-image" src="<?php echo htmlspecialchars($expertiza_data['image']); ?>"
                        alt="<?php echo htmlspecialchars($expertiza_data['title']); ?>" />
                    <!-- Секция "Кому нужна экспертиза" -->
                    <div class="who-needs-section">
                        <h2 class="who-needs-title">КОМУ НУЖНА ЭКСПЕРТИЗА<br />ПРОМБЕЗОПАСНОСТИ?</h2>
                        <div class="who-needs-content">
                            <img class="who-needs-icon" src="/assets/images/Polygon 7.svg" alt="" />
                            <p class="who-needs-text">
                                Юридическим лицам и индивидуальным предпринмателям,<br />эксплуатирующим опасные
                                производственные
                                объекты
                            </p>
                        </div>
                        <a href="#contact-form" class="who-needs-question">
                            <span>Является ли мое предприятие опасным производственным объектом?</span>
                            <img src="/assets/images/Arrow.svg" alt="" />
                        </a>
                    </div>
                </div>
                <div class="hero-content">
                    <h1 class="hero-title"><?php echo htmlspecialchars($expertiza_data['title']); ?></h1>
                    <p class="hero-category"><?php echo htmlspecialchars($expertiza_data['category']); ?></p>
                    <div class="hero-description">
                        <?php echo $expertiza_data['full_text']; ?>
                    </div>
                    <div class="hero-buttons">
                        <a href="#contact-form" class="btn-order">ЗАКАЗАТЬ УСЛУГУ</a>
                        <button class="btn-arrow" aria-label="Перейти">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Особенности ЭПБ -->
    <section class="features-section">
        <div class="container">
            <h2 class="features-title">ОСОБЕННОСТИ ЭПБ ПОДЪЕМНЫХ СООРУЖЕНИЙ И КРАНОВ</h2>
            <article class="features-content">
                <?php echo $expertiza_data['features_text']; ?>
            </article>
        </div>
    </section>

    <!-- Ответственность -->
    <section class="responsibility-section">
        <div class="container">
            <div class="responsibility-inner">
                <h2 class="responsibility-title">КАКАЯ ОТВЕТСТВЕННОСТЬ<br />ЗА НЕПРОВЕДЕНИЕ ЭПБ?</h2>
                <div class="responsibility-content">
                    <div class="responsibility-text">
                        <p>
                            <?php echo htmlspecialchars($expertiza_data['responsibility_text']); ?>
                        </p>
                        <img class="responsibility-icon" src="/assets/images/Polygon 7.svg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Предупреждение -->
    <section class="warning-section">
        <div class="container">
            <div class="warning-section-inner">
                <img class="warning-image" src="/assets/images/Текст абзаца (3) 1.png" alt="Предупреждение" />
                <div class="warning-content">
                    <p class="warning-text-secondary">
                        <?php echo htmlspecialchars($expertiza_data['warning_secondary']); ?>
                    </p>
                    <a href="#contact-form" class="warning-link">
                        <span>Оставить заявку на проведение экспертизы</span>
                        <img src="/assets/images/arrow-43.svg" alt="" />
                    </a>
                </div>
            </div>
            <p class="warning-text-primary">
                <?php echo htmlspecialchars($expertiza_data['warning_primary']); ?>
            </p>
        </div>
    </section>

    <!-- Другие экспертизы -->
    <section class="other-services-section">
        <div class="container">
            <div class="other-services-header">
                <h2 class="other-services-title">ДРУГИЕ<br />ЭКСПЕРТИЗЫ</h2>
                <div class="other-services-navigation">
                    <button class="other-services-prev" aria-label="Предыдущий слайд">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button class="other-services-next" aria-label="Следующий слайд">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="swiper other-services-swiper">
                <div class="swiper-wrapper other-services-carousel">
                    <?php foreach ($expertiza_data['other_services'] as $service): ?>
                        <div class="swiper-slide">
                            <article class="service-card <?php echo $service['active'] ? 'service-card-active' : ''; ?>">
                                <img class="service-card-image" src="<?php echo htmlspecialchars($service['image']); ?>"
                                    alt="<?php echo htmlspecialchars(strip_tags($service['title'])); ?>" />
                                <div class="service-card-content">
                                    <div class="service-card-info">
                                        <div class="service-card-info-item">
                                            <span class="service-card-info-label">Стоимость</span>
                                            <span
                                                class="service-card-info-value"><?php echo htmlspecialchars($service['price']); ?></span>
                                        </div>
                                        <span class="service-card-divider"></span>
                                        <div class="service-card-info-item">
                                            <span class="service-card-info-label">Сроки</span>
                                            <span
                                                class="service-card-info-value"><?php echo htmlspecialchars($service['term']); ?></span>
                                        </div>
                                    </div>
                                    <h3 class="service-card-title"><?php echo $service['title']; ?></h3>
                                    <p class="service-card-description">
                                        <?php echo htmlspecialchars($service['description']); ?>
                                    </p>
                                    <a href="<?php echo htmlspecialchars($service['link']); ?>" class="service-card-link">
                                        <span>Подробнее</span>
                                        <img src="/assets/images/arrow-39-4.svg" alt="" />
                                    </a>
                                    <span
                                        class="service-card-category"><?php echo htmlspecialchars($service['category']); ?></span>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Форма контактов -->
    <section class="contact-form-section" id="contact-form">
        <div class="container">
            <div class="contact-form-section-inner">
                <h2 class="contact-form-title">ОСТАВЛЯЙТЕ ЗАЯВКУ — НАЧНЕМ РАБОТУ</h2>
                <p class="contact-form-description">
                    Заполните форму обратной связи. После обращения с вами свяжется менеджер в рабочее время с 9:00 до
                    19:00
                </p>
                <form class="contact-form" action="/sendmail.php" method="post">
                    <div class="contact-form-row">
                        <div class="contact-form-field">
                            <label for="name" class="contact-form-label">Ваше имя</label>
                            <input type="text" id="name" name="name" class="contact-form-input" placeholder="Имя"
                                required />
                        </div>
                        <div class="contact-form-field">
                            <label for="phone" class="contact-form-label">Ваш номер телефона</label>
                            <input type="tel" id="phone" name="phone" class="contact-form-input"
                                placeholder="+ 7 495 127 09-35" required />
                        </div>
                        <button type="submit" class="contact-form-submit">
                            <span class="contact-form-submit-text">ОТПРАВИТЬ</span>
                            <span class="contact-form-submit-icon">
                                <img src="/assets/images/Arrow.svg" alt="" />
                            </span>
                        </button>
                    </div>
                    <div class="contact-form-consent">
                        <input type="checkbox" id="consent" name="consent" class="contact-form-checkbox" required />
                        <label for="consent" class="contact-form-consent-text">
                            Нажимая кнопку "Отправить", Вы даете согласие на
                            <a href="#" class="contact-form-consent-link">обработку персональных данных и соглашаетесь с
                                политикой конфиденциальности</a>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Этапы проведения -->
    <section class="stages-section">
        <div class="container">
            <h2 class="stages-title">ЭТАПЫ ПРОВЕДЕНИЯ ЭПБ</h2>
            <img class="stages-indicator" src="/assets/images/group-1597882195.png" alt="" />
            <div class="stages-list">
                <?php foreach ($expertiza_data['stages'] as $stage): ?>
                    <article class="stage-item">
                        <span class="stage-number"><?php echo htmlspecialchars($stage['number']); ?></span>
                        <h3 class="stage-title"><?php echo $stage['title']; ?></h3>
                        <p class="stage-description"><?php echo $stage['description']; ?></p>
                        <?php if (isset($stage['link']) && $stage['link']): ?>
                            <a href="#contact-form" class="stage-link">
                                <span>Оставить заявку</span>
                                <img src="/assets/images/arrow-39-3.svg" alt="" />
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Отзывы -->
    <?php load_component('reviews'); ?>

    <!-- FAQ -->
    <?php load_component('faq'); ?>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>