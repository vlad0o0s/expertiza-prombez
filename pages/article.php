<?php
/**
 * Динамический шаблон статьи
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/component-loader.php';
require_once __DIR__ . '/../includes/articles-functions.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('HTTP/1.0 404 Not Found');
    include __DIR__ . '/../404.php';
    exit;
}

$article = getArticleBySlug($slug);

if (!$article) {
    header('HTTP/1.0 404 Not Found');
    include __DIR__ . '/../404.php';
    exit;
}

$page_key = 'articles-article';

// Получаем последние 3 статьи (исключая текущую)
$latestArticles = getLatestArticles($article['id'], 3);

// Подключаем CSS для компонентов ДО header.php
$additional_css = [];
$additional_css[] = '/assets/css/index.css';

$breadcrumbs_css = '/components/breadcrumbs/component.css';
if (file_exists(__DIR__ . '/../components/breadcrumbs/component.css')) {
    $additional_css[] = $breadcrumbs_css;
}

// Подключение CSS для страницы статьи
$article_css = '/assets/css/article-page.css';
if (file_exists(__DIR__ . '/../assets/css/article-page.css')) {
    $additional_css[] = $article_css;
}

// Подключение JavaScript для анимаций
$additional_js = [
    '/assets/js/index-animations.js',
    '/assets/js/article-page.js'
];

include __DIR__ . '/../includes/header.php';
?>

<main>
    <?php
    load_component('breadcrumbs', [
        'items' => [
            [
                'title' => 'Главная',
                'url' => '/'
            ],
            [
                'title' => 'Статьи',
                'url' => '/articles'
            ],
            [
                'title' => htmlspecialchars($article['title']),
                'url' => null
            ],
        ]
    ]);
    ?>
    
    <div class="article-page-container">
        <!-- Верхний блок: фото + первый абзац (50%) и другие статьи (50%) -->
        <div class="article-page-wrapper">
            <!-- Левая колонка (50%) -->
            <div class="article-main-column">
                <!-- Блок 1: Изображение с заголовком и датой -->
                <div class="article-header-image" style="<?php echo !empty($article['header_image']) ? 'background-image: url(' . htmlspecialchars($article['header_image']) . ');' : ''; ?>">
                    <div class="article-header-content">
                        <h1 class="article-header-title"><?php echo htmlspecialchars($article['title']); ?></h1>
                        <div class="article-header-date"><?php echo date('d.m.Y', strtotime($article['published_at'] ?? $article['created_at'])); ?></div>
                    </div>
                </div>
                
                <!-- Блок 2: Первый абзац -->
                <?php
                // Извлекаем первый абзац из контента
                $content = $article['content'];
                $firstParagraph = '';
                $remainingContent = '';
                
                // Пытаемся найти первый параграф <p>
                if (preg_match('/^(.*?<p[^>]*>.*?<\/p>)/is', $content, $matches)) {
                    $firstParagraph = trim($matches[1]);
                    $remainingContent = trim(substr($content, strlen($matches[1])));
                } else {
                    // Если нет тегов <p>, пытаемся разделить по первым 500 символам
                    $text = strip_tags($content);
                    if (mb_strlen($text) > 500) {
                        // Ищем место для разрыва (точка, восклицательный или вопросительный знак)
                        $breakPos = mb_strpos($text, '.', 400);
                        if ($breakPos === false) {
                            $breakPos = mb_strpos($text, '!', 400);
                        }
                        if ($breakPos === false) {
                            $breakPos = mb_strpos($text, '?', 400);
                        }
                        if ($breakPos === false) {
                            $breakPos = 500;
                        } else {
                            $breakPos += 1; // Включаем точку в первый абзац
                        }
                        $firstParagraph = '<p>' . mb_substr($text, 0, $breakPos) . '</p>';
                        $remainingContent = '<p>' . mb_substr($text, $breakPos) . '</p>';
                    } else {
                        $firstParagraph = '<p>' . $text . '</p>';
                        $remainingContent = '';
                    }
                }
                
                // Очищаем оставшийся контент от лишних пробелов в начале
                $remainingContent = ltrim($remainingContent);
                ?>
                <div class="article-content-block article-first-paragraph">
                    <h2 class="article-content-title"><?php echo htmlspecialchars($article['title']); ?></h2>
                    <div class="article-content-text">
                        <?php echo $firstParagraph; ?>
                    </div>
                </div>
            </div>
            
            <!-- Правая колонка (50%) -->
            <div class="article-sidebar-column">
                <!-- Заголовок -->
                <div class="sidebar-title">ДРУГИЕ СТАТЬИ</div>
                
                <!-- Список статей -->
                <div class="sidebar-articles">
                    <?php if (empty($latestArticles)): ?>
                        <p style="color: #91A2B8; font-size: 14px;">Других статей пока нет</p>
                    <?php else: ?>
                        <?php foreach ($latestArticles as $index => $latestArticle): ?>
                            <div class="sidebar-article-card">
                                <div class="article-card-header">
                                    <h3 class="article-card-title"><?php echo htmlspecialchars($latestArticle['title']); ?></h3>
                                    <div class="article-card-number"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?><span class="article-card-number-total">/<?php echo count($latestArticles); ?></span></div>
                                </div>
                                <p class="article-card-description"><?php echo htmlspecialchars($latestArticle['excerpt'] ?? mb_substr(strip_tags($latestArticle['content']), 0, 200) . '...'); ?></p>
                                <div class="article-card-footer">
                                    <div class="article-card-date"><?php echo date('d.m.Y', strtotime($latestArticle['published_at'] ?? $latestArticle['created_at'])); ?></div>
                                    <a href="/articles/<?php echo htmlspecialchars($latestArticle['slug']); ?>" class="article-card-link">
                                        Подробнее
                                        <svg width="22" height="12" viewBox="0 0 22 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 4.77298C0.335786 4.77298 3.62117e-08 5.10877 0 5.52298C-3.62117e-08 5.93719 0.335786 6.27298 0.75 6.27298L0.75 5.52298L0.75 4.77298ZM21.2803 6.05331C21.5732 5.76042 21.5732 5.28554 21.2803 4.99265L16.5074 0.21968C16.2145 -0.0732132 15.7396 -0.0732132 15.4467 0.21968C15.1538 0.512574 15.1538 0.987447 15.4467 1.28034L19.6893 5.52298L15.4467 9.76562C15.1538 10.0585 15.1538 10.5334 15.4467 10.8263C15.7396 11.1192 16.2145 11.1192 16.5074 10.8263L21.2803 6.05331ZM0.75 5.52298L0.75 6.27298L20.75 6.27298L20.75 5.52298L20.75 4.77298L0.75 4.77298L0.75 5.52298Z" fill="#152333" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <!-- Ссылка "Смотреть все статьи" -->
                <a href="/articles" class="sidebar-view-all">
                    Смотреть все статьи
                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.21967 9.41205C-0.0732233 9.70495 -0.0732233 10.1798 0.21967 10.4727C0.512563 10.7656 0.987437 10.7656 1.28033 10.4727L0.75 9.94238L0.21967 9.41205ZM10.6924 0.749995C10.6924 0.335781 10.3566 -5.03349e-06 9.94239 -4.88598e-06L3.19239 -5.30745e-06C2.77817 -5.30745e-06 2.44239 0.335781 2.44239 0.749995C2.44239 1.16421 2.77817 1.49999 3.19239 1.49999H9.19239V7.49999C9.19239 7.91421 9.52817 8.24999 9.94239 8.24999C10.3566 8.24999 10.6924 7.91421 10.6924 7.49999L10.6924 0.749995ZM0.75 9.94238L1.28033 10.4727L10.4727 1.28032L9.94239 0.749995L9.41206 0.219665L0.21967 9.41205L0.75 9.94238Z" fill="#152333" />
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Остальной контент статьи на 100% ширины -->
        <?php if (!empty($remainingContent)): ?>
            <div class="article-content-block article-content-fullwidth">
                <div class="article-content-text">
                    <?php echo $remainingContent; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

