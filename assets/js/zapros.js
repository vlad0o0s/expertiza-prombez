function toggleForm(value) {
  // Сохраняем данные текущей активной формы перед переключением
  const activeForm = document.querySelector('.custom-form.active');
  if (activeForm) {
    saveFormData(activeForm);
  }
  
  document.querySelector(".form1").classList.remove("active");
  document.querySelector(".form2").classList.remove("active");
  document.querySelector(".form3").classList.remove("active");
  document.querySelector(".form4").classList.remove("active");
  
  const newActiveForm = document.querySelector(`.${value}`);
  newActiveForm.classList.add("active");
  
  // Восстанавливаем данные новой активной формы
  restoreFormData(newActiveForm);
}

function toggleFormYr(formId, value) {
  const clientInput = document.getElementById("client-type-" + formId);
  const form = document.querySelector("." + formId);
  if (!form || !clientInput) return;
  
  const yrFields = form.querySelectorAll(".yr input");
  const chasDiv = form.querySelector(".chas");
  const yrDiv = form.querySelector(".yr");

  if (chasDiv) chasDiv.classList.remove("active");
  if (yrDiv) yrDiv.classList.remove("active");

  if (value === "chas") {
    clientInput.value = "Частное лицо";
    yrFields.forEach((input) => (input.disabled = true));
  } else if (value === "yr") {
    clientInput.value = "Представитель юридического лица";
    yrFields.forEach((input) => (input.disabled = false));
    if (yrDiv) yrDiv.classList.add("active");
  }
}

function toggleFormStorona(formId, value) {
  const clientInput = document.getElementById("storona-" + formId);
  if (!clientInput) return;
  
  if (value === "ints") {
    clientInput.value = "Истца";
  } else if (value === "otv") {
    clientInput.value = "Ответчика";
  }
}

// Анимация стрелки при открытии/закрытии select
document.addEventListener('DOMContentLoaded', function() {
    // Обработка для form-select-type (кнопка переключения форм)
    const formSelects = document.querySelectorAll('.form-select-type');
    
    formSelects.forEach(function(select) {
        const selectWrapper = select.closest('.custom-select1');
        if (!selectWrapper) return;
        
        select.addEventListener('focus', function() {
            selectWrapper.classList.add('is-open');
        });
        
        select.addEventListener('blur', function() {
            selectWrapper.classList.remove('is-open');
        });
        
        select.addEventListener('change', function() {
            // Небольшая задержка для визуального эффекта
            setTimeout(function() {
                selectWrapper.classList.remove('is-open');
            }, 300);
        });
    });
    
    // Обработка для всех custom-select (выпадающие списки в формах)
    const customSelects = document.querySelectorAll('.custom-select');
    
    customSelects.forEach(function(select) {
        const selectWrapper = select.closest('.custom-select-wrapper-arrow');
        if (!selectWrapper) return;
        
        select.addEventListener('focus', function() {
            selectWrapper.classList.add('is-open');
        });
        
        select.addEventListener('blur', function() {
            selectWrapper.classList.remove('is-open');
        });
        
        select.addEventListener('change', function() {
            // Небольшая задержка для визуального эффекта
            setTimeout(function() {
                selectWrapper.classList.remove('is-open');
            }, 300);
        });
    });
});

// Хранилище масок для каждого поля телефона
const phoneMasks = new Map();

