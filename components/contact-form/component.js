/**
 * Компонент формы контактов
 * Маска ввода телефона и AJAX обработка
 */

document.addEventListener('DOMContentLoaded', function() {
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
    
    // Находим все формы contact-form
    const contactForms = document.querySelectorAll('.contact-form');
    
    contactForms.forEach(function(form) {
        const phoneInput = form.querySelector('input[type="tel"]');
        
        // Инициализация маски телефона
        if (phoneInput) {
            let retryCount = 0;
            const maxRetries = 50;
            
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
            
            initPhoneMask();
        }
        
        // Обработка отправки формы через AJAX
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            formData.append('form_name', 'Контактная форма');
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const submitText = submitBtn ? submitBtn.querySelector('.contact-form-submit-text') : null;
            const originalText = submitText ? submitText.textContent : 'ОТПРАВИТЬ';
            
            // Блокируем кнопку и меняем текст
            if (submitBtn) {
                submitBtn.disabled = true;
                if (submitText) {
                    submitText.textContent = 'ОТПРАВКА...';
                }
            }
            
            // Отправляем AJAX-запрос
            fetch('/sendmail.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Восстанавливаем кнопку
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (submitText) {
                        submitText.textContent = originalText;
                    }
                }
                
                // Показываем модальное окно
                showModalPopup(data.success ? 'success' : 'error', data.message);
                
                // Очищаем форму при успехе
                if (data.success) {
                    form.reset();
                }
            })
            .catch(error => {
                // Восстанавливаем кнопку
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (submitText) {
                        submitText.textContent = originalText;
                    }
                }
                
                // Показываем модальное окно с ошибкой
                showModalPopup('error', 'Произошла ошибка при отправке сообщения. Попробуйте позже.');
                console.error('Ошибка отправки формы:', error);
            });
        });
    });
});

