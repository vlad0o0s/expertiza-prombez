/**
 * Обработка форм на главной странице
 * Маска ввода телефона
 */

document.addEventListener('DOMContentLoaded', function() {
    // Инициализация маски для телефона
    const phoneInput = document.getElementById('callback-phone');
    
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
        
        // Функция для изменения цвета текста
        function updatePhoneColor() {
            const unmaskedValue = phoneMask.unmaskedValue;
            // Проверяем, есть ли реальные введенные цифры (больше чем просто +7)
            if (unmaskedValue && unmaskedValue.length > 1) {
                phoneInput.classList.add('has-value');
            } else {
                phoneInput.classList.remove('has-value');
            }
        }
        
        // Отслеживание изменений только при реальном вводе
        phoneMask.on('accept', function() {
            // Небольшая задержка для корректной обработки маски
            setTimeout(updatePhoneColor, 10);
        });
        
        phoneInput.addEventListener('input', function() {
            setTimeout(updatePhoneColor, 10);
        });
        
        // При фокусе - не меняем цвет, только если есть реальный ввод
        phoneInput.addEventListener('focus', function() {
            updatePhoneColor();
        });
        
        // При потере фокуса проверяем, есть ли реальный ввод
        phoneInput.addEventListener('blur', function() {
            updatePhoneColor();
        });
    }
    
    // Запускаем инициализацию
    initPhoneMask();
});