// Инициализация маски для телефона
function initPhoneMasks() {
    // Ждем загрузки IMask
    let retryCount = 0;
    const maxRetries = 50;
    
    function initMasks() {
        if (typeof IMask === 'undefined') {
            retryCount++;
            if (retryCount < maxRetries) {
                setTimeout(initMasks, 100);
            } else {
                console.error('IMask library failed to load after multiple attempts');
            }
            return;
        }
        
        // Находим все поля телефона в формах
        const phoneInputs = document.querySelectorAll('.custom-form input[type="tel"]');
        
        phoneInputs.forEach(function(phoneInput) {
            if (!phoneInput) return;
            
            // Пропускаем если маска уже инициализирована
            if (phoneMasks.has(phoneInput)) return;
            
            // Сохраняем оригинальный placeholder
            const originalPlaceholder = phoneInput.placeholder || '';
            
            // Инициализируем маску
            const phoneMask = IMask(phoneInput, {
                mask: '+{7}(000)000-00-00',
                lazy: true,
                placeholderChar: ' '
            });
            
            // Сохраняем маску для этого поля
            phoneMasks.set(phoneInput, phoneMask);
            
            // Восстанавливаем placeholder после инициализации маски
            if (originalPlaceholder) {
                phoneInput.placeholder = originalPlaceholder;
            }
            
            // При фокусе - начинаем ввод с +7 если поле пустое
            phoneInput.addEventListener('focus', function() {
                const currentValue = phoneMask.value || phoneInput.value || '';
                if (!currentValue || currentValue.trim() === '') {
                    phoneMask.value = '+7';
                    phoneMask.updateValue();
                }
            });
            
            // При начале ввода - убеждаемся что +7 есть
            phoneMask.on('accept', function() {
                const currentValue = phoneMask.value || '';
                if (currentValue && !currentValue.startsWith('+7') && !currentValue.startsWith('+')) {
                    const digits = currentValue.replace(/\D/g, '');
                    if (digits) {
                        phoneMask.value = '+7' + digits;
                        phoneMask.updateValue();
                    }
                }
            });
        });
    }
    
    // Запускаем инициализацию
    initMasks();
}

// Функция для обновления маски после восстановления данных
function updatePhoneMaskAfterRestore(phoneInput) {
    const phoneMask = phoneMasks.get(phoneInput);
    if (phoneMask && phoneInput.value) {
        // Обновляем значение маски
        phoneMask.value = phoneInput.value;
        phoneMask.updateValue();
    }
}

// Функции для сохранения и восстановления данных формы
function saveFormData(form) {
    const formData = {};
    const formId = form.classList.contains('form1') ? 'form1' :
                   form.classList.contains('form2') ? 'form2' :
                   form.classList.contains('form3') ? 'form3' : 'form4';
    
    // Сохраняем значения всех полей
    form.querySelectorAll('input, textarea, select').forEach(function(field) {
        if (field.type === 'checkbox') {
            formData[field.name] = field.checked;
        } else if (field.type === 'file') {
            // Файлы не сохраняем в localStorage
            return;
        } else if (field.type === 'hidden') {
            // Сохраняем hidden поля
            if (field.name) {
                formData[field.name] = field.value;
            }
        } else {
            if (field.name) {
                formData[field.name] = field.value;
            }
        }
    });
    
    // Сохраняем значения скрытых полей по ID
    const clientInput = form.querySelector('input[id^="client-type"]');
    const storonaInput = form.querySelector('input[id^="storona-"]');
    
    if (clientInput) {
        formData['Клиент'] = clientInput.value;
    }
    
    if (storonaInput) {
        formData['Вы представляете сторону'] = storonaInput.value;
    }
    
    // Сохраняем в localStorage
    localStorage.setItem('commercial_form_' + formId, JSON.stringify(formData));
}

