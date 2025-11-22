/**
 * Инициализация слайдера "Услуги лаборатории неразрушающего контроля"
 */
document.addEventListener('DOMContentLoaded', function() {
    // Ждем загрузки Swiper (на случай медленной загрузки CDN)
    let retryCount = 0;
    const maxRetries = 50; // Максимум 5 секунд ожидания
    
    function initLabServicesSwiper() {
        if (typeof Swiper === 'undefined') {
            retryCount++;
            if (retryCount < maxRetries) {
                setTimeout(initLabServicesSwiper, 100);
            } else {
                console.error('Swiper library failed to load after multiple attempts');
            }
            return;
        }
        
        const labServicesSwiperEl = document.querySelector('.lab-services-swiper');
        if (!labServicesSwiperEl) {
            return;
        }
        
        const labServicesSwiper = new Swiper('.lab-services-swiper', {
            slidesPerView: 4,
            spaceBetween: 10,
            loop: false,
            watchOverflow: true,
            navigation: {
                nextEl: '.lab-services-next',
                prevEl: '.lab-services-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
            },
        });
    }
    
    // Запускаем инициализацию
    initLabServicesSwiper();
});

