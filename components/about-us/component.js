/**
 * Анимация счетчиков для статистики
 */
document.addEventListener('DOMContentLoaded', function() {
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

