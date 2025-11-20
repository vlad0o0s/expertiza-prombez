// Инициализация Swiper для клиентов
(function() {
    function initClientsSwiper() {
        const clientsSwiperElement = document.querySelector('.clients-swiper');
        if (!clientsSwiperElement) {
            return false;
        }

        // Проверяем, не инициализирован ли уже
        if (clientsSwiperElement.swiper) {
            return true;
        }

        // Проверяем наличие Swiper
        if (typeof Swiper === 'undefined') {
            return false;
        }

        try {
            const clientsSwiper = new Swiper('.clients-swiper', {
                slidesPerView: 3,
                spaceBetween: 0,
                loop: true,
                watchOverflow: true,
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: '.clients-nav-next',
                    prevEl: '.clients-nav-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                },
                on: {
                    init: function() {
                        // Показываем слайдер после инициализации
                        const swiperEl = document.querySelector('.clients-swiper');
                        if (swiperEl) {
                            swiperEl.classList.add('swiper-initialized');
                        }
                    }
                }
            });
            return true;
        } catch (e) {
            console.error('Error initializing clients swiper:', e);
            return false;
        }
    }

    // Пробуем инициализировать сразу
    if (!initClientsSwiper()) {
        // Если не получилось, ждем загрузки DOM
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                if (!initClientsSwiper()) {
                    // Если все еще не получилось, ждем загрузки всех скриптов
                    window.addEventListener('load', function() {
                        let attempts = 0;
                        const tryInit = setInterval(function() {
                            attempts++;
                            if (initClientsSwiper() || attempts > 50) {
                                clearInterval(tryInit);
                            }
                        }, 100);
                    });
                }
            });
        } else {
            // DOM уже загружен, но Swiper может быть еще не загружен
            window.addEventListener('load', function() {
                let attempts = 0;
                const tryInit = setInterval(function() {
                    attempts++;
                    if (initClientsSwiper() || attempts > 50) {
                        clearInterval(tryInit);
                    }
                }, 100);
            });
        }
    }
})();

