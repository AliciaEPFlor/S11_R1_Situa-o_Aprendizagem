<?php
require_once __DIR__ . '/../database/connect.php';

function cadastrar($conexao, $nome, $nasc, $turma, $ativo) 
{
    $sql = "INSERT INTO alunos (nome,nasc,turma,ativo) VALUES (:nome,:nasc,:turma,:ativo)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome",$nome);
    $stmt->bindParam(":nasc",$nasc);
    $stmt->bindParam(":turma",$turma);
    $stmt->bindParam(":ativo",$ativo);

    $stmt->execute();
    echo "Aluno Cadastrado com Sucesso!";
}

function deletar($conexao, $id) 
{

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $sql = "DELETE FROM alunos WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "Registro ". $id ." deletado.";
    } else {
        echo "Insira o ID para apagar. <br>";
    }
}

function listar($conexao) {

            $sql = "SELECT * FROM alunos LIMIT 10";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            
            $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($alunos as $aluno) {
                echo "<hr>";
                echo "ID: {$aluno['id']} <br>";
                echo "Nome: {$aluno['nome']} <br>";
                echo "Nascimento: {$aluno['nasc']} <br>";
                echo "Turma: {$aluno['turma']} <br>";
                echo "Ativo: {$aluno['ativo']} <br>";
            }
}

function consultar($conexao, $id){

    $sql = "SELECT nome, nasc, turma, ativo
            FROM alunos
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt-> bindParam(":id", $id);
    $stmt->execute();

    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$aluno) {
        echo '<p class="notice">Nenhum aluno encontrado com esse ID.</p>';
        return;
    }

    echo '<section class="card">';
    echo 'Aluno: ' . htmlspecialchars((string)$aluno['nome'], ENT_QUOTES, 'UTF-8') . '<br>';
    echo 'Turma: ' . htmlspecialchars((string)$aluno['turma'], ENT_QUOTES, 'UTF-8') . '<br>';
    echo 'Nascimento: ' . htmlspecialchars((string)$aluno['nasc'], ENT_QUOTES, 'UTF-8') . '<br>';
    echo 'Ativo: ' . htmlspecialchars((string)$aluno['ativo'], ENT_QUOTES, 'UTF-8') . '<br>';
    echo '</section>';

}

function atualizar($conexao,$id,$nome,$turma,$nasc,$ativo) {

    $sql = "UPDATE alunos SET nome = :nome, turma = :turma, nasc = :nasc, ativo = :ativo WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":turma", $turma);
    $stmt->bindParam(":nasc", $nasc);
    $stmt->bindParam(":ativo", $ativo);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

}

// Funções para sistema de login
    function cadastrar_user($conexao, $email, $senha) 
{
    $sql = "INSERT INTO usuario (email,senha) VALUES (:email,:senha)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":email",$email);
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt->bindParam(":senha", $senhaHash);

    $stmt->execute();
    echo "Usuário Cadastrado com Sucesso!";
}

function consulta_user($conexao, $email){

    $sql = "SELECT id, email, senha
            FROM usuario
            WHERE email = :email";

    $stmt = $conexao->prepare($sql);
    $stmt-> bindParam(":email", $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return $usuario;
}


    ?>

