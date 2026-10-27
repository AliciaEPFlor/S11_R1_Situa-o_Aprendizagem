<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = (string)($_POST['senha'] ?? '');
    if ($email) {
        $usuario = consulta_user($conexao, $email);
        if ($usuario && (password_verify($senha, $usuario['senha']) || hash_equals((string)$usuario['senha'], $senha))) {
            // Compatibilidade com usuários antigos que tinham senha sem hash.
            if (!password_verify($senha, $usuario['senha'])) {
                $hash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt = $conexao->prepare('UPDATE usuario SET senha = :senha WHERE id = :id');
                $stmt->execute([':senha' => $hash, ':id' => $usuario['id']]);
            }
            session_regenerate_id(true);
            $_SESSION['id'] = $usuario['id'];
            header('Location: ' . APP_BASE_URL . '/index.php');
            exit;
        }
    }
    $erro = 'E-mail ou senha inválidos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= APP_BASE_URL ?>/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <h1>Faça login</h1>
    <form method="post">
        <label for="email">E-mail:</label><br>
        <input type="email" name="email" id="email" required><br>
        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha" required><br>
        <input type="submit" value="Entrar">
        <?php if ($erro): ?><p class="notice"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
    </form>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
