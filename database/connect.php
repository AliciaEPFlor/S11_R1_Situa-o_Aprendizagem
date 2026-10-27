<?php
// Preencha com os dados reais do seu servidor PostgreSQL.
$host = 'localhost';
$dbname = 'escola';
$user = 'escola';
$pass = 'SUA_SENHA_AQUI';

try {
    $conexao = new PDO(
        "pgsql:host={$host};dbname={$dbname}",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados. Confira as configurações em database/connect.php e se a extensão pdo_pgsql está habilitada.');
}
