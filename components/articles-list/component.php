<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/articles-list/component.css">';
}

// Получаем данные статей из параметров или используем пустой массив
$articles = $data['articles'] ?? [];
$currentPage = $data['currentPage'] ?? 1;
$totalArticles = count($articles);
?>

<section class="articles-list">
    <div class="container">
        <div class="articles-list-grid">
            <?php if (empty($articles)): ?>
                <div style="text-align: center; padding: 40px; color: #91A2B8;">
                    Статьи не найдены
                </div>
            <?php else: ?>
                <?php foreach ($articles as $index => $article): ?>
                    <article class="article-card">
                        <?php if (!empty($article['header_image'])): ?>
                            <div class="article-card-image" style="background-image: url('<?php echo htmlspecialchars($article['header_image']); ?>');"></div>
                        <?php else: ?>
                            <div class="article-card-image" style="background-image: url('/assets/images/news/razmeshenie.png');"></div>
                        <?php endif; ?>
                        <div class="article-card-content">
                            <div class="article-card-header">
                                <div class="article-date"><?php echo date('d.m.Y', strtotime($article['published_at'] ?? $article['created_at'])); ?></div>
                                <div class="article-number">
                                    <span class="article-current"><?php echo ($currentPage - 1) * 12 + $index + 1; ?></span>/<span class="article-total"><?php echo $totalArticles; ?></span>
                                </div>
                            </div>
                            <h3 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                            <p class="article-description"><?php echo htmlspecialchars($article['excerpt'] ?? mb_substr(strip_tags($article['content']), 0, 200) . '...'); ?></p>
                            <a href="/articles/<?php echo htmlspecialchars($article['slug']); ?>" class="article-link">
                                <span class="article-link-text">Подробнее</span>
                                <svg class="article-link-arrow" width="27" height="12" viewBox="0 0 27 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 4.77295C0.335786 4.77295 -3.62117e-08 5.10874 0 5.52295C3.62117e-08 5.93716 0.335786 6.27295 0.75 6.27295L0.75 5.52295L0.75 4.77295ZM26.2803 6.05328C26.5732 5.76038 26.5732 5.28551 26.2803 4.99262L21.5074 0.219647C21.2145 -0.0732468 20.7396 -0.0732468 20.4467 0.219647C20.1538 0.51254 20.1538 0.987414 20.4467 1.28031L24.6893 5.52295L20.4467 9.76559C20.1538 10.0585 20.1538 10.5334 20.4467 10.8262C20.7396 11.1191 21.2145 11.1191 21.5074 10.8262L26.2803 6.05328ZM0.75 5.52295L0.75 6.27295L25.75 6.27295L25.75 5.52295L25.75 4.77295L0.75 4.77295L0.75 5.52295Z" fill="#152333" />
                                </svg>
                            </a>
                        </div>
                    </article>
                    <?php if ($index < count($articles) - 1): ?>
                        <div class="article-divider"></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

