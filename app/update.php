<?php require_once __DIR__ . '/../includes/config.php'; ?>
<?php require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar</title>
    <link rel="stylesheet" href="<?= APP_BASE_URL ?>/css/style.css">

</head>
<body>

    <h1>Atualizar Informações</h1>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    

    <form action="" method="post">
        <label for="id">ID: </label>
        <input type="number" name="id" id="id"><br>
        <br>
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome"><br>

        <label for="turma">Turma</label>
        <input type="text" name="turma" id="turma"><br> 

        <label for="nasc">Nascimento: </label>
        <input type="date" name="nasc" id="nasc"><br>
        <br>
        <label for="ativo">Ativo?</label>
        <input type="radio" name="ativo" id="ativo" value="true">
        <label for="sim">Está Ativo</label>

        <input type="radio" name="ativo" id="ativo" value="false">
        <label for="nao">Não Está Ativo</label><br>
        
        <br>
        <input type="submit" value="Atualizar">
        <input type="reset" value="Limpar">
    </form>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        atualizar($conexao, $_POST['id'], $_POST['nome'], $_POST['turma'], $_POST['nasc'], $_POST['ativo']);
    }

    include __DIR__ . '/../includes/footer.php'; 
    ?>
</body>
</html>
<?php


?>