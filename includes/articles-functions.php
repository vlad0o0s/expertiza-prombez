<?php
/**
 * Функции для работы со статьями
 */

require_once __DIR__ . '/../config/database.php';

/**
 * Получить статью по slug
 */
function getArticleBySlug($slug) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM articles WHERE slug = ? AND published = 1");
            $stmt->execute([$slug]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $retryCount++;
            
            // Если это ошибка "MySQL server has gone away" и есть попытки
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    // Принудительно переподключаемся
                    $pdo = getDBConnection(true);
                    usleep(100000); // Небольшая задержка перед повтором (0.1 секунды)
                    continue;
                }
            }
            
            // Если это другая ошибка или закончились попытки
            error_log("Error in getArticleBySlug: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить список статей с фильтрацией и пагинацией
 */
function getArticles($category = null, $page = 1, $perPage = 12) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $offset = ($page - 1) * $perPage;
            
            $where = "WHERE published = 1";
            $params = [];
            
            if ($category && $category !== 'all') {
                $where .= " AND category = ?";
                $params[] = $category;
            }
            
            // Получаем общее количество статей
            $countStmt = $pdo->prepare("SELECT COUNT(*) FROM articles $where");
            $countStmt->execute($params);
            $total = $countStmt->fetchColumn();
            
            // Получаем статьи
            // Для MySQL нужно использовать intval для LIMIT и OFFSET
            $sql = "SELECT * FROM articles $where ORDER BY published_at DESC, created_at DESC LIMIT " . intval($perPage) . " OFFSET " . intval($offset);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $articles = $stmt->fetchAll();
            
            return [
                'articles' => $articles,
                'total' => $total,
                'page' => $page,
                'perPage' => $perPage,
                'totalPages' => ceil($total / $perPage)
            ];
        } catch (PDOException $e) {
            $retryCount++;
            
            // Если это ошибка "MySQL server has gone away" и есть попытки
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    // Принудительно переподключаемся
                    $pdo = getDBConnection(true);
                    usleep(100000); // Небольшая задержка перед повтором (0.1 секунды)
                    continue;
                }
            }
            
            // Если это другая ошибка или закончились попытки
            error_log("Error in getArticles: " . $e->getMessage());
            throw $e;
        }
    }
    
    // Если все попытки исчерпаны
    throw new Exception("Не удалось выполнить запрос после нескольких попыток");
}

/**
 * Получить последние N статей (исключая текущую)
 */
function getLatestArticles($excludeId = null, $limit = 3) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            
            if ($excludeId) {
                $stmt = $pdo->prepare("SELECT * FROM articles WHERE published = 1 AND id != ? ORDER BY published_at DESC, created_at DESC LIMIT ?");
                $stmt->execute([$excludeId, $limit]);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM articles WHERE published = 1 ORDER BY published_at DESC, created_at DESC LIMIT ?");
                $stmt->execute([$limit]);
            }
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            // Если это ошибка "MySQL server has gone away" и есть попытки
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    // Принудительно переподключаемся
                    $pdo = getDBConnection(true);
                    usleep(100000); // Небольшая задержка перед повтором (0.1 секунды)
                    continue;
                }
            }
            
            // Если это другая ошибка или закончились попытки
            error_log("Error in getLatestArticles: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить категории статей
 */
function getArticleCategories() {
    return [
        'all' => 'ВСЕ',
        'metallurgy' => 'ЭПБ МАТАЛЛУРГИЧЕСКИХ ПРОИЗВОДСТВ',
        'energy' => 'ЭПБ ЭНЕРГЕТИЧЕСКИХ УСТАНОВОК И КОТЛОВ',
        'coal' => 'ЭПБ ОБЪЕКТОВ УГОЛЬНОЙ ПРОМЫШЛЕННОСТИ',
        'gas' => 'ЭПБ ГАЗОВОГО ОБОРУДОВАНИЯ И ГАЗОПРОВОДОВ',
        'flammable' => 'ЭПБ ОБЪЕКТОВ С ГОРЮЧИМИ ЖИДКОСТЯМИ',
        'explosive' => 'ЭПБ ОБЪЕКТОВ СО ВЗЫВЧАТАМИ ВЕЩЕСТВАМИ',
        'hazardous' => 'ЭПБ ОБЪЕКТОВ С ОПАСНЫМИ ВЕЩЕСТВАМИ',
        'pressure' => 'ЭПБ ОБОРУДОВАНИЯ, РАБОТАЮЩЕГО ПОД ДАВЛЕНИЕМ',
        'lifting' => 'ЭПБ ПОДЪЕМНЫХ СООРУЖЕНИЙ И КРАНОВ',
        'explosive-works' => 'ЭПБ ВЗРЫВНЫХ РАБОТ И МАТЕРИАЛОВ',
        'oil-refining' => 'ЭПБ НЕФТЕПЕРЕРАБАТЫВАЮЩИХ И НЕФТЕХИМИЧЕСКИХ ОБЪЕКТОВ',
        'mining' => 'ЭПБ ГОРНОДОБЫВАЮЩИХ ОБЪЕКТОВ',
        'underground' => 'ЭПБ ПОДЗЕМНЫХ ОБЪЕКТОВ И ТОННЕЛЕЙ',
        'pipelines' => 'ЭПБ ТРУБО- ГАЗО- НЕФТЕ-ПРОДУКТО- АММИАКО- ПРОВОДОВ',
        'storage' => 'ЭПБ ОБЪЕКТОВ ХРАНЕНИЯ НЕФТИ И ГАЗА'
    ];
}

