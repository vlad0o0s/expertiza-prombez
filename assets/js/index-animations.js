/**
 * Анимации появления элементов при скролле
 * Для коммерческого сайта - плавные, профессиональные анимации
 */

document.addEventListener('DOMContentLoaded', function() {
    // Настройка Intersection Observer для отслеживания появления элементов
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Функция для проверки и инициализации видимых элементов
    function checkVisibleElements() {
        const animatedElements = document.querySelectorAll('.animate-on-scroll:not(.animated)');
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        
        animatedElements.forEach(function(element) {
            const rect = element.getBoundingClientRect();
            // Элемент считается видимым, если он в пределах viewport или чуть ниже
            const isVisible = rect.top < windowHeight + 200 && rect.bottom > -200;
            
            if (isVisible) {
                // Добавляем класс animated для видимых элементов
                element.classList.add('animated');
            } else {
                // Наблюдаем за невидимыми элементами
                observer.observe(element);
            }
        });
    }

    // Проверяем элементы после загрузки DOM
    setTimeout(function() {
        checkVisibleElements();
    }, 200);

    // Дополнительная проверка после полной загрузки страницы
    window.addEventListener('load', function() {
        setTimeout(function() {
            checkVisibleElements();
        }, 300);
    });

    // Также проверяем при скролле
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
            checkVisibleElements();
        }, 100);
    }, { passive: true });

    // Анимация для hero секции при загрузке страницы (без задержки)
    const heroContent = document.querySelector('.hero-content');
    if (heroContent && heroContent.classList.contains('fade-in')) {
        setTimeout(function() {
            heroContent.classList.add('animated');
        }, 100);
    }

    // Анимация счетчиков теперь находится в компоненте about-us/component.js
});

