/**
 * Инициализация слайдера отзывов
 */
document.addEventListener('DOMContentLoaded', function() {
    // Ждем загрузки Swiper (на случай медленной загрузки CDN)
    let retryCount = 0;
    const maxRetries = 50; // Максимум 5 секунд ожидания
    
    function initReviewsSwiper() {
        if (typeof Swiper === 'undefined') {
            retryCount++;
            if (retryCount < maxRetries) {
                setTimeout(initReviewsSwiper, 100);
            } else {
                console.error('Swiper library failed to load after multiple attempts');
            }
            return;
        }
        
        const reviewsSwiperEl = document.querySelector('.reviews-swiper');
        if (!reviewsSwiperEl) {
            return;
        }
        
        const reviewsSwiper = new Swiper('.reviews-swiper', {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: false,
            watchOverflow: true,
            navigation: {
                nextEl: '.reviews-next',
                prevEl: '.reviews-prev',
            },
            pagination: {
                el: '.reviews-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '"></span>';
                },
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    }
    
    // Запускаем инициализацию
    initReviewsSwiper();
});

