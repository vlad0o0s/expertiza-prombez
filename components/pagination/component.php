<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/pagination/component.css">';
}

$currentPage = $data['currentPage'] ?? 1;
$totalPages = $data['totalPages'] ?? 1;
$baseUrl = $data['baseUrl'] ?? '/articles';

// Генерируем ссылки пагинации
$paginationItems = [];
$maxVisible = 5; // Максимум видимых страниц

$start = max(1, $currentPage - floor($maxVisible / 2));
$end = min($totalPages, $start + $maxVisible - 1);
$start = max(1, $end - $maxVisible + 1);

if ($start > 1) {
    $paginationItems[] = ['page' => 1, 'label' => '1', 'url' => $baseUrl . ($baseUrl === '/articles' ? '' : '&page=1')];
    if ($start > 2) {
        $paginationItems[] = ['page' => null, 'label' => '...', 'url' => null];
    }
}

for ($i = $start; $i <= $end; $i++) {
    $url = $baseUrl;
    if ($i > 1) {
        $url .= (strpos($baseUrl, '?') !== false ? '&' : '?') . 'page=' . $i;
    }
    $paginationItems[] = ['page' => $i, 'label' => (string)$i, 'url' => $url];
}

if ($end < $totalPages) {
    if ($end < $totalPages - 1) {
        $paginationItems[] = ['page' => null, 'label' => '...', 'url' => null];
    }
    $url = $baseUrl . (strpos($baseUrl, '?') !== false ? '&' : '?') . 'page=' . $totalPages;
    $paginationItems[] = ['page' => $totalPages, 'label' => (string)$totalPages, 'url' => $url];
}

$nextUrl = null;
if ($currentPage < $totalPages) {
    $nextUrl = $baseUrl . (strpos($baseUrl, '?') !== false ? '&' : '?') . 'page=' . ($currentPage + 1);
}
?>

<nav class="pagination" aria-label="Навигация по страницам">
    <div class="container">
        <div class="pagination-inner">
            <?php foreach ($paginationItems as $item): ?>
                <?php if ($item['url'] === null): ?>
                    <span class="pagination-item pagination-ellipsis"><?php echo htmlspecialchars($item['label']); ?></span>
                <?php else: ?>
                    <a href="<?php echo htmlspecialchars($item['url']); ?>" 
                       class="pagination-item <?php echo $item['page'] === $currentPage ? 'pagination-item-active' : ''; ?>" 
                       <?php echo $item['page'] === $currentPage ? 'aria-current="page"' : ''; ?>>
                        <?php echo htmlspecialchars($item['label']); ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <?php if ($nextUrl): ?>
                <a href="<?php echo htmlspecialchars($nextUrl); ?>" class="pagination-item pagination-next">Следующая</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

