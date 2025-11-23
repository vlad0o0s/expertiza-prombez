-- Обновление таблицы services: добавление полей для лаборатории
-- Выполните этот скрипт, если таблица services уже существует

ALTER TABLE `services` 
ADD COLUMN IF NOT EXISTS `equipment_list` TEXT DEFAULT NULL COMMENT 'Список оборудования (для лаборатории)' AFTER `hero_image`,
ADD COLUMN IF NOT EXISTS `price` VARCHAR(100) DEFAULT NULL COMMENT 'Стоимость экспертизы' AFTER `equipment_list`,
ADD COLUMN IF NOT EXISTS `term` VARCHAR(100) DEFAULT NULL COMMENT 'Сроки проведения' AFTER `price`;

