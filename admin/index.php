<?php
/**
 * Редирект на dashboard или login
 */

require_once __DIR__ . '/../includes/admin-auth.php';

if (isAdminLoggedIn()) {
    header('Location: /admin/dashboard');
} else {
    header('Location: /admin/login');
}
exit;

