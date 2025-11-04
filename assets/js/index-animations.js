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
});

