<?php
/**
 * Функция для загрузки компонента
 * Автоматически подключает CSS и JS файлы компонента
 * 
 * @param string $componentName Имя компонента (папка в components/)
 * @param array $data Данные для передачи в компонент
 */
function load_component($componentName, $data = []) {
    global $additional_css, $additional_js;
    
    $componentPath = __DIR__ . '/../components/' . $componentName;
    $componentFile = $componentPath . '/component.php';
    $cssFile = $componentPath . '/component.css';
    $jsFile = $componentPath . '/component.js';
    
    // Подключаем CSS если существует
    if (file_exists($cssFile)) {
        $cssUrl = '/components/' . $componentName . '/component.css';
        if (!isset($additional_css) || !is_array($additional_css)) {
            $additional_css = [];
        }
        if (!in_array($cssUrl, $additional_css)) {
            $additional_css[] = $cssUrl;
        }
    }
    
    // Подключаем JS если существует
    if (file_exists($jsFile)) {
        $jsUrl = '/components/' . $componentName . '/component.js';
        if (!isset($additional_js) || !is_array($additional_js)) {
            $additional_js = [];
        }
        if (!in_array($jsUrl, $additional_js)) {
            $additional_js[] = $jsUrl;
        }
    }
    
    // Включаем PHP файл компонента
    if (file_exists($componentFile)) {
        // Извлекаем переменные из массива $data для использования в компоненте
        extract($data);
        include $componentFile;
    } else {
        echo "<!-- Component {$componentName} not found -->";
    }
}
?>

