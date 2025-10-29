/**
 * Главный JavaScript файл
 */

// Инициализация после загрузки DOM
document.addEventListener('DOMContentLoaded', function() {
    console.log('Сайт загружен');
    
    // Инициализация Swiper (будет вызвана при наличии слайдеров)
    initSwiper();
    
    // Инициализация других компонентов
    initComponents();
});

/**
 * Инициализация Swiper слайдеров
 */
function initSwiper() {
    // Основной слайдер
    const mainSwiper = document.querySelector('.swiper-main');
    if (mainSwiper) {
        new Swiper('.swiper-main', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }
    
    // Дополнительные слайдеры можно добавить по классам
    const swiperInstances = document.querySelectorAll('.swiper:not(.swiper-main)');
    swiperInstances.forEach(function(swiperEl) {
        new Swiper(swiperEl, {
            slidesPerView: 'auto',
            spaceBetween: 20,
            loop: false,
        });
    });
}

/**
 * Инициализация других компонентов
 */
function initComponents() {
    // Мобильное меню
    initMobileMenu();
    
    // Формы
    initForms();
    
    // Плавная прокрутка
    initSmoothScroll();
}

/**
 * Мобильное меню
 */
function initMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
}

/**
 * Обработка форм
 */
function initForms() {
    const forms = document.querySelectorAll('form[data-ajax]');
    
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn ? submitBtn.textContent : '';
            
            // Отключение кнопки на время отправки
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Отправка...';
            }
            
            // Здесь будет AJAX запрос
            fetch(form.action || window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('Сообщение успешно отправлено!', 'success');
                    form.reset();
                } else {
                    showMessage(data.message || 'Произошла ошибка', 'error');
                }
            })
            .catch(error => {
                showMessage('Произошла ошибка при отправке', 'error');
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            });
        });
    });
}

/**
 * Плавная прокрутка для якорных ссылок
 */
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
}

/**
 * Показать сообщение
 */
function showMessage(message, type = 'info') {
    const messageEl = document.createElement('div');
    messageEl.className = `message message-${type}`;
    messageEl.textContent = message;
    
    document.body.appendChild(messageEl);
    
    setTimeout(function() {
        messageEl.classList.add('show');
    }, 10);
    
    setTimeout(function() {
        messageEl.classList.remove('show');
        setTimeout(function() {
            document.body.removeChild(messageEl);
        }, 300);
    }, 3000);
}
