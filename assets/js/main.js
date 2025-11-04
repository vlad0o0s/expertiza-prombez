/**
 * Главный JavaScript файл
 */

// Инициализация после загрузки DOM
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация Swiper (будет вызвана при наличии слайдеров)
    initSwiper();
    
    // Инициализация других компонентов
    initComponents();
});

/**
 * Инициализация Swiper слайдеров
 */
function initSwiper() {
    // Проверка наличия Swiper
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper library is not loaded');
        return;
    }
    
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
    const modal = document.querySelector('.mobile-modal');
    const modalClose = document.querySelector('.mobile-modal-close');

    function setModalTop() {
        const header = document.querySelector('.site-header');
        if (modal && header) {
            const headerHeight = header.offsetHeight || 0;
            // Прижимаем модалку к шапке (работает для ПК и мобильной версии)
            modal.style.top = headerHeight + 'px';
            modal.style.height = `calc(100vh - ${headerHeight}px)`;
        }
    }

    if (mobileMenuToggle && modal) {
        mobileMenuToggle.addEventListener('click', function() {
            const img = this.querySelector('img');
            const isOpen = modal.classList.toggle('open');
            document.body.style.overflow = isOpen ? 'hidden' : '';
            setModalTop();
            if (img) {
                img.src = isOpen ? '/assets/images/exit.svg' : '/assets/images/burgermenu.svg';
            }
            // Гарантируем, что нужные секции открыты при каждом открытии
            if (isOpen) {
                const epb = modal.querySelector('.mm-section[data-section="epb"]');
                const contacts = modal.querySelector('.mm-section[data-section="contacts"]');
                [epb, contacts].forEach(function(section) {
                    if (!section) return;
                    section.classList.add('is-open');
                    const toggle = section.querySelector('.mm-section-toggle');
                    if (toggle) toggle.setAttribute('aria-expanded', 'true');
                });
            }
        });
        window.addEventListener('resize', setModalTop);
        // Вызываем при загрузке для правильной позиции на ПК
        setModalTop();
    }

    if (modalClose && modal) {
        modalClose.addEventListener('click', function() {
            const img = mobileMenuToggle ? mobileMenuToggle.querySelector('img') : null;
            modal.classList.remove('open');
            document.body.style.overflow = '';
            if (img) img.src = '/assets/images/burgermenu.svg';
        });
    }

    // Закрытие по клику вне контента
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                const img = mobileMenuToggle ? mobileMenuToggle.querySelector('img') : null;
                modal.classList.remove('open');
                document.body.style.overflow = '';
                if (img) img.src = '/assets/images/burgermenu.svg';
            }
        });
        // Закрытие по Esc
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('open')) {
                const img = mobileMenuToggle ? mobileMenuToggle.querySelector('img') : null;
                modal.classList.remove('open');
                document.body.style.overflow = '';
                if (img) img.src = '/assets/images/burgermenu.svg';
            }
        });
    }

    // Аккордеон разделов
    document.querySelectorAll('.mm-section-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const section = this.closest('.mm-section');
            const isOpen = section.classList.toggle('is-open');
            this.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    });
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
