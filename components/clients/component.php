<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/clients/component.css">';
}
?>

<section class="our-clients">
    <div class="container-fluid">
        <div class="clients-inner">
            <div class="clients-slider-wrapper animate-on-scroll">
                <div class="swiper clients-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0000_slider3.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0001_slider2.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0002_slider1.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0003_slider9.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0004_slider8.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0005_slider7.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0006_slider6.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0007_slider5.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0008_slider4.png" alt="Client logo">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo">
                                <img src="/assets/images/slider_0009_Слой-1.png" alt="Client logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clients-header animate-on-scroll delay-1">
                <h2 class="clients-main-title">НАШИ<br>КЛИЕНТЫ</h2>
                <div class="clients-nav">
                    <button class="clients-nav-btn clients-nav-prev" aria-label="Previous">
                        <img src="/assets/images/arrowClients.svg" alt="">
                    </button>
                    <button class="clients-nav-btn clients-nav-next" aria-label="Next">
                        <img src="/assets/images/arrowClients.svg" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function () {
        function initClientsSwiper() {
            const clientsSwiperElement = document.querySelector('.clients-swiper');

            if (!clientsSwiperElement) {
                return false;
            }

            // Проверяем, не инициализирован ли уже
            if (clientsSwiperElement.swiper) {
                clientsSwiperElement.swiper.destroy(true, true);
            }

            if (typeof Swiper === 'undefined') {
                return false;
            }

            const containerWidth = clientsSwiperElement.offsetWidth;

            // Проверяем, что контейнер имеет валидную ширину
            if (containerWidth === 0 || !containerWidth || containerWidth > 10000) {
                return false;
            }

            try {
                let isUpdatingBorders = false;

                function addBorders(swiper) {
                    if (isUpdatingBorders) {
                        return;
                    }
                    isUpdatingBorders = true;

                    const slides = swiper.slides;
                    const slidesPerView = swiper.params.slidesPerView;
                    const totalSlides = slides.length;

                    // Сначала убираем все границы
                    slides.forEach(function (slide) {
                        slide.style.borderRight = '';
                    });

                    // Добавляем границы ко всем слайдам, кроме последних в каждом ряду
                    slides.forEach(function (slide, index) {
                        // Проверяем, не является ли слайд последним в ряду
                        const isLastInRow = (index + 1) % slidesPerView === 0;
                        // Проверяем, не является ли слайд последним вообще
                        const isLastSlide = index === totalSlides - 1;

                        // Добавляем границу, если это не последний в ряду и не последний слайд
                        if (!isLastInRow && !isLastSlide) {
                            slide.style.borderRight = '2px solid rgba(145, 162, 184, 0.5)';
                        }
                    });

                    setTimeout(function () {
                        isUpdatingBorders = false;
                    }, 50);
                }

                function updateNavButtons(swiper) {
                    const prevBtn = document.querySelector('.clients-nav-prev');
                    const nextBtn = document.querySelector('.clients-nav-next');

                    if (prevBtn) {
                        if (swiper.isBeginning) {
                            prevBtn.style.opacity = '0.5';
                        } else {
                            prevBtn.style.opacity = '1';
                        }
                    }

                    if (nextBtn) {
                        if (swiper.isEnd) {
                            nextBtn.style.opacity = '0.5';
                        } else {
                            nextBtn.style.opacity = '1';
                        }
                    }
                }

                const swiperInstance = new Swiper('.clients-swiper', {
                    slidesPerView: 4,
                    slidesPerGroup: 4,
                    spaceBetween: 0,
                    loop: false,
                    watchOverflow: true,
                    observer: false,
                    observeParents: false,
                    navigation: {
                        nextEl: '.clients-nav-next',
                        prevEl: '.clients-nav-prev',
                    },
                breakpoints: {
                    320: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    },
                    768: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    },
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    },
                    1280: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    }
                },
                    on: {
                        init: function () {
                            const swiperEl = document.querySelector('.clients-swiper');
                            if (swiperEl) {
                                swiperEl.classList.add('swiper-initialized');
                            }
                            addBorders(this);
                            updateNavButtons(this);
                        },
                        slideChange: function () {
                            addBorders(this);
                            updateNavButtons(this);
                        },
                        reachBeginning: function () {
                            updateNavButtons(this);
                        },
                        reachEnd: function () {
                            updateNavButtons(this);
                        },
                        resize: function () {
                            const currentWidth = this.width;
                            const containerEl = this.el;
                            const actualWidth = containerEl ? containerEl.offsetWidth : 0;

                            // Проверяем, что ширина разумная (не больше 5000px)
                            if (currentWidth > 5000 || actualWidth > 5000) {
                                // Останавливаем обработчик resize
                                this.off('resize');
                                return;
                            }

                            // Если ширина Swiper не совпадает с реальной и разница большая, обновляем
                            if (actualWidth > 0 && Math.abs(currentWidth - actualWidth) > 50) {
                                this.update();
                                return;
                            }

                            // Обновляем границы при изменении размера
                            addBorders(this);
                        }
                    }
                });

                return true;
            } catch (e) {
                console.error('ERROR initializing clients swiper:', e);
                console.error('Error stack:', e.stack);
                return false;
            }
        }

        // Ждем полной загрузки страницы и Swiper
        window.addEventListener('load', function () {
            // Небольшая задержка для гарантии, что все стили применены
            setTimeout(function () {
                if (!initClientsSwiper()) {
                    let attempts = 0;
                    const tryInit = setInterval(function () {
                        attempts++;
                        if (initClientsSwiper() || attempts > 30) {
                            clearInterval(tryInit);
                        }
                    }, 200);
                }
            }, 100);
        });
    })();
</script>