<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/pagination/component.css">';
}
?>

<nav class="pagination" aria-label="Навигация по страницам">
    <div class="container">
        <div class="pagination-inner">
            <a href="#" class="pagination-item pagination-item-active" aria-current="page">1</a>
            <a href="#" class="pagination-item">2</a>
            <a href="#" class="pagination-item">3</a>
            <a href="#" class="pagination-item">4</a>
            <a href="#" class="pagination-item pagination-next">Следующая</a>
        </div>
    </div>
</nav>

