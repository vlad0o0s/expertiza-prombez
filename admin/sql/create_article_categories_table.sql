-- Создание таблицы для категорий статей (иерархическая структура)
CREATE TABLE IF NOT EXISTS `article_categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `parent_id` INT DEFAULT NULL,
    `level` TINYINT NOT NULL DEFAULT 1 COMMENT 'Уровень категории: 1, 2, 3',
    `description` TEXT DEFAULT NULL,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`parent_id`) REFERENCES `article_categories`(`id`) ON DELETE CASCADE,
    KEY `parent_id` (`parent_id`),
    KEY `level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

