<?php
session_start();
include_once '../models/config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../views/form_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "❌ ID da consulta não especificado.";
    exit();
}

$id = $_GET['id'];

// Cancelar consulta
$sql = "DELETE FROM consultas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$mensagem = "";
if ($stmt->execute()) {
    $mensagem = "✅ Consulta cancelada com sucesso.";
} else {
    $mensagem = "❌ Erro ao cancelar a consulta.";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cancelar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>❌ Cancelamento de Consulta</h2>
    <div class="alert alert-info"><?= $mensagem ?></div>
    <a href="../views/historico_consultas.php" class="btn btn-secondary">← Voltar ao Histórico</a>
</div>
</body>
</html>

