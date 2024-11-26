<?php
// Habilita exibição de erros para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclui o arquivo de conexão
require_once __DIR__ . '/../models/conexao.php';

// Verifica se a conexão foi estabelecida corretamente
if (!$conexao) {
    die("Erro: Conexão com o banco de dados não foi estabelecida.");
}

// 1. Ação de Cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
    // Receber os dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $tipo = trim($_POST['tipo']);

    // Validar os campos
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($tipo)) {
        // Criptografar a senha antes de salvar
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Prepara a consulta SQL
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $nome, $email, $senhaHash, $tipo);

            if ($stmt->execute()) {
                header("Location: ../views/lista_usuarios.php?msg=sucesso");
                exit;
            } else {
                die("Erro ao inserir usuário: " . $stmt->error);
            }

            $stmt->close();
        } else {
            die("Erro na preparação do SQL: " . $conexao->error);
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

// 2. Ação de Edição
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'editar') {
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $tipo = trim($_POST['tipo']);

    // Atualizar os dados (sem alterar a senha)
    $sql = "UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssi", $nome, $email, $tipo, $id);

        if ($stmt->execute()) {
            header("Location: ../views/lista_usuarios.php?msg=editado");
            exit;
        } else {
            die("Erro ao editar usuário: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Erro na preparação do SQL: " . $conexao->error);
    }
}

// 3. Ação de Exclusão
if (isset($_GET['acao'], $_GET['id']) && $_GET['acao'] === 'excluir' && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: ../views/lista_usuarios.php?msg=excluido");
            exit;
        } else {
            die("Erro ao excluir usuário: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Erro na preparação do SQL: " . $conexao->error);
    }
}

// 4. Redireciona para a lista se nenhuma ação for detectada
header("Location: ../views/lista_usuarios.php");
exit;
