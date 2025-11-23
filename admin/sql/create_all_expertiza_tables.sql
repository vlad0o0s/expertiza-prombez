-- Создание всех таблиц для статей экспертизы
-- ВАЖНО: Выполняйте запросы в указанном порядке!

-- 1. Сначала создаем таблицу категорий
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

-- 2. Затем создаем таблицу статей (с внешним ключом на категории)
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

-- 3. Вставляем все категории из структуры

-- ============================================
-- КАТЕГОРИЯ 1 УРОВНЯ: Экспертиза технических устройств
-- ============================================
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Экспертиза технических устройств', 'ekspertiza-tehnicheskih-ustroystv', NULL, 1, 'Категория 1 уровня: Экспертиза технических устройств', 1);
SET @parent_1_tehnicheskie_ustroystva = LAST_INSERT_ID();

-- Категории 2 уровня под "Экспертиза технических устройств"
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Экспертиза кранов и подъемных сооружений', 'ekspertiza-kranov-i-podemnyh-sooruzheniy', @parent_1_tehnicheskie_ustroystva, 2, 'Категория 2 уровня', 1),
('Экспертиза котлов и энергетических установок', 'ekspertiza-kotlov-i-energeticheskih-ustanovok', @parent_1_tehnicheskie_ustroystva, 2, 'Категория 2 уровня', 2),
('Экспертиза трубопроводов', 'ekspertiza-truboprovodov', @parent_1_tehnicheskie_ustroystva, 2, 'Категория 2 уровня', 3),
('Экспертиза резервуаров и емкостного оборудования', 'ekspertiza-rezervuarov-i-emkostnogo-oborudovaniya', @parent_1_tehnicheskie_ustroystva, 2, 'Категория 2 уровня', 4),
('Экспертиза промышленных холодильных установок', 'ekspertiza-promyshlennyh-holodilnyh-ustanovok', @parent_1_tehnicheskie_ustroystva, 2, 'Категория 2 уровня', 5),
('Экспертиза тепловых сетей', 'ekspertiza-teplovyh-setey', @parent_1_tehnicheskie_ustroystva, 2, 'Категория 2 уровня', 6),
('Экспертиза газоиспользующего оборудования', 'ekspertiza-gazoispolzuyushchego-oborudovaniya', @parent_1_tehnicheskie_ustroystva, 2, 'Категория 2 уровня', 7);

-- Категории 3 уровня под "Экспертиза трубопроводов"
SET @parent_2_truboprovody = (SELECT id FROM `article_categories` WHERE slug = 'ekspertiza-truboprovodov' LIMIT 1);
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Газопроводы', 'gazoprovody', @parent_2_truboprovody, 3, 'Категория 3 уровня', 1),
('Нефтепроводы', 'nefteprovody', @parent_2_truboprovody, 3, 'Категория 3 уровня', 2),
('Продуктопроводы', 'produktoprovody', @parent_2_truboprovody, 3, 'Категория 3 уровня', 3),
('Аммиакопроводы', 'ammiakoprovody', @parent_2_truboprovody, 3, 'Категория 3 уровня', 4);

-- ============================================
-- КАТЕГОРИЯ 1 УРОВНЯ: Здания и сооружения
-- ============================================
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Здания и сооружения', 'zdaniya-i-sooruzheniya', NULL, 1, 'Категория 1 уровня: Здания и сооружения', 2);
SET @parent_1_zdaniya = LAST_INSERT_ID();

-- Категории 2 уровня под "Здания и сооружения"
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Экспертиза производственных зданий', 'ekspertiza-proizvodstvennyh-zdaniy', @parent_1_zdaniya, 2, 'Категория 2 уровня', 1),
('Экспертиза инженерных и технологических сооружений', 'ekspertiza-inzhenernyh-i-tehnologicheskih-sooruzheniy', @parent_1_zdaniya, 2, 'Категория 2 уровня', 2),
('Экспертиза объектов хранения нефти и газа', 'ekspertiza-obektov-hraneniya-nefti-i-gaza', @parent_1_zdaniya, 2, 'Категория 2 уровня', 3),
('Экспертиза подземных сооружений и тоннелей', 'ekspertiza-podzemnyh-sooruzheniy-i-tonneley', @parent_1_zdaniya, 2, 'Категория 2 уровня', 4),
('Экспертиза объектов угольной и горнорудной промышленности', 'ekspertiza-obektov-ugolnoy-i-gornorudnoy-promyshlennosti', @parent_1_zdaniya, 2, 'Категория 2 уровня', 5);

-- ============================================
-- КАТЕГОРИЯ 1 УРОВНЯ: Экспертиза промышленной безопасности проектной документации
-- ============================================
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Экспертиза промышленной безопасности проектной документации', 'ekspertiza-promyshlennoy-bezopasnosti-proektnoy-dokumentacii', NULL, 1, 'Категория 1 уровня: Экспертиза промышленной безопасности проектной документации', 3);

-- ============================================
-- КАТЕГОРИЯ 1 УРОВНЯ: Экспертиза промышленной безопасности декларации промышленной безопасности
-- ============================================
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Экспертиза промышленной безопасности декларации промышленной безопасности', 'ekspertiza-promyshlennoy-bezopasnosti-deklaracii-promyshlennoy-bezopasnosti', NULL, 1, 'Категория 1 уровня: Экспертиза промышленной безопасности декларации промышленной безопасности', 4);

-- ============================================
-- КАТЕГОРИЯ 1 УРОВНЯ: Экспертиза обоснования безопасности опасных производственных объектов (ОПО)
-- ============================================
INSERT INTO `article_categories` (`name`, `slug`, `parent_id`, `level`, `description`, `sort_order`) VALUES
('Экспертиза обоснования безопасности опасных производственных объектов (ОПО)', 'ekspertiza-obosnovaniya-bezopasnosti-opasnyh-proizvodstvennyh-obektov-opo', NULL, 1, 'Категория 1 уровня: Экспертиза обоснования безопасности опасных производственных объектов (ОПО)', 5);

