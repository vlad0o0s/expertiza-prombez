<?php
/**
 * Динамический шаблон услуги
 * Если slug = "laboratoriya-nerazrushayushchego-kontrolya" - использует шаблон лаборатории
 * Иначе - использует шаблон статьи
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';
require_once __DIR__ . '/../includes/services-functions.php';
require_once __DIR__ . '/../includes/epb-functions.php';
require_once __DIR__ . '/../includes/expertiza-articles-functions.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    http_response_code(404);
    die('Страница не найдена');
}

// Сначала проверяем статьи экспертизы
$expertizaArticle = getExpertizaArticleBySlug($slug);
if ($expertizaArticle) {
    // Если найдена статья экспертизы, используем шаблон экспертизы с данными из БД
    // Передаем данные статьи в шаблон
    $expertiza_data = [
        'title' => $expertizaArticle['title'],
        'category' => $expertizaArticle['category_name'] ?? '',
        'image' => $expertizaArticle['hero_image'] ?? '/assets/images/hero.png',
        'full_text' => $expertizaArticle['hero_content'] ?? '',
        'features_text' => $expertizaArticle['features_content'] ?? '',
        'responsibility_text' => 'Всё зависит от конкретной ситуации, но в целом, штрафы для ЮЛ и ИП колеблются от 500 000₽ до 1 000 000₽',
        'warning_primary' => 'Чтобы быть уверенными в безопасности своего предприятия и получить объективные результаты, а также полностью исключить возможность претензий со стороны контролирующих и надзорных органов, следует обращаться только в проверенные экспертные организации, основной специализацией которых является промышленная безопасность, какой является компания «ТОП ЭКСПЕРТ».',
        'warning_secondary' => 'Компания «ТОП ЭКСПЕРТ» предупреждает вас, что заключение, подготовленное без фактического проведения указанной экспертизы или которое противоречит содержанию материалов предоставленных эксперту по промышленной безопасности или не соответствует фактическому состоянию технических устройств, зданий и сооружений на ОПО, являвшихся объектами экспертизы промышленной безопасности влечет за собой исключение из реестра ложного заключения ЭПБ, а ответственные должностные лица несут административную (п.4 ст.9.1 КоАП РФ) или уголовную ответственность (ст.217.2 УК РФ).',
    ];
    
    // Получаем другие статьи экспертизы для секции "Другие экспертизы"
    require_once __DIR__ . '/../includes/expertiza-articles-functions.php';
    $allExpertizaArticles = getAllExpertizaArticles();
    $otherArticles = array_filter($allExpertizaArticles, function($item) use ($expertizaArticle) {
        return $item['id'] != $expertizaArticle['id'] && $item['published'] == 1;
    });
    $otherArticles = array_slice($otherArticles, 0, 6);
    
    // Преобразуем в формат для компонента
    $otherServices = [];
    foreach ($otherArticles as $item) {
        $otherServices[] = [
            'image' => '/assets/images/test.png',
            'title' => mb_strtoupper(htmlspecialchars($item['title'])),
            'description' => mb_substr(strip_tags($item['hero_content'] ?? ''), 0, 100) . '...',
            'category' => htmlspecialchars($item['category_name'] ?? ''),
            'price' => 'от 30 000 ₽',
            'term' => 'от 15 дней',
            'link' => '/' . htmlspecialchars($item['slug']),
            'active' => false
        ];
    }
    
    // Если нет других статей, используем дефолтные данные
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
    
    $expertiza_data['other_services'] = $otherServices;
    
    // Этапы проведения (можно оставить дефолтные или вынести в БД)
    $expertiza_data['stages'] = [
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
    ];
    
    include __DIR__ . '/expertiza-template.php';
    exit;
}

// Затем проверяем услуги
$service = getServiceBySlug($slug);

// Если услуга не найдена, проверяем ЭПБ
if (!$service) {
    $epb = getEpbBySlug($slug);
    if ($epb) {
        // Если найдено ЭПБ, включаем обработчик ЭПБ напрямую
        $_GET['slug'] = $slug;
        include __DIR__ . '/epb.php';
        exit;
    }
    // Если не найдено ни услуги, ни ЭПБ, ни статьи экспертизы - 404
    http_response_code(404);
    die('Страница не найдена');
}

// Если категория услуги - "Лаборатория неразрушающего контроля" - используем специальный шаблон
if (!empty($service['category_slug']) && $service['category_slug'] === 'laboratoriya-nerazrushayushchego-kontrolya') {
    // Используем специальный шаблон лаборатории с данными из БД
    $page_key = 'laboratoriya-nerazrushayushchego-kontrolya';
    
    // Подключение CSS
    $additional_css = [];
    $additional_css[] = '/assets/css/index.css';
    $additional_css[] = '/components/breadcrumbs/component.css';
    $additional_css[] = '/components/company-banner/component.css';
    $additional_css[] = '/components/lab-licenses-banner/component.css';
    $additional_css[] = '/components/why-choose-us/component.css';
    $additional_css[] = '/components/reviews/component.css';
    $additional_css[] = '/components/faq/component.css';
    $additional_css[] = '/assets/css/laboratoriya-nerazrushayushchego-kontrolya.css';
    
    // Подключение JavaScript
    $additional_js = [];
    $additional_js[] = '/assets/js/index-animations.js';
    $additional_js[] = '/components/reviews/component.js';
    $additional_js[] = '/components/faq/component.js';
    
    include __DIR__ . '/../includes/header.php';
    
    // Парсим список оборудования из текста (каждая строка с "-" это элемент списка)
    $equipmentItems = [];
    if (!empty($service['equipment_list'])) {
        $lines = explode("\n", $service['equipment_list']);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                // Убираем "-" в начале, если есть
                $line = preg_replace('/^-\s*/', '', $line);
                if (!empty($line)) {
                    $equipmentItems[] = $line;
                }
            }
        }
    }
    
    // Если список оборудования пуст, используем значения по умолчанию
    if (empty($equipmentItems)) {
        $equipmentItems = [
            'аппараты рентгеновские импульсные',
            'аппараты ультразвуковые',
            'денситометры',
            'эталоны, комплекты мер, ручной РЭП',
            'наборы ВИК',
            'толщиномеры',
            'дозиметры и т.д.'
        ];
    }
    
    // Значения по умолчанию для цены и сроков
    $price = $service['price'] ?? 'от 17 000₽';
    $term = $service['term'] ?? 'от 20 дней';
    ?>
    
    <main>
        <?php
        load_component('breadcrumbs', [
            'items' => [
                ['title' => 'Главная', 'url' => '/'],
                ['title' => 'Лаборатория неразрушающего контроля', 'url' => null]
            ]
        ]);
        ?>
    
        <section class="hero-section">
            <div class="hero-content-wrapper">
                <div class="hero-content">
                    <h1 class="hero-title"><?php echo mb_strtoupper(htmlspecialchars($service['title'] ?? 'ЛАБОРАТОРИЯ НЕРАЗРУШАЮЩЕГО КОНТРОЛЯ')); ?></h1>
                    <p class="hero-description">
                        <?php echo htmlspecialchars($service['description'] ?? 'Лаборатория неразрушающего контроля является структурным подразделением компании «ТОП ЭКСПЕРТ». Главной целью функционирования лаборатории является обеспечение и поддержание высокого качества работ при изготовлении, строительстве, эксплуатации, монтаже, ремонте, реконструкции и техническом диагностировании объектов, за счет выявления недопустимых дефектов методами неразрушающего контроля, обеспечение достоверности результатов контроля и проведения на этой основе технически обоснованных корректирующих и предупреждающих действий.'); ?>
                    </p>
                </div>
                <div class="equipment-section">
                    <h2 class="equipment-title">ЛАБОРАТОРИЯ ОСАЩЕНА СОВРЕМЕННЫМ ОБОРУДОВАНИЕМ И ПРИБОРАМИ:</h2>
                    <ul class="equipment-list">
                        <?php foreach ($equipmentItems as $item): ?>
                            <li class="equipment-item">- <?php echo htmlspecialchars($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="company-buttons">
                        <a href="#" class="btn-order-company">ЗАКАЗАТЬ УСЛУГУ</a>
                        <button class="btn-arrow-company" aria-label="Перейти">
                            <img src="/assets/images/Arrow.svg" alt="">
                        </button>
                    </div>
                </div>
            </div>
            <div class="equipment-chemical-section">
                <div class="hero-image-wrapper">
                    <img class="hero-image" src="<?php echo htmlspecialchars($service['hero_image'] ?? '/assets/images/lb.png'); ?>" alt="Лаборатория неразрушающего контроля" />
                    <div class="hero-image-overlay" aria-hidden="true"></div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <p class="hero-stat-label">Стоимость экспертизы</p>
                            <p class="hero-stat-value"><?php echo htmlspecialchars($price); ?></p>
                        </div>
                        <span class="hero-stat-divider" aria-hidden="true"></span>
                        <div class="hero-stat">
                            <p class="hero-stat-label">Сроки проведения</p>
                            <p class="hero-stat-value"><?php echo htmlspecialchars($term); ?></p>
                        </div>
                    </div>
                </div>
    
                <div class="chemical-lab-section">
                    <div class="chemical-lab-images">
                        <img class="chemical-lab-image" src="/assets/images/himlab.png" alt="Лабораторная посуда" />
                        <img class="chemical-lab-image-secondary" src="/assets/images/himlab.png"
                            alt="Химическая лаборатория" />
                    </div>
                    <div class="chemical-lab-content">
                        <h2 class="chemical-lab-title">ХИМИЧЕСКАЯ ЛАБОРАТОРИЯ</h2>
                        <ul class="chemical-lab-list">
                            <li class="chemical-lab-item">Химическая экспертиза строительных материалов</li>
                            <li class="chemical-lab-item">Анализ нефтепродуктов и ГСМ</li>
                            <li class="chemical-lab-item">Химический анализ металлов и сплавов</li>
                            <li class="chemical-lab-item">Лабораторные испытания бетона и цемента</li>
                            <li class="chemical-lab-item">Экспертиза коррозии металлоконструкций</li>
                            <li class="chemical-lab-item">Анализ агрессивности производственной среды</li>
                        </ul>
                        <a href="#chemical-lab-details" class="chemical-lab-link">
                            <span class="chemical-lab-link-text">Подробнее</span>
                            <img class="chemical-lab-link-icon" src="/assets/images/Arrow.svg" alt="" aria-hidden="true" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    
        <?php
        load_component('lab-services-section', [
            'title' => 'УСЛУГИ<br>ЛАБОРАТОРИИ<br>НЕРАЗРУШАЮЩЕГО КОНТРОЛЯ',
            'services' => [
                [
                    'image' => '/assets/images/test.png',
                    'title' => 'УЛЬТРАЗВУКОВОЙ КОНТРОЛЬ СВАРНЫХ ШВОВ',
                    'description' => 'Неразрушающий метод диагностики, который использует ультразвуковые волны для обнаружения внутренних дефектов в сварных швах без повреждения конструкции',
                    'price' => 'от 30 000 ₽',
                    'term' => 'от 15 дней',
                    'link' => '#service-details-1',
                    'category' => '01',
                    'active' => true
                ],
                [
                    'image' => '/assets/images/test.png',
                    'title' => 'РАДИОГРАФИЧЕСКИЙ КОНТРОЛЬ МЕТАЛЛОВ',
                    'description' => 'Метод неразрушающего контроля, который позволяет выявлять скрытые дефекты в металлических изделиях и сварных соединениях без их повреждения',
                    'price' => 'от 30 000 ₽',
                    'term' => 'от 15 дней',
                    'link' => '#service-details-2',
                    'category' => '02',
                    'active' => false
                ],
                [
                    'image' => '/assets/images/test.png',
                    'title' => 'МАГНИТОПОРОШКОВАЯ ЭКСПЕРТИЗА',
                    'description' => 'Вид неразрушающего контроля, используемый для выявления поверхностных и подповерхностных дефектов в ферромагнитных материалах (сталь, чугун и т.д.)',
                    'price' => 'от 30 000 ₽',
                    'term' => 'от 15 дней',
                    'link' => '#service-details-3',
                    'category' => '03',
                    'active' => false
                ],
                [
                    'image' => '/assets/images/test.png',
                    'title' => 'КАППИЛЯРНЫЙ КОНТРОЛЬ (ДЕФЕКТОСКОПИЯ)',
                    'description' => 'Неразрушающий метод выявления поверхностных и сквозных дефектов в материалах путем проникновения в них специальных индикаторных жидкостей (пенетрантов)',
                    'price' => 'от 30 000 ₽',
                    'term' => 'от 15 дней',
                    'link' => '#service-details-4',
                    'category' => '04',
                    'active' => false
                ]
            ]
        ]);
        ?>
    
        <?php
        load_component('lab-licenses-banner', [
            'downloadLink' => '#',
            'iconPath' => '/assets/images/ss.png'
        ]);
        ?>
    
        <?php load_component('why-choose-us'); ?>
    
        <?php load_component('reviews'); ?>
    
        <?php load_component('faq'); ?>
    </main>
    
    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <?php
    exit;
}

