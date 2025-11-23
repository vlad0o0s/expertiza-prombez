<?php
/**
 * SEO Configuration for all pages
 * 
 * HOW TO USE:
 * 1. Edit this file to configure SEO settings for all pages
 * 2. On each page, set $page_key variable before including header.php
 *    Example: $page_key = 'index';
 * 3. All SEO meta tags (title, description, keywords, Open Graph, Twitter Card, Schema.org) 
 *    will be automatically generated from this configuration
 * 
 * CUSTOMIZATION:
 * - You can override title/description on individual pages by setting $page_title or $page_description
 * - All other SEO settings come from this config file
 * - Add new page configurations by creating new key in the array below
 */

return [
    // Главная страница
    'index' => [
        'title' => 'Экспертиза Промбезопасность - Профессиональная экспертиза промышленной безопасности',
        'description' => 'Профессиональная экспертиза промышленной безопасности. Комплексные услуги по оценке и экспертизе объектов промышленного назначения.',
        'keywords' => 'экспертиза промбезопасности, промышленная безопасность, экспертиза объектов, оценка промышленной безопасности',
        'og_title' => 'Экспертиза Промбезопасность',
        'og_description' => 'Профессиональная экспертиза промышленной безопасности',
        'og_image' => SITE_URL . '/assets/images/og-image.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/',
        'schema_type' => 'WebSite', // Schema.org тип для главной страницы
    ],
    
    // Страница контактов
    'contacts' => [
        'title' => 'Контакты - Экспертиза Промбезопасность',
        'description' => 'Свяжитесь с нами для консультации по вопросам промышленной безопасности. Мы готовы ответить на ваши вопросы.',
        'keywords' => 'контакты экспертиза промбезопасности, связь, консультация промышленная безопасность',
        'og_title' => 'Контакты - Экспертиза Промбезопасность',
        'og_description' => 'Свяжитесь с нами для консультации по вопросам промышленной безопасности',
        'og_image' => SITE_URL . '/assets/images/og-image-contacts.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/contacts',
        'schema_type' => 'ContactPage', // Schema.org тип для страницы контактов
    ],
    
    // Страница экспертиз промбезопасности
    'expertiza-prombezopasnosti' => [
        'title' => 'Экспертизы промбезопасности',
        'description' => 'Профессиональные экспертизы промышленной безопасности. Комплексная оценка и экспертиза объектов промышленного назначения.',
        'keywords' => 'экспертизы промбезопасности, промышленная безопасность, экспертиза объектов',
        'og_title' => 'Экспертизы промбезопасности',
        'og_description' => 'Профессиональные экспертизы промышленной безопасности',
        'og_image' => SITE_URL . '/assets/images/og-image.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/expertiza-prombezopasnosti',
        'schema_type' => 'Service', // Schema.org тип для страницы услуг
    ],
    
    // Страница статей
    'articles' => [
        'title' => 'Статьи - Экспертиза Промбезопасность',
        'description' => 'Полезные статьи и материалы по промышленной безопасности. Актуальная информация, новости и экспертные мнения.',
        'keywords' => 'статьи промбезопасность, промышленная безопасность, статьи экспертиза, новости промбезопасности',
        'og_title' => 'Статьи - Экспертиза Промбезопасность',
        'og_description' => 'Полезные статьи и материалы по промышленной безопасности',
        'og_image' => SITE_URL . '/assets/images/og-image.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/articles',
        'schema_type' => 'CollectionPage', // Schema.org тип для страницы со статьями
    ],
    
    // Страница о компании
    'about' => [
        'title' => 'О компании "ТОП ЭКСПЕРТ" - Экспертиза Промбезопасность',
        'description' => 'АНО ЭПЦ "Топ Эксперт" — ведущая организация в сфере судебной экспертизы и оценочной деятельности. Опытные специалисты с 20-летним стажем, полный спектр услуг, гарантия качества.',
        'keywords' => 'о компании топ эксперт, экспертиза промбезопасности, компания, опыт, специалисты, документы компании',
        'og_title' => 'О компании "ТОП ЭКСПЕРТ" - Экспертиза Промбезопасность',
        'og_description' => 'АНО ЭПЦ "Топ Эксперт" — ведущая организация в сфере судебной экспертизы и оценочной деятельности',
        'og_image' => SITE_URL . '/assets/images/og-image-about.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/about',
        'schema_type' => 'AboutPage', // Schema.org тип для страницы о нас
    ],
    
    // Страница услуг (пример для future страницы)
    'services' => [
        'title' => 'Услуги - Экспертиза Промбезопасность',
        'description' => 'Полный спектр услуг по экспертизе промышленной безопасности. Оценка объектов, консультации, документация.',
        'keywords' => 'услуги экспертиза промбезопасности, оценка объектов, консультации',
        'og_title' => 'Услуги - Экспертиза Промбезопасность',
        'og_description' => 'Полный спектр услуг по экспертизе промышленной безопасности',
        'og_image' => SITE_URL . '/assets/images/og-image-services.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/services',
        'schema_type' => 'Service', // Schema.org тип для страницы услуг
    ],
    
    // Страница экспертизы промышленной безопасности
    'expertiza-promyshlennoy-bezopasnosti' => [
        'title' => 'Экспертиза промышленной безопасности - Экспертиза Промбезопасность',
        'description' => 'Профессиональная экспертиза промышленной безопасности. Комплексная оценка и экспертиза объектов промышленного назначения.',
        'keywords' => 'экспертиза промышленной безопасности, промбезопасность, экспертиза объектов, промышленная безопасность',
        'og_title' => 'Экспертиза промышленной безопасности - Экспертиза Промбезопасность',
        'og_description' => 'Профессиональная экспертиза промышленной безопасности. Комплексная оценка и экспертиза объектов промышленного назначения.',
        'og_image' => SITE_URL . '/assets/images/og-image.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/expertiza-promyshlennoy-bezopasnosti',
        'schema_type' => 'Service', // Schema.org тип для страницы услуг
    ],
    
    // Страница запроса коммерческого предложения
    'zapros-kommercheskogo-predlozheniya' => [
        'title' => 'Запрос коммерческого предложения - Экспертиза Промбезопасность',
        'description' => 'Оставьте запрос на персональное коммерческое предложение на проведение экспертизы промышленной безопасности. Быстрый расчёт стоимости и сроков.',
        'keywords' => 'запрос коммерческого предложения, коммерческое предложение, экспертиза промбезопасности, расчет стоимости',
        'og_title' => 'Запрос коммерческого предложения - Экспертиза Промбезопасность',
        'og_description' => 'Оставьте запрос на персональное коммерческое предложение на проведение экспертизы промышленной безопасности',
        'og_image' => SITE_URL . '/assets/images/og-image.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/zapros-kommercheskogo-predlozheniya',
        'schema_type' => 'ContactPage', // Schema.org тип для страницы контактов
    ],
    
    // Страница лаборатории неразрушающего контроля
    'laboratoriya-nerazrushayushchego-kontrolya' => [
        'title' => 'Лаборатория неразрушающего контроля - Экспертиза Промбезопасность',
        'description' => 'Лаборатория неразрушающего контроля компании ТОП ЭКСПЕРТ. Профессиональные услуги по ультразвуковому контролю, радиографическому контролю, магнитопорошковой экспертизе и другие методы неразрушающего контроля.',
        'keywords' => 'лаборатория неразрушающего контроля, ультразвуковой контроль, радиографический контроль, магнитопорошковая экспертиза, неразрушающий контроль, химическая лаборатория',
        'og_title' => 'Лаборатория неразрушающего контроля - Экспертиза Промбезопасность',
        'og_description' => 'Профессиональные услуги лаборатории неразрушающего контроля. Современное оборудование и приборы для контроля качества.',
        'og_image' => SITE_URL . '/assets/images/og-image.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/laboratoriya-nerazrushayushchego-kontrolya',
        'schema_type' => 'Service', // Schema.org тип для страницы услуг
    ],
    
    // Дефолтные значения (используются если страница не найдена или $page_key не задан)
    'default' => [
        'title' => SITE_NAME,
        'description' => 'Сайт экспертизы промбезопасности',
        'keywords' => 'экспертиза промбезопасности, промышленная безопасность',
        'og_title' => SITE_NAME,
        'og_description' => 'Сайт экспертизы промбезопасности',
        'og_image' => SITE_URL . '/assets/images/og-image.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . $_SERVER['REQUEST_URI'],
        'schema_type' => 'WebPage', // Schema.org тип по умолчанию
    ],
];
