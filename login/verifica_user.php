<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/config.php';

if (empty($_SESSION['id'])) {
    header('Location: ' . APP_BASE_URL . '/login/login.php');
    exit;
}
?>
