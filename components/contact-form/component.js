/**
 * Компонент формы контактов
 * Маска ввода телефона
 */

document.addEventListener('DOMContentLoaded', function() {
    // Находим все поля телефона в формах contact-form
    const contactForms = document.querySelectorAll('.contact-form');
    
    contactForms.forEach(function(form) {
        const phoneInput = form.querySelector('input[type="tel"]');
        
        if (!phoneInput) {
            return;
        }
        
        // Ждем загрузки IMask (на случай медленной загрузки CDN)
        let retryCount = 0;
        const maxRetries = 50; // Максимум 5 секунд ожидания
        
        function initPhoneMask() {
            if (typeof IMask === 'undefined') {
                retryCount++;
                if (retryCount < maxRetries) {
                    setTimeout(initPhoneMask, 100);
                } else {
                    console.error('IMask library failed to load after multiple attempts');
                }
                return;
            }
            
            if (!phoneInput) {
                return;
            }
            
            const phoneMask = IMask(phoneInput, {
                mask: '+{7}(000)000-00-00',
                lazy: false,
                placeholderChar: '_'
            });
        }
        
        // Запускаем инициализацию
        initPhoneMask();
    });
});

