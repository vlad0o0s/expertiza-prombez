-- Создание таблицы для статей экспертизы (отдельно от обычных статей)
-- ВАЖНО: Сначала должна быть создана таблица article_categories!
CREATE TABLE IF NOT EXISTS `expertiza_articles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `category_id` INT DEFAULT NULL,
    `hero_content` LONGTEXT NOT NULL,
    `features_content` LONGTEXT NOT NULL,
    `hero_image` VARCHAR(255) DEFAULT NULL,
    `published` BOOLEAN DEFAULT TRUE,
    `published_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `article_categories`(`id`) ON DELETE SET NULL,
    KEY `category_id` (`category_id`),
    KEY `published` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

