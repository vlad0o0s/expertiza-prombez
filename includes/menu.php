<?php
// Общий список пунктов меню
$menuItems = [
	[
		'label' => 'Услуги',
		'href' => '/services',
		'children' => [
			['label' => 'Экспертиза промышленной безопасности', 'href' => '/expertiza-prombezopasnosti'],
			['label' => 'Экологическая экспертиза', 'href' => '#'],
			['label' => 'Техническое обследование зданий', 'href' => '#'],
			['label' => 'Судебная экспертиза', 'href' => '#'],
			['label' => 'Лаборатория неразрушающего контроля', 'href' => '#'],
			['label' => 'Химическая лаборатория', 'href' => '#'],
			['label' => 'Образование и повышение квалификации', 'href' => '#'],
			['label' => 'Аудит СУОТ и внедрение', 'href' => '#'],
		],
	],
	[
		'label' => 'Статьи',
		'href' => '/stati',
	],
	[
		'label' => 'О компании',
		'href' => '/about',
		'children' => [
			['label' => 'Презентация', 'href' => '#'],
			['label' => 'Документы', 'href' => '#'],
			['label' => 'Реквизиты', 'href' => '#'],
			['label' => 'Контакты', 'href' => '#'],
		],
	],
];

/**
 * Выводит пункты меню в виде <li><a></a></li>
 */
function render_menu_items(array $items, bool $withDropdownMarkup = true): void
{
	$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

	foreach ($items as $item) {
		$href = $item['href'] ?? '#';
		$label = $item['label'] ?? '';
		$children = isset($item['children']) && is_array($item['children']) ? $item['children'] : [];

		$isActive = $href === '/' ? $currentPath === '/' : $currentPath === $href;
		$activeAttr = $isActive ? ' aria-current="page"' : '';

		if ($withDropdownMarkup && !empty($children)) {
			echo '<li class="has-dropdown">';
			// Кнопка/ссылка с иконкой стрелки
			echo '<a href="' . htmlspecialchars($href) . '" class="dropdown-toggle"' . $activeAttr . '>';
			echo htmlspecialchars($label);
			echo ' <span class="menu-arrow"></span>';
			echo '</a>';
			// Выпадающее меню
			echo '<ul class="dropdown">';
			foreach ($children as $child) {
				$chHref = $child['href'] ?? '#';
				$chLabel = $child['label'] ?? '';
				echo '<li><a href="' . htmlspecialchars($chHref) . '">' . htmlspecialchars($chLabel) . '</a></li>';
			}
			echo '</ul>';
			echo '</li>';
		} else {
			echo '<li><a href="' . htmlspecialchars($href) . '"' . $activeAttr . '>' . htmlspecialchars($label) . '</a></li>';
		}
	}
}
?>

