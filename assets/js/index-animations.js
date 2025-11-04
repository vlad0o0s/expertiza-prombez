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
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Находим все элементы с классом animate-on-scroll
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    animatedElements.forEach(function(element) {
        observer.observe(element);
    });

    // Анимация для hero секции при загрузке страницы (без задержки)
    const heroContent = document.querySelector('.hero-content');
    if (heroContent && heroContent.classList.contains('fade-in')) {
        setTimeout(function() {
            heroContent.classList.add('animated');
        }, 100);
    }

    // Анимация счетчиков для статистики
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // 2 секунды
        const step = target / (duration / 16); // 60 FPS
        let current = 0;

        const timer = setInterval(function() {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current) + '+';
        }, 16);
    }

    // Observer для счетчиков статистики
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                statsObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    });

    // Находим все счетчики статистики (десктоп и мобильная версия)
    const statNumbers = document.querySelectorAll('.stat-number[data-target], .stat-mobile-number[data-target]');
    statNumbers.forEach(function(statNumber) {
        statsObserver.observe(statNumber);
    });
});

