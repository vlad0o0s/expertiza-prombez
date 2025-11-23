-- Создание таблицы для категорий услуг
CREATE TABLE IF NOT EXISTS `services_categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description` TEXT DEFAULT NULL,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY `sort_order` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Вставка начальных категорий услуг (9 основных категорий)
-- Используем INSERT IGNORE, чтобы избежать ошибки при повторном выполнении скрипта
INSERT IGNORE INTO `services_categories` (`name`, `slug`, `description`, `sort_order`) VALUES
('Лаборатория неразрушающего контроля', 'laboratoriya-nerazrushayushchego-kontrolya', 'Услуги лаборатории неразрушающего контроля', 1),
('Химическая лаборатория', 'himicheskaya-laboratoriya', 'Услуги химической лаборатории', 2),
('Выезд эксперта', 'vyezd-eksperta', 'Выездные услуги эксперта', 3),
('Участие в комиссии при расследовании аварий и инцидентов', 'uchastie-v-komissii-pri-rassledovanii-avariy-i-incidentov', 'Участие в комиссиях по расследованию', 4),
('Образование и повышение квалификации', 'obrazovanie-i-povyshenie-kvalifikacii', 'Образовательные услуги', 5),
('Аудит СУОТ и внедрение', 'audit-suot-i-vnedrenie', 'Аудит системы управления охраной труда', 6),
('Экологическая экспертиза и аудит', 'ekologicheskaya-ekspertiza-i-audit', 'Экологическая экспертиза и аудит', 7),
('Пожарная безопасность', 'pozharnaya-bezopasnost', 'Услуги по пожарной безопасности', 8),
('Экспертиза промышленной безопасности', 'ekspertiza-promyshlennoy-bezopasnosti', 'Экспертиза промышленной безопасности объектов', 9);

-- Создание таблицы для записей услуг
CREATE TABLE IF NOT EXISTS `services` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `category_id` INT NOT NULL,
    `description` TEXT DEFAULT NULL,
    `content` LONGTEXT DEFAULT NULL,
    `hero_image` VARCHAR(500) DEFAULT NULL,
    `equipment_list` TEXT DEFAULT NULL COMMENT 'Список оборудования (для лаборатории)',
    `price` VARCHAR(100) DEFAULT NULL COMMENT 'Стоимость экспертизы',
    `term` VARCHAR(100) DEFAULT NULL COMMENT 'Сроки проведения',
    `published` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `services_categories`(`id`) ON DELETE RESTRICT,
    KEY `category_id` (`category_id`),
    KEY `published` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
