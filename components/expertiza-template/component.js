/**
 * Инициализация слайдера "Другие экспертизы"
 */
document.addEventListener('DOMContentLoaded', function() {
    // Ждем загрузки Swiper (на случай медленной загрузки CDN)
    let retryCount = 0;
    const maxRetries = 50; // Максимум 5 секунд ожидания
    
    function initOtherServicesSwiper() {
        if (typeof Swiper === 'undefined') {
            retryCount++;
            if (retryCount < maxRetries) {
                setTimeout(initOtherServicesSwiper, 100);
            } else {
                console.error('Swiper library failed to load after multiple attempts');
            }
            return;
        }
        
        const otherServicesSwiperEl = document.querySelector('.other-services-swiper');
        if (!otherServicesSwiperEl) {
            return;
        }
        
        const otherServicesSwiper = new Swiper('.other-services-swiper', {
            slidesPerView: 4,
            spaceBetween: 13,
            loop: false,
            watchOverflow: true,
            navigation: {
                nextEl: '.other-services-next',
                prevEl: '.other-services-prev',
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
                    spaceBetween: 13,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 13,
                },
            },
        });
    }
    
    // Запускаем инициализацию
    initOtherServicesSwiper();
});