// Для всех остальных услуг используем шаблон как у ЭПБ (expertiza-template.php)
// Формируем данные услуги в формате, который ожидает expertiza-template.php
$expertiza_data = [
    'title' => $service['title'],
    'category' => $service['category_name'] ?? '',
    'image' => $service['hero_image'] ?? '/assets/images/hero.png',
    'description' => $service['description'] ?? '',
    'full_text' => $service['content'] ?? '',
    'features_text' => $service['content'] ?? '', // Для услуг используем content как features_text
    'responsibility_text' => 'Всё зависит от конкретной ситуации, но в целом, штрафы для ЮЛ и ИП колеблются от 500 000₽ до 1 000 000₽',
    'warning_primary' => 'Чтобы быть уверенными в безопасности своего предприятия и получить объективные результаты, а также полностью исключить возможность претензий со стороны контролирующих и надзорных органов, следует обращаться только в проверенные экспертные организации, основной специализацией которых является промышленная безопасность, какой является компания «ТОП ЭКСПЕРТ».',
    'warning_secondary' => 'Компания «ТОП ЭКСПЕРТ» предупреждает вас, что заключение, подготовленное без фактического проведения указанной экспертизы или которое противоречит содержанию материалов предоставленных эксперту по промышленной безопасности или не соответствует фактическому состоянию технических устройств, зданий и сооружений на ОПО, являвшихся объектами экспертизы промышленной безопасности влечет за собой исключение из реестра ложного заключения ЭПБ, а ответственные должностные лица несут административную (п.4 ст.9.1 КоАП РФ) или уголовную ответственность (ст.217.2 УК РФ).',
];

