<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/articles/component.css">';
}
?>

<section class="our-articles">
    <div class="container-fluid">
        <div class="articles-inner">
            <div class="articles-header">
                <h2 class="articles-main-title">НАШИ<br>СТАТЬИ</h2>
                <a href="#" class="articles-view-all">
                    Смотреть все статьи
                    <img src="/assets/images/postarrow.svg" alt="" class="articles-arrow">
                </a>
            </div>
            
            <div class="articles-grid">
                <div class="article-card">
                    <div class="article-nav">
                        <span class="article-number">
                            <span class="article-current">01</span>/<span class="article-total">12</span>
                        </span>
                        <div class="article-arrows">
                            <button class="article-arrow-btn article-arrow-right">
                                <img src="/assets/images/arrowPost.svg" alt="">
                            </button>
                        </div>
                    </div>
                    <h3 class="article-title">Размещение надземных газопроводов</h3>
                    <p class="article-description">Газопроводы высокого давления прокладывают по глухим стенам или участкам стен на высоте не менее 0,5 м над оконными или дверными проемами, а также открытыми проемами верхних этажей производственных зданий. Газопровод должен быть проложен ниже кровли здания на расстоянии не менее 0,2 м...</p>
                    <div class="article-image-wrapper">
                        <img src="/assets/images/post.png" alt="Размещение надземных газопроводов">
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-nav">
                        <span class="article-number">
                            <span class="article-current">02</span>/<span class="article-total">12</span>
                        </span>
                        <div class="article-arrows">
                            <button class="article-arrow-btn article-arrow-right">
                                <img src="/assets/images/arrowPost.svg" alt="">
                            </button>
                        </div>
                    </div>
                    <h3 class="article-title">Надземные газопроводы</h3>
                    <p class="article-description">Газопроводы можно прокладывать в грунте или над землей. В настоящее время подземная прокладка газопроводов является предпочтительной. Трубы в грунте не портят архитектурный облик, не мешают проезду автотранспорта и проходу людей...</p>
                    <div class="article-image-wrapper">
                        <img src="/assets/images/post2.png" alt="Надземные газопроводы">
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-nav">
                        <span class="article-number">
                            <span class="article-current">03</span>/<span class="article-total">12</span>
                        </span>
                        <div class="article-arrows">
                            <button class="article-arrow-btn article-arrow-right">
                                <img src="/assets/images/arrowPost.svg" alt="">
                            </button>
                        </div>
                    </div>
                    <h3 class="article-title">Порядок аттестации по промбезопасности</h3>
                    <p class="article-description">Аттестацию в сфере промышленной безопасности в обязательном порядке проходят руководители промышленных предприятий, отнесенных к категории опасных производственных объектов. И касается это не только директоров: аттестация по промбезопасности обязательна для всего руководящего состава...</p>
                    <div class="article-image-wrapper">
                        <img src="/assets/images/post3.png" alt="Порядок аттестации по промбезопасности">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

