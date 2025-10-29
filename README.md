# Экспертиза Промбезопасность

Сайт на PHP с поддержкой HTML, CSS и JavaScript.

## Структура проекта

```
expertiza-prombez.ru/
├── assets/
│   ├── css/
│   │   ├── main.css          # Основные стили с глобальными переменными цветов
│   │   ├── header-footer.css # Стили для шапки и подвала
│   │   └── messages.css      # Стили для сообщений
│   ├── js/
│   │   └── main.js           # Основной JavaScript файл
│   └── images/               # Изображения
├── config/
│   ├── config.php            # Основная конфигурация
│   └── mail.php              # Класс для отправки писем
├── includes/
│   ├── header.php            # Шапка сайта (шаблон)
│   └── footer.php             # Подвал сайта (шаблон)
├── vendor/                    # Библиотеки Composer (создается автоматически)
├── index.php                  # Главная страница
├── composer.json              # Зависимости проекта
└── README.md                  # Этот файл

```

## Установка

1. Установите зависимости Composer:
```bash
composer install
```

2. Настройте конфигурацию:
   - Откройте `config/config.php`
   - Укажите правильные настройки SMTP для отправки писем

3. Создайте необходимые страницы в корне проекта (например, `about.php`, `services.php`, `contacts.php`)

## Использование

### Создание новой страницы

```php
<?php
require_once 'config/config.php';

$page_title = 'Заголовок страницы';
$page_description = 'Описание страницы';

include 'includes/header.php';
?>

<main>
    <h1>Содержимое страницы</h1>
</main>

<?php include 'includes/footer.php'; ?>
```

### Отправка письма

```php
require_once 'config/mail.php';

$mailSender = new MailSender();
$mailSender->send(
    'recipient@example.com',
    'Тема письма',
    '<h1>Текст письма</h1>',
    ['путь/к/файлу.pdf'] // опциональные вложения
);
```

### Использование Swiper

```html
<div class="swiper swiper-main">
    <div class="swiper-wrapper">
        <div class="swiper-slide">Слайд 1</div>
        <div class="swiper-slide">Слайд 2</div>
        <div class="swiper-slide">Слайд 3</div>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
```

## Цветовая палитра

- **Основной (Primary)**: `#E60012` - Красный
- **Вторичный (Secondary)**: `#91A2B8` - Серо-голубой
- **Светло-серый (Light Gray)**: `#E6E6E6`
- **Светло-голубой (Light Blue)**: `#E9F1FC`
- **Белый (White)**: `#FFFFFF`
- **Темно-синий (Dark Blue)**: `#152333`
- **Темно-серый (Dark Gray)**: `#3C3C3C`
- **Черный (Black)**: `#0A0A0A`

Используйте CSS переменные: `var(--color-primary)`, `var(--color-secondary)` и т.д.

## Технологии

- PHP 7.4+
- PHPMailer (для отправки писем через SMTP)
- Swiper.js (для слайдеров)
- HTML5, CSS3, JavaScript (ES6+)
