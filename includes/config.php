<?php
// Descobre automaticamente a URL base do projeto, mesmo se a pasta tiver outro nome.
$scriptDir = str_replace('\\\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
if (preg_match('~/(app|login)$~', $scriptDir)) {
    $scriptDir = dirname($scriptDir);
}
define('APP_BASE_URL', rtrim($scriptDir, '/') === '.' ? '' : rtrim($scriptDir, '/'));
?>
