<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/reviews/component.css">';
}
?>

<section class="reviews-section animate-on-scroll">
    <div class="container-fluid">
        <div class="reviews-inner">
            <div class="reviews-header">
            <h2 class="reviews-title">ОТЗЫВЫ</h2>
            <div class="reviews-navigation">
                <button class="reviews-prev" aria-label="Предыдущий слайд">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="reviews-next" aria-label="Следующий слайд">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="swiper reviews-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="review-card">
                        <div class="review-author">
                            <div class="review-name">Сергей Кузнецов</div>
                            <div class="review-role">предприниматель</div>
                        </div>
                        <div class="review-text">
                            Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="review-card">
                        <div class="review-author">
                            <div class="review-name">Сергей Кузнецов</div>
                            <div class="review-role">предприниматель</div>
                        </div>
                        <div class="review-text">
                            Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="review-card">
                        <div class="review-author">
                            <div class="review-name">Сергей Кузнецов</div>
                            <div class="review-role">предприниматель</div>
                        </div>
                        <div class="review-text">
                            Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="review-card">
                        <div class="review-author">
                            <div class="review-name">Сергей Кузнецов</div>
                            <div class="review-role">предприниматель</div>
                        </div>
                        <div class="review-text">
                            Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="review-card">
                        <div class="review-author">
                            <div class="review-name">Сергей Кузнецов</div>
                            <div class="review-role">предприниматель</div>
                        </div>
                        <div class="review-text">
                            Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="review-card">
                        <div class="review-author">
                            <div class="review-name">Сергей Кузнецов</div>
                            <div class="review-role">предприниматель</div>
                        </div>
                        <div class="review-text">
                            Обратились для проведения экспертизы промышленной безопасности на нашем объекте с опасными химическими веществами. Работу выполнили быстро и профессионально, выявили ряд недочетов и дали рекомендации. Благодаря заключению мы смогли безопасно продолжить эксплуатацию оборудования и успешно пройти проверку Ростехнадзора.
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination reviews-pagination"></div>
        </div>
        <div class="reviews-footer">
            <a href="#" class="reviews-link" target="_blank">
                Отзывы на Яндекс Картах
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 3L11 8L6 13M11 8H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        </div>
    </div>
</section>