// Получаем другие услуги из той же категории (исключая текущую)
$otherServices = [];
if (!empty($service['category_id'])) {
    $otherServices = getServicesByCategory($service['category_id']);
    $otherServices = array_filter($otherServices, function($item) use ($service) {
        return $item['id'] != $service['id'] && $item['published'] == 1;
    });
    $otherServices = array_slice($otherServices, 0, 6);
}

// Преобразуем в формат для компонента
$otherServicesFormatted = [];
foreach ($otherServices as $item) {
    $otherServicesFormatted[] = [
        'image' => $item['hero_image'] ?? '/assets/images/test.png',
        'title' => mb_strtoupper(htmlspecialchars($item['title'])),
        'description' => mb_substr(strip_tags($item['description'] ?? $item['content'] ?? ''), 0, 100) . '...',
        'category' => htmlspecialchars($item['category_name'] ?? ''),
        'price' => $item['price'] ?? 'от 30 000 ₽',
        'term' => $item['term'] ?? 'от 15 дней',
        'link' => '/' . htmlspecialchars($item['slug']),
        'active' => false
    ];
}

// Если нет других услуг, используем дефолтные данные
if (empty($otherServicesFormatted)) {
    $otherServicesFormatted = [
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

$expertiza_data['other_services'] = $otherServicesFormatted;

// Этапы проведения (можно оставить дефолтные или вынести в БД)
$expertiza_data['stages'] = [
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
];

// Подключаем шаблон экспертизы
include __DIR__ . '/expertiza-template.php';
exit;

