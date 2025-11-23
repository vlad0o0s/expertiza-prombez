<?php
/**
 * Функции для работы со статьями экспертизы (с категориями)
 */

require_once __DIR__ . '/../config/database.php';

/**
 * Получить статью по slug
 */
function getExpertizaArticleBySlug($slug) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("
                SELECT ea.*, ac.name as category_name, ac.slug as category_slug, ac.level as category_level
                FROM expertiza_articles ea
                LEFT JOIN article_categories ac ON ea.category_id = ac.id
                WHERE ea.slug = ? AND ea.published = 1
            ");
            $stmt->execute([$slug]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getExpertizaArticleBySlug: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить список статей экспертизы
 */
function getExpertizaArticlesList($categoryId = null, $limit = null) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            
            $sql = "
                SELECT ea.*, ac.name as category_name, ac.slug as category_slug, ac.level as category_level
                FROM expertiza_articles ea
                LEFT JOIN article_categories ac ON ea.category_id = ac.id
                WHERE ea.published = 1
            ";
            
            $params = [];
            if ($categoryId) {
                $sql .= " AND ea.category_id = ?";
                $params[] = $categoryId;
            }
            
            $sql .= " ORDER BY ea.published_at DESC, ea.created_at DESC";
            
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getExpertizaArticlesList: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить все статьи экспертизы (для админки)
 */
function getAllExpertizaArticles() {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("
                SELECT ea.*, ac.name as category_name
                FROM expertiza_articles ea
                LEFT JOIN article_categories ac ON ea.category_id = ac.id
                ORDER BY ea.published_at DESC, ea.created_at DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getAllExpertizaArticles: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить статью по ID (для админки)
 */
function getExpertizaArticleById($id) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("
                SELECT ea.*, ac.name as category_name
                FROM expertiza_articles ea
                LEFT JOIN article_categories ac ON ea.category_id = ac.id
                WHERE ea.id = ?
            ");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getExpertizaArticleById: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить все категории статей
 */
function getAllArticleCategories() {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM article_categories ORDER BY level, sort_order, name");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getAllArticleCategories: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить категорию по ID
 */
function getArticleCategoryById($id) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM article_categories WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getArticleCategoryById: " . $e->getMessage());
            throw $e;
        }
    }
    
    return false;
}

/**
 * Получить категории по уровню
 */
function getArticleCategoriesByLevel($level) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM article_categories WHERE level = ? ORDER BY sort_order, name");
            $stmt->execute([$level]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getArticleCategoriesByLevel: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить дочерние категории
 */
function getChildArticleCategories($parentId) {
    $maxRetries = 3;
    $retryCount = 0;
    
    while ($retryCount < $maxRetries) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM article_categories WHERE parent_id = ? ORDER BY sort_order, name");
            $stmt->execute([$parentId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $retryCount++;
            
            if (strpos($e->getMessage(), '2006') !== false || strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                if ($retryCount < $maxRetries) {
                    $pdo = getDBConnection(true);
                    usleep(100000);
                    continue;
                }
            }
            
            error_log("Error in getChildArticleCategories: " . $e->getMessage());
            throw $e;
        }
    }
    
    return [];
}

/**
 * Получить полный путь категории (хлебные крошки)
 */
function getArticleCategoryPath($categoryId) {
    $path = [];
    $category = getArticleCategoryById($categoryId);
    
    while ($category) {
        array_unshift($path, $category);
        if ($category['parent_id']) {
            $category = getArticleCategoryById($category['parent_id']);
        } else {
            break;
        }
    }
    
    return $path;
}

