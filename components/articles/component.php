<?php
// Подключаем функции для работы со статьями
if (!function_exists('getLatestArticles')) {
    require_once __DIR__ . '/../../includes/articles-functions.php';
}

// Получаем последние 3 статьи
$latestArticles = getLatestArticles(null, 3);
$totalArticles = count($latestArticles);

// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/articles/component.css">';
}
?>

<section class="our-articles">
    <div class="container-fluid">
        <div class="articles-inner">
            <div class="articles-header animate-on-scroll">
                <h2 class="articles-main-title">НАШИ<br>СТАТЬИ</h2>
                <a href="/articles" class="articles-view-all">
                    Смотреть все статьи
                    <img src="/assets/images/postarrow.svg" alt="" class="articles-arrow">
                </a>
            </div>
            
            <div class="articles-grid">
                <?php if (empty($latestArticles)): ?>
                    <div class="article-card animate-on-scroll delay-1">
                        <p style="color: #91A2B8; font-size: 14px; text-align: center; padding: 40px 20px;">Статей пока нет</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($latestArticles as $index => $article): ?>
                        <?php
                        $articleNumber = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                        $delayClass = 'delay-' . ($index + 1);
                        $articleTitle = htmlspecialchars($article['title']);
                        $articleDescription = htmlspecialchars($article['excerpt'] ?? mb_substr(strip_tags($article['content']), 0, 200) . '...');
                        $articleImage = !empty($article['header_image']) ? htmlspecialchars($article['header_image']) : '/assets/images/post.png';
                        $articleLink = '/articles/' . htmlspecialchars($article['slug']);
                        ?>
                        <div class="article-card animate-on-scroll <?php echo $delayClass; ?>">
                            <div class="article-nav">
                                <span class="article-number">
                                    <span class="article-current"><?php echo $articleNumber; ?></span>/<span class="article-total"><?php echo str_pad($totalArticles, 2, '0', STR_PAD_LEFT); ?></span>
                                </span>
                                <div class="article-arrows">
                                    <a href="<?php echo $articleLink; ?>" class="article-arrow-btn article-arrow-right">
                                        <img src="/assets/images/arrowPost.svg" alt="">
                                    </a>
                                </div>
                            </div>
                            <h3 class="article-title">
                                <a href="<?php echo $articleLink; ?>" style="color: inherit; text-decoration: none;">
                                    <?php echo $articleTitle; ?>
                                </a>
                            </h3>
                            <p class="article-description"><?php echo $articleDescription; ?></p>
                            <div class="article-image-wrapper">
                                <a href="<?php echo $articleLink; ?>">
                                    <img src="<?php echo $articleImage; ?>" alt="<?php echo $articleTitle; ?>">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

