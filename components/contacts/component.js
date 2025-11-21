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
    
    // Функция для показа модального окна
    function showModalPopup(type, message) {
        // Удаляем существующее модальное окно, если есть
        const existingModal = document.querySelector('.modal-overlay');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Создаем модальное окно
        const modalOverlay = document.createElement('div');
        modalOverlay.className = 'modal-overlay';
        
        const title = type === 'success' ? 'СПАСИБО!' : 'ОШИБКА';
        const iconSvg = type === 'success' 
            ? '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'
            : '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        
        modalOverlay.innerHTML = `
            <div class="modal-popup modal-popup-${type}">
                <button class="modal-popup-close" aria-label="Закрыть">&times;</button>
                <div class="modal-popup-icon">${iconSvg}</div>
                <h2 class="modal-popup-title">${title}</h2>
                <p class="modal-popup-message">${message}</p>
                <div class="modal-popup-button">
                    <button type="button">OK</button>
                </div>
            </div>
        `;
        
        document.body.appendChild(modalOverlay);
        
        // Блокируем прокрутку страницы
        if (typeof toggleBodyScroll === 'function') {
            toggleBodyScroll(true);
        } else {
            document.body.style.overflow = 'hidden';
        }
        
        // Показываем модальное окно
        setTimeout(function() {
            modalOverlay.classList.add('show');
        }, 10);
        
        // Функция закрытия
        function closeModal() {
            modalOverlay.classList.remove('show');
            // Разблокируем прокрутку страницы
            if (typeof toggleBodyScroll === 'function') {
                toggleBodyScroll(false);
            } else {
                document.body.style.overflow = '';
            }
            setTimeout(function() {
                if (modalOverlay.parentNode) {
                    modalOverlay.parentNode.removeChild(modalOverlay);
                }
            }, 300);
        }
        
        // Закрытие по кнопке
        const closeBtn = modalOverlay.querySelector('.modal-popup-close');
        const okBtn = modalOverlay.querySelector('.modal-popup-button button');
        
        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }
        
        if (okBtn) {
            okBtn.addEventListener('click', closeModal);
        }
        
        // Закрытие по клику вне окна
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
        
        // Закрытие по Esc
        function handleEsc(e) {
            if (e.key === 'Escape') {
                closeModal();
                document.removeEventListener('keydown', handleEsc);
            }
        }
        document.addEventListener('keydown', handleEsc);
        
        // Автоматическое закрытие через 5 секунд для успеха
        if (type === 'success') {
            setTimeout(closeModal, 5000);
        }
    }
    
    // Обработка отправки формы обратного звонка через AJAX
    const callbackForm = document.querySelector('.callback-form');
    if (callbackForm) {
        callbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButtons = this.querySelectorAll('button[type="submit"]');
            const originalTexts = [];
            
            // Сохраняем оригинальные тексты кнопок и отключаем их
            submitButtons.forEach(function(btn) {
                const btnText = btn.textContent || btn.innerHTML;
                originalTexts.push(btnText);
                btn.disabled = true;
                
                // Для кнопки с текстом меняем текст, для кнопки со стрелкой - добавляем класс
                if (btn.classList.contains('btn-order-company')) {
                    btn.textContent = 'Отправка...';
                } else if (btn.classList.contains('btn-arrow-company')) {
                    btn.style.opacity = '0.5';
                }
            });
            
            // Отправляем AJAX-запрос
            fetch('', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Восстанавливаем кнопки
                submitButtons.forEach(function(btn, index) {
                    btn.disabled = false;
                    if (btn.classList.contains('btn-order-company')) {
                        btn.textContent = originalTexts[index];
                    } else if (btn.classList.contains('btn-arrow-company')) {
                        btn.style.opacity = '1';
                    }
                });
                
                // Показываем модальное окно
                showModalPopup(data.success ? 'success' : 'error', data.message);
                
                // Скрываем форму и очищаем при успехе
                if (data.success) {
                    // Очищаем форму
                    callbackForm.reset();
                    // Убираем класс has-value с поля телефона
                    const phoneInput = document.getElementById('callback-phone');
                    if (phoneInput) {
                        phoneInput.classList.remove('has-value');
                    }
                    // Скрываем форму после небольшой задержки
                    setTimeout(function() {
                        callbackForm.style.display = 'none';
                    }, 500);
                } else {
                    // Показываем форму обратно при ошибке (если была скрыта)
                    callbackForm.style.display = '';
                }
            })
            .catch(error => {
                // Восстанавливаем кнопки
                submitButtons.forEach(function(btn, index) {
                    btn.disabled = false;
                    if (btn.classList.contains('btn-order-company')) {
                        btn.textContent = originalTexts[index];
                    } else if (btn.classList.contains('btn-arrow-company')) {
                        btn.style.opacity = '1';
                    }
                });
                
                // Показываем модальное окно с ошибкой
                showModalPopup('error', 'Произошла ошибка при отправке сообщения. Попробуйте позже.');
            });
        });
    }
});