function restoreFormData(form) {
    const formId = form.classList.contains('form1') ? 'form1' :
                   form.classList.contains('form2') ? 'form2' :
                   form.classList.contains('form3') ? 'form3' : 'form4';
    
    const savedData = localStorage.getItem('commercial_form_' + formId);
    
    if (!savedData) return;
    
    try {
        const formData = JSON.parse(savedData);
        
        Object.keys(formData).forEach(function(fieldName) {
            const field = form.querySelector('[name="' + fieldName + '"]');
            
            if (field) {
                if (field.type === 'checkbox') {
                    field.checked = formData[fieldName] === true;
                } else if (field.type === 'file') {
                    // Файлы не восстанавливаем
                    return;
                } else if (field.type === 'tel') {
                    // Для телефона восстанавливаем значение и обновляем маску
                    const savedValue = formData[fieldName] || '';
                    field.value = savedValue;
                    // Обновляем маску после небольшой задержки
                    setTimeout(function() {
                        updatePhoneMaskAfterRestore(field);
                    }, 100);
                } else {
                    field.value = formData[fieldName] || '';
                    
                    // Если это select, нужно также вызвать событие change
                    if (field.tagName === 'SELECT' && field.onchange) {
                        field.onchange();
                    }
                }
            }
        });
        
        // Восстанавливаем значения скрытых полей (клиент, сторона)
        const clientInput = form.querySelector('input[id^="client-type"]');
        const storonaInput = form.querySelector('input[id^="storona-"]');
        
        if (clientInput && formData['Клиент']) {
            clientInput.value = formData['Клиент'];
            const select = form.querySelector('select[onchange*="toggleFormYr"]');
            if (select) {
                if (formData['Клиент'] === 'Представитель юридического лица') {
                    select.value = 'yr';
                } else {
                    select.value = 'chas';
                }
                // Вызываем функцию переключения для обновления состояния полей
                const formId = form.classList.contains('form1') ? 'form1' :
                              form.classList.contains('form2') ? 'form2' :
                              form.classList.contains('form3') ? 'form3' : 'form4';
                toggleFormYr(formId, select.value);
            }
        }
        
        if (storonaInput && formData['Вы представляете сторону']) {
            storonaInput.value = formData['Вы представляете сторону'];
            const select = form.querySelector('select[onchange*="toggleFormStorona"]');
            if (select) {
                const formId = form.classList.contains('form1') ? 'form1' :
                              form.classList.contains('form2') ? 'form2' :
                              form.classList.contains('form3') ? 'form3' : 'form4';
                
                if (formData['Вы представляете сторону'] === 'Ответчика') {
                    select.value = 'otv';
                    toggleFormStorona(formId, 'otv');
                } else {
                    select.value = 'ints';
                    toggleFormStorona(formId, 'ints');
                }
            }
        }
    } catch (e) {
        console.error('Ошибка восстановления данных формы:', e);
    }
}

function clearFormData(form) {
    const formId = form.classList.contains('form1') ? 'form1' :
                   form.classList.contains('form2') ? 'form2' :
                   form.classList.contains('form3') ? 'form3' : 'form4';
    
    localStorage.removeItem('commercial_form_' + formId);
}

