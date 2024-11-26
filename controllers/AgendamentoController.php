<?php
require_once('../models/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'agendar') {
    $especialidade = $_POST['especialidade'];
    $data = $_POST['data'];

    $sql = "INSERT INTO consultas (especialidade, data) VALUES (?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $especialidade, $data);

    if ($stmt->execute()) {
        header("Location: ../views/historico_consultas.php?mensagem=sucesso");
    } else {
        header("Location: ../views/agendamento.php?mensagem=erro");
    }

    $stmt->close();
    $conexao->close();
    exit();
}
