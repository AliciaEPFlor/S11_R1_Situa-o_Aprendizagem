<?php require_once __DIR__ . '/../includes/config.php'; ?>
<?php require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select</title>
    <link rel="stylesheet" href="<?= APP_BASE_URL ?>/css/style.css">

</head>

<body>
    <br>
    <h1>Relatório de Alunos</h1>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <main>
        <div style="width: 50%; margin:auto; text-align:center; border:1px solid black; border-radius:5px;">
        <h3>Lista Completa de Alunos</h3>
        <?php
        listar($conexao);
        ?>
        </div>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
