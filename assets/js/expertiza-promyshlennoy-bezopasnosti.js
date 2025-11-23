/**
 * Инициализация слайдера видов экспертизы
 */
document.addEventListener("DOMContentLoaded", function () {
  // Ждем загрузки Swiper
  let retryCount = 0;
  const maxRetries = 50;

  function initExpertizaTypesSwiper() {
    if (typeof Swiper === "undefined") {
      retryCount++;
      if (retryCount < maxRetries) {
        setTimeout(initExpertizaTypesSwiper, 100);
      } else {
        console.error("Swiper library failed to load");
      }
      return;
    }

    const swiperEl = document.querySelector(".expertiza-types-swiper");
    if (!swiperEl) {
      return;
    }

    // Проверяем, не инициализирован ли уже
    if (swiperEl.swiper) {
      swiperEl.swiper.destroy(true, true);
    }

    const swiper = new Swiper(".expertiza-types-swiper", {
      slidesPerView: 4,
      spaceBetween: 15,
      loop: false,
      watchOverflow: true,
      navigation: {
        nextEl: ".expertiza-types-next",
        prevEl: ".expertiza-types-prev",
      },
      pagination: {
        el: ".expertiza-types-pagination",
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '"></span>';
        },
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
          spaceBetween: 15,
        },
        1280: {
          slidesPerView: 4,
          spaceBetween: 15,
        },
      },
    });
  }

  // Запускаем инициализацию
  initExpertizaTypesSwiper();
});
