<?php
/** @var array $data */

$items = $data['items'] ?? null;
$current_title = $data['current_title'] ?? '';

if (!$items && $current_title) {
    $items = [
        [
            'title' => 'Главная',
            'url' => '/'
        ],
        [
            'title' => $current_title,
            'url' => null
        ],
    ];
}
?>

<?php if (!empty($items)): ?>
<nav class="breadcrumbs animate-on-scroll" aria-label="Хлебные крошки">
    <div class="container">
        <div class="breadcrumbs__inner">
            <?php foreach ($items as $index => $item): ?>
                <?php if ($index > 0): ?>
                    <?php
                    // Первая стрелка большая, остальные маленькие
                    $is_small_arrow = ($index > 1);
                    ?>
                    <span class="breadcrumbs__separator<?= $is_small_arrow ? ' breadcrumbs__separator--small' : '' ?>" aria-hidden="true">
                        <?php if ($is_small_arrow): ?>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.33333 12.1667L11.5 8L7.33333 3.83333" stroke="#152333" stroke-opacity="0.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        <?php else: ?>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.33333 12.1667L11.5 8L7.33333 3.83333" stroke="#152333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
                <?php
                $is_last = ($index === count($items) - 1);
                $tag = (!$is_last && !empty($item['url'])) ? 'a' : 'span';
                $class = 'breadcrumbs__item' . ($is_last ? ' breadcrumbs__item--current' : '');
                ?>
                <<?= $tag ?>
                    <?php if ($tag === 'a' && !empty($item['url'])): ?>
                        href="<?= htmlspecialchars($item['url']); ?>"
                    <?php endif; ?>
                    class="<?= $class; ?>">
                    <?= htmlspecialchars($item['title']); ?>
                </<?= $tag ?>>
            <?php endforeach; ?>
        </div>
    </div>
</nav>
<?php endif; ?>

