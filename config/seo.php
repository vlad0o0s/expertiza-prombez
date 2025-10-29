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
        'canonical' => SITE_URL . '/contacts.php',
        'schema_type' => 'ContactPage', // Schema.org тип для страницы контактов
    ],
    
    // Страница о нас (пример для future страницы)
    'about' => [
        'title' => 'О нас - Экспертиза Промбезопасность',
        'description' => 'Информация о компании, занимающейся экспертизой промышленной безопасности. Наш опыт и профессиональный подход.',
        'keywords' => 'о нас, экспертиза промбезопасности, компания, опыт',
        'og_title' => 'О нас - Экспертиза Промбезопасность',
        'og_description' => 'Информация о компании, занимающейся экспертизой промышленной безопасности',
        'og_image' => SITE_URL . '/assets/images/og-image-about.jpg',
        'og_type' => 'website',
        'canonical' => SITE_URL . '/about.php',
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
        'canonical' => SITE_URL . '/services.php',
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