// Debounce функция для сохранения
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Обработка загрузки файлов
document.addEventListener('DOMContentLoaded', function() {
    // Инициализируем маски для телефонов
    initPhoneMasks();
    
    // Восстанавливаем данные всех форм (после задержки для инициализации масок)
    setTimeout(function() {
        const forms = document.querySelectorAll('.custom-form');
        forms.forEach(function(form) {
            restoreFormData(form);
            
            // Сохраняем данные при вводе (с задержкой 500ms)
            const saveDebounced = debounce(function() {
                saveFormData(form);
            }, 500);
            
            form.querySelectorAll('input, textarea, select').forEach(function(field) {
                if (field.type === 'file') return; // Файлы не сохраняем
                
                // Для полей телефона не перезаписываем обработчик маски
                if (field.type !== 'tel') {
                    field.addEventListener('input', saveDebounced);
                }
                field.addEventListener('change', saveDebounced);
            });
            
            // Для полей телефона добавляем сохранение через обработчик маски
            form.querySelectorAll('input[type="tel"]').forEach(function(phoneInput) {
                const phoneMask = phoneMasks.get(phoneInput);
                if (phoneMask) {
                    const saveDebounced = debounce(function() {
                        saveFormData(form);
                    }, 500);
                    
                    phoneMask.on('accept', saveDebounced);
                }
            });
        });
    }, 500); // Задержка для полной инициализации масок
    const uploadIcons = document.querySelectorAll('.upload-icon');
    const fileInputs = document.querySelectorAll('.pdfUpload');
    const uploadedFilesContainers = document.querySelectorAll('.uploaded-files');

    uploadIcons.forEach(function(icon, index) {
        const fileInput = fileInputs[index];
        const uploadedFilesContainer = uploadedFilesContainers[index];
        
        if (icon && fileInput && uploadedFilesContainer) {
            icon.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                const existingFiles = Array.from(uploadedFilesContainer.querySelectorAll('.uploaded-file-preview')).map(el => el.dataset.fileName);
                
                files.forEach(function(file) {
                    if (file.type === 'application/pdf' && !existingFiles.includes(file.name)) {
                        const filePreview = document.createElement('div');
                        filePreview.className = 'uploaded-file-preview';
                        filePreview.dataset.fileName = file.name;
                        
                        // Обертка для иконки PDF с кнопкой удаления
                        const pdfIconWrapper = document.createElement('div');
                        pdfIconWrapper.className = 'pdf-icon-wrapper';
                        
                        // Иконка PDF
                        const pdfIcon = document.createElement('img');
                        pdfIcon.className = 'pdf-icon';
                        pdfIcon.src = '/assets/images/our-documents.png';
                        pdfIcon.alt = 'PDF документ';
                        pdfIcon.style.width = '40px';
                        pdfIcon.style.height = '40px';
                        pdfIcon.style.objectFit = 'contain';
                        
                        // Кнопка удаления (рядом с иконкой)
                        const removeBtn = document.createElement('button');
                        removeBtn.className = 'remove-file';
                        removeBtn.type = 'button';
                        removeBtn.innerHTML = '×';
                        removeBtn.setAttribute('aria-label', 'Удалить файл');
                        removeBtn.onclick = function() {
                            filePreview.remove();
                            // Удаляем файл из input
                            const dt = new DataTransfer();
                            const inputFiles = Array.from(fileInput.files);
                            inputFiles.forEach(function(f) {
                                if (f.name !== file.name) {
                                    dt.items.add(f);
                                }
                            });
                            fileInput.files = dt.files;
                        };
                        
                        pdfIconWrapper.appendChild(pdfIcon);
                        pdfIconWrapper.appendChild(removeBtn);
                        
                        // Название файла
                        const fileName = document.createElement('div');
                        fileName.className = 'file-name';
                        fileName.textContent = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;
                        fileName.title = file.name; // Полное имя в tooltip
                        
                        filePreview.appendChild(pdfIconWrapper);
                        filePreview.appendChild(fileName);
                        uploadedFilesContainer.appendChild(filePreview);
                    }
                });
            });
        }
    });

    // Обработка отправки форм через AJAX
    const forms = document.querySelectorAll('.custom-form');
    forms.forEach(function(form) {
        // Сохраняем оригинальный action
        const originalAction = form.getAttribute('action') || '/sendmail.php';
        
        // Убираем action из формы, чтобы предотвратить обычную отправку
        form.setAttribute('data-ajax', 'true');
        form.removeAttribute('action');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Проверяем, не отправляется ли форма уже
            if (form.hasAttribute('data-submitting')) {
                return;
            }
            
            // Помечаем форму как отправляемую через AJAX
            form.setAttribute('data-submitting', 'true');
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.custom-submit');
            const submitArrowBtn = form.querySelector('.custom-submit-arrow');
            const originalText = submitBtn ? submitBtn.textContent : '';
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Отправка...';
            }
            
            if (submitArrowBtn) {
                submitArrowBtn.disabled = true;
                submitArrowBtn.style.opacity = '0.5';
            }
            
            // Убеждаемся, что отправляем POST запрос
            // Используем прямой путь к файлу без редиректа
            const url = '/sendmail.php';
            
            console.log('Отправка формы через POST на:', url);
            console.log('FormData:', formData);
            
            fetch(url, {
                method: 'POST',
                body: formData,
                redirect: 'manual', // Не следовать редиректам
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                // Проверяем статус ответа
                if (!response.ok) {
                    // Если ответ не OK, пытаемся получить текст ошибки
                    return response.text().then(text => {
                        try {
                            const json = JSON.parse(text);
                            return json;
                        } catch (e) {
                            throw new Error(text || 'Ошибка сервера: ' + response.status);
                        }
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    alert('Заявка успешно отправлена!');
                    form.reset();
                    // Очищаем сохраненные данные формы
                    clearFormData(form);
                    // Очистка превью файлов
                    const uploadedFiles = form.querySelector('.uploaded-files');
                    if (uploadedFiles) {
                        uploadedFiles.innerHTML = '';
                    }
                    // Сброс масок телефона
                    const phoneInputs = form.querySelectorAll('input[type="tel"]');
                    phoneInputs.forEach(function(input) {
                        input.value = '';
                    });
                } else {
                    alert(data.message || 'Произошла ошибка при отправке');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Произошла ошибка при отправке: ' + (error.message || 'Неизвестная ошибка'));
            })
            .finally(() => {
                // Убираем флаг отправки
                form.removeAttribute('data-submitting');
                
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
                if (submitArrowBtn) {
                    submitArrowBtn.disabled = false;
                    submitArrowBtn.style.opacity = '1';
                }
            });
        });
    });
});

