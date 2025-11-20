<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/articles-list/component.css">';
}

// Данные статей (можно вынести в отдельный файл или БД)
$articles = [
    [
        'date' => '01.09.2025',
        'number' => '01',
        'total' => '12',
        'title' => 'Размещение надземных газопроводов',
        'description' => 'Газопроводы высокого давления прокладывают по глухим стенам или участкам стен на высоте не менее 0,5 м над оконными или дверными проемами, а также открытыми проемами верхних этажей производственных зданий. Газопровод должен быть проложен ниже кровли здания на расстоянии не менее 0,2 м...',
        'image' => '/assets/images/news/razmeshenie.png',
        'link' => '#'
    ],
    [
        'date' => '02.09.2025',
        'number' => '02',
        'total' => '12',
        'title' => 'Надземные газопроводы',
        'description' => 'Газопроводы можно прокладывать в грунте или над землей. В настоящее время подземная прокладка газопроводов является предпочтительной. Трубы в грунте не портят архитектурный облик, не мешают проезду автотранспорта и проходу людей...',
        'image' => '/assets/images/news/razmeshenie.png',
        'link' => '#'
    ]
];
?>

<section class="articles-list">
    <div class="container">
        <div class="articles-list-grid">
            <?php foreach ($articles as $index => $article): ?>
                <article class="article-card">
                    <div class="article-card-image" style="background-image: url('<?php echo htmlspecialchars($article['image']); ?>');"></div>
                    <div class="article-card-content">
                        <div class="article-card-header">
                            <div class="article-date"><?php echo htmlspecialchars($article['date']); ?></div>
                            <div class="article-number">
                                <span class="article-current"><?php echo htmlspecialchars($article['number']); ?></span>/<span class="article-total"><?php echo htmlspecialchars($article['total']); ?></span>
                            </div>
                        </div>
                        <h3 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                        <p class="article-description"><?php echo htmlspecialchars($article['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($article['link']); ?>" class="article-link">
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
        </div>
    </div>
</section>

