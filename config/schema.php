<?php
/**
 * Schema.org JSON-LD Generator
 * This file contains functions to generate structured data (Schema.org) in JSON-LD format
 */

/**
 * Генерация Schema.org разметки для страницы
 * 
 * @param string $schemaType Тип схемы (WebSite, ContactPage, AboutPage, Service, WebPage)
 * @param array $seo SEO конфигурация текущей страницы
 * @return string JSON-LD скрипт
 */
function generateSchemaOrg($schemaType, $seo) {
    $schema = [];
    
    // Базовые данные для всех типов
    $url = $seo['canonical'] ?? SITE_URL . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/');
    // Используем page_title из массива seo, если он передан, иначе используем title
    $name = isset($seo['page_title']) ? $seo['page_title'] : $seo['title'];
    
    switch ($schemaType) {
        case 'WebSite':
            // Разметка для главной страницы сайта
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => ORG_NAME,
                'url' => SITE_URL,
                'description' => $seo['description'],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => SITE_URL . '/search?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ];
            
            // Добавляем Organization для главной страницы
            $organization = generateOrganizationSchema();
            return json_encode([$schema, $organization], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            
        case 'ContactPage':
            // Разметка для страницы контактов
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'ContactPage',
                'name' => $name,
                'description' => $seo['description'],
                'url' => $url,
                'mainEntity' => generateOrganizationSchema(),
            ];
            break;
            
        case 'AboutPage':
            // Разметка для страницы о нас
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'AboutPage',
                'name' => $name,
                'description' => $seo['description'],
                'url' => $url,
                'about' => generateOrganizationSchema(),
            ];
            break;
            
        case 'Service':
            // Разметка для страницы услуг
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $name,
                'description' => $seo['description'],
                'url' => $url,
                'provider' => generateOrganizationSchema(),
                'serviceType' => 'Экспертиза промышленной безопасности',
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'Россия',
                ],
            ];
            break;
            
        case 'WebPage':
        default:
            // Разметка для обычной веб-страницы
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => $name,
                'description' => $seo['description'],
                'url' => $url,
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => ORG_NAME,
                    'url' => SITE_URL,
                ],
                'publisher' => generateOrganizationSchema(),
            ];
            break;
    }
    
    // Добавляем Organization ко всем страницам (кроме главной, где она уже есть)
    if ($schemaType !== 'WebSite') {
        $organization = generateOrganizationSchema();
        return json_encode([$schema, $organization], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    return json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

/**
 * Генерация Schema.org разметки для организации
 * 
 * @return array Массив данных организации
 */
function generateOrganizationSchema() {
    return [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => ORG_NAME,
        'legalName' => ORG_LEGAL_NAME,
        'url' => ORG_URL,
        'logo' => ORG_LOGO,
        'description' => ORG_DESCRIPTION,
        'email' => ORG_EMAIL,
        'telephone' => ORG_PHONE,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => ORG_ADDRESS_STREET,
            'addressLocality' => ORG_ADDRESS_CITY,
            'addressCountry' => ORG_ADDRESS_COUNTRY,
            'postalCode' => ORG_ADDRESS_POSTAL_CODE,
        ],
        'sameAs' => [
            // Добавьте ссылки на социальные сети, если есть
            // 'https://www.facebook.com/yourpage',
            // 'https://www.linkedin.com/company/yourcompany',
        ],
    ];
}

