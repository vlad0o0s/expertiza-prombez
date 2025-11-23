/**
 * Кастомный выпадающий список для select элементов
 */
(function() {
    'use strict';

    // Создаем кастомный dropdown для select
    function createCustomSelect(selectElement) {
        // Пропускаем если уже обработан
        if (selectElement.dataset.customSelect === 'true') {
            return;
        }

        const wrapper = document.createElement('div');
        wrapper.className = 'custom-select-wrapper';
        
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'custom-select-button';
        button.innerHTML = `
            <span class="custom-select-text">${selectElement.options[selectElement.selectedIndex]?.text || 'Выберите...'}</span>
            <span class="custom-select-arrow">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 9L1 4H11L6 9Z" fill="#152333"/>
                </svg>
            </span>
        `;

        const dropdown = document.createElement('div');
        dropdown.className = 'custom-select-dropdown';
        dropdown.dataset.selectId = selectElement.id || 'select-' + Math.random().toString(36).substr(2, 9);
        
        // Создаем опции
        function updateOptions() {
            dropdown.innerHTML = '';
            Array.from(selectElement.options).forEach((option, index) => {
                const item = document.createElement('div');
                item.className = 'custom-select-item';
                if (option.value === selectElement.value) {
                    item.classList.add('selected');
                }
                item.textContent = option.text;
                item.dataset.value = option.value;
                
                item.addEventListener('click', function() {
                    selectElement.value = option.value;
                    selectElement.dispatchEvent(new Event('change', { bubbles: true }));
                    button.querySelector('.custom-select-text').textContent = option.text;
                    updateOptions();
                    closeDropdown();
                });
                
                dropdown.appendChild(item);
            });
        }
        
        updateOptions();
        
        wrapper.appendChild(button);
        wrapper.appendChild(dropdown);
        
        // Заменяем select на wrapper
        selectElement.style.display = 'none';
        selectElement.parentNode.insertBefore(wrapper, selectElement);
        wrapper.appendChild(selectElement);
        selectElement.dataset.customSelect = 'true';
        
        // Открытие/закрытие dropdown
        function toggleDropdown() {
            const isOpen = dropdown.classList.contains('open');
            closeAllDropdowns();
            if (!isOpen) {
                dropdown.classList.add('open');
                button.classList.add('active');
                wrapper.classList.add('active');
            }
        }
        
        function closeDropdown() {
            dropdown.classList.remove('open');
            button.classList.remove('active');
            wrapper.classList.remove('active');
        }
        
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown();
        });
        
        // Закрытие при клике вне
        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) {
                closeDropdown();
            }
        });
        
        // Обновление при изменении select программно
        selectElement.addEventListener('change', function() {
            button.querySelector('.custom-select-text').textContent = 
                selectElement.options[selectElement.selectedIndex]?.text || 'Выберите...';
            updateOptions();
        });
    }
    
    function closeAllDropdowns() {
        document.querySelectorAll('.custom-select-dropdown').forEach(dropdown => {
            dropdown.classList.remove('open');
        });
        document.querySelectorAll('.custom-select-button').forEach(button => {
            button.classList.remove('active');
        });
        document.querySelectorAll('.custom-select-wrapper').forEach(wrapper => {
            wrapper.classList.remove('active');
        });
    }
    
    // Инициализация всех select'ов
    function initCustomSelects(container) {
        const scope = container || document;
        // Ищем все select'ы, которые еще не обработаны
        scope.querySelectorAll('select').forEach(select => {
            // Пропускаем уже обработанные
            if (select.dataset.customSelect === 'true') {
                return;
            }
            
            // Пропускаем select'ы с явным указанием не использовать кастомный select
            if (select.dataset.customSelect === 'false') {
                return;
            }
            
            // Пропускаем скрытые select'ы внутри скрытых wrapper'ов
            const wrapper = select.closest('.category-select-wrapper');
            if (wrapper) {
                const hasShowClass = wrapper.classList.contains('show');
                const displayStyle = wrapper.style.display;
                const isDisplayBlock = displayStyle === 'block' || displayStyle === '';
                const isOffsetParent = wrapper.offsetParent !== null;
                
                // Если wrapper скрыт и нет класса show, пропускаем
                if (!hasShowClass && displayStyle === 'none') {
                    return;
                }
                // Если wrapper видим (есть класс show или display: block), обрабатываем
            }
            
            // Пропускаем select'ы внутри уже созданных custom-select-wrapper
            if (select.closest('.custom-select-wrapper')) {
                return;
            }
            
            createCustomSelect(select);
        });
    }
    
    // Инициализация при загрузке
    function initializeOnLoad() {
        // Небольшая задержка для гарантии, что все элементы загружены
        setTimeout(() => {
            initCustomSelects();
        }, 100);
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeOnLoad);
    } else {
        initializeOnLoad();
    }
    
    // Экспорт функции для повторной инициализации
    window.initCustomSelects = initCustomSelects;
})();

