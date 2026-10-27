<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION = [];
session_destroy();
require_once __DIR__ . '/../includes/config.php';
header('Location: ' . APP_BASE_URL . '/index.php');
exit;
