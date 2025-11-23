<?php
/**
 * Динамический шаблон ЭПБ
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';
require_once __DIR__ . '/../includes/epb-functions.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('HTTP/1.0 404 Not Found');
    include __DIR__ . '/../404.php';
    exit;
}

$epb = getEpbBySlug($slug);

if (!$epb) {
    header('HTTP/1.0 404 Not Found');
    include __DIR__ . '/../404.php';
    exit;
}

$page_key = 'expertiza-template';

// Подключение CSS
$additional_css = [];
$additional_css[] = '/components/breadcrumbs/component.css';
$additional_css[] = '/components/commercial-proposal-form/component.css';
$additional_css[] = '/components/reviews/component.css';
$additional_css[] = '/components/faq/component.css';
$additional_css[] = '/components/expertiza-template/component.css';

// Подключение JavaScript
$additional_js = [];
$additional_js[] = 'https://cdn.jsdelivr.net/npm/imask@6.4.3/dist/imask.min.js';
$additional_js[] = '/components/expertiza-template/component.js';

include __DIR__ . '/../includes/header.php';

?>

<main>
    <?php
    load_component('breadcrumbs', [
        'items' => [
            ['title' => 'Главная', 'url' => '/'],
            ['title' => htmlspecialchars($epb['title']), 'url' => null]
        ]
    ]);
    ?>

    <!-- Hero секция ЭПБ -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-section-inner">
                <div class="hero-left-column">
                    <img class="hero-image" src="<?php echo htmlspecialchars($epb['hero_image'] ?? '/assets/images/hero.png'); ?>"
                        alt="<?php echo htmlspecialchars($epb['title']); ?>" />
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
                    <h1 class="hero-title"><?php echo htmlspecialchars($epb['title']); ?></h1>
                    <?php if (!empty($epb['category'])): ?>
                        <p class="hero-category"><?php echo htmlspecialchars($epb['category']); ?></p>
                    <?php endif; ?>
                    <div class="hero-description">
                        <?php echo $epb['hero_content']; ?>
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
            <article class="features-content">
                <?php echo $epb['features_content']; ?>
            </article>
        </div>
    </section>

    <!-- Ответственность -->
    <?php load_component('responsibility-section', [
        'title' => 'КАКАЯ ОТВЕТСТВЕННОСТЬ<br />ЗА НЕПРОВЕДЕНИЕ ЭПБ?',
        'text' => 'Всё зависит от конкретной ситуации, но в целом, штрафы для ЮЛ и ИП колеблются от 500 000₽ до 1 000 000₽',
        'icon' => '/assets/images/Polygon 7.svg'
    ]); ?>

    <!-- Предупреждение -->
    <?php load_component('warning-section', [
        'warning_secondary' => 'Компания «ТОП ЭКСПЕРТ» предупреждает вас, что заключение, подготовленное без фактического проведения указанной экспертизы или которое противоречит содержанию материалов предоставленных эксперту по промышленной безопасности или не соответствует фактическому состоянию технических устройств, зданий и сооружений на ОПО, являвшихся объектами экспертизы промышленной безопасности влечет за собой исключение из реестра ложного заключения ЭПБ, а ответственные должностные лица несут административную (п.4 ст.9.1 КоАП РФ) или уголовную ответственность (ст.217.2 УК РФ).',
        'warning_primary' => 'Чтобы быть уверенными в безопасности своего предприятия и получить объективные результаты, а также полностью исключить возможность претензий со стороны контролирующих и надзорных органов, следует обращаться только в проверенные экспертные организации, основной специализацией которых является промышленная безопасность, какой является компания «ТОП ЭКСПЕРТ».',
        'contact_form_id' => 'contact-form',
        'warning_image' => '/assets/images/Текст абзаца (3) 1.png',
        'background_image' => '/assets/images/image 6344877.png'
    ]); ?>

    <!-- Другие экспертизы -->
    <?php 
    // Получаем список других ЭПБ (исключая текущую)
    $otherEpb = getEpbList();
    $otherEpb = array_filter($otherEpb, function($item) use ($epb) {
        return $item['id'] != $epb['id'];
    });
    $otherEpb = array_slice($otherEpb, 0, 6); // Берем первые 6
    
    // Преобразуем в формат для компонента
    $otherServices = [];
    foreach ($otherEpb as $item) {
        $otherServices[] = [
            'image' => '/assets/images/test.png',
            'title' => mb_strtoupper(htmlspecialchars($item['title'])),
            'description' => mb_substr(strip_tags($item['hero_content']), 0, 100) . '...',
            'category' => htmlspecialchars($item['category'] ?? ''),
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '/' . htmlspecialchars($item['slug']),
            'active' => false
        ];
    }
    
    // Если нет других ЭПБ, используем дефолтные данные
    if (empty($otherServices)) {
        $otherServices = [
            [
                'image' => '/assets/images/test.png',
                'title' => 'ЭПБ ОБЪЕКТОВ С ОПАСНЫМИ ВЕЩЕСТВАМИ',
                'description' => 'Проверяем соответствие ОПО, анализируем риски утечек и меры защиты',
                'category' => 'Э1',
                'price' => 'от 30 000 ₽',
                'term' => 'от 15 дней',
                'link' => '#',
                'active' => false
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
            ]
        ];
    }
    
    load_component('other-services-section', [
        'title' => 'ДРУГИЕ<br />ЭКСПЕРТИЗЫ',
        'services' => $otherServices
    ]); 
    ?>

    <!-- Форма контактов -->
    <?php load_component('contact-form', [
        'form_id' => 'contact-form',
        'name_id' => 'name',
        'phone_id' => 'phone',
        'consent_id' => 'consent'
    ]); ?>

    <!-- Этапы проведения -->
    <?php load_component('stages-section', [
        'title' => 'ЭТАПЫ ПРОВЕДЕНИЯ ЭПБ',
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
                'description' => 'Мы оцениваем предоставленные данные, формируем перечень необходимых исследований и согласовываем условия сотрудничества'
            ],
            [
                'number' => '03',
                'title' => 'Оформление договора <br />и оплата услуг',
                'description' => 'Заключается договор, уточняются сроки, после чего производится оплата выбранных услуг'
            ],
            [
                'number' => '04',
                'title' => 'Проведение <br />экспертизы',
                'description' => 'Наши специалисты проводят исследование, применяя современные методики и оборудование'
            ],
            [
                'number' => '05',
                'title' => 'Подготовка и выдача экспертного заключения',
                'description' => 'Вы получаете официальный документ с детальным анализом, выводами и обоснованиями, который можно использовать в суде или других инстанциях'
            ]
        ],
        'contact_form_id' => 'contact-form'
    ]); ?>

    <!-- Отзывы -->
    <?php load_component('reviews'); ?>

    <!-- FAQ -->
    <?php load_component('faq'); ?>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

