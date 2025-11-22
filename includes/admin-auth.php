<?php
/**
 * Функции для работы с авторизацией администратора
 */

session_start();

/**
 * Проверка авторизации администратора
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

/**
 * Получение ID текущего администратора
 */
function getAdminId() {
    return $_SESSION['admin_id'] ?? null;
}

/**
 * Получение имени текущего администратора
 */
function getAdminUsername() {
    return $_SESSION['admin_username'] ?? null;
}

/**
 * Требовать авторизацию (редирект на login если не авторизован)
 */
function requireAdminAuth() {
    if (!isAdminLoggedIn()) {
        header('Location: /admin/login');
        exit;
    }
}

/**
 * Авторизация администратора
 */
function loginAdmin($username, $password) {
    require_once __DIR__ . '/../config/database.php';
    
    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT id, username, email, password FROM admins WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_email'] = $admin['email'];
            
            // Обновляем время последнего входа
            $updateStmt = $pdo->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
            $updateStmt->execute([$admin['id']]);
            
            return true;
        }
        
        return false;
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}

/**
 * Выход из системы
 */
function logoutAdmin() {
    session_unset();
    session_destroy();
    header('Location: /admin/login');
    exit;
}

