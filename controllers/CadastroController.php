<?php
require_once('../models/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'cadastrar') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha, $tipo);

    if ($stmt->execute()) {
        header("Location: ../views/home.php?mensagem=sucesso");
    } else {
        header("Location: ../views/cadastro.php?mensagem=erro");
    }

    $stmt->close();
    $conexao->close();
    exit();
}
